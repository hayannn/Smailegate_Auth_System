<?php
    session_start();

    $id = isset($_SESSION["id"])? $_SESSION["id"]:"";
    $name = isset($_SESSION["name"])? $_SESSION["name"]:"";
    // echo "Session ID : ".$s_id." / Name : ".$s_name;
?>
<?php if(!$id){/* 로그인 전  */ ?>
    <p>
        <a href="../member/login.php" class="bar">로그인</a>
        <a href="register.php">회원가입</a>
    </p>
    <?php } else{ /* 로그인 후 */ ?>
    <p>"<?php echo $_SESSION['name'] ?>"님, 안녕하세요.</p>
    <p>
        <?php if($_SESSION['id'] == "admin"){ ?>
        <a href="admin.php" class="bar">관리자</a>
        <?php }; ?>
        <a href="member_process.php?mode=logout" class="bar">로그아웃</a>
        <a href="update.php">정보수정</a>
    </p>
<?php }; ?>