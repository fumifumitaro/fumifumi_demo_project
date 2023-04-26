<?php

namespace App\Http\Controllers;

use App\Utils\SampleClass;

class SampleController extends Controller
{
    public function class()
    {
        $sample = new SampleClass();

        dd($sample->to());
        // dd($sample->message());
    }
}
