<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    // 데이터 가져오기
    $youID = $_GET['youID'];
    $skinType = $_POST['skinType'];
    $skinTone = $_POST['skinTone'];
    $skinWorry = $_POST['skinWorry'];
    $hairType = $_POST['hairType'];
    $hairWorry = $_POST['hairWorry'];
    $freeText = $_POST['freeText'];
    
    // 데이터 가져오기 확인
    echo $youID, $skinType, $skinTone, $skinWorry, $hairType, $hairWorry, $freeText, $regTime;

    // // sql문 작성
    $sql = "UPDATE TPmyMember SET skinType = '{$skinType}', skinTone = '{$skinTone}', skinWorry = '{$skinWorry}', hairType = '{$hairType}', hairWorry = '{$hairWorry}', freeText = '{$freeText}' WHERE youID = '{$youID}'";

    // 데이터 추가하기 - 회원가입
    $result = $connect -> query($sql);
    if($result){
        echo "성공";
    } else{
        echo "<script>alert('에러발생02 -- 관리자에게 문의하세요'); history.back(1);</script>";
    }
?>

<script>
    let youID = "<?php echo $youID;?>";
    location.href = "joinFinish.php?youID="+youID;
</script>