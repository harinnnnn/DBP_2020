<?php
  $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'world_x');
  $filtered_order = mysqli_real_escape_string($link, $_POST['order']);

  if($filtered_order == 'asc') {
    $query = "SELECT
              c.name as cname, ct.name as ctname, ct.info as ctinfo
              FROM country c
              INNER JOIN city ct ON c.capital = ct.id
              ORDER BY c.name";
  } else if ($filtered_order == 'desc') {
    $query = "SELECT
              c.name as cname, ct.name as ctname, ct.info as ctinfo
              FROM country c
              INNER JOIN city ct ON c.capital = ct.id
              ORDER BY c.name desc";
  }


  $result = mysqli_query($link, $query);
  $population_info = '';
  while($row = mysqli_fetch_array($result)) {
    $population_info .= '<tr>';
    $population_info .= '<td>'.$row['cname'].'</td>';
    $population_info .= '<td>'.$row['ctname'].'</td>';
    $population_info .= '<td>'.$row['ctinfo'].'</td>';
    $population_info .= '</tr>';
  }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>국가의 수도별 인구 수</title>
</head>

<body>
    <h2><a href="index.php">인터넷으로 떠나는 세계여행</h2>
    <table border="1">
        <tr>
            <th>Country Name</th>
            <th>Capital</th>
            <th>Population</th>
        </tr>
        <?= $population_info ?>

    </table>
</body>

</html>
