<?php
    $sql = "SELECT count(boardID) FROM TPBoardR";
    $result = $connect -> query($sql);
    
    $boardCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardCount = $boardCount['count(boardID)'];

    // echo "<pre>";
    // var_dump($boardCount);
    // echo "</pre>";

    //페이지 넘버 갯수
    //300/10 = 30
    //301/10 = 31
    //309/10 = 31

    //echo $boardCount;

    //총 페이지 갯수
    $boardCount = ceil($boardCount / $pageView);

    //echo $boardCount;

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
        echo "<li><a href='boardR.php?page=1'>처음으로</a></li>";
    }

    //이전 페이지
    if($page != 1){
        $prePage = $page - 1;
        echo "<li><a href='boardR.php?page={$prePage}'>이전</a></li>";
    }

    //페이지 넘버 표시
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page){
            $active = "active";
        }
        echo "<li class ='{$active}'><a href='boardR.php?page={$i}'>{$i}</a></li>";
    }

    //다음 페이지
    if($count != 0 && $page != $boardCount){
        $nextPage = $page + 1;
        echo "<li><a href='boardR.php?page={$nextPage}'>다음</a></li>";
    }

    //마지막 페이지
    if($count != 0 && $page != $boardCount){
        echo "<li><a href='boardR.php?page={$boardCount}'>마지막으로</a></li>";
    }
?>