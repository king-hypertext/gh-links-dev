<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request){
        return view('pages.home', ['page_title' => 'Home']);
    }
}
