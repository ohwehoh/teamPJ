<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>

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
            <h3>sign in</h3>
            <div class="login__box">
                <form action="loginSave.php" name="login" id="login"method="post">
                    <fieldset>
                        <legend class="ir_so">로그인 영역</legend>
                        
                        <label for="youID" class="ir_so">아이디</label>
                        <input type="text" name="youID" id="youID" class="login" placeholder="아이디" required>
                        <label for="youPW" class="ir_so">비밀번호</label>
                        <input type="password" name="youPW" id="youPW" class="login" placeholder="비밀번호" required>
                    </fieldset>
                </form>
                <button type="submit" class="btn" form="login">로그인</button>
                <div class="wrap">
                    <a href="findPW.php">비밀번호 찾기</a>
                    <span>|</span>
                    <a href="findID.php">아이디 찾기</a>
                    <span>|</span>
                    <a href="../join/join1.php">회원가입</a>
                </div>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php"
    ?>
</body>
</html>