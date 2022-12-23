<?php
include "member_process.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원목록</title>
    <style type="text/css">
        body{font-size:16px}
        a{text-decoration:none;color:rgb(0, 132, 255)}
        a:hover{color:rgb(255, 153, 0)}
        table{width:1328px;border-collapse:collapse}
        td{padding:10px 15px;text-align:center}
        .title{border-top:3px solid #999;border-bottom:2px solid #999;background:#eee;font-weight:bold}
        .brd{border-bottom:1px solid #999}
        table a{text-decoration:none;color:#000;border:1px solid #333;display:inline-block;padding:3px 5px;font-size:12px;border-radius:5px}
        table a:hover{border:0 none;background:rgb(0, 132, 255);color:#fff}
    </style>
    <script type="text/javascript">
        function del_check(idx){
            var i = confirm("정말 삭제하시겠습니까?\n삭제한 아이디는 복원하실 수 없습니다.");

            if(i == true){
                // alert("delete.php?u_idx="+idx);
                location.href = "delete.php?u_idx="+idx;
            };
        };
    </script>
</head>
<body>
    <h2>* 관리자 페이지 *</h2>
    <p>
        <a href="/sg/main.php" class="bar">홈으로</a>
        <!-- <a href="../board/board_list.php">게시판 관리</a> -->
        <a href="#none" class="bar">게시판 관리</a>
        <a href="list.php" class="bar">회원 관리</a>
    </p>
    <hr>
    <p>총 <?php echo $num; ?>명</p>
    <table>
        <tr class="title">
            <td>번호</td>
            <td>아이디</td>
            <td>비밀번호</td>
            <td>이름</td>
            <td>성별</td>
            <td>전화번호</td>
            <td>이메일</td>
            <td>가입일</td>
            <td>수정</td>
            <td>삭제</td>
        </tr>

        <?php
        // for($i = 1; $i <= $num; $i++){
        /* $i = 1;
        while($array = mysqli_fetch_array($result)){ */

        /* paging : 시작 번호 = (현재 페이지 번호 - 1) * 페이지 당 보여질 데이터 수 */
        $start = ($page - 1) * $list_num;

        /* paging : 쿼리 작성 - limit 몇번부터, 몇개 */
        $sql = "select * from new limit $start, $list_num;";

        /* paging : 쿼리 전송 */
        $result = mysqli_query($con, $sql);

        /* paging : 글번호 */
        $cnt = $start + 1;

        /* paging : 회원정보 가져오기(반복) */
        while($array = mysqli_fetch_array($result)){
        ?>
        <tr class="brd">
            <!-- <td><?php echo $i; ?></td> -->
            <td><?php echo $cnt; ?></td>
            <td><?php echo $array['no']; ?></td>
            <td><?php echo $array['userid']; ?></td>
            <td><?php echo $array['pw']; ?></td>
            <td><?php echo $array['name']; ?></td>
            <td><?php echo $array['sex']; ?></td>
            <td><?php echo $array['tel']; ?></td>
            <td><?php echo $array['email']; ?></td>
            <td><?php echo $array['redate']; ?></td>
            <td><a href="edit.php?u_idx=<?php echo $array['no']; ?>">수정</a></td>
            <td><a href="#" onclick="del_check(<?php echo $array['no']; ?>)">삭제</a></td>
        </tr>
        <?php  
            /* $i++; */
            /* paging */
            $cnt++;
        }; 
        ?>
    </table>
    <p class="pager">

    <?php
    /* paging : 이전 페이지 */
    if($page <= 1){
    ?>
    <a href="list.php?page=1">이전</a>
    <?php } else{ ?>
    <a href="list.php?page=<?php echo ($page-1); ?>">이전</a>
    <?php };?>

    <?php
    /* pager : 페이지 번호 출력 */
    for($print_page = $s_pageNum; $print_page <= $e_pageNum; $print_page++){
    ?>
    <a href="list.php?page=<?php echo $print_page; ?>"><?php echo $print_page; ?></a>
    <?php };?>

    <?php
    /* paging : 다음 페이지 */
    if($page >= $total_page){
    ?>
    <a href="list.php?page=<?php echo $total_page; ?>">다음</a>
    <?php } else{ ?>
    <a href="list.php?page=<?php echo ($page+1); ?>">다음</a>
    <?php };?>

    </p>
</body>
</html>
</html>