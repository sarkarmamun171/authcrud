<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackHomeController extends Controller
{
    public function index(){
        return view('Backend.partials.index');
    }
}
