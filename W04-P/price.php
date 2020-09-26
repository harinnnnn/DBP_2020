<?php
    $link = mysqli_connect('localhost:3307', 'root', 'root1234', 'dbp');

    $query = "SELECT * FROM price";
    $result = mysqli_query($link, $query);
    $author_info = '';
    while($row = mysqli_fetch_array($result)){
        $filtered = array(
            'id' => htmlspecialchars($row['id']),
            'price' => htmlspecialchars($row['price']),
            'color' => htmlspecialchars($row['color'])
        );
        $author_info .= '<tr>';
        $author_info .= '<td>'.$filtered['id'].'</td>';
        $author_info .= '<td>'.$filtered['price'].'</td>';
        $author_info .= '<td>'.$filtered['color'].'</td>';
        $author_info .= '<td><a href="price.php?id='.$filtered['id'].'">update</a></td>';
        $author_info .= '<td>
            <form action="process_delete_price.php" method="post">
                <input type="hidden" name="id" value="'.$filtered['id'].'">
                <input type="submit" value="delete">
            </form></td>
        ';
        $author_info .= '</tr>';
    };

    $escaped = array(
        'price' => '',
        'color' => ''
    );

    $label_submit = 'Create price';
    $form_action = 'process_create_price.php';
    $form_id = '';

    if(isset($_GET['id'])) {
        $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
        settype($filtered_id, 'integer');
        $query = "SELECT * FROM price WHERE id = {$filtered_id}";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);
        $escaped['price'] = htmlspecialchars($row['price']);
        $escaped['color'] = htmlspecialchars($row['color']);
        $label_submit = 'Update price';
        $form_action = 'process_update_price.php';
        $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
    };
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ALPHAFRUIT</title>
    </head>
    <body>
        <h1><a href="index.php">ALPHAFRUIT</a></h1>
        <p><a href="index.php">topic</a></p>

        <table border="1">
            <tr>
                <th>id</th>
                <th>price</th>
                <th>color</th>
                <th>update</th>
                <th>delete</th>
            </tr>
            <?= $author_info ?>
        </table>
        <br>
        <form action="<?=$form_action?>" method="post">
            <?=$form_id?>
            <label for="fname">price:</label><br>
            <input type="text" id="price" name="price" placeholder="price" value="<?=$escaped['price']?>"><br>
            <label for="lname">color:</label><br>
            <input type="text" id="color" name="color" placeholder="color" value="<?=$escaped['color']?>"><br><br>
            <input type="submit" value="<?=$label_submit?>">
        </form>
    </body>
</html>
