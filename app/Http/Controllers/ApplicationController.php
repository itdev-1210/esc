<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('company');
    }

    public function __invoke()
    {
        return view('application');
    }
}
