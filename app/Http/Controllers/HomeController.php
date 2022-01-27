<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function dashboard()
    {

        return view('dashboard');
    }

    public function ciudad()
    {
        $this->authorize('viewAny', User::class);
        return view('pages.ciudad.index');
    }
}