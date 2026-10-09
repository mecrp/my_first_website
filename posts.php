<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Посты</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    >
  </head>
  <body class="bg-light">
    <div class="container py-4" style="max-width: 640px;">
      <h1 class="h4 mb-4">Посты</h1>


      <?php
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);


        require_once('db.php');
        $link = mysqli_connect($servername, $username, $password, $dbName);
        if (isset($_GET['id'])) {
          $get_id = $_GET['id'];
          $sql = "SELECT * FROM posts WHERE id=$get_id";
          $result = mysqli_query($link, $sql);
          $post = mysqli_fetch_array($result);
          echo '<div class="card mb-3"><div class="card-body">';
          echo '<h2 class="h5 card-title">'. $post['id'] . ' - ' . $post['title'] .'</h2>';
          echo '<p class="card-text mb-0">'. $post['main_text'] .'</p>';
          echo '</div></div>';
        } else {
          $sql = 'SELECT * FROM posts';
          $result = mysqli_query($link, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($post = mysqli_fetch_array($result)) {
              // echo $post["id"] . $post["title"];
              echo '<div class="card mb-3"><div class="card-body">';
              echo '<h2 class="h5 card-title">'. $post['id'] . ' - ' . $post['title'] .'</h2>';
              echo '<p class="card-text mb-0">'. $post['main_text'] .'</p>';
              echo '</div></div>';
            }
          }
        }
      ?>
  </body>
</html>
