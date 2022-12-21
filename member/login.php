<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/style.css?ver=6">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Paytone+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR&family=Paytone+One&display=swap');
    </style>
    <title>NOW 로그인</title>
</head>
<body>
    <header>
        <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    NOW.
                </div>
                <div class="navBarRight"></div>
                    <div class="navBarLast">
                    <button type="button" class="btn_image" id="img_btn" style="width: 50%; height: 50%; background-color: #1c1c1c; border: 0px;"><img  src="image/편성표.png" style="border:0px;"></button><button type="button" class="btn_image" id="img_btn2" style="width: 50%; height: 50%; background-color: #1c1c1c; border: 0px;"><img  src="image/메뉴.png" style="border:0px;"></button>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <div class="loginTitle">로그인</div>
            <form action="member_process.php?mode=login" method="post" class="loginForm">
                <p class="loginId">아이디 : <input type="text" name="userid"></p>
                <p class="loginPw">비밀번호 : <input type="password" name="pw"></p>
                <div class="loginButton">
                <input type="submit" value="로그인">
                <input type="button" value="취소" onclick="location.href='../main.php'">
                </div>
            </form>
            <div class="registerAndFind">
            <a href="register.php">회원가입</a>&nbsp;|
            <a href="findId.php">아이디/비밀번호 찾기</a>
            </div>
        </div>
    </section>
    <footer></footer>
</body>
</html>