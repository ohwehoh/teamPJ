<?php
    include "../connect/connect.php";

    for($i=1; $i<=300; $i++){
        $regTime = time();

        $sql = "INSERT INTO PmyBoard(memberID, boardTitle, boardContents, boardView, regTime) VALUES(1, '게시판 타이틀${i}입니다', '게시판 내용${i}입니다. 어제는 사람이 쫌 있었는데. 오늘은 없네', '1', '$regTime')";
        
        $connect -> query($sql);
    }
    for($i=1; $i<=300; $i++){
        $regTime = time();

        $sql = "INSERT INTO PmyBoard02(memberID, boardTitle, boardContents, boardView, regTime) VALUES(1, '게시판 타이틀${i}입니다', '게시판 내용${i}입니다. 어제는 사람이 쫌 있었는데. 오늘은 없네', '1', '$regTime')";
        
        $connect -> query($sql);
    }
?>
