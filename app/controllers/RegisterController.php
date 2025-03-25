<?php


use App\Core\Controller;
use App\Models\User;

class RegisterController extends Controller
{

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->register();
        } else {
            $this->view('register');
        }
    }

    private function register()
    {
        $user = new User();

        $errors = $this->validate($user);
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $_SESSION[$key] = $error;
            }
            redirect('/register');
        }

        $user->create([
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]);

        $_SESSION['success'] = 'Вы успешно зарегистрированы';
        redirect('/login');
    }

    private function validate(User $user): array
    {
        $errors = [];

        if (empty($_POST['name'])) {
            $errors['name'] = 'Имя обязательно для заполнения';
        }
        if ($user->find(['name' => $_POST['name']])) {
            $errors['name'] = 'Такое имя уже зарегистрировано';
        }

        if (empty($_POST['phone'])) {
            $errors['phone'] = 'Телефон обязателен для заполнения';
        }
        if ($user->find(['phone' => $_POST['phone']])) {
            $errors['phone'] = 'Такой телефон уже зарегистрирован';
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'Email обязателен для заполнения';
        }
        if ($user->find(['email' => $_POST['email']])) {
            $errors['email'] = 'Такой Email уже зарегистрирован';
        }

        if (empty($_POST['password'])) {
            $errors['password'] = 'Пароль обязателен для заполнения';
        }
        if (empty($_POST['password_confirmation']) || $_POST['password'] !== $_POST['password_confirmation']) {
            $errors['password_confirmation'] = 'Пароли должны совпадать';
        }

        return $errors;
    }
}