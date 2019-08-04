<?php 
        $connect = mysqli_connect('localhost','root','111111','snackDB');
        $query_read_al = "SELECT * FROM snack_table_almost WHERE snack_name = '$_GET[snackName]';";
        $query_read_ingr = "SELECT snack_ingredient FROM snack_table_ingredient WHERE snack_name = '$_GET[snackName]';";
        $result_read_al = mysqli_query($connect,$query_read_al);
        $result_read_ingr = mysqli_query($connect,$query_read_ingr);
        $assoc_read_al = mysqli_fetch_assoc($result_read_al);
       
        $query_hit = "UPDATE snack_table_list
                        SET hit = hit+1
                        WHERE snack_name = '$_GET[snackName]';";
        mysqli_query($connect,$query_hit);
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta char-set="utf-8">
    <link href="board_style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <a href="../snack.php" class="back">뒤로가기</a>
    <h2><?php echo $assoc_read_al['snack_name']?></h2>
    <table>
        <tr>
            <td class="description">과자명</td>
            <td class="content"><?php echo $assoc_read_al['snack_name'] ?></td>
        </tr>
        <tr>
            <td class="description">원산지</td>
            <td class="content"><?php echo $assoc_read_al['origin'] ?></td>
        </tr>
        <tr>
            <td class="description">제조사</td>
            <td class="content"><?php echo $assoc_read_al['manufacturer'] ?></td>
        </tr>
        <tr>
            <td class="description">칼로리</td>
            <td class="content"><?php echo $assoc_read_al['calorie'] ?></td>
        </tr>
        <tr>
            <td class="description">가  격</td>
            <td class="content"><?php echo $assoc_read_al['price'] ?></td>
        </tr>
        <tr  style="height:100px">
            <td class="description">성  분</td>
            <td class="content"><?php 
                while($row_read_ingr = mysqli_fetch_row($result_read_ingr)){
                    echo "$row_read_ingr[0]<br>";
                }
            ?></td>
        </tr>
    </table>
    <div id='functionbtn'>
        <form action="update.php" method="post">
            <input type="hidden" name="update_snackName" value=<?php echo $_GET['snackName']?>>
            <input type="submit" value="수정">
        </form>
        <form action="delete.php" method="post">
            <input type="hidden" name="delete_snackName" value=<?php echo $_GET['snackName']?>>
            <input type="submit" value="삭제">
        </form>
    </div>
</body>
</html>