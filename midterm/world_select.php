<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'world_x');
  if(isset($_GET['country_name'])) {
    $filtered_id = mysqli_real_escape_string($link, $_GET['country_name']);
  } else {
    $filtered_id = mysqli_real_escape_string($link, $_POST['country_name']);
  }

  $query = "
      SELECT c.name as cname, c.code as ccode, ct.name as ctname, cl.language as cllanguage
      FROM country c
      INNER JOIN city ct ON c.capital = ct.id
      INNER JOIN countrylanguage cl ON c.code = cl.countrycode
      WHERE c.name = '{$filtered_id}'
      ";

  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_array($result);

  $world_info = '';
  while($row = mysqli_fetch_array($result)) {
    $world_info .= '<tr>';
    $world_info .= '<td>'.$row['cname'].'</td>';
    $world_info .= '<td>'.$row['ccode'].'</td>';
    $world_info .= '<td>'.$row['ctname'].'</td>';
    $world_info .= '<td>'.$row['cllanguage'].'</td>';
    $world_info .= '</tr>';
  }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>국가명으로 정보 조회</title>
</head>

<body>
    <h2><a href="index.php">인터넷으로 떠나는 세계여행</h2>
    <table border="1">
        <tr>
            <th>Country Name</th>
            <th>Country Code</th>
            <th>Capital</th>
            <th>Language</th>
        </tr>
        <?= $world_info ?>

    </table>
</body>

</html>
