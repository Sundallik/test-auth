<?php

function dd($data)
{
    echo '<pre>';
    print_r($data);
    die();
    echo '</pre>';
}

function redirect($url)
{
    header('Location: ' . ROOT . $url);
    exit;
}

function showFlash($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return false;
}