<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function Dashboard(Request $request)
    {
        $menu = 'beranda';
        return view('dashboard', compact('menu'));
    }
    public function viewLogin(Request $request)
    {
        $menu = 'login';
        return view('dashboard', compact('menu'));
    }
}
