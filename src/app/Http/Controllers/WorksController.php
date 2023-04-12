<?php

namespace App\Http\Controllers\Works;

use App\Http\Controllers\Controller;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function edit()
    {
    $user = Auth::user();

    return Inertia::render('User/Edit',[
        'user' =>$user
    ]);
}    
}
