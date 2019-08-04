<!DOCTYPE html>
 
<html>
<head>
        <meta charset = 'utf-8'>
        <link href="snackF/board_style.css" type="text/css" rel="stylesheet">
</head>
<body>
        <?php
                //DB와 연결
                $connect = mysqli_connect('localhost', 'root', '111111','snackDB');
                // snackDB가 존재하지 않을 때
                if($connect == false){
                        $connect = mysqli_connect('localhost','root','111111');
                        $query_create_db = "CREATE DATABASE snackDB;";
                        mysqli_query($connect,$query_create_db);
                        $connect = mysqli_connect('localhost','root','111111','snackDB');
                }
                // snack_table_list가 존재하는지 확인
                $query_exist = "SHOW TABLES LIKE snack_table_list;";
                $result_exist = mysqli_query($connect,$query_exist);
                $row_exist = mysqli_fetch_array($result_exist);
                // snack_table_list가 존재하지 않을 때
                if($row_exist == false){
                        $query_create_table_list = "CREATE TABLE snack_table_list (
                                snack_name VARCHAR(10) NOT NULL,
                                time DATETIME NOT NULL,
                                hit INT(4) DEFAULT 0,
                                PRIMARY KEY(snack_name)
                                );";
                        mysqli_query($connect,$query_create_table_list);
                }
                // snack_table_list에 있는 data 전부 지정
                $query_select_list ="select * from snack_table_list order by snack_name";
                $result = $connect->query($query_select_list);
                $total = mysqli_num_rows($result);
        ?>
        <h2>과자 등록 목록</h2>
        <table>
        <thead>
        <tr>
        <?php if($total == 0) { ?>
                <td>등록된 과자 정보가 없습니다.</td>
        </tr>
        </head>
        </table>
        <!-- if data is in snack_table_list -->
        <?php } else { ?> 
                <td width = "50">번호</td>
                <td width = "500">과자명</td>
                <td width = "200">날짜</td>
                <td width = "100">조회수</td>
        </tr>
        </thead>
 
        <tbody>
        <?php
                $temp_for_list_count= $total-1;

                while($rows = mysqli_fetch_assoc($result)){ //DB에 저장된 데이터 수 (열 기준)

                        $list_count=$total-$temp_for_list_count; // 상품 목록의 번호 결정

                        if($list_count%2==0){?>
                                <tr class = "even">
                <?php   }
                        else{?>
                                <tr>
                        <?php } ?>
                <td width = "50"><?php echo $list_count?></td>
                <td width = "500">
                <a href = "snackF/view.php?snackName=<?php echo $rows['snack_name']?>">
                <?php echo $rows['snack_name']?></td>
                  <td width = "200"><?php echo $rows['time']?></td>
                <td width = "100"><?php echo $rows['hit']?></td>
                </tr>
        <?php
                $temp_for_list_count--;
                }
        ?>
        </tbody>
        </table>
        <?php } ?>
 
        <div class = text>
        <font style="cursor: hand" onClick="location.href='snackF/write.php'">제품등록하기</font>
        </div>
        <div class= text>
        <font style="cursor: hand" onClick="location.href='author.php'">만든사람</font>
        </div>
 
</body>
</html>
