<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보 찾기 실패</title>

    <?php
        include "../include/css.php";
    ?>
</head>
<body>
    <?php
        include "../include/header.php";
    ?>

    <main id="main">
        <h2 class="ir_so">회원정보찾기실패영역</h2>
        <section id="section" class="signup container">
            <h3 class="find">회원정보가 없습니다.회원가입 하시겠습니까?</h3>
            <a href="../join/join1.php" class="joinF__btn top" style="margin-top:100px;">회원가입</a>
            <a href="javascript:history.back();" class="joinF__btn bottom">다시시도</a>
        </section>
    </main>
    <!-- //main -->

    <?php
        include "../include/footer.php"
    ?>
</body>
</html>