<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    // 데이터 가져오기
    $youID = $_POST['youID'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youEmail = $_POST['youEmail'];
    $youName = $_POST['youName'];
    $youBirth = $_POST['youBirth'];
    $youPhone = $_POST['youPhone'];
    $youGender = $_POST['youGender'];
    $youselect1 = 'O';
    $youselect2 = 'O';
    $youselect3 = 'O';
    $youselect4 = 'O';
    $regTime = time();

    // 데이터 가져오기 확인
    //echo $youID, $youPass, $youPassC, $youEmail, $youName, $youBirth, $youPhone, $youGender, $youselect1, $youselect2, $youselect3, $youselect4, $regTime;
    
    // sql 작성
    $sql = "INSERT INTO TPmyMember(youID, youPass, youEmail, youName, youBirth, youPhone, youGender, youselect1, youselect2, youselect3, youselect4, regTime) VALUES('$youID', '$youPass', '$youEmail', '$youName', '$youBirth', '$youPhone', '$youGender', '$youselect1', '$youselect2', '$youselect3', '$youselect4', '$regTime')";

    // 데이터 추가하기 - 회원가입
    $result = $connect -> query($sql);
    if($result){
        echo "성공";
    } else{
        echo "<script>alert('에러발생01 -- 관리자에게 문의하세요'); history.back(1);</script>";
    }
?>

<script>
    let youID = "<?php echo $youID;?>";
    location.href = "join3.php?youID="+youID;
</script>

