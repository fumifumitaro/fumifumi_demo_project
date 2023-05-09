<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();

        return Inertia::render('User/Profile', [
            'user' => $user
        ]);
    }
}