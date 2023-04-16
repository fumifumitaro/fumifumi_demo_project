<?php

namespace App\Http\Controllers\Works;

use App\Http\Controllers\Controller;

use App\Models\User; //ユーザーモデルクラス
use Auth; //ユーザー認証に必要
use Illuminate\Http\Request; //データの格納処理
use Inertia\Inertia; //Inertia.jsにてユーザー登録画面やログイン画面の生成

class UserController extends Controller
{
    public function edit()//ページを作り出す
    {
    $user = Auth::user(); //ユーザー認証　ログインしていればログインしているユーザーのモデルクラスを返す。ログインしていなければnull。

    return Inertia::render('User/Edit',[ //Inertia.jsにてユーザー登録画面やログイン画面の生成
        'user' =>$user //=>は連想配列の処理?
    ]);
}
    public function update(Request $request)//worksテーブルにデータを格納するための処理
    {
        logger($request->all());// $requestにデータ格納

            User::update([
                'works' => $request->works //=>は連想配列の処理
            ]);
        return[];    
    }    
}
