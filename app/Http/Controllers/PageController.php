<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function programs(): View
    {
        return view('pages.programs');
    }

    public function gallery(): View
    {
        return view('pages.gallery');
    }

    public function news(): View
    {
        return view('pages.news');
    }

    public function information(): View
    {
        return view('pages.information');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function wasteCalculator(): View
    {
        return view('pages.waste-calculator');
    }
}
