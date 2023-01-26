<?php
session_start();

if (isset($_SESSION['user'])) {
  header('Location: profile.php');
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Регистрация и авторизация</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h5>Форма авторизации</h5>
        <br>
        <form action="">
          Логин<input type="text" name="login" placeholder="Введите свой логин" class="form-control"><br>
          Пароль<input type="password" name="password" placeholder="Введите свой пароль" class="form-control"><br>
          <input type="button" id="login-btn" value="Войти" class="btn btn-primary btn-block">
          <p>
            У вас нет аккаунта? - <a href="/registr.php">Зарегистрируйтесь</a>!
          </p>
          <p class="alert alert-danger none msg">Поле для вывода ошибок</p>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="/assets/js/js.js"></script>
</body>

</html>