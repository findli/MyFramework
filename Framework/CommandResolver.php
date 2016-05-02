<?php

namespace Framework;

class CommandResolver extends Base
{
    public static $controllerPreClass = '';

    public function getCommand()
    {
        $controllerClassName = (new Request())->getControllerClass();
        $controllerClassName = self::$controllerPreClass . $controllerClassName;
        $this->ensure(class_exists($controllerClassName), 'Http404', '404: Controller not found!');
        $controller = new $controllerClassName();
        $this->ensure(is_a($controller, Controller::class), 'Http404', '404: Controller not found!');

        return $controller;
    }
} 