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
    <link rel="stylesheet" href="../css/style.css?ver=15">
    <title>NOW 비밀번호 찾기</title>
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
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <div class="registerTitle">비밀번호 찾기</div>
            <div class="findIdPw">
            <form action="member_process.php?mode=findPw" method="post">
                <p>아이디 : <input type="text"  name="userid" placeholder="아이디 입력" size="30"></p>
                <p class="findEmail">이메일 : <input type="text"  name="email" placeholder="이메일 입력" size="30"></p>
                <div class="findBtn">
                <input type="submit" value="찾기">&nbsp;&nbsp;&nbsp;
                <input type="button" value="취소" onclick="history.back(1)">
                </div>
            </form>
            </div>
            <div class="findMenu">
                <button onclick="location.href='findId.php'">아이디 찾기</button>&nbsp;&nbsp;&nbsp;
                <button onclick="location.herf='findPw.php'">비밀번호 찾기</button>
            </div>
        </div>
    </section>
    <footer></footer>
    <script src="../script/script.js"></script>
</body>
</html>