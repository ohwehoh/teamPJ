<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삭제하기</title>
</head>
<body>
    <?php
    
        $boardID = $_GET['boardID'];
        $userID = $_SESSION['memberID'];
        $boardID = $connect -> real_escape_string($boardID);
        
        //본인확인
        $sql = "SELECT memberID FROM TPBoardR WHERE boardID = {$boardID}";
        $result = $connect -> query($sql);
        $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);

        if($boardInfo['memberID'] == $_SESSION['memberID']){
            $sql = "DELETE FROM TPBoardR WHERE boardID = {$boardID}";
            $connect -> query($sql);

            echo "<script>alert('삭제되었습니다.'); location.href = 'boardR.php';</script>";
        } else {
            echo "<script>alert('당신은 작성자가 아닙니다.'); location.href = 'boardR.php';</script>";
        }        
    ?>
</body>
</html>