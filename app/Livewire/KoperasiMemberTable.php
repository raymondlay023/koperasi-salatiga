<?php

namespace App\Livewire;

use App\Models\KoperasiMember;
use App\Models\MemberType;
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

final class KoperasiMemberTable extends PowerGridComponent
{
    public int $typeId = 0;
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
        return KoperasiMember::query()
            ->when($this->typeId,
                fn($builder) => $builder
                    ->whereHas('type', fn($builder) => $builder->where('type_id', $this->typeId)
                    )->with(['type'])
            );
    }

    public function relationSearch(): array
    {
        return [
            'type' => [
                'name',
            ]
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nama_anggota')
            ->add('alamat_anggota')
            ->add('handphone')
            ->add('type_name', fn($model) => e($model->type->name))
            ->add('is_penabung', fn($model) => $model->is_penabung === 1 ? 'Ya' : 'Tidak')
            ->add('is_peminjam', fn($model) => $model->is_peminjam === 1 ? 'Ya' : 'Tidak')
            ->add('created_at_formatted', fn ($model) => Carbon::parse($model->created_at)->setTimezone('Asia/Jakarta')->format('d-m-Y (h:i:s)'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nama anggota', 'nama_anggota')
                ->sortable()
                ->searchable(),

            Column::make('Alamat anggota', 'alamat_anggota')
                ->sortable()
                ->searchable(),

            Column::make('Handphone', 'handphone')
                ->sortable()
                ->searchable(),

            Column::make('Tipe member', 'type_name')
                ->sortable()
                ->searchable(),

            Column::make('Penabung?', 'is_penabung')
                ->sortable()
                ->searchable(),

            Column::make('Peminjam?', 'is_peminjam')
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
        ];
    }

    public function actionsFromView($row) : View
    {
        $types = MemberType::all();
        return view('partials.koperasi-member-actions', ['row' => $row, 'types' => $types]);
    }

    // #[\Livewire\Attributes\On('edit')]
    // public function edit($rowId): void
    // {
    //     $this->js('alert('.$rowId.')');
    // }

    // public function actions(KoperasiMember $row): array
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
