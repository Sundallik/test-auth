<?php

use App\Core\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->captchaValidation();
        } else {
            $this->view('login');
        }
    }

    private function captchaValidation()
    {
        $token = $_POST['smart-token'] ?? '';
        $ip = $_SERVER['REMOTE_ADDR'];

        if (empty($token)) {
            $_SESSION['error'] = 'Капча не пройдена';
            redirect('/login');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' => 'ysc2_a12B4aIbEhmYSnj8GinZXsQBKnNRruXIDDlziK6t1bc9766f',
            'token' => $token,
            'ip' => $ip
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true);

        if ($responseData['status'] === 'ok') {
            $this->login();
        } else {
            $_SESSION['error'] = 'Ошибка проверки капчи: ' . $responseData['message'];
            redirect('/login');
        }
    }

    private function login()
    {
        $user = new User();

        $password = $_POST['password'];
        unset($_POST['password']);

        $this->validate();
        $user = $user->find($_POST);
        if ($user && password_verify($password, $user[0]['password'])) {
            $_SESSION['id'] = $user[0]['id'];
            redirect('/profile');
        }

        $_SESSION['error'] = 'Неправильный логин или пароль';
        redirect('/login');
    }

    private function validate()
    {
        if (str_contains($_POST['login'], '@')) {
            $_POST['email'] = $_POST['login'];
        } else {
            $_POST['phone'] = $_POST['login'];
        }
        unset($_POST['login']);
        unset($_POST['smart-token']);
    }
}