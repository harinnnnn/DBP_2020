<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');
    
    if (mysqli_connect_errno()) {
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }


    $query = "
        SELECT d.dept_name, e.first_name, e.last_name, e.gender, e.hire_date 
        FROM employees e
        INNER JOIN dept_manager de ON e.emp_no=de.emp_no
        INNER JOIN departments d ON de.dept_no=d.dept_no
        ORDER BY e.hire_date;
    ";

    $result = mysqli_query($link, $query); // link에게 query를 던져줘
    
    $article = '';
    while ($row = mysqli_fetch_array($result)) {
        $article .= '<tr><td>';
        $article .= $row['dept_name'];
        $article .= '</td><td>';
        $article .= $row['first_name'];
        $article .= '</td><td>';
        $article .= $row['last_name'];
        $article .= '</td><td>';
        $article .= $row['gender'];
        $article .= '</td><td>';
        $article .= $row['hire_date'];
        $article .= '</td></tr>';
    }

    mysqli_free_result($result);
    mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="uft-8">
    <title> 부서별 매니저 정보 </title>
    <style>
        body{
            font-family: Consolas, monospace;
            font-family: 12px;
        }
        table{
            width: 100%;
        }
        th, td{
            padding: 10px;
            border-bottom: 1px solid #dadada;
        }
    </style>

</head>
<body>
        <h2><a href="index.php"> 직원 관리 시스템 </a> | 부서별 매니저 정보 </h2>
        <table>
            <tr>
                <th>부서명</th>
                <th>성</th>
                <th>이름</th>
                <th>성별</th>
                <th>고용일</th>
            </tr>
            <?= $article ?>
            
        </table>
</body>
</html>