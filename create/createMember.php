<?php
    include "../connect/connect.php";
    $sql = "CREATE TABLE TPmyMember (";
    $sql .= "memberID int(10) unsigned auto_increment,";
    $sql .= "youID varchar(40) UNIQUE NULL,";
    $sql .= "youPass varchar(40) NOT NULL,";
    $sql .= "youEmail varchar(40) UNIQUE NULL,";
    $sql .= "youName varchar(20) NOT NULL,";
    $sql .= "youBirth varchar(20) NOT NULL,";
    $sql .= "youPhone varchar(20) NOT NULL,";
    $sql .= "youGender enum('남자', '여자') NOT NULL,";
    $sql .= "youBackground varchar(225) DEFAULT NULL,";
    $sql .= "youPhoto varchar(225) DEFAULT NULL,";
    $sql .= "youIntro varchar(225) DEFAULT NULL,";
    $sql .= "youselect1 enum('O', 'X') NOT NULL,";
    $sql .= "youselect2 enum('O', 'X') NOT NULL,";
    $sql .= "youselect3 enum('O', 'X') NOT NULL,";
    $sql .= "youselect4 enum('O', 'X') NOT NULL,";
    $sql .= "skinType varchar(40) DEFAULT NULL,";
    $sql .= "skinTone varchar(40) DEFAULT NULL,";
    $sql .= "skinWorry varchar(40) DEFAULT NULL,";
    $sql .= "hairType varchar(40) DEFAULT NULL,";
    $sql .= "hairWorry varchar(40) DEFAULT NULL,";
    $sql .= "freeText varchar(40) DEFAULT NULL,";
    $sql .= "regTime int(11) NOT NULL,";
    $sql .= "PRIMARY KEY (memberID)";
    $sql .= ") charset=utf8;";
    $result = $connect -> query($sql);
    
    if($result){
        echo "create table true";
    } else {
        echo "create table false";
    }
?>