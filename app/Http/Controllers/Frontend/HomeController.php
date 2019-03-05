<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function portfolio()
    {
        return view('frontend.home.portfolio.index');
    }

    public function aboutMe()
    {
        return view('frontend.home.about-me.index');
    }
}
