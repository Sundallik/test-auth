<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="bg-light">
<div class="mx-auto w-25 bg-white p-4 mt-5 border rounded">
    <h1 class="text-center">Регистрация</h1>
    <form action="<?=ROOT?>/register" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Имя</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Имя">
            <?php if (isset($_SESSION['name'])): ?>
                <div class="alert alert-danger mt-1"><?= showFlash('name') ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Телефон</label>
            <input name="phone" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Телефон">
            <?php if (isset($_SESSION['phone'])): ?>
                <div class="alert alert-danger mt-1"><?= showFlash('phone') ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            <?php if (isset($_SESSION['email'])): ?>
                <div class="alert alert-danger mt-1"><?= showFlash('email') ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputPassword1">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
            <?php if (isset($_SESSION['password'])): ?>
                <div class="alert alert-danger mt-1"><?= showFlash('password') ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputPassword1">Подтвердите пароль</label>
            <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
            <?php if (isset($_SESSION['password_confirmation'])): ?>
                <div class="alert alert-danger mt-1"><?= showFlash('password_confirmation') ?></div>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-2">Зарегистрироваться</button>
            <a href="<?=ROOT?>/login" class="d-block">Вход</a>
        </div>

    </form>
</div>
</body>
</html>