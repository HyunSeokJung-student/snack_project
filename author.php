<?php
    $connect = mysqli_connect("localhost","root","111111","snackDB");
    $query_read_author = "select name, team from author_data where id=0;";
    $result_read_author = mysqli_query($connect,$query_read_author);
    $array_read_author = mysqli_fetch_array($result_read_author);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta char-set="utf-8">
        <link href="snackF/board_style.css" rel="stylesheet" type="text/css">
        <title>author</title>
    </head>
    <body>
    <h2>Author</h2>
        <table>
            <tr>
                <td>이름</td><td><?php echo $array_read_author['name']?></td>
            </tr>
            <tr>
                <td>소속</td><td><?php echo $array_read_author['team']?></td>
            </tr>
        </table>
    </body>
</html>
