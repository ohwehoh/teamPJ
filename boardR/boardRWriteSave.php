<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $memberID = $_SESSION['memberID'];
    $boardAuthor = $_SESSION['youID'];
    $boardTitle = $_POST['boardTitle'];
    $boardContents = nl2br($_POST['boardContents']);
    $boardView = 1;
    $boardLike = 0;
    $regTime = time();

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);

    $boardImgFile = $_FILES['boardPhoto'];
    $boardImgSize = $_FILES['boardPhoto']['size'];
    $boardImgType = $_FILES['boardPhoto']['type'];
    $boardImgName = $_FILES['boardPhoto']['name'];
    $boardImgTmp = $_FILES['boardPhoto']['tmp_name'];

    //이미지 파일명 확인
    $fileTypeExtension = explode("/", $boardImgType); //문자열쪼개기
    $fileType = $fileTypeExtension[0]; //image
    $fileExtension = $fileTypeExtension[1]; //jpeg

    $check = false;


    //이미지 확인 작업 / 이미지 확장자 확인 작업 / 용량 확인
    if($fileType == "image"){
        //확장자 확인
        if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension = "gif"){
            $boardImgDir = "../assets/img/boardR/";
            $boardImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";

            if($boardImgSize <= 1000000){
                $sql = "INSERT INTO TPBoardR(memberID, boardTitle, boardContents, boardCategory, boardAuthor, boardView, boardLike, boardImgFile, boardImgSize, boardDelete, boardRegTime) VALUES('$memberID', '$boardTitle', '$boardContents', '$boardCate', '$boardAuthor', '$boardView', '$boardLike', '$boardImgName', '$boardImgSize', '1', '$regTime')";
                $check = true;
            } else {
                echo "<script>alert('이미지의 용량이 너무 큽니다. 1MB이하의 사진 파일만 지원합니다..'); history.back(1)</script>";
                $check = false;
            }
        } else {
            echo "<script>alert('지원하는 이미지 파일 형식이 아닙니다. jpg, png, gif 사진 파일만 지원 합니다.'); history.back(1)</script>";
            $check = false;
        }
    } else {
        $sql = "INSERT INTO TPBoardR(memberID, boardTitle, boardContents, boardCategory, boardAuthor, boardView, boardLike, boardImgFile, boardDelete, boardRegTime) VALUES('$memberID', '$boardTitle', '$boardContents', '$boardCate', '$boardAuthor', '$boardView', '$boardLike', 'default.jpg', '1', '$regTime')";
        $check = true;
    }
    if($check == true){
        $result = $connect-> query($sql);
        $result = move_uploaded_file($boardImgTmp, $boardImgDir.$boardImgName);
        Header("Location: boardR.php");
    }
?>