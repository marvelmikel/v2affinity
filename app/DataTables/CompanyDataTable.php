<?php

namespace App\DataTables;

use App\Models\Company;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Models\Role;


class CompanyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $editUrl = route('voyager.stores.edit', $row->id);
                $deleteUrl = route('voyager.stores.delete', $row->id);

                $btn = "<div style='display:flex;'>
                    <a href='$editUrl' style='margin-right:2px' class='btn btn-success btn-xs'><i class='voyager-eye'></i></a>
                    <form action='$deleteUrl' method='POST' style='display:inline; margin-right:2px'>
                        " . csrf_field() . "
                        " . method_field('DELETE') . "
                        <button type='submit'  class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure you want to delete this Store?\")'>
                            <i class='voyager-trash'></i>
                        </button>
                    </form> 
                </div>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    public function query(Company $model): Builder
{
    // Check if the authenticated user has role_id 1 (admin)
    if (Auth::user()->role_id !== 1) {
        return $model->newQuery()->where('id', '=', null); // Return an empty result set
    }

    return $model->newQuery();
}

    
    
    
    
    
     /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('add'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('row_number')
            ->title('#')
            ->render('meta.row + meta.settings._iDisplayStart + 1;')
            ->width(50)
            ->orderable(false),
            Column::make('company_name'),
            Column::make('company_email'),
            Column::make('company_phone'),
            Column::make('company_address'),
            Column::make('company_number'),
            Column::make('vat_number'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
