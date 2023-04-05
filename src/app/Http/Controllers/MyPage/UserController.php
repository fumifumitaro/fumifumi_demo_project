<?php

namespace App\Http\Controllers\MyPage;

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

        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request) //TODO: バリデーションを加える。
    {
        logger($request->all());

    

       User::update([
            'name' => $request->name,
            'address' => $request->address
       ])->save();//save()追加

        // TODO: 返却する値を調整する
        return [];
    }
}
