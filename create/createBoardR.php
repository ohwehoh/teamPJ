<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE TPBoardR (";
    $sql .= "boardID int(10) unsigned auto_increment,";
    $sql .= "memberID int(10) unsigned NOT NULL,";
    $sql .= "boardTitle varchar(255) NOT NULL,";
    $sql .= "boardContents longtext NOT NULL,";
    $sql .= "boardCategory varchar(20) NOT NULL,";
    $sql .= "boardAuthor varchar(20) NOT NULL,";
    $sql .= "boardView int(10) NOT NULL,";
    $sql .= "boardLike int(10) NOT NULL,";
    $sql .= "boardImgFile varchar(100) DEFAULT NULL,";
    $sql .= "boardImgSize varchar(100) DEFAULT NULL,";
    $sql .= "boardDelete int(10) NOT NULL,";
    $sql .= "boardRegTime int(20) NOT NULL,";
    $sql .= "boardModTime int(20) DEFAULT NULL,";
    $sql .= "PRIMARY KEY (boardID)";
    $sql .= ") charset=utf8;";

    $result = $connect -> query($sql);

    if($result){
        echo "create table true";
    } else {
        echo "create table false";
    }
?>