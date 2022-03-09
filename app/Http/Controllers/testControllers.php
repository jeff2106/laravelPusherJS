<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class TestController extends Controller
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
        $cards = Card::inRandomOrder()->take(3)->get();
        return view('test', compact('cards'));
    }
}
