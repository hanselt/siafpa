<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccederController extends Controller
{
    public function login() {
        return view('acceder');
    }
}
