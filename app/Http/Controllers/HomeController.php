<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page
     */
    public function index(): View
    {
        return view('landing');
    }

    /**
     * Display the pricing page
     */
    public function pricing(): View
    {
        return view('pricing');
    }

    /**
     * Display the features page
     */
    public function features(): View
    {
        return view('features');
    }
}
