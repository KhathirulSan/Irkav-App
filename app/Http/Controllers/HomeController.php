<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin()
    {
        $pageTitle = 'Admin Dashboard';
        return view('admin.dashboard', ['pageTitle' => $pageTitle]);
    }
    public function inventori()
    {
        $pageTitle = 'Inventori';
        return view('admin.inventori.inventori', ['pageTitle' => $pageTitle]);
    }

    public function rt()
    {
        $pageTitle = 'RT Dashboard';
        return view('rt.dashboard', ['pageTitle' => $pageTitle]);
    }
    public function user()
    {
        $pageTitle = 'User Dashboard';
        return view('user.dashboard', ['pageTitle' => $pageTitle]);
    }
}
