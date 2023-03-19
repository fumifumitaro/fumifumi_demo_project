<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;//??これ何
use Illuminate\Http\Request;

class AdressControl extends Controller
{
    //テスト
public function index() {

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
