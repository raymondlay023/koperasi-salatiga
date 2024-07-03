<?php

namespace App\Livewire;

use App\Models\KoperasiMember;
use App\Models\Pinjaman;
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

final class PinjamanTable extends PowerGridComponent
{
    use WithExport;

    public $memberId = 0;

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
        return Pinjaman::query()
        ->when($this->memberId,
            fn($builder) => $builder->whereHas(
                'memberpinjaman',
                fn($builder) => $builder->where('member_id', $this->memberId)
            )
            ->with(['memberpinjaman'])
        );
    }

    public function relationSearch(): array
    {
        return [
            'memberpinjaman' => [
                'nama_anggota',
            ]
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('doc_num')
            ->add('member_name', fn(Pinjaman $model) => $model->memberpinjaman->nama_anggota)
            ->add('jumlah_pinjaman', fn(Pinjaman $model) => 'Rp ' . number_format($model->jumlah_pinjaman, 0, ',', '.'))
            ->add('start_date_formatted', fn (Pinjaman $model) => Carbon::parse($model->start_date)->format('d/m/Y'))
            ->add('end_date_formatted', fn (Pinjaman $model) => $model->end_date ? Carbon::parse($model->end_date)->format('d/m/Y') : null)
            ->add('total_bayar', fn(Pinjaman $model) => 'Rp ' . number_format($model->total_bayar, 0, ',', '.'))
            ->add('tenor')
            ->add('bayar_perbulan', fn(Pinjaman $model) => 'Rp ' . number_format($model->bayar_perbulan, 0, ',', '.'))
            ->add('is_lunas', fn(Pinjaman $model) => $model->is_lunas ? 'Lunas' : 'Belum Lunas')
            ->add('tenor_counter', fn(Pinjaman $model) => $model->tenor_counter == null ? 'Belum ada pembayaran' : $model->tenor_counter)
            ->add('created_at_formatted', fn (Pinjaman $model) => Carbon::parse($model->created_at)->timezone('Asia/Jakarta')->format("d/m/Y (h:i:s)"));
    }

    public function columns(): array
    {
        return [
            Column::make('Document No', 'doc_num'),
            Column::make('Nama Anggota', 'member_name')
                ->searchable(),

            Column::make('Jumlah pinjaman', 'jumlah_pinjaman')
                ->sortable()
                ->searchable(),

            Column::make('Start date', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('End date', 'end_date_formatted', 'end_date')
                ->sortable(),

            Column::make('Total bayar', 'total_bayar')
                ->sortable()
                ->searchable(),

            Column::make('Tenor', 'tenor')
                ->sortable()
                ->searchable(),

            Column::make('Bayar perbulan', 'bayar_perbulan')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'is_lunas')
                ->sortable()
                ->searchable(),

            Column::make('Tenor counter', 'tenor_counter')
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
            Filter::datepicker('start_date'),
            Filter::datepicker('end_date'),
        ];
    }

    public function actionsFromView($row) : View
    {
        $members = KoperasiMember::all();
        return view('partials.pinjaman-action-view', ['row' => $row, 'members' => $members]);
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert('.$rowId.')');
    // }

    // public function actions(Pinjaman $row): array
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
