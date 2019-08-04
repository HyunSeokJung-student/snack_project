<?php 
    $connect = mysqli_connect("localhost","root","111111","snackDB");
    $query_delete_list = "DELETE FROM snack_table_list WHERE snack_name='$_POST[delete_snackName]';";
    $query_delete_al = "DELETE FROM snack_table_almost WHERE snack_name='$_POST[delete_snackName]';";
    $query_delete_ingr = "DELETE FROM snack_table_ingredient WHERE snack_name='$_POST[delete_snackName]';";
    mysqli_query($connect,$query_delete_list);
    mysqli_query($connect,$query_delete_al);
    mysqli_query($connect,$query_delete_ingr);
    echo "<script>alert(\"해당 정보 삭제가 완료되었습니다!\");document.location.href='../snack.php';</script>";
?>