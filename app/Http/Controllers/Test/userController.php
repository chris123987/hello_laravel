<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    public function create(){
        return view('users.create');
    }
}
