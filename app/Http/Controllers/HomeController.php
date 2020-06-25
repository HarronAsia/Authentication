<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(Request $req)
    {
        return view('unauthorized')->withMessage("Admin");
    }
    public function manager(Request $req)
    {
        return view('unauthorized')->withMessage("Manager");
    }
    public function member(Request $req)
    {
        return view('unauthorized')->withMessage("Member");
    }
}
