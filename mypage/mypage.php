<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지</title>
    <?php
        include "../include/css.php"
    ?>
</head>
<body>
    <?php
        include "../include/header.php"
    ?>
    <main id="main">
        <div class="mypage__wrap">
        <h3>개인 페이지</h3>
            <div class="mypage__info">
<?php
    // memberID 가져오기
    $memberID = $_SESSION['memberID'];
    //데이터 확인
    // echo $memberID;
    // memberID에 맞는 회원정보 가져오기
    $sql = "SELECT * FROM TPmyMember WHERE memberID = {$memberID}";
    $result = $connect -> query($sql);
    // 배열로 만들기
    $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
    // 데이터 확인
    // echo "<pre>";
    // var_dump($memberInfo);
    // echo "</pre>";
?>
                <div>
                    <span class="title">회원정보</span>
                    <a href="#" class="btn">수정하기</a>
                    <div class="mypage__member">
                        <div class="memberBox box">
                            <div class="img">
                                <img src="./assets/img/face01.jpg" alt="사진">
                            </div>
<?php
    //youIntro
    if($memberInfo['youIntro'] == null){
        echo "<div class='text'>당신의 자기소개를 넣어주세요!</div>";
    } else {
        echo "<div class='text'>".$memberInfo['youIntro']."</div>";
    }
?>
                        </div>
                        <div class="boxwrap">
                            <div class="box1 box" style="margin-bottom: 20px;">이메일 : <?=$memberInfo['youEmail']?></div>
                            <div class="box2 box" style="margin-bottom: 20px;">가입날짜 : <?=date('Y-m-d', $memberInfo['regTime'])?></div>
                            <div class="box3 box" style="margin-bottom: 20px;">이름 : <?=$memberInfo['youName']?></div>
                            <div class="box4 box" style="margin-bottom: 20px;">생년월일 : <?=$memberInfo['youBirth']?></div>
                            <div class="box5 box" style="margin-bottom: 20px;">성별 : <?=$memberInfo['youGender']?></div>
                            <div class="box6 box">전화번호 : <?=$memberInfo['youPhone']?></div>
                        </div>
                    </div>
                </div>
                <div>
                    <span class="title">맞춤정보</span>
                    <a href="#" class="btn">수정하기</a>
                    <a href="#" class="btn btn2">분석하기</a>
                    <div class="mypage__custom">
                        <div class="boxwrap">
                            <div class="box1 box">
                                <span class="cate">피부타입</span>
                                <span class="doc"><?=$memberInfo['skinType']?></span>
                            </div>
                            <div class="box2 box">
                                <span class="cate">피부톤</span>
                                <span class="doc"><?=$memberInfo['skinTone']?></span>
                            </div>
                            <div class="box3 box">
                                <span class="cate">피부고민</span>
                                <span class="doc"><?=$memberInfo['skinWorry']?></span>
                            </div>
                            <div class="box4 box">
                                <span class="cate">헤어타입</span>
                                <span class="doc"><?=$memberInfo['hairType']?></span>
                            </div>
                            <div class="box5 box">
                                <span class="cate">헤어고민</span>
                                <span class="doc"><?=$memberInfo['hairWorry']?></span>
                            </div>
                        </div>
                        <div class="longbox box">
                            <span class="cate">원하는 정보 / 기타고민</span>
                            <span class="doc">
<?php
    // 데이터 가져오기
    $freeText = $memberInfo['freeText'];
    // 가져오기 확인 o
    //echo $memberInfo['freeText'];
    // 띄어쓰기 기준으로 쪼개기
    $freeTexta = explode(" ", $freeText);
    // 배열로 쪼개기 확인 o
    // var_dump($freeTexta)
    // 배열의 갯수 구하기
    $count = count($freeTexta);
    for($i=0; $i<$count; $i++){
        echo "<span>#".$freeTexta[$i]." </span>";
    }
?>
                            </span>
                        </div>
                    </div>
                </div>
                <div>
                <span class="title">활동내역</span>
                    <div class="mypage__activity">
                        <div class="box1 box">
                            <span class="title">나의 게시물</span>
                            <table class="table">
                                <colgroup>
                                    <col style="width: 10%;">
                                    <col style="width: 60%;">
                                    <col style="width: 10%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="br">유형</th>
                                        <th>제목</th>
                                        <th>조회수</th>
                                        <th>작성일</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ** $_SESSION()으로 맴버ID 가져와 사용 -->
                                    <!-- 반묵문(10개 까지)을 사용한다 -->
                                    <!-- 여기부터 -->
                                    
                                        <?php
                                        $sql = "SELECT * FROM (SELECT boardType, boardTitle, boardView, regTime FROM PmyBoard WHERE memberID = '$memberID' UNION SELECT boardType, boardTitle, boardView, regTime FROM PmyBoard02 WHERE memberID = '$memberID' UNION SELECT boardType, boardTitle, boardView, boardRegTime FROM TPBoardR WHERE memberID = '$memberID') a ORDER BY regTime DESC LIMIT 10";
                                        $result = $connect -> query($sql);
                                        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

                                        if($memberInfo['boardType'] == "R"){
                                            $boardType = "리뷰";
                                        } else if($memberInfo['boardType'] == "R"){
                                            $boardType = "꿀팁";
                                        } else {
                                            $boardType = "고민";
                                        }
                                        foreach($result as $act){
                                        ?>
                                        <tr>
                                        <td class="tac br"><?=$boardType?></td>
                                        <td class="pl10"><?=$act['boardTitle']?></td>
                                        <td class="tac"><?=$act['boardView']?></td>
                                        <td class="tac"><?=date('Y-m-d', $act['regTime'])?></td>
                                        </tr>
                                        <?php ;} ?>
                                    
                                    <!-- 여기까지 -->
                                </tbody>
                            </table>
                        </div>
                        <div class="box2 box">
                            <span class="title">나의 댓글</span>
                            <table class="table">
                                <colgroup>
                                    <col style="width: 40%;">
                                    <col style="width: 40%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="br">게시글</th>
                                        <th>내용</th>
                                        <th>작성일</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- 게시글에 댓글 기능이 아직 지원하지 않습니다.? -->
                                        <!-- 반묵문(10개 까지)을 사용한다 -->
                                        <!-- 여기부터 -->
                                        <td class="pl10 br">게시글</td>
                                        <td class="pl10">내용</td>
                                        <td class="tac">작성일</td>
                                        <!-- 여기까지 -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include "../include/footer.php"
    ?>
</body>
</html>