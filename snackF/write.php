<!DOCTYPE html>
<html>
<head>
    <meta char-set="utf-8">
    <link href="board_style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <a href="../snack.php" class="back">뒤로가기</a>
    <h2>과 자 등 록</h2>
    <form action="write_collect.php" method="POST">
    <div class="write">
    <label for="write_snackName">과자명</label>
    <input name="write_snackName" type="text" placeholder="과자명">
    </div>
    <div class="write">
    <label for="write_origin">원산지</label>
    <input name="write_origin" type="text" placeholder="원산지">
    </div>
    <div class="write">
    <label for="write_manufacturer">제조사</label>
    <input name="write_manufacturer" type="text" placeholder="제조사">
    </div>
    <div class="write">
    <label for="write_calorie">칼로리</label>
    <input name="write_calorie" type="number" placeholder="칼로리">
    </div>
    <div class="write">
    <label for="write_price">가  격</label>
    <input name="write_price" type="number" placeholder="가격">
    </div>
    <div class="write">
    <label for="write_ingredient">성  분</label>
    <textarea name="write_ingredient" type="text" placeholder="성분 간에 ,(콤마)로 표시해주세요 &#10 ex)설탕,밀가루, 소금"></textarea>
    </div>
    <div class="write">
    <input type="submit" value="등록" name="register">
    </div>
    </form>
    
</body>
</html>