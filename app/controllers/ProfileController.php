<?php

use App\Core\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = (new User)->find(['id' => $_SESSION['id']])[0];
    }

    public function index()
    {
        if (!$_SESSION['id'] || !$this->user) {
            redirect('/login');
        }

        $this->view('profile', ['user' => $this->user]);
    }

    public function logout()
    {
        unset($_SESSION['id']);
        redirect('/');
    }

    public function update()
    {
        $data = array_filter($_POST, function($value, $key) {
            return $value !== "" && $value != $this->user[$key];
        }, ARRAY_FILTER_USE_BOTH);
        $data['id'] = $_SESSION['id'];

        $errors = $this->validate($data);
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $_SESSION[$key] = $error;
            }
            redirect('/profile');
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password_confirmation']);
        }

        (new User)->update($data);
        $_SESSION['success'] = 'Данные успешно обновлены!';
        redirect('/profile');
    }

    public function validate($data)
    {
        $errors = [];

        if (empty($_POST['name'])) {
            $errors['name'] = 'Имя обязательно для заполнения';
        }
        if ($_POST['name'] != $this->user['name'] && (new User)->find(['name' => $_POST['name']])) {
            $errors['name'] = 'Такое имя уже зарегистрировано';
        }

        if (empty($_POST['phone'])) {
            $errors['phone'] = 'Телефон обязателен для заполнения';
        }
        if ($_POST['phone'] != $this->user['phone'] && (new User)->find(['phone' => $_POST['phone']])) {
            $errors['phone'] = 'Такой телефон уже зарегистрирован';
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'Email обязателен для заполнения';
        }
        if ($_POST['email'] != $this->user['email'] && (new User)->find(['email' => $_POST['email']])) {
            $errors['email'] = 'Такой Email уже зарегистрирован';
        }

        if (isset($data['password']) && $data['password'] !== $data['password_confirmation']) {
            $errors['password_confirmation'] = 'Пароли должны совпадать';
        }
        return $errors;
    }
}