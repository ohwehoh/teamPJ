<?php
    include "../connect/connect.php";

    for($i=1; $i<=100; $i++){
        $regTime = time();

        $sql = "INSERT INTO TPBoardR(memberID, boardTitle, boardContents, boardCategory, boardAuthor, boardView, boardLike, boardImgFile, boardDelete, boardRegTime) values(1, '리뷰 게시판 타이틀${i}입니다.', '리뷰 게시판 내용${i}입니다.', '제품리뷰', '작성자', '1', '0', 'default.jpg', '1',  '$regTime')";
        $connect -> query($sql);
    }

?>