<?php

namespace Framework;

use Framework\Helper\Registry;

/**
 * Class Request
 *
 * for provide access with filtering to GET and POST params
 */
class Request extends Registry
{
    public static function getGet($key)
    {
        return (isset($_GET[$key])) ? htmlentities($_GET[$key]) : null;
    }
    public static function getPost($key)
    {
        return (isset($_POST[$key])) ? htmlentities($_POST[$key]) : null;
    }
    public static function getParam($key)
    {
        if (isset($_GET[$key])) {
            return ($_GET[$key]);
        } elseif (isset($_POST[$key])) {
            return ($_POST[$key]);
        }

        return null;
    }
    public static function getParamsByRequestType()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod === 'GET') {
            return $_GET;
        } elseif ($requestMethod === 'POST') {
            return $_POST;
        }
    }
    public static function getControllerClass()
    {
        return 'Controller\\' . ucfirst(self::getController()) . 'Controller';
    }
    public static function getController()
    {
        $tmp1 = explode(
            '/',
            explode(
                '?',
                $_SERVER['REQUEST_URI']
            )[0]
        );

        return $tmp1[1];
    }
    public static function getAction()
    {
        $tmp1 = explode(
            '/',
            explode(
                '?',
                $_SERVER['REQUEST_URI']
            )[0]
        );

        return $tmp1[2];
    }
}