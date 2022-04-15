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
    <style>
        .button {
            --color: #1E2235;
            --color-hover: #1E2235;
            --color-active: #fff;
            --icon: #BBC1E1;
            --icon-hover: #8A91B4;
            --icon-active: #fff;
            --background: #fff;
            --background-hover: #fff;
            --background-active: #362A89;
            --border: #E1E6F9;
            --border-active: #362A89;
            --shadow: rgba(0, 17, 119, 0.025);
            display: block;
            outline: none;
            cursor: pointer;
            position: absolute;
            bottom: 50px;
            left: 43%;
            border: 0;
            background: none;
            padding: 8px 20px 8px 24px;
            border-radius: 9px;
            line-height: 27px;
            font-family: inherit;
            font-weight: 600;
            font-size: 14px;
            color: var(--color);
            -webkit-appearance: none;
            -webkit-tap-highlight-color: transparent;
            transition: color 0.2s linear;
        }

        .button.dark {
            --color: #F6F8FF;
            --color-hover: #F6F8FF;
            --color-active: #fff;
            --icon: #8A91B4;
            --icon-hover: #BBC1E1;
            --icon-active: #fff;
            --background: #1E2235;
            --background-hover: #171827;
            --background-active: #275EFE;
            --border: transparent;
            --border-active: transparent;
            --shadow: rgba(0, 17, 119, 0.16);
        }

        .button:hover {
            --icon: var(--icon-hover);
            --color: var(--color-hover);
            --background: var(--background-hover);
            --border-width: 2px;
        }

        .button:active {
            --scale: .95;
        }

        .button:not(.liked):hover {
            --hand-rotate: 8;
            --hand-thumb-1: -12deg;
            --hand-thumb-2: 36deg;
        }

        .button.liked {
            --span-x: 2px;
            --span-d-o: 1;
            --span-d-x: 0;
            --icon: var(--icon-active);
            --color: var(--color-active);
            --border: var(--border-active);
            --background: var(--background-active);
        }

        .button:before {
            content: "";
            min-width: 103px;
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            transition: background 0.2s linear, transform 0.2s, box-shadow 0.2s linear;
            transform: scale(var(--scale, 1)) translateZ(0);
            background: var(--background);
            box-shadow: inset 0 0 0 var(--border-width, 1px) var(--border), 0 4px 8px var(--shadow), 0 8px 20px var(--shadow);
        }

        .button .hand {
            width: 11px;
            height: 11px;
            border-radius: 2px 0 0 0;
            background: var(--icon);
            position: relative;
            margin: 10px 8px 0 0;
            transform-origin: -5px -1px;
            transition: transform 0.25s, background 0.2s linear;
            transform: rotate(calc(var(--hand-rotate, 0) * 1deg)) translateZ(0);
        }

        .button .hand:before,
        .button .hand:after {
            content: "";
            background: var(--icon);
            position: absolute;
            transition: background 0.2s linear, box-shadow 0.2s linear;
        }

        .button .hand:before {
            left: -5px;
            bottom: 0;
            height: 12px;
            width: 4px;
            border-radius: 1px 1px 0 1px;
        }

        .button .hand:after {
            right: -3px;
            top: 0;
            width: 4px;
            height: 4px;
            border-radius: 0 2px 2px 0;
            background: var(--icon);
            box-shadow: -0.5px 4px 0 var(--icon), -1px 8px 0 var(--icon), -1.5px 12px 0 var(--icon);
            transform: scaleY(0.6825);
            transform-origin: 0 0;
        }

        .button .hand .thumb {
            background: var(--icon);
            width: 10px;
            height: 4px;
            border-radius: 2px;
            transform-origin: 2px 2px;
            position: absolute;
            left: 0;
            top: 0;
            transition: transform 0.25s, background 0.2s linear;
            transform: scale(0.85) translateY(-0.5px) rotate(var(--hand-thumb-1, -45deg)) translateZ(0);
        }

        .button .hand .thumb:before {
            content: "";
            height: 4px;
            width: 7px;
            border-radius: 2px;
            transform-origin: 2px 2px;
            background: var(--icon);
            position: absolute;
            left: 7px;
            top: 0;
            transition: transform 0.25s, background 0.2s linear;
            transform: rotate(var(--hand-thumb-2, -45deg)) translateZ(0);
        }

        .button .hand,
        .button span {
            display: inline-block;
            vertical-align: top;
        }

        .button .hand span,
        .button span span {
            opacity: var(--span-d-o, 0);
            transition: transform 0.25s, opacity 0.2s linear;
            transform: translateX(var(--span-d-x, 4px)) translateZ(0);
        }

        .button>span {
            transition: transform 0.25s;
            transform: translateX(var(--span-x, 4px)) translateZ(0);
        }
    </style>
