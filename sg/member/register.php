<section>
        <div class="mainCon">
            <div class="registerTitle">회원가입</div>
            <div class="registerBox">
            <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/style.css?ver=4">
    <script>
        function checkId() {
            window.open("checkId.php?userid=" + document.register.userid.value,"IDcheck","left=50, top=50, width=50, height=10, scrollbars=no, resizeable=no");
        }
    </script>
    <title>NOW 회원가입</title>
</head>
            <form name="register" action="member_process.php?mode=register" method="post">
                <input type="hidden" name="id" value="register">
                <table class="registerTable">
                    <tr>
                        <td>아이디</td>
                        <td><input type="text" name="userid" required></td>
                        <td><input type="button" value="중복확인"></td>
                    </tr>
                    <tr>
                        <td>비밀번호</td>
                        <td><input type="password" name="pw1" required></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>비밀번호 확인</td>
                        <td><input type="password" name="pw2" required></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>이름</td>
                        <td><input type="text" name="name" required></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>성별</td>
                        <td><input type="checkbox" name="sex" value="male" checked>남&nbsp;&nbsp;
                        <input type="checkbox" name="sex" value="female">여</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>전화번호</td>
                        <td><input type="text" name="tel" placeholder="010-1234-5678"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>이메일</td>
                        <td><input type="text" name="email" required></td>
                        <td></td>
                    </tr>
                </table>
                <div class="registerSubmit">
                    <input type="submit" value="가입"></input>
                    <button onClick="history.back(-1)">취소</button>
                </div>
            </form>
            </div>
        </div>
    </section>