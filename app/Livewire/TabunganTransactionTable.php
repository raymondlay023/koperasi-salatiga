<?php

namespace App\Livewire;

use App\Models\TabunganTransaction;
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

final class TabunganTransactionTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return TabunganTransaction::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('doc_num')
            ->add('nama_anggota', fn(TabunganTransaction $model) => $model->Tabunganlist->membertabungan->nama_anggota)
            ->add('setor', fn(TabunganTransaction $model) => 'Rp. ' . number_format($model->setor, 0, ',', '.'))
            ->add('tarikan', fn(TabunganTransaction $model) => 'Rp. ' . number_format($model->tarikan, 0, ',', '.'))
            ->add('setor_date_formatted', fn (TabunganTransaction $model) => Carbon::parse($model->setor_date)->format('d/m/Y'))
            ->add('remark')
            ->add('created_at_formatted', fn(TabunganTransaction $model) => Carbon::parse($model->created_at)->format("d/m/Y (h:i:s)"));
    }

    public function columns(): array
    {
        return [
            Column::make('Document No', 'doc_num'),
            Column::make('Tabungan id', 'nama_anggota')
                ->sortable()
                ->searchable(),

            Column::make('Jumlah Setor', 'setor')
                ->sortable()
                ->searchable(),

            Column::make('Jumlah Tarikan', 'tarikan'),

            Column::make('Tanggal Transaksi', 'setor_date_formatted', 'setor_date')
                ->sortable(),

            Column::make('Remark', 'remark')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('setor_date'),
        ];
    }

    public function actionsFromView($row) : View
    {
        // $members = KoperasiMember::all();
        return view('partials.tabungan-transaction-action-view', ['row' => $row]);
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert('.$rowId.')');
    // }

    // public function actions(TabunganTransaction $row): array
    // {
    //     return [
    //         Button::add('edit')
    //             ->slot('Edit: '.$row->id)
    //             ->id()
    //             ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
    //             ->dispatch('edit', ['rowId' => $row->id])
    //     ];
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
