<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 인터넷으로 떠나는 세계여행 </title>
</head>

<body>
    <h1> 나라 별 정보 조회 </h1>
    <form action="world_select.php" method="POST">
        (1) 국가명으로 검색:
        <input type="text" name="country_name" placeholder="country_name">
        <input type="submit" value="Search">
    </form>
    <form action="city_select.php" method="POST">
        (2) 도시명으로 검색:
        <input type="text" name="city_name" placeholder="city_name">
        <input type="submit" value="Search">
    </form>
    <form action="info_select.php" method="POST">
        (3) 각국의 수도별 인구 수:
        <label><input type="radio" name="order" value="asc" checked>오름차순</label>
        <label><input type="radio" name="order" value="desc" checked>내림차순</label>
        <input type="submit" value="Search">
    </form>
    <!-- <a href="info_select.php">(3) 각국의 수도별 인구 수 </a> -->


</body>

</html>
