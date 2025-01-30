<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class payController extends Controller
{
    public function pay()
    {
        return view('user.pay');
    }
}
