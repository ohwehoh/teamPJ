<?php
    if ($_POST['select1'] == 'agree'){
        $select1 = true;
    } else {
        $select1 = false;
    }

    if ($_POST['select2'] == 'agree'){
        $select2 = true;
    } else {
        $select2 = false;
    }

    if ($_POST['select3'] == 'agree'){
        $select3 = true;
    } else {
        $select3 = false;
    }

    if ($_POST['select4'] == 'agree'){
        $select4 = true;
    } else {
        $select4 = false;
    }

    if($select1 == true && $select2 == true && $select3 == true && $select4 == true){
        Header("Location: join2.php");
    } else{
        echo "<script>alert('동의사항을 동의하지 않으면 회원가입 할 수 없습니다!'); history.back(1)</script>";
    }
?>