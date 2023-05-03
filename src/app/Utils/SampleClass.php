<?php

namespace App\Utils;

class SampleClass
{
    protected $to;
    protected $message;

    public function __construct($to = 'サンプル')//ここの引数をnew SampleClass("田中");で変える。
    {
        $this->to = $to;
    }

    public function to()
    {
        return $this->to;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function message()
    {
        if(blank($this->message)) return '';//messageが空欄なら''を返す

        return $this->to . 'さん' . $this->message;
    }
}
