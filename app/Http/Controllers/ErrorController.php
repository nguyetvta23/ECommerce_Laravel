<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    // 404 error
    public function error404(){
        return view('errors.401');
    }
}
