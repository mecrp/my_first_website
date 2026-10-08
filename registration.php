<?php
  if (isset($_COOKIE['User'])) {
    header('Location: /profile.php');
    exit();
  }

  require_once('db.php');
  $link = mysqli_connect($servername, $username, $password, $dbName);

  if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $emai = $_POST['email'];
    $password = $_POST['password'];
    if (!$login || !$emai || !$password) {
      die('input all parametrs');
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$login', '$email', '$password')";
    if (!mysqli_query($link, $sql)) {
      mysqli_close($link);
      echo "не удалось добавить пользователя";
    } else {
      mysqli_close($link);
      header("Location: /login.php");
      exit();
    }

  }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >
  </head>
  <body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    
    <form
      action="/registration.php" method="POST"
      class="bg-white p-4 rounded shadow-sm" style="width: 320px;"
    >
      <h1 class="h4 mb-4 text-center">Регистрация</h1>

      <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-control" id="login" name="login">
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Почта</label>
        <input type="text" class="form-control" id="email" name="email">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <a href="/login.php">уже есть аккаунт?</a>

      <button type="submit" name="submit" class="btn btn-primary w-100">Подтвердить</button>
    </form>
    
  </body>
  
</html>
