<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function prelaunch()
    {
        return view('pre-launch');
    }
    public function home()
    {
        return view('home');
    }
    public function searchimmobiles()
    {
        return view('immobiles-search');
    }
}