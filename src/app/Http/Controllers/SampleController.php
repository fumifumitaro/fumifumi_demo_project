<?php

namespace App\Http\Controllers;

use App\Utils\SampleClass;

class SampleController extends Controller
{
    public function class()
    {
        $sample = new ReverseController("田中");
        $sample->setMessage('ありがとう');
       
        //dd($sample->to($name));
        dd($sample->message());
    }

}

class ReverseController extends SampleClass //オーバーライド
{
    public function message()
    {
      return $this->message . $this->to . 'さん';
    }
} 
