<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입-완료</title>

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
            <h3>Welcome</h3>
            <div class="signup__ex">
                <p class="finish">남자다움은<?=$youID?>님을 환영합니다!</p>
            </div>
            <a href="../main/main.php" class="joinF__btn top">메인 페이지로 이동</a>
            <a href="../login/login.php" class="joinF__btn bottom">로그인 페이지로 이동</a>
        </section>
    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php"
    ?>
</body>
</html>