<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function ownerList()
    {
        return view('admin.pages.owners');
    }

    public function petList()
    {
        return view('admin.pages.pets');
    }

    public function serviceList(){
        return view('admin.pages.services');
    }

    public function medicationList(){
        return view('admin.pages.medications');
    }

}
