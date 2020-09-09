<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'dbp');
  $query = "SELECT * FROM w02p";
  $result = mysqli_query($link, $query);
  $list = ' ';
  while ($row = mysqli_fetch_array($result)) {
    $list = $list."<li>
    <a href=\"index.php?id={$row['id']}\">{$row['title']}</li>";
  }

  $article = array(
    'title' => 'Welcome',
    'description' => 'Database is ...'
  );

  if (isset($_GET['id'])) {
  $query = "SELECT * FROM w02p WHERE id={$_GET['id']}";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_array($result);
  $article = array(
    'title' => $row['title'],
    'description' => $row['description']
  );
}
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> ALPHAFRUIT </title>
</head>
<body>
  <h1><a href="index.php"> ALPHAFRUIT </h1>
  <ol> <?= $list ?> </ol>
  <form action="process_create.php" method="post">
    <p><input type="text" name="title" placeholder="title"></p>
    <p><textarea name="description" placeholder="description"></textarea></p>
    <p><input type="submit"</p>
  </form>
</body>
</html>

