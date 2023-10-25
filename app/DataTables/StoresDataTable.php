<?php
namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class StoresDataTable extends DataTable
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
            // ->addColumn('action'  )
            ->addColumn('action', function($row){
                $showUrl = route('voyager.stores.show', $row->id);
                $editUrl = route('voyager.stores.edit', $row->id);
                $deleteUrl = route('voyager.stores.delete', $row->id);
                
                $btn = "<div style='display:flex;'>
                <a href='$showUrl' style='margin-right:2px' class='btn m- btn-primary btn-xs'><i class='voyager-eye'></i></a>
                <a href='$editUrl' style='margin-right:2px' class='btn btn-success btn-xs'><i class='voyager-edit'></i></a>
                <form action='$deleteUrl' method='POST' style='display:inline'>
                    " . csrf_field() . "
                    " . method_field('DELETE') . "
                    <button type='submit' class='btn btn-danger btn-xs' onclick='return confirm(\"Are you sure you want to delete this Store?\")'>
                        <i class='voyager-trash'></i>
                    </button>
                </form> 
                </div>";

                 return $btn;
            })
         ->rawColumns(['action'])
            ->setRowId('id');

    }

}