</head>
<body>
    <?php
        include "../connect/connect.php";
        include "../connect/session.php";
        include "../include/header.php";
    ?>

    <main id="main">
        <h2 class="ir_so">리뷰게시판 글보기</h2>
        <section id="section" class="signup container">
        <div class="container">
                <h3 class="section__title">리뷰 게시판</h3>
                <div class="board__inner">
                    <div class="boardRcont__wrap">
                        <?php
                            $boardID = $_GET['boardID'];
                            $memberID = $_SESSION['memberID'];

                            $sql = "SELECT boardTitle, boardView, boardContents, boardRegTime, boardImgFile, memberID, boardLike FROM TPBoardR WHERE boardID = {$boardID}";
                            $result = $connect -> query($sql);
                            
                            $sql = "UPDATE TPBoardR SET boardView = boardView + 1 WHERE boardID = {$boardID}";
                            $connect -> query($sql);
                            if($result){
                                $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
                            ?>
                        
                            <div class="title"><?=$boardInfo['boardTitle']?></div>
                            <div class="info">
                                <strong><?=$boardInfo['youID']?></strong>
                                <span>|</span>
                                <strong><?=date('Y-m-d', $boardInfo['boardRegTime'])?></strong>
                                <span>|</span>
                                <strong>조회수 : <?=$boardInfo['boardView']?></strong>
                            </div>
                            <div class="cont">
                                <img src="../assets/img/boardR/<?=$boardInfo['boardImgFile']?>" alt="첨부이미지" class="imgCont">
                                <p><?=$boardInfo['boardContents']?></p>
                                <?php
                                    $youlikeCheck = 'logout';

                                    //로그인한 사용자가 해당 개시물에 좋아요를 눌렀는지 안눌렀는지 확인
                                    if($_SESSION['memberID'] != ""){
                                        $sql = "SELECT likeID FROM TPBoardRLike WHERE memberID = {$memberID} AND boardID = {$boardID}";
                                        $result = $connect -> query($sql);
                                        $count = $result -> num_rows;
                                        $likeInfo = $result -> fetch_array(MYSQLI_ASSOC);
                                        if($count > 0){
                                            $youlikeCheck = true;
                                            $likeID = $likeInfo['likeID'];
                                        }else{
                                            $youlikeCheck = false;
                                        }
                                    }
                                ?>
                                <button class="button"  onclick="boardLike()">
                                    <div class="hand">
                                        <div class="thumb"></div>
                                    </div>
                                    <span>Like<span>d</span></span>
                                </button>
                                <span id="like">좋아요 : <?=$boardInfo['boardLike']?></span>
                            </div>
                            <?php ;} ?>
                        </div>
                    <div class="board__btn">
                        <a href="boardR.php">목록보기</a>
                        <a href="boardRRemove.php?boardID=<?=$boardID?>">삭제하기</a>
                        <a href="boardRModify.php?boardID=<?=$boardID?>">수정하기</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var youlikeCheck = "<? echo $youlikeCheck;?>"
        var likeID = "<? echo $likeID;?>"
        function boardLike(){
            var boardID = "<? echo $boardID;?>"
            if(youlikeCheck == false){
                $.ajax({
                type : "POST",           
                url : "likeCheck.php",     
                data : {"boardID": boardID, "check": 1, "likeID": "likeID"},
                dataType : "json",
                success : function(data){ 
                    $("#like").text("좋아요 : "+data.result);
                    youlikeCheck = true;
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
                });
            } else if(youlikeCheck == true){
                $.ajax({
                type : "POST",
                url : "likeCheck.php",
                data : {"boardID": boardID, "check": 2, "likeID": "likeID"},     
                dataType : "json",
                success : function(data){ 
                    $("#like").text("좋아요 : "+data.result);
                    youlikeCheck = false;
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
                });
            } else if(youlikeCheck == 'logout'){
                alert("로그인을 해야 좋아요를 누를 수 있습니다.");
            } 
        }
        document.querySelectorAll(".button").forEach((button) => {
            if(youlikeCheck == true) {
                button.classList.add("liked");
                button.addEventListener("click", (e) => {
                    button.classList.toggle("liked");
                });
            } else if(youlikeCheck == false){
                button.addEventListener("click", (e) => {
                    button.classList.toggle("liked");
                    if (button.classList.contains("liked")) {
                        gsap.fromTo(
                            button, {
                                "--hand-rotate": 8
                            }, {
                                ease: "none",
                                keyframes: [{
                                        "--hand-rotate": -45,
                                        duration: 0.16,
                                        ease: "none"
                                    },
                                    {
                                        "--hand-rotate": 15,
                                        duration: 0.12,
                                        ease: "none"
                                    },
                                    {
                                        "--hand-rotate": 0,
                                        duration: 0.2,
                                        ease: "none",
                                        clearProps: true
                                    }
                                ]
                            }
                        );
                    }
                });
            }
        });
    </script>
</body>
</html>