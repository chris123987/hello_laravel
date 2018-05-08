<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{
    public function home(){
        return view('/static_pages/home');
    }

    public function help(){

    }
}
