<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница</title>
    <style>
    body {
      font-family: sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      gap: 12px;
    }

    button {
      padding: 8px 16px;
      margin: 0 4px;
    }
    </style>
  </head>

  <body>
    <img src="">
    <button>войдите</button>
    <div>
      <button>регистрация</button>
      <button>логин</button>
    </div>
    <?php
      if (isset($_COOKIE['User'])) {
        require_once('db.php');
        $link = mysqli_connect($servername, $username, $password, $dbName);
        $sql = 'SELECT * FROM posts';
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($post = mysqli_fetch_array($result)) {
            echo "<a href='/posts.php?id=" . $post["id"] . "'>" . $post["id"] . " - " . $post["title"] . "</a>";
          }
        }
      }

    ?>

    <script>
      const buttons = document.getElementsByTagName("button");
      const picture = document.getElementsByTagName("img");
      
      buttons[1].onclick = function () {
        window.location.href = "/registration.php";
      }
      buttons[2].onclick = function () {
        window.location.href = "/login.php";
      }

      buttons[0].onmouseover = function () {
        document.body.style.background = "purple";
      };

      buttons[0].onmouseout = function () {
        document.body.style.background = "";
      };
      var last_image_adding = Date.now();
      var ms;
      buttons[1].onmouseout = function () {
        ms = Date.now() - last_image_adding;
        if (ms < 2000) {
          return
        }
        last_image_adding = Date.now();
        picture[0].src = "https://picsum.photos/200/300?grayscale";
      };
      buttons[2].onmouseout = function () {
        ms = Date.now() - last_image_adding;
        if (ms < 2000) {
          return
        }
        last_image_adding = Date.now();

        picture[0].src = "https://picsum.photos/200/300/?blur";
      };
    </script>
  </body>
</html>