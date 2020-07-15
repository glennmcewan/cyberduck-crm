<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard', ['title' => 'Dashboard']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dashboard  $Dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $Dashboard)
    {
        //
    }
}
