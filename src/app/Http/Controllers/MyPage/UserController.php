<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;

use Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        dd($user);
    }
}
