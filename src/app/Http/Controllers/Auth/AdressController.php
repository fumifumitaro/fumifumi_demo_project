<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

// これがLaravelのベースのコントローラー

class AdressController extends Controller
{
    //テスト
    public function showAddressForm()
    {

        return <<<EOF
    <html>
    <head>
      <title>Adress index</title>
      <style>
        body {font-size: 16px; color: #999; }
      </style>
    </head>
    <body>
        <h1>Adress</h1>
    </body>
    </html>
EOF;
    }
}
