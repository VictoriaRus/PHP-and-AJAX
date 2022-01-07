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
        <h5>Форма регистрации</h5>
        <small>* поля обязательные для заполнения</small>
        <br>
        <br>
        <form action="">
          Логин*   <small>(минимум 6 символов)</small>
          <input type="text" name="login" placeholder="Введите логин" class="form-control" /><br>
          Пароль*   <small>(минимум 6 символов: буквы и цифры)</small>
          <input type="password" id="txtNewPassword" name="password" placeholder="Введите пароль" class="form-control" /><br>
          Подтверждение пароля*<input type="password" id="txtConfirmPassword" name="confirm_password" placeholder="Подтвердите пароль" class="form-control" /><br>
          <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
          Email*<input type="email" name="email" placeholder="Введите email" class="form-control" /><br>
          Имя*   <small>(минимум 2 символа: только буквы)</small>
          <input type="text" name="name" placeholder="Введите имя" class="form-control" /><br>
          
          <input type="button" id="register-btn" value="Зарегистрироваться" class="btn btn-primary btn-block" />
          <p>
            У вас уже есть аккаунт? - <a href="/">Авторизируйтесь</a>!
          </p>
          <p class="alert alert-danger none msg">Поле для вывода ошибок</p>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="/assets/js/js.js"></script>
</body>

</html>