<?php

namespace App\Http\Controllers\Works;

use App\Http\Controllers\Controller;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function edit()//ページを作り出す
    {
    $user = Auth::user();

    return Inertia::render('User/Edit',[
        'user' =>$user
    ]);
}
    public function update(Request $request)//worksテーブルにデータを格納するための処理
    {
        logger($request->all());// $requestにデータ格納

            User::update([
                'works' => $request->works
            ]);
        return[];    
    }    
}
