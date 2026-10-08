<?php
$servername = "127.0.0.1";
$username = "root";
$password = "kali";
$dbName = "db";

$link = mysqli_connect($servername, $username, $password);

if (!$link) {
    die("Error: " . mysqli_connect_error());
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbName;";

if (!mysqli_query($link, $sql)) {
    echo "не удалось создать БД";
}

mysqli_close($link);

$link = mysqli_connect($servername, $username, $password, $dbName);
if (!$link) {
    die("Error: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL
)";
if (!mysqli_query($link, $sql)) {
    die("не удалось создать таблицу users");
}

$sql = "CREATE TABLE IF NOT EXISTS posts(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(20) NOT NULL,
    main_text VARCHAR(400) NOT NULL
)";
if (!mysqli_query($link, $sql)) {
    die("не удалось создать таблицу posts");
}

mysqli_close($link);
?>