<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 찾기</title>

    <?php
        include "../include/css.php";
    ?>
</head>
<body>
    <?php
        include "../include/header.php";
    ?>

    <main id="main">
        <h2 class="ir_so">회원가입 영역</h2>
        <section id="section" class="signup container">
            <h3>Find your PW</h3>
            <div class="login__box">
                <form action="findPWSave.php" name="findPW" id="findPW" method="post">
                    <fieldset>
                        <legend class="ir_so">비밀번호찾기</legend>
                        
                        <label for="youID" class="ir_so">아이디</label>
                        <input type="text" name="youID" id="youID" class="login" placeholder="아이디" required>
                        <label for="youEmail" class="ir_so">이메일</label>
                        <input type="email" name="youEmail" id="youEmail" class="login" placeholder="이메일" required>
                    </fieldset>
                </form>
                <button type="submit" class="btn" form="findPW">비밀번호 찾기</button>
                <div class="wrap">
                    <a href="findID.php">아이디 찾기</a>
                    <span>|</span>
                    <a href="../join/join.php">회원가입</a>
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