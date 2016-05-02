<?php

namespace Framework;

use Framework\Exceptions\FileNotFound;
use Framework\Exceptions\Http404;

class Base
{
    function ensure($expr, $Exception, $message)
    {
        if (!$expr) {
            switch ($Exception) {
                case 'Http404':
                    throw new Http404($message);
                    break;
                case 'FileNotFound':
                    throw new FileNotFound($message);
                    break;
                default:
                    throw new \Exception($message);
            }
        }
    }
    static function getClass($path)
    {
        $t1 = explode('\\', $path);

        return $t1[count($t1) - 1];
    }
} 