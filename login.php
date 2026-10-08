<?php
  if (isset($_COOKIE['User'])) {
    header('Location: /profile.php');
    exit();
  }

  require_once('db.php');
  $link = mysqli_connect($servername, $username, $password, $dbName);

  if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (!$login || !$password) {
      die('input all parametrs');
    }

    $sql = "SELECT * FROM users WHERE username='$login' AND password='$password'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 1) {
      mysqli_close($link);
      setcookie("User", $username, time()+7200);
      header("Location: /profile.php");
      exit();
    } else {
      mysqli_close($link);
      echo "неправильный логин или пароль";
    }

  }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >
  </head>
  <body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <form
      action="/login.php" method="POST"
      class="bg-white p-4 rounded shadow-sm" style="width: 320px;"
    >
      <h1 class="h4 mb-4 text-center">Вход</h1>

      <div class="mb-3">
        <label for="login" class="form-label">Логин</label>
        <input type="text" class="form-control" id="login" name="login">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>

      <a href="/login.php">нет аккаунта?</a>

      <button name="submit" type="submit" class="btn btn-primary w-100">Подтвердить</button>
    </form>
    
  </body>
</html>
