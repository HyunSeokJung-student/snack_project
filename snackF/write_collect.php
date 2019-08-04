<?php 

    $connect = mysqli_connect("localhost","root","111111","snackDB");

    $query_exist_al = "SHOW TABLES LIKE snack_table_almost;";
    $result_exist_al = mysqli_query($connect,$query_exist_al);
    $row_exist_al = mysqli_fetch_array($result_exist_al);

    if($row_exist_al==false){
        $query_create_al = "CREATE TABLE snack_table_almost (
                             snack_name VARCHAR(10) NOT NULL,
                             origin VARCHAR(15) NOT NULL,
                             manufacturer VARCHAR(8) NOT NULL,
                             calorie INT(4) NOT NULL,
                             price INT(5) NOT NULL,
                             PRIMARY KEY(snack_name)
                             );";
        mysqli_query($connect,$query_create_al);
    }

    $query_exist_ingr = "SHOW TABLES LIKE snack_table_ingredient;";
    $result_exist_ingr = mysqli_query($connect,$query_exist_ingr);
    $row_exist_ingr = mysqli_fetch_array($result_exist_ingr);

    if($row_exist_ingr==false){
      $query_create_ingr = "CREATE TABLE snack_table_ingredient (
            snack_name VARCHAR(10) NOT NULL,
            snack_ingredient VARCHAR(10) NOT NULL,
            id INT(5) AUTO_INCREMENT PRIMARY KEY
            );";
        mysqli_query($connect,$query_create_ingr);
    }



    if(isset($_POST))
    {
        // snack_name 중복여부 판단
        $query_overlap = "SELECT * FROM snack_table_list WHERE snack_name = '$_POST[write_snackName]';";        
        $result_is_overlap = mysqli_query($connect,$query_overlap);
        $is_overlap = mysqli_num_rows($result_is_overlap);

        // if 중복되는 상품명이 없는 경우
        if($is_overlap == 0){
            $query_insert_table_almost = "INSERT INTO snack_table_almost(snack_name,origin,manufacturer,calorie,price)
                                      VALUES('$_POST[write_snackName]','$_POST[write_origin]','$_POST[write_manufacturer]','$_POST[write_calorie]','$_POST[write_price]'); ";
            $query_insert_table_list ="INSERT INTO snack_table_list(snack_name,time)
                                      VALUES('$_POST[write_snackName]',NOW());";
            mysqli_query($connect,$query_insert_table_almost);
            mysqli_query($connect,$query_insert_table_list);

            // ingredient parsing
            $array_ingredient = explode(",",$_POST['write_ingredient']);
            foreach($array_ingredient as $key => $ch){
                $query_insert_table_ingredient = "INSERT INTO snack_table_ingredient(snack_name,snack_ingredient)
                                                   VALUES('$_POST[write_snackName]','$ch');";
                mysqli_query($connect,$query_insert_table_ingredient);
            }
            echo "<script>alert(\"등록이 완료되었습니다!\");document.location.href='../snack.php';</script>";
        } else {
            echo "<script>alert(\"이미 등록된 과자정보입니다!\");document.location.href='write.php';);</script>";
        }
    } else {
        echo "<script>alert(\"등록 과정중에 오류가 발생했습니다!\");document.location.href='write.php';</script>";
    }
?>