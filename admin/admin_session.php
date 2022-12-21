<?php
session_start();


/* 관리자가 아닌 경우 메인문서로 이동 */
if(!$id || ($id != "admin")){
    echo "
        <script type=\"text/javascript\">
            alert(\"관리자 로그인이 필요합니다.\");
            location.href = \"../member/admin_main.php\";
        </script>
    ";
};    
?>