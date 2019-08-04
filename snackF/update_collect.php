<?php 
    $connect = mysqli_connect("localhost","root","111111","snackDB");
    if(isset($_POST))
    {
        // snack_name 중복여부 판단
        $query_overlap = "SELECT snack_name FROM snack_table_list WHERE snack_name <> '$_POST[previous_snackName]';";        
        $result_is_overlap = mysqli_query($connect,$query_overlap);
        $is_overlap = 0;
        while($arr_is_overlap = mysqli_fetch_array($result_is_overlap)){
            if($arr_is_overlap['snack_name']==$_POST['update_snackName']){
                $is_overlap += 1;
            }
        }
        

        // if 중복되는 상품명이 없는 경우
        if($is_overlap == 0){
            $query_update_table_almost = "UPDATE snack_table_almost
                                            SET snack_name='$_POST[update_snackName]', origin='$_POST[update_origin]', manufacturer='$_POST[update_manufacturer]',
                                                calorie='$_POST[update_calorie]', price='$_POST[update_price]'
                                            WHERE snack_name='$_POST[previous_snackName]';";
            $query_update_table_list ="UPDATE snack_table_list
                                        SET snack_name='$_POST[update_snackName]', time=NOW(), hit=0
                                        WHERE snack_name='$_POST[previous_snackName]';";
                        
            mysqli_query($connect,$query_update_table_almost);
            mysqli_query($connect,$query_update_table_list);

            // ingredient parsing
            $array_ingredient = explode(",".PHP_EOL,$_POST['update_ingredient']);
            $array_ingredient = array_filter($array_ingredient);
            $size_array_ingredient = count($array_ingredient);
            // Bring id which is in tuple to be updated
            $query_id_list = "SELECT id FROM snack_table_ingredient WHERE snack_name='$_POST[previous_snackName]'";
            $result_id_list = mysqli_query($connect,$query_id_list);
            $id_list=array();
            $count_id=mysqli_num_rows($result_id_list);
            for($i=0;$i<$count_id;$i++){
                $id_list[$i]=(int)mysqli_fetch_row($result_id_list)[0];
            }
            if($size_array_ingredient<=$count_id){
               for($i=0;$i<$size_array_ingredient;$i++){
                    $query_update_table_ingredient = "UPDATE snack_table_ingredient 
                                                      SET  snack_name='$_POST[update_snackName]', snack_ingredient='$array_ingredient[$i]'
                                                      WHERE id='$id_list[$i]';";
                    mysqli_query($connect,$query_update_table_ingredient);
               }
                for($i=$size_array_ingredient;$i<$count_id;$i++){
                    $query_delete_remainder="DELETE from snack_table_ingredient WHERE id='$id_list[$i]';";
                    mysqli_query($connect,$query_delete_remainder);
                }
            }else{
                for($i=0;$i<$count_id;$i++){
                    $query_update_table_ingredient = "UPDATE snack_table_ingredient 
                                                        SET  snack_name='$_POST[update_snackName]', snack_ingredient='$array_ingredient[$i]'
                                                       WHERE id='$id_list[$i]';";
                    mysqli_query($connect,$query_update_table_ingredient);
                }
                for($i=$count_id;$i<$size_array_ingredient;$i++){
                    $query_insert_remainder = "INSERT INTO snack_table_ingredient(snack_name,snack_ingredient)
                                                VALUES('$_POST[update_snackName]','$array_ingredient[$i]');";
                    mysqli_query($connect,$query_insert_remainder);
                }               
            }
            echo "<script>alert(\"수정이 완료되었습니다!\");document.location.href='../snack.php';</script>";
        } else {
            echo "<script>alert(\"수정된 과자이름이 이미 존재합니다!\");history.back();</script>";
        }
    } else {
        echo "<script>alert(\"수정 과정중에 오류가 발생했습니다!\");history.back();</script>";
    }
?>