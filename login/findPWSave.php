<?php 
    include "../connect/connect.php";

    $youID = $_POST['youID'];
    $youEmail = $_POST['youEmail'];
    //echo $youID, $youPass, $youPassC, $youName, $youBirth, $youGender, $youEmail, $youPhone, $youPhoneCheck, $regTime;

    //아이디 찾기
    $sql = "SELECT youID, youEmail, youPass FROM TPmyMember WHERE youID = '$youID' && youEmail = '$youEmail'";
    $result = $connect -> query($sql);
    $count = $result -> num_rows;
    if($count){
        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
        $to = "{$memberInfo['youEmail']}";
        $subject = "남자다움 회원님의 비밀번호입니다.";
        $contents = "회원님의 비밀번호는 '{$memberInfo['youPass']}'입니다.";
        $headers = "From: ohwehoh@naver.com\r\n";

        mail($to, $subject, $contents, $headers);
        Header("Location: findPWFinish.php");
    } else {
        Header("Location: findFail.php");
    }
?>