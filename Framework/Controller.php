<?php

namespace Framework;

class Controller extends Base
{
    public static $viewPath = '';
    function __construct()
    {
    }
    function applyFilters($action)
    {
        $action  = strtolower(substr_replace($action, '', 0, strlen('action')));
        $filters = $this->filters();
        foreach ($filters as $k1 => $v1) {
            if (strtolower($k1) === $action) {
                //                				echo '<br>';
                //                				echo $_SERVER['REQUEST_METHOD'] . ' !== ' . strtoupper($v1);
                //                				echo '<br>';
                $this->ensure($_SERVER['REQUEST_METHOD'] === strtoupper($v1), 'Http404', null);
            }
        }
    }
    function filters()
    {
        return ['index' => 'get'];
    }
    function execute()
    {
        $request = new Request();
        $action  = $request->getAction();
        $action  = 'action' . ucfirst($action);
        $this->ensure(method_exists($this, $action), 'Http404', '404: Action not found!');
        $this->applyFilters($action);
        $method        = new \ReflectionMethod($this, $action);
        $requestParams = $method->getParameters();
        $funcParams    = [];
        foreach ($requestParams as $k1 => $v1) {
            if (Request::getParam($v1->name)) {
                $funcParams[$v1->name] = Request::getParam($v1->name);
            }
        }
        call_user_func_array([$this, $action], $funcParams);
    }
    protected function render($view, $params = [])
    {
        $filename = self::$viewPath . $view . '.php';
        $this->ensure(is_file($filename), 'FileNotFound', 'wrong view: ' . $view);
        extract($params);
        include_once $filename;
    }
    public function getFormUri()
    {
        $uri = '/' . Request::getController() . '/' . Request::getAction();

        return $uri;
    }
}
