<?php

namespace App\Http\Controllers\Works;

use App\Http\Controllers\Controller;

use App\Hello;

use App\Models\User; //ユーザーモデルクラス
use Auth; //ユーザー認証に必要
use Illuminate\Http\Request; //requestデータの参照
use Inertia\Inertia; //Inertia.jsにてユーザー登録画面やログイン画面の生成

class UserController extends Controller
{
    public function hello()
    {
        $hi = new Hello();
        $hello = $hi->hello();
        return $hello;
    }

    public function edit()
    {
    $user = Auth::user(); //ユーザー認証　ログインしていればログインしているユーザーのモデルクラスを返す。ログインしていなければnull。

    return Inertia::render('User/Edit',[ //Inertia.jsにてvuew.jsの画面を表示
        'user' =>$user //=>は連想配列の処理
    ]);
}
    public function update(Request $request)
    {
        logger($request->all());// $requestの中身をlogに出している

            User::update([
                'works' => $request->works //=>は連想配列の処理
            ]);
        return[];    
    }    
}
