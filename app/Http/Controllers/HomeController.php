<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\ProjectManagement;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
       // $users = User::all();
        return view('home');
    }
    public function userdata()
    {
        $users = User::all();
        $users_count = User::all()->count();
        $projects = ProjectManagement::orderBy('id', 'desc')->take(5)->get();
        return view('home', compact('users','users_count','projects'));
    }

}
