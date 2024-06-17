<?php

namespace App\Livewire;

use App\Enums\TipeBarangEnum;
use App\Models\Inventory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

final class InventoryTable extends PowerGridComponent
{
    public int $itemTypeId = 0;
    public bool $deferLoading = true;
    public string $loadingComponent = 'components.my-custom-loading';

    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
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
        return Inventory::query()
            ->when($this->itemTypeId,
            fn($builder) => $builder->whereHas(
                'item',
                fn($builder) => $builder->where('item_type_id', $this->itemTypeId)
            )
            ->with(['type'])
        );
    }

    public function relationSearch(): array
    {
        return [
            'type' => [
                'name',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('item_name')
            ->add('item_type', fn ($inventory) => e($inventory->type->name))
            ->add('stock')
            ->add('created_at_formatted', fn ($dish) => Carbon::parse($dish->created_at)->format('d-m-Y'));;
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Item name', 'item_name')
                ->sortable()
                ->searchable(),

            Column::make('Tipe barang', 'item_type')
                ->searchable(),

            Column::make('Stock', 'stock')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->visibleInExport(false),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::enumSelect('item_type', 'inventories.item_type_id')
                ->dataSource(TipeBarangEnum::cases())
                ->optionLabel('inventories.item_type_id'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Inventory $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    // public function hydrate(): void
    // {
    //     sleep(1);  // ⏳ Purposefully slow down the Component loading for demonstration purposes.
    // }

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
