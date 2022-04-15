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
    <title>수정세이브</title>
</head>
<body>
    <?php
        $boardID = $_POST['boardID'];
        $boardTitle = $_POST['boardTitle'];
        $boardContents = nl2br($_POST['boardContents']);
        $youPass = $_POST['youPass'];
        $author = $_POST['memberID'];
        $memberID = $_SESSION['memberID'];
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

        
        //쿼리문 작성
        $sql = "SELECT youPass FROM TPmyMember WHERE memberID = {$memberID}";
        $result = $connect -> query($sql);

        if($result){
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

            echo "<pre>";
            var_dump($memberInfo);
            echo "</pre>";

            //아이디 비밀번호 확인
            if($memberInfo['youPass'] == $youPass && $author == $memberID){
                //이미지 확인 작업 / 이미지 확장자 확인 작업 / 용량 확인
                if($fileType == "image"){
                    //확장자 확인
                    if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension = "gif"){
                        $boardImgDir = "../assets/img/boardR/";
                        $boardImgName = "Img_".time().rand(1,99999)."."."{$fileExtension}";

                        if($boardImgSize <= 1000000){
                            $sql = "UPDATE TPBoardR SET boardImgFile = '{$boardImgName}' WHERE boardID = '{$boardID}'";
                            $check = true;
                        } else {
                            echo "<script>alert('이미지의 용량이 너무 큽니다. 1MB이하의 사진 파일만 지원합니다..'); history.back(1)</script>";
                            $check = false;
                        }
                    } else {
                        echo "<script>alert('지원하는 이미지 파일 형식이 아닙니다. jpg, png, gif 사진 파일만 지원 합니다.'); history.back(1)</script>";
                        $check = false;
                    }
                }
                if($check == true){
                    $result = $connect-> query($sql);
                    $result = move_uploaded_file($boardImgTmp, $boardImgDir.$boardImgName);
                }

                //수정(쿼리문 작성)
                $sql = "UPDATE TPBoardR SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}', boardModTime = '{$regTime}' WHERE boardID = '{$boardID}'";
                $connect -> query($sql);
                echo "수정이 완료되었습니다.";
            } else if($memberInfo['youPass'] != $youPass) {
                echo "<script>alert('비밀번호가 일치하지 않습니다. 다시 한번 확인해주세요.'); history.back(1)</script>";
            } else if($author != $memberID) {
                echo "<script>alert('당신은 작성자가 아닙니다.')</script>";
            } else {
                echo "<script>alert('오류입니다. 다시 한번 확인해주세요.');history.back(1)</script>";
            }
        }
    ?>
    <script>
        location.href = "boardRView.php?boardID=<?=$boardID?>";
    </script>
</body>
</html>