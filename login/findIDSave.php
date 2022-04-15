<?php 
    include "../connect/connect.php";

    $youName = $_POST['youName'];
    $youPhone = $_POST['youPhone'];
    //echo $youID, $youPass, $youPassC, $youName, $youBirth, $youGender, $youEmail, $youPhone, $youPhoneCheck, $regTime;

    //휴대폰 번호 유효성 검사
    $check_phone = preg_match("/^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/", $youPhone);
    if($check_phone == false){
        echo "<script>alert('핸드폰번호 입력 양식이 잘못되었습니다. 다시 확인해주세요.'); history.back(1)</script>";
        exit;
    }
    $check_phone = $connect -> real_escape_string($check_phone); 

    //아이디 찾기
    $sql = "SELECT youID, youName, youPhone FROM TPmyMember WHERE youName = '$youName' && youPhone = '$youPhone'";
    $result = $connect -> query($sql);
    $count = $result -> num_rows;
    if($count){
        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
        Header("Location: findIDFinish.php?youID={$memberInfo['youID']}");
    } else {
        Header("Location: findFail.php");
    }
?>