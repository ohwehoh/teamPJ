<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입-맞춤정보입력</title>

    <?php
        include "../include/css.php";
    ?>
</head>
<body>
    <?php
        include "../include/header.php";
        $youID = $_GET['youID'];
    ?>

    <main id="main">
        <h2 class="ir_so">회원가입 영역</h2>
        <section id="section" class="signup container">
            <h3>sign up</h3>
            <div class="signup__step">
                <span class="finish">
                    <strong><img src="../assets/img/signup/check.svg" alt="회원가입1단계완료"></strong>
                </span>
                <span class="finish">
                    <strong><img src="../assets/img/signup/check.svg" alt="회원가입1단계완료"></strong>
                </span>
                <span class="on">
                    <strong>3</strong>
                </span>
            </div>
            <div class="signup__ex">
                <p class="top"><?=$youID?>님을 자세하게 알고싶어요!</p>
                <p class="bottom">아래 항목을 입력해 주시면 <?=$youID?>님의 맞춤 정보를 추천해 드릴게요!</p>
            </div>
            <div class="signup__box info">
                <form action="join3Save.php?youID=<?=$youID?>" name="signup__info2" id="signup__info2"method="post">
                    <fieldset>
                        <legend class="ir_so">회원가입 맞춤정보 입력</legend>
                        <label for="skinType">피부타입이 무엇인가요?</label>
                        <select name="skinType" id="skinType">
                            <option value="건성">건성</option>
                            <option value="지성">지성</option>
                            <option value="복합성">복합성</option>
                        </select>
                        <label for="skinTone">피부톤이 무엇인가요?</label>
                        <select name="skinTone" id="skinTone">
                            <option value="웜톤">웜톤</option>
                            <option value="쿨톤">쿨톤</option>
                        </select>
                        <label for="skinWorry">피부고민이 무엇인가요?</label>
                        <select name="skinWorry" id="skinWorry">
                            <option value="여드름">여드름</option>
                            <option value="건조함">건조함</option>
                            <option value="홍조">홍조</option>
                            <option value="잡티">잡티</option>
                            <option value="흉터">흉터</option>
                        </select>
                        <label for="hairType">헤어타입이 무엇인가요?</label>
                        <select name="hairType" id="hairType">
                            <option value="직모">직모</option>
                            <option value="곱슬">곱슬</option>
                            <option value="복합성">복합성</option>
                        </select>
                        <label for="hairWorry">헤어고민이 무엇인가요?</label>
                        <select name="hairWorry" id="hairWorry">
                            <option value="스타일링">스타일링</option>
                            <option value="건조함">건조함</option>
                            <option value="기름짐">기름짐</option>
                            <option value="탈모">탈모</option>
                            <option value="두피관리">두피관리</option>
                        </select>
                        <label for="freeText">원하는 정보나 고민을 자유롭게 입력하세요!</label>
                        <input type="text" name="freeText" id="freeText" class="info2Input">
                    </fieldset>
                </form>
            </div>
            <div class="signup__btn__wrap">
                <button type="button" class="signup__btn prev" onclick="location.href='join2.php'">이전</button>
                <button type="submit" class="signup__btn next" form="signup__info2">다음</button>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php"
    ?>
</body>
</html>