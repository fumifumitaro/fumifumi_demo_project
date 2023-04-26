<?php

namespace App\Utils;

class SampleClass
{
    protected $to;
    protected $message;

    public function __construct($to = 'サンプル')
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
        if(blank($this->message)) return '';

        return $this->to . 'さん' . $this->message;
    }
}
