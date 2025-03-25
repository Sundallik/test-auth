<?php

namespace App\Core;

abstract class Controller
{
    public function view($name, $data = [])
    {
        $filename = '../views/' . $name . '.php';

        extract($data);

        if (file_exists($filename)) {
            require $filename;
        } else {
            $err404 = '../views/404.php';
            require $err404;
        }
    }
}