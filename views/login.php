<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="mx-auto w-25 bg-white p-4 mt-5 border rounded">
    <h1 class="text-center">Вход</h1>
    <form action="<?=ROOT?>/login" method="post" id="auth-form" >
        <div class="form-group">
            <label for="exampleInputEmail1">Почта или телефон</label>
            <input name="login" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Имя">
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputPassword1">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
        </div>

        <div id="captcha-container"
             class="smart-captcha mt-2"
             data-sitekey="ysc1_a12B4aIbEhmYSnj8GinZ8A56Ow2aHybuA5eNltSWbad69cc5"></div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-2">Войти</button>
            <a href="<?=ROOT?>/register" class="d-block">Регистрация</a>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger mt-4"><?=showFlash('error')?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success mt-4"><?=showFlash('success')?></div>
        <?php endif; ?>
    </form>
</div>

</body>
</html>