<?php

namespace App\Core;

class App
{
    private $controller = 'login';
    private $action = 'index';

    public function loadController()
    {
        $url = $this->spliturl();

        $filename = '../app/controllers/' . ucfirst($url[0]) . 'Controller.php';

        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($url[0]) . 'Controller';
        } else {
            $filename = '../app/controllers/ErrorController.php';
            require $filename;
            $this->controller = 'ErrorController';
        }

        $controller = new $this->controller;
        $this->action = $url[1] ?? 'index';

        call_user_func_array([$controller, $this->action], []);
    }

    private function splitURL()
    {
        $url = $_GET['url'] ?? 'login';
        $url = explode('/', $url);
        return $url;
    }
}