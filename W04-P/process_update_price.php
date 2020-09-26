<?php
    $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'dbp');
    settype($_POST['id'], 'integer');
    $filtered = array(
        'id' => mysqli_real_escape_string($link, $_POST['id']),
        'price' => mysqli_real_escape_string($link, $_POST['price']),
        'color' => mysqli_real_escape_string($link, $_POST['color'])
    );

    $query = "
        UPDATE price
            SET
                price = '{$filtered['price']}',
                color = '{$filtered['color']}'
            WHERE
                id = '{$filtered['id']}'
    ";

    $result = mysqli_query($link, $query);
    if( $result == false ){
        echo '수정하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
        error_log(mysqli_error($link));
    } else {
        header('Location:price.php?id='.$filtered['id']);
    }
?>
