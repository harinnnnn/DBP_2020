<?php
    $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'dbp');

    $filtered = array(
        'title' => mysqli_real_escape_string($link, $_POST['title']),
        'description' => mysqli_real_escape_string($link, $_POST['description']),
        'price_id' => mysqli_real_escape_string($link, $_POST['price_id'])
    );
    $query = "
        INSERT INTO w02p
            (title, description, created, price_id)
            VALUES(
                '{$filtered['title']}',
                '{$filtered['description']}',
                NOW(),
                '{$filtered['price_id']}'
            )
    ";

    $result = mysqli_multi_query($link, $query);
    if ($result == false) {
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        error_log(mysqli_error($link));
    } else {
        echo '성공했습니다. <a href="index.php">돌아가기</a>';
    }
