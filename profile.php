<?php
session_start();
if (!$_SESSION["user"]) {
  header("Location: /");
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Регистрация и авторизация</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="/assets/js/js.js"></script>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h5>Личная страничка пользователя</h5>
        <br>
        <h2>Логин: <?= $_SESSION["user"]["login"] ?></h2>
        <p>Имя: <?= $_SESSION["user"]["name"] ?></p>
        <a href="#"><?= $_SESSION["user"]["email"] ?></a>
        <br>
        <br>
        <a href="/logout.php" class="btn btn-primary btn-block">Выход</a>
        <br>
      </div>
    </div>
</body>

</html>