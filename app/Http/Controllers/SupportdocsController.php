<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class SupportdocsController extends Controller
{
    // user doc
    public function userguide(Request $request)
    {
        return view('voyager::supportdoc.userguide');

    }
}
