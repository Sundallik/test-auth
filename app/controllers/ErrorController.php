<?php

use App\Core\Controller;

class ErrorController extends Controller
{
    public function index()
    {
        echo '404 - Not Found';
    }
}