<?php

namespace Framework\Exceptions;


class Http404 extends \Exception
{
    function __construct($message = null)
    {
        $message = ($message) ? $message : '404: page not found!';
        parent::__construct($message);
    }
}