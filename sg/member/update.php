<?php
    session_start();
    require_once("../db/db.php");
    
    $sql = $db -> prepare("SELECT * FROM register WHERE userid=:userid");
    $sql -> bindParam("userid",$_SESSION['userid']);
    $sql -> execute();
    $row = $sql -> fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Paytone+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR&family=Paytone+One&display=swap');
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/style.css?ver=12">
    <title>NOW 정보 수정</title>
</head>
<body>
    <header>
    <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    NOW.
                </div>
                <div class="navBarRight">
                    <div class="navBarLogin">
                        <?php if(!isset($_SESSION['userid'])){
                            echo '<a href="login.php">로그인</a>';
                        } else {
                        echo '<div class="helloUser">'.$_SESSION['name'].'님 환영합니다.</div>';
                        echo '<div class="outAndUpdate"><a href="member_process.php?mode=logout">로그아웃</a> | 
                        <a href="update.php">정보수정</a>
                        </div>';
                        }
                        ?>   
                    </div>
                </div>
                <div class="navBarLast">
                    <button type="button" class="btn_image" id="img_btn" style="width: 50%; height: 50%; background-color: #1c1c1c; border: 0px;"><img  src="image/편성표.png" style="border:0px;"></button><button type="button" class="btn_image" id="img_btn2" style="width: 20%; height: 50%; background-color: #1c1c1c; border: 0px;"><img  src="image/메뉴.png" style="border:0px;"></button><button type="button" class="btn_image" id="img_btn3" onClick="location.href='/sg/admin2/employees.php'" style="width: 30%; height: 0%; background-color: #1c1c1c; border: 0px;"><img  src="image/관리자.png" style="width: 30px; height: 30px; border:0px;"></button>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <div class="updateTitle">회원정보</div>
            <form action="member_process.php?mode=update" method="post">
                <input type="hidden" name="userid" value="<?= $row['userid']?>">
                <table class="updateTable">
                    <tr>
                        <p class="updateId"><td>아이디</td>
                        <td><?= $row['userid'] ?></td></p>
                    </tr>
                    <tr>
                        <p class="updatePw1"><td>비밀번호</td>
                        <td><input type="password" name="pw1"></td></p>
                    </tr>
                    <tr>
                        <p class="updatePw2"><td>비밀번호 확인</td>
                        <td><input type="password" name="pw2"></td></p>
                    </tr>
                    <tr>
                        <p class="updateTel"><td>전화번호</td>
                        <td><input type="text" name="tel" placeholder=<?= $row['tel']?>></td></p>
                    </tr>
                    <tr>
                        <p class="updateEmail"><td>이메일</td>
                        <td><?= $row['email'] ?></td></p>
                    </tr>
                </table>
                <div class="updateBtn">
                <input type="submit" value="수정">
                <input type="button" value="취소" onclick="history.back(1)">
                </div>
            </form>
        </div>
    </section>
    <footer></footer>
</body>
</html>