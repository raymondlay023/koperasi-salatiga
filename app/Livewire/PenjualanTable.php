<?php

namespace App\Livewire;

use App\Models\ItemType;
use App\Models\Penjualan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class PenjualanTable extends PowerGridComponent
{
    public int $itemId = 0;
    public bool $deferLoading = true;
    public string $loadingComponent = 'components.my-custom-loading';

    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->withoutLoading()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Penjualan::query()
            ->when($this->itemId,
            fn($builder) => $builder->whereHas(
                'inventory',
                fn($builder) => $builder->where('item_id', $this->itemId)
            )->with(['inventory'])
        );
    }

    public function relationSearch(): array
    {
        return [
            'inventory' => [
                'item_name',
            ]
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('item_name', fn($penjualan) => e($penjualan->inventory->item_name))
            ->add('jumlah_jual')
            ->add('harga_jual')
            ->add('customer')
            ->add('status')
            ->add('tanggal_jual_formatted', fn (Penjualan $model) => Carbon::parse($model->tanggal_jual)->format('d/m/Y'))
            ->add('created_at_formatted', fn(Penjualan $model) => Carbon::parse($model->created_at)->format('d/m/Y h:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Item name', 'item_name')
                ->searchable(),

            Column::make('Jumlah jual', 'jumlah_jual')
                ->sortable()
                ->searchable(),

            Column::make('Harga jual', 'harga_jual')
                ->sortable()
                ->searchable(),

            Column::make('Customer', 'customer')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Tanggal jual', 'tanggal_jual_formatted', 'tanggal_jual')
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('tanggal_jual'),
        ];
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert('.$rowId.')');
    // }

    // public function actions(Penjualan $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: '.$row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
    // }

    public function actionsFromView($row) : View
    {
        $types = ItemType::all();
        return view('partials.penjualan-action-view', ['row' => $row, 'types' => $types]);
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
