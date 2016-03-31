<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Page;
use App\Promotion;

class PageController extends Controller
{
    /**
     * Show the page
     *
     * @param Page $page
     * @return Response
     */
    public function index(Page $page)
    {
        return view('application.page.index', compact('page'));
    }

    public function promotions(){
        $promotions = Promotion::all();
        return view('application.page.promotions', compact('promotions'));
    }

    public function login(){
        $user = 'Marx Stingray';
        return view('application.page.login', compact('user'));
    }

}
