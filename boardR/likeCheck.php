<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    //변수 설정
    $check = $_POST['check'];
    $boardID = $_POST['boardID'];
    $likeID = $_POST['likeID'];
    $memberID = $_SESSION['memberID'];

    if($check == 1){
        // echo "<script>alert('좋아요');</script>";
        $sql = "UPDATE TPBoardR SET boardLike = boardLike + 1 WHERE boardID = {$boardID}";
        $result = $connect -> query($sql);

        $sql = "INSERT INTO TPBoardRLike(memberID, boardID) VALUES('$memberID', '$boardID')";
        $result = $connect -> query($sql);
    } else {
        // echo "<script>alert('좋아요 취소');</script>";
        $sql = "UPDATE TPBoardR SET boardLike = boardLike - 1 WHERE boardID = {$boardID}";
        $result = $connect -> query($sql);

        $sql = "DELETE FROM TPBoardRLike WHERE likeID = {$likeID}";
        $result = $connect -> query($sql);
    }

    $sql = "SELECT boardLike FROM TPBoardR WHERE boardID = {$boardID}";
    $result = $connect -> query($sql);
    $boardlike = $result -> fetch_array(MYSQLI_ASSOC);
    $boardlike = $boardlike['boardLike'];

    echo json_encode(array("result" => $boardlike));
?>