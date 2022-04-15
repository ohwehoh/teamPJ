<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youID = $_POST['youID'];
    $youPass = $_POST['youPW'];
    
    //메세지 출력
    function msg($alert){
        echo "<p class='alert'>{$alert}</p>";
    }

    $sql = "SELECT memberID, youPass, youID, youName, youEmail FROM TPmyMember WHERE youID = '$youID' AND youPass = '$youPass'";
    $result = $connect -> query($sql);
    if($result){
        $count = $result -> num_rows;
        if($count == 0){
            msg("아이디 또는 비밀번호가 잘못되었습니다. 다시 한번 확인해주세요!");
            exit;
        } else {
            //로그인 성공
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

            //섹션 추가
            $_SESSION['memberID'] = $memberInfo['memberID'];
            $_SESSION['youName'] = $memberInfo['youName'];
            $_SESSION['youEmail'] = $memberInfo['youEmail'];
            $_SESSION['youID'] = $memberInfo['youID'];

            //메인으로 이동
            Header("Location: ../main/main.php");

            //섹션 보기
            echo "<pre>";
            var_dump($memberInfo);
            echo "</pre>";
        }
    }
?>
