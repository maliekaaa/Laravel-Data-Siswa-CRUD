<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DataSiswaController;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.index');
    }
}
