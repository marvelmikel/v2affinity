<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class SupportdocsController extends Controller
{
    // Suppor user docs
    public function userguide1(Request $request)
    {
        return view('voyager::supportdoc.userguide');

    }
    public function userguide2(Request $request)
    {
        return view('voyager::supportdoc.add-carpet-roll-items');

    }
    public function userguide3(Request $request)
    {
        return view('voyager::supportdoc.add-packed-tile-item');

    }
    public function userguide4(Request $request)
    {
        return view('voyager::supportdoc.add-roll-end');

    }
    public function userguide5(Request $request)
    {
        return view('voyager::supportdoc.add-underlay');

    }
    public function userguide6(Request $request)
    {
        return view('voyager::supportdoc.add-other-stocks');

    }
    public function userguide7(Request $request)
    {
        return view('voyager::supportdoc.create-new-invoice');

    }
}
