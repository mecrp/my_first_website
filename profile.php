<?php
  require_once('db.php');
  $link = mysqli_connect($servername, $username, $password, $dbName);

  if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $main_text = $_POST['main_text'];
    echo $title . " - " . $main_text . "<br>";
    if (!$title || !$main_text) {
      die('no data post');
    }

    $sql = "INSERT INTO posts (title, main_text) VALUES ('$title', '$main_text')";
    if (!mysqli_query($link, $sql)) {
      mysqli_close($link);
      echo "не удалось добавить пост";
    }
    if(!empty($_FILES["file"])) {
      if (
        ((@$_FILES["file"]["type"] == "image/gif") || (@$_FILES["file"]["type"] == "image/jpeg")
        || (@$_FILES["file"]["type"] =="image/jpg") || (@$_FILES["file"]["type"] == "image/pjpeg")
        || (@$_FILES["file"]["type"] == "image/x-png") || (@$_FILES["file"]["type"] == "image/png"))
        && (@$_FILES["file"]["size"] < 1002400)
      ) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "Load in;  " . "upload/" . $_FILES["file"]["name"];
            
        } else {
            echo "upload failed!";
        }
    }

  }
?>


<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Профиль</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >
  </head>
  <body class="bg-light d-flex justify-content-center">
    <?php if (isset($_COOKIE['User'])): ?>
      <form action="/logout.php" method="POST" class="d-flex">
        <button class="btn btn-outline-danger" type="submit" name="submit">Logout</button>
      </form>
    <?php endif; ?>
    <div class="py-4 px-3" style="width: 100%; max-width: 640px;">
      <h1 class="h4 mb-4">Профиль</h1>

      <div class="d-flex align-items-center gap-3 mb-5">
        <p class="mb-0">статус / цитата</p>
        <div class="bg-secondary-subtle rounded" style="width: 80px; height: 80px;"></div>
      </div>

      <form action="/profile.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="file" class="form-label">Прикрепить фото</label>
          <input type="file" class="form-control" id="file" name="file" accept="image/*">
        </div>

        <div class="mb-3">
          <label for="title" class="form-label">Название поста</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3">
          <label for="main_text" class="form-label">Текст поста</label>
          <textarea class="form-control" id="main_text" name="main_text" rows="4"></textarea>
        </div>

        <button name="submit" type="submit" class="btn btn-primary">Опубликовать</button>
      </form>
    </div>
  </body>
</html>