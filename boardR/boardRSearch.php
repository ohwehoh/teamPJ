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
        include "../connect/connect.php";
        include "../connect/session.php";
        include "../include/header.php";
    ?>

    <main id="main">
        <h2 class="ir_so">리뷰게시판</h2>
        <section id="section" class="signup container">
        <div class="container">
                <h3 class="section__title">리뷰 게시판 검색결과</h3>
                <div class="board__inner">
                    <?php
                        function msg($alert){
                            echo "<p class='result'>총 ".$alert."건이 검색되었습니다.</p>";
                        }
                        $searchKeyword = $_GET['search-form'];
                        // $searchOption = $_GET['searchOption'];

                        $searchKeyword = $connect -> real_escape_string(trim($searchKeyword));
                        //$searchOption = $connect -> real_escape_string(trim($searchOption));

                        if(isset($_GET['page'])){
                            $page = (int) $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $pageView = 9;
                        $pageLimit = ($pageView * $page) - $pageView;

                        $sql = "SELECT boardID, boardTitle, boardContents, boardAuthor, boardRegTime, boardView, boardImgFile FROM TPBoardR WHERE boardContents LIKE '%{$searchKeyword}%' OR boardTitle LIKE '%{$searchKeyword}%' OR boardAuthor LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";

                        $result = $connect -> query($sql);

                        if($result){
                            $count = $result -> num_rows;
                            msg($count);
                            $sql2 = $sql." LIMIT {$pageLimit}, {$pageView}";
                            $result = $connect -> query($sql2);
                ;} ?>      <div class="review__box">
                    <?php   if($result){
                                $countt = $result -> num_rows;
                                if($countt > 0){
                                    for($i = 1; $i<=$countt; $i++){
                                    $boardInfo = $result -> fetch_array(MYSQLI_ASSOC);
                    ?>
                                    <a href="boardRView.php?boardID=<?=$boardInfo['boardID']?>">
                                    <div class="review__cont">
                                    <div class="img" style="background: url(../assets/img/boardR/<?=$boardInfo['boardImgFile']?>);"></div>
                                    <div class="title"><?=$boardInfo['boardTitle']?></div>
                                    <div class="cont"><?=$boardInfo['boardContents']?></div>
                                    <div class="info">
                                        <div class="author"><?=$boardInfo['boardAuthor']?></div>
                                        <div class="date"><?=date('Y-m-d', $boardInfo['boardRegTime'])?></div>
                                    </div>
                                    </div></a>
                        <?php   ;}
                            ;}
                        ?> </div> <?php ;} ?>
                    <div class="board__pages">
                        <ul>
                        <?php
                            $sql = "SELECT count(b.boardID) FROM TPBoardR b JOIN TPmyMember m ON(b.memberID = m.memberID) WHERE b.boardContents LIKE '%{$searchKeyword}%' OR b.boardTitle LIKE '%{$searchKeyword}%' OR m.youID LIKE '%{$searchKeyword}%' ORDER BY boardID DESC";
                            $result = $connect -> query($sql);
                            
                            $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
                            $boardCount = $boardCount['count(b.boardID)'];

                            $boardCount = ceil($boardCount / $pageView);

                            //현재 페이지를 기준으로 보여주고 싶은 갯수
                            $pageCurrent = 5;
                            $startPage = $page - $pageCurrent;
                            $endPage = $page + $pageCurrent;

                            //처음 페이지 초기화
                            if($startPage < 1) $startPage = 1;

                            //마지막 페이지 초기화
                            if($endPage >= $boardCount) $endPage = $boardCount;

                            //처음 페이지
                            if($page != 1){
                                echo "<li><a href='boardRSearch.php?page=1&search-form={$searchKeyword}'>처음으로</a></li>";
                            }

                            //이전 페이지
                            if($page != 1){
                                $prePage = $page - 1;
                                echo "<li><a href='boardRSearch.php?page={$prePage}&search-form={$searchKeyword}'>이전</a></li>";
                            }

                            //페이지 넘버 표시
                            for($i=$startPage; $i<=$endPage; $i++){
                                $active = "";
                                if($i == $page){
                                    $active = "active";
                                }
                                echo "<li class ='{$active}'><a href='boardRSearch.php?page={$i}&search-form={$searchKeyword}'>{$i}</a></li>";
                            }

                            //다음 페이지
                            if($boardCount != 0 && $page != $boardCount){
                                $nextPage = $page + 1;
                                echo "<li><a href='boardRSearch.php?page={$nextPage}&search-form={$searchKeyword}'>다음</a></li>";
                            }

                            //마지막 페이지
                            if($boardCount != 0 && $page != $boardCount){
                                echo "<li><a href='boardRSearch.php?page={$boardCount}&search-form={$searchKeyword}'>마지막으로</a></li>";
                            }
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