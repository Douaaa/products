<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
      return view('home');
    }
    public function register()
    {
      if (Auth::check()) {
        return redirect('/');
      }else {
        $pageInfo['title'] ='';
        return view('pages.register' ,compact('pageInfo'));
      }

    }
    public function login()
    {
      if (Auth::check()) {
        return redirect('/');
      }else {
        $pageInfo['title'] ='';
        return view('pages.login' ,compact('pageInfo'));
      }

    }
}
