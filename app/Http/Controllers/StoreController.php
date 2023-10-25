<?php

namespace App\Http\Controllers;

use App\DataTables\StoresDataTable;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Store;
use Illuminate\Support\Facades\Gate;

class StoreController extends Controller
{
    public function index(StoresDataTable $dataTable)
    {
        return $dataTable->render('voyager::stores.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return 
     */
    public function create()
    {
        return view('voyager::stores.create');
    }
}
