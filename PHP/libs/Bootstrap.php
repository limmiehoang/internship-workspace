<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/4/2019
 * Time: 10:55 AM
 */

class Bootstrap
{
    function __construct()
    {
        if (empty($_GET['url'])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return;
        }
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        $controller_name = $url[0];
        $file = 'controllers/' . $controller_name . '.php';

        if (file_exists($file)) {
            require $file;
            $controller = new $controller_name;
        } else {
            require 'controllers/error.php';
            $controller = new MyError();
        }

        $method = (isset($url[1])) ? $url[1] : null;
        $parameter = (isset($url[2])) ? $url[2] : null;

        if (isset($method) && method_exists($controller, $method)) {
            if (isset($parameter)) {
                $controller->{$method}($parameter);
                return;
            }
            $controller->{$method}();
        } else {
            $controller->index();
        }
    }
}