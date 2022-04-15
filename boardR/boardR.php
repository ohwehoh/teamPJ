<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리뷰게시판</title>

    <?php
        include "../include/css.php";
    ?>
</head>
<body>
    <?php
        include "../include/header.php";
    ?>

    <main id="main">
        <h2 class="ir_so">리뷰게시판</h2>
        <section id="section" class="">
            <div class="container">
                <div class="boardR__head">
                    <h3 class="boardR__title">리뷰 게시판</h3>
                    <div class="board__search">
                            <form action="boardRSearch.php" name="boardSearch" method="get">
                                <fieldset>
                                    <legend class="ir_so">게시판 검색 영역</legend>
                                    <div>
                                        <input type="search" id="search-form" name="search-form" class="search-form" placeholder="검색어를 입력하세요!" aria-label="search" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="search-btn">
                                            <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="45" height="45" rx="5" fill="#5066B0"/>
                                                <path d="M32.7094 30.2904L28.9994 26.6104C30.4395 24.8148 31.1369 22.5357 30.9482 20.2417C30.7595 17.9477 29.6991 15.8132 27.9849 14.277C26.2708 12.7409 24.0332 11.9199 21.7323 11.9829C19.4315 12.0458 17.2421 12.988 15.6146 14.6155C13.987 16.2431 13.0448 18.4324 12.9819 20.7333C12.9189 23.0342 13.7399 25.2718 15.2761 26.9859C16.8122 28.7001 18.9467 29.7605 21.2407 29.9492C23.5347 30.1379 25.8138 29.4405 27.6094 28.0004L31.2894 31.6804C31.3824 31.7741 31.493 31.8485 31.6148 31.8993C31.7367 31.9501 31.8674 31.9762 31.9994 31.9762C32.1314 31.9762 32.2621 31.9501 32.384 31.8993C32.5059 31.8485 32.6165 31.7741 32.7094 31.6804C32.8897 31.4939 32.9904 31.2447 32.9904 30.9854C32.9904 30.7261 32.8897 30.4769 32.7094 30.2904ZM21.9994 28.0004C20.6149 28.0004 19.2616 27.5899 18.1104 26.8207C16.9593 26.0515 16.0621 24.9583 15.5323 23.6792C15.0024 22.4001 14.8638 20.9926 15.1339 19.6348C15.404 18.2769 16.0707 17.0296 17.0497 16.0506C18.0286 15.0717 19.2759 14.405 20.6338 14.1349C21.9917 13.8648 23.3991 14.0034 24.6782 14.5332C25.9573 15.063 27.0505 15.9603 27.8197 17.1114C28.5889 18.2625 28.9994 19.6159 28.9994 21.0004C28.9994 22.8569 28.2619 24.6374 26.9492 25.9501C25.6364 27.2629 23.8559 28.0004 21.9994 28.0004Z" fill="white"/>
                                            </svg>
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review__popular">
                <div class="container">
                    <h3 class="find">TOP3</h3>
                    <div class="popular__box">
                        <?php
                            $sql = "SELECT boardImgFile, boardTitle, boardContents, boardAuthor, boardRegTime, boardID FROM TPBoardR ORDER BY boardView DESC LIMIT 3";
                            $result = $connect -> query($sql);

                            if($result) {
                                foreach($result as $boardInfo){ ?>
                                <div class="review__cont">
                                    <a href="boardRView.php?boardID=<?=$boardInfo['boardID']?>">
                                        <div class="img" style="background-image: url(../assets/img/boardR/<?=$boardInfo['boardImgFile']?>);"></div>
                                        <div class="author"><?=$boardInfo['boardAuthor']?></div>
                                        <div class="title"><?=$boardInfo['boardTitle']?></div>
                                        <div class="cont"><?=$boardInfo['boardContents']?></div>
                                        <div class="date"><?=date('Y-m-d', $boardInfo['boardRegTime'])?></div>
                                    </a>
                                </div>
                        <?php   ;}
                            } ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="board__inner">
                    <?php
                        if(isset($_SESSION['memberID'])){
                    ?>
                    <div class="boardWrite__btn">
                        <a href="boardRWrite.php" class="write-btn">작성하기</a>
                    </div>
                    <?php ;} ?>
                    <div class="review__box">
                            <?php
                                if(isset($_GET['page'])){
                                    $page = (int) $_GET['page'];
                                } else {
                                    $page = 1;
                                }

                                $pageView = 9;
                                $pageLimit = ($pageView * $page) - $pageView;

                                $sql = "SELECT boardImgFile, boardTitle, boardContents, boardAuthor, boardRegTime, boardID, boardLike FROM TPBoardR ORDER BY boardID DESC LIMIT {$pageLimit}, {$pageView}";
                                $result = $connect -> query($sql);
                                
                                if($result) {
                                    $count = $result -> num_rows;
                                    if($count > 0){
                                        for($i = 1; $i<=$count; $i++){ 
                                            $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
                            ?>
                                            
                                            <div class="review__cont">
                                                <a href="boardRView.php?boardID=<?=$boardInfo['boardID']?>">
                                                    <div class="img" style="background-image: url(../assets/img/boardR/<?=$boardInfo['boardImgFile']?>);"></div>
                                                    <div class="author"><?=$boardInfo['boardAuthor']?></div>
                                                    <div class="title"><?=$boardInfo['boardTitle']?></div>
                                                    <div class="cont"><?=$boardInfo['boardContents']?></div>
                                                    <div class="cont__footer">
                                                        <div class="date"><span><?=date('Y-m-d', $boardInfo['boardRegTime'])?></span></div>
                                                        <div class="like"><img src="../assets/img/boardR/like.svg" alt="좋아요"><span class="like__span"><?=$boardInfo['boardLike']?></span></div>
                                                    </div>
                                                </a>
                                            </div>
                                            
                                <?php ;}
                                    if($count % 9 == 2 || $count % 9 == 5 || $count % 9 == 8){ ?>
                                        <div class="review__cont" style="opacity:0;"></div>
                                <?php  ;}
                                    ;}
                                ;} ?>
                        
                    </div>
                    <div class="board__pages">
                        <ul>
                            <?php
                                include "page.php";
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php";
    ?>
</body>
</html>