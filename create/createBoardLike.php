<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE TPBoardRLike (";
    $sql .= "likeID int(10) unsigned auto_increment,";
    $sql .= "memberID int(10) NOT NULL,";
    $sql .= "boardID int(10) NOT NULL,";
    $sql .= "PRIMARY KEY (likeID)";
    $sql .= ") charset=utf8;";

    $result = $connect -> query($sql);

    if($result){
        echo "create table true";
    } else {
        echo "create table false";
    }
?>