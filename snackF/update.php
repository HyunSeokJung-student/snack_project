<?php 
    $connect = mysqli_connect("localhost","root","111111","snackDB");
    $query_previous_al = "SELECT * FROM snack_table_almost WHERE snack_name = '$_POST[update_snackName]';";
    $query_previous_ingr = "SELECT snack_ingredient FROM snack_table_ingredient WHERE snack_name = '$_POST[update_snackName]';";
    $result_previous_al = mysqli_query($connect,$query_previous_al);
    $result_previous_ingr = mysqli_query($connect,$query_previous_ingr);
    $arr_previous_al = mysqli_fetch_array($result_previous_al);
?>
<!DOCTYPE html>
<html>
<head>
    <meta char-set="utf-8">
    <link href="board_style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <a href="view.php?snackName=<?php echo $_POST['update_snackName']?>" class="back">뒤로가기</a>
    <h2><?php echo $_POST['update_snackName']?></h2>
    <form action="update_collect.php" method="POST">
    <div class="update">
    <label for="update_snackName">과자명</label>
    <input name="update_snackName" type="text" value="<?php echo $arr_previous_al['snack_name']?>">
    </div>
    <div class="update">
    <label for="update_origin">원산지</label>
    <input name="update_origin" type="text" value="<?php echo $arr_previous_al['origin']?>">
    </div>
    <div class="update">
    <label for="update_manufacturer">제조사</label>
    <input name="update_manufacturer" type="text" value="<?php echo $arr_previous_al['manufacturer']?>">
    </div>
    <div class="update">
    <label for="update_calorie">칼로리</label>
    <input name="update_calorie" type="number" value="<?php echo $arr_previous_al['calorie']?>">
    </div>
    <div class="update">
    <label for="update_price">가  격</label>
    <input name="update_price" type="number" value="<?php echo $arr_previous_al['price']?>">
    </div>
    <div class="update">
    <label for="update_ingredient">성  분</label>
    <textarea name="update_ingredient" type="text"><?php 
            while($arr_previous_ingr = mysqli_fetch_array($result_previous_ingr)){
                echo "$arr_previous_ingr[snack_ingredient],&#10";
            }
        ?></textarea>
    </div>
    <div class="update">
    <input type="submit" value="수정" name="register">
    </div>
    <input type="hidden" name="previous_snackName" value=<?php echo $_POST['update_snackName']?>>
    </form>
    
</body>
</html>