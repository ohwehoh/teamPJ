<header id="header">
    <div class="header container">
        <h1 class="logo"><a href="../main/main.php"><img src="../assets/img/header/logo.svg" alt="로고이미지"></a></h1>
        <nav class="menu">
            <h2 class="ir_so">메인 메뉴</h2>
            <ul>
                <li><a href="../mypage/mypage.php">개인</a></li>
                <li><a href="../boardR/boardR.php">리뷰</a></li>
                <li><a href="../tip/board.php">꿀팁</a></li>
                <li><a href="../worry/board.php">고민</a></li>
            </ul>
        </nav>
        <div class="member">
            <span class="ir_so">회원 정보 영역</span>
            <?php   if(isset($_SESSION['memberID'])){?>
            <a href="../mypage/mypage.php" class="signin_btn"><?=$_SESSION['youID']?>님</a>
            <a href="../login/logout.php" class="signup_btn">sign out</a>
            <?php   } else { ?>
            <a href="../join/join1.php" class="signin_btn">sign up</a>
            <a href="../login/login.php" class="signup_btn">sign in</a>
            <?}?>
        </div>
    </div>
</header>