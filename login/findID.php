<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디찾기</title>

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
        <h3>Find your ID</h3>
            <div class="login__box">
                <form action="findIDSave.php" name="findID" id="findID" method="post">
                    <fieldset>
                        <legend class="ir_so">아이디찾기</legend>
                        
                        <label for="youName" class="ir_so">이름</label>
                        <input type="text" name="youName" id="youName" class="login" placeholder="이름" required>
                        <label for="youPhone" class="ir_so">핸드폰번호</label>
                        <input type="text" name="youPhone" id="youPhone" class="login" placeholder="핸드폰번호(010-0000-0000)" required>
                    </fieldset>
                </form>
                <button type="submit" class="btn" form="findID">아이디 찾기</button>
                <div class="wrap">
                    <a href="findPW.php">비밀번호 찾기</a>
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