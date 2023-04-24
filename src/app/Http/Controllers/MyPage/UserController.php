<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;

use App\Hello;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function hello()
    {
        $hi = new Hello();
        $hello = $hi->hello();
        return $hello;
    }

    public function edit(Request $request)
    {
        logger($request->all());  
        $user = Auth::user();

        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request) //TODO: バリデーションを加える。
    {
        logger($request->all());
        $user = Auth::user();
    

       $user->update([
            'name' => $request->name,
            'address' => $request->email,
       ]);

        // TODO: 返却する値を調整する
        return [];
    }
}
