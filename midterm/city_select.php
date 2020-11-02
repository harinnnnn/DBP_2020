<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'world_x');
  if(isset($_GET['city_name'])) {
    $filtered_id = mysqli_real_escape_string($link, $_GET['city_name']);
  } else {
    $filtered_id = mysqli_real_escape_string($link, $_POST['city_name']);
  }

  $query = "
      SELECT c.name as cname, c.code as ccode, cl.language as cllanguage, ct.info as ctinfo
      FROM city ct
      INNER JOIN country c ON ct.countrycode = c.code
      INNER JOIN countrylanguage cl ON ct.countrycode = cl.countrycode
      WHERE ct.name = '{$filtered_id}'
      ";

  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_array($result);

  $city_info = '';
  while($row = mysqli_fetch_array($result)) {
    $city_info .= '<tr>';
    $city_info .= '<td>'.$row['cname'].'</td>';
    $city_info .= '<td>'.$row['ccode'].'</td>';
    $city_info .= '<td>'.$row['cllanguage'].'</td>';
    $city_info .= '<td>'.$row['ctinfo'].'</td>';
    $city_info .= '</tr>';
  }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>도시명으로 정보 조회</title>
</head>

<body>
    <h2><a href="index.php">인터넷으로 떠나는 세계여행</h2>
    <table border="1">
        <tr>
            <th>Country Name</th>
            <th>Country Code</th>
            <th>Language</th>
            <th>Population</th>
        </tr>
        <?= $city_info ?>

    </table>
</body>

</html>
