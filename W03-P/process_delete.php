<?php
  $link = mysqli_connect("localhost:3307", "root", "root1234", "dbp");
  settype($_POST['id'], 'integer');
  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id'])
    //수정할때는 id만 알면 됨.
  );
  $query = "
    DELETE
      FROM w02p
      WHERE id = '{$filtered['id']}'
    ";

  // die($query); // 인자로 들어오는 쿼리값을 출력, 프로그램 실행을 멈춰줌.

  $result = mysqli_multi_query($link, $query);
  if($result == false) {
    echo '삭제하는 과정에서 문제가 발생했습니다. 관리자에게 문의하세요.';
    error_log(mysql_error($link));
  } else {
    echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }

 ?>
