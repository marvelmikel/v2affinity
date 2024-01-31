<?php

namespace App\DataTables;

use App\Models\Invoice;
use App\Models\InvoiceLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;



class InvoiceLogsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
       
        
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row){
                $showUrl = route('voyager.invoices.show', $row->id);
                $editUrl = route('voyager.invoices.edit', $row->id);
                $deleteUrl = route('voyager.invoices.delete', $row->id);
                
                $btn = "<div style='display:flex;'>
                <a data-toggle='modal' data-target='#add_pricing_column_modal'  style='margin-right:2px; display:none' class='btn m- btn-warning btn-xs'><i class='voyager-logbook'></i></a>
                
               
                
                <form action='$deleteUrl' method='POST' style='display:none'>
                        " . csrf_field() . "
                        " . method_field('DELETE') . "
                        <button type='submit' class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure you want to delete this Invoice ?\")'>
                            <i class='voyager-trash'></i>
                        </button>
                    </form>
                </div>";

                 return $btn;
            })
         ->rawColumns(['action'])
            ->setRowId('id');


            
    }

    

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Invoice $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
   

    public function query(InvoiceLog $model): QueryBuilder
    {
        return $model->where('invoice_id', $this->invoiceId);
    }
    

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('invoices-table')
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
            Column::make('id')
            ->title('#')
            ->render('meta.row + meta.settings._iDisplayStart + 1;')
            ->width(50)
            ->orderable(false),
            Column::make('username'),
            Column::make('activity'),
            Column::make('created_at'),
            Column::make('updated_at'),
             Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  ->width(60)
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
        return 'Invoices_' . date('YmdHis');
    }
}
