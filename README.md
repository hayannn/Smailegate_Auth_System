# Smailegate_Auth_System

## 개요
|서비스||
|---|---|
|인증시스템|- 해당 사이트 접속 시 로그인 및 회원가입이 가능하도록 구성<br>- 회원가입과 동시에 Password Encryption 진행<br>- 인증서버 API 및 MariaDB로 회원을 인증 및 유저관리|


## 기술스택
- Xampp v3.3.0
- php 8.1.12
- MySQL(Maria DB)
- Visual Studio Code 1.74.2

## 아키텍처

![아키텍쳐](https://user-images.githubusercontent.com/102213509/208891951-27c8861a-476f-4fd6-b8a4-459c6bffca8e.png)


## 제공 기능
|기능|설명|
|---|---|
|가입, 로그인 페이지 | 최초 접속 페이지에서 로그인 및 회원가입 가능하도록 구현|
|유저 관리 페이지 | - 화면 최우측의 관리자 아이콘 클릭 시 접속 가능하도록 구현|
|인증 서버 API | -Session 방식을 사용한 사용자 인증 방식 사용 <br> - Sever side Session인 인증서버와 DB의 연동으로 사용자 인증|
|RDBMS DB 사용 | - Xampp의 MySQL 사용으로 PHP와의 연동성을 최상으로 유지|
|Password Encryption | - PHP 내장 함수인 password_hash를 사용해 해시함수 방식으로 비밀번호 암호화 로직 사용|
|아이디 및 비밀번호 찾기 | - findId.php와 findPw.php를 통한 아이디 및 비밀번호 찾기 기능 구현|

## 구현

### 0. 데이터베이스 구성
- 테이블 구조 및 테이블 내용(암호화 적용이 되었는지 확인하기 위해 나누어 진행했음을 보여줌)
![테이블 구조](https://user-images.githubusercontent.com/102213509/208899715-464377e4-0ced-429d-ab17-98f47e6a3980.png)

![테이블 내용](https://user-images.githubusercontent.com/102213509/208900154-7bac5023-033f-4ba4-a921-b9960536c7d0.png)

- 데이터베이스 구조
<br>![데이터베이스](https://user-images.githubusercontent.com/102213509/208899800-1d1e65ac-a590-4cba-92c8-432588ffa302.png)

### 1. 메인 페이지(로그인, 회원가입)
- main.php

 ```
 <?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Paytone+One&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+KR&family=Paytone+One&display=swap');
body{
background-image: url("image/메인 배경2.png");
background-size: cover;
background-repeat: no-repeat;
background-position: left top;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css?ver=8">
    <title>NOW.</title>
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
                            echo '<a href="member/login.php">로그인</a>';
                        } else {
                        echo '<div class="helloUser">'.$_SESSION['name'].'님 환영합니다.</div>';
                        echo '<div class="outAndUpdate"><a href="member/member_process.php?mode=logout">로그아웃</a> | 
                        <a href="member/update.php">정보수정</a>
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

        </div>
    </section>
    <footer></footer>
</body>
</html>
```
### 2. 유저 관리 페이지
- 메인 페이지에서 관리자 아이콘 클릭 시 접속
- 현재 가입되어 있는 회원의 정보를 테이블 형식으로 출력
  - 사용자별로 Edit(수정), Delete(삭제) 할 수 있도록 구성
 
|유저 관리 관련 php|설명|
|---|---|
|employees.php | 사용자 정보를 출력, 수정, 삭제 기능 보여주기 위함|
|employees_add.php | - 새로운 사용자를 관리자 권한으로 추가하기 위함|
|employees_edit.php | - 해당 사용자의 정보를 관리자 권한으로 수정하기 위함<br> - 관리자 권한이 아닐 경우, 아이디와 이메일은 수정 불가능함.|
|employees_insert.php | - 수정한 사용자 정보가 저장되었는지 확인시켜주기 위함|
|employees_update.php | - 해당 사용자의 정보를 모두 수정한 뒤 edit 버튼 클릭 시 나오는 화면|

- employees.php

 ```
 <!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Employees</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
      table {
        width: 100%;
      }
      th, td {
        padding: 10px;
        border-bottom: 1px solid #dadada;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>no</th>
          <th>userid</th>
          <th>pw</th>
          <th>name</th>
          <th>sex</th>
          <th>tel</th>
          <th>email</th>
          <th>redate</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $jb_conn = mysqli_connect( 'localhost', 'root', '2470', 'new' );
          @$delete_no = $_POST[ 'delete_no' ];
          if ( isset( $delete_no ) ) {
            $jb_sql_delete = "DELETE FROM register WHERE no = '$delete_no';";
            mysqli_query( $jb_conn, $jb_sql_delete );
            echo '<p style="color: red;">Employee ' . $delete_no . ' is deleted.</p>';
          }
          $jb_sql = "SELECT * FROM register LIMIT 5;";
          $jb_result = mysqli_query( $jb_conn, $jb_sql );
          while( $jb_row = mysqli_fetch_array( $jb_result ) ) {
            $jb_edit = '
              <form action="employees_edit.php" method="POST">
                <input type="hidden" name="edit_no" value="' . $jb_row[ 'no' ] . '">
                <input type="submit" value="Edit">
              </form>
            ';
            $jb_delete = '
              <form action="employees.php" method="POST">
                <input type="hidden" name="delete_no" value="' . $jb_row[ 'no' ] . '">
                <input type="submit" value="Delete">
              </form>
            ';
            echo '<tr><td>' . $jb_row[ 'no' ] . '</td><td>'. $jb_row[ 'userid' ] . '</td><td>' . $jb_row[ 'pw' ] . '</td><td>' . $jb_row[ 'name' ] . '</td><td>'. $jb_row[ 'sex' ] . '</td><td>' . $jb_row[ 'tel' ] . '</td><td>'. $jb_row[ 'email' ] . '</td><td>'. $jb_row[ 'redate' ] . '</td><td>'. $jb_edit . '</td><td>' . $jb_delete . '</td></tr>';
          }
        ?>
      </tbody>
    </table>
  </body>
</html>
 ```
 
 ### 3. 인증 서버 API
- db.php와 memeber_process.php를 사용해 사용자 인증 및 암호화 확인
- 로그인, 회원가입, 메인에 활용
  - 사용자별로 정보를 확인할 수 있도록 구성
 
|관련 php|설명|
|---|---|
|main.php & db.php & member_process.php | - 메인 페이지에 로그인 상태를 보여주기 위함|
|login.php & db.php & member_process.php | - 로그인 시에 일치하는 정보가 있는지 확인하고, 있을 시 로그인이 성공하는 상태를 보여주기 위함 |
|register.php & db.php & member_process.php | - 아이디가 중복되는지 여부를 판단하고, 비밀번호를 제대로 입력했는지 확인한 후 회원가입이 가능하도록 함|

- db.php
```
<?php
    $dns = "mysql:host=localhost;dbname=new;charset=utf8";
    $username="root";
    $pw="2470";

    try {
        $db = new PDO($dns, $username,$pw);
    } catch (PDOException $th) {
        echo '접속실패 : ' . $th->getMessage();
    }

    function errMsg($msg){
        echo "<script>
            window.alert('$msg');
            history.back(1);
        </script>";
        exit;
    }
?>
 ```
 
 - member_process.php
  ```
  <?php
session_start();
    require_once('../db/db.php');

    switch ($_GET['mode']){
        case 'register':
        $id = $_POST['id'];
        $userid = $_POST['userid'];

        $pw1 = $_POST['pw1'];
        $encrypted_password = password_hash( $pw1, PASSWORD_DEFAULT);

        $pw2 = $_POST['pw2'];

        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        
        $sql = $db -> prepare('INSERT INTO register
        (id, userid, pw, encrypted_password, name, sex, tel, email, redate)
        VALUE(:id, :userid, :pw, :encrypted_password, :name, :sex, :tel, :email, now())');

        $sql -> bindParam(':id',$id);
        $sql -> bindParam(':userid',$userid);
        $sql -> bindParam(':pw',$pw1);
        $sql -> bindParam(':encrypted_password',$encrypted_password);
        $sql -> bindParam(':name',$name);
        $sql -> bindParam(':sex',$sex);
        $sql -> bindParam(':tel',$tel);
        $sql -> bindParam(':email',$email);

        if($pw1 != $pw2){
            errMsg("비밀번호가 일치하지 않습니다.");
        }

        $sql -> execute();
        
        header('location:../main.php');
        break;

        case 'login':
            $userid = $_POST['userid'];
          $pw = $_POST['pw'];

          $sql = $db -> prepare("SELECT * FROM register WHERE userid=:userid");
          $sql -> bindParam("userid",$userid);
          $sql -> execute();
          $row = $sql -> fetch();

          if(!$userid){
              errMsg("아이디를 입력해주세요.");
          } elseif(!isset($row['userid'])){
              errMsg('존재하지 않는 아이디입니다.');
          } elseif(!$pw){
              errMsg('비밀번호를 입력해주세요.');
          } elseif($pw != $row['pw']){
              errMsg('비밀번호가 일치하지 않습니다.');
          } 
          
          $_SESSION['userid'] = $row['userid'];
          $_SESSION['name'] = $row['name'];
          header('location:../main.php');
          break;

          case 'logout':
            session_unset();
            header('location:../main.php');
            break;

            case 'update':
                $userid = $_POST['userid'];
                $pw1 = $_POST['pw1'];
                $pw2 = $_POST['pw2'];
                $tel = $_POST['tel'];
    
                $stmt = $db -> prepare("SELECT * FROM register WHERE userid=:userid");
                $stmt -> bindParam("userid",$userid);
                $stmt -> execute();
                $user = $stmt -> fetch();
    
                $sql = $db -> prepare("UPDATE register set pw=:pw, tel=:tel WHERE userid=:userid");
                $sql -> bindParam("pw",$pw1);
                $sql -> bindParam("tel",$tel);
                $sql -> bindParam("userid",$userid);
    
                if(!$pw1 || !$pw2){
                    errMsg("비밀번호를 입력해주세요.");
                } elseif($pw1 != $pw2){
                    errMsg("비밀번호가 일치하지 않습니다.");
                } elseif($pw1 == $user['pw']){
                    errMsg("이전 비밀번호와 같습니다.");
                } elseif (!$tel) {
                    errMsg("전화번호를 입력해주세요.");
                }
    
                $sql -> execute();
                session_unset();
                header('location:../main.php');
            break;

            case 'findId':
                $name = $_POST['name'];
                $email = $_POST['email'];
                $userEmail = array();
                $pdo = $db -> prepare("SELECT * FROM register WHERE name=:name");
                $pdo -> bindParam("name",$name);
                $pdo -> execute();
                $con = $pdo -> fetch();
    
                $sql = $db -> prepare("SELECT * FROM register WHERE name=:name");
                $sql -> bindParam("name",$name);
                $sql -> execute();
                if(!$con){
                    errMsg("가입 이력이 없습니다.");
                } else{
                        while($row = $sql -> fetch()){
                                array_push($userEmail, $row['email']);
                        }
                    }
                    if(in_array($email,$userEmail) == false){
                        errMsg("이메일을 확인해주세요.");
                    } elseif (in_array($email,$userEmail) == true) {
                        $stmt = $db -> prepare("SELECT * FROM register WHERE name=:name AND email=:email");
                        $stmt -> bindParam("name",$name);
                        $stmt -> bindParam("email",$email);
                        $stmt -> execute();
                        $user = $stmt -> fetch();
                        echo "
                            <script>
                            alert('고객님의 아이디는 ".$user['userid']."입니다.');
                            location.href='../main.php';
                            </script>
                        ";
                    }  
            break;

            case 'findPw':
                $userid = $_POST['userid'];
                $email = $_POST['email'];
    
                $sql = $db -> prepare("SELECT * FROM register WHERE userid=:userid");
                $sql -> bindParam("userid",$userid);
                $sql -> execute();
                $row = $sql -> fetch();
                
                if(!$row){
                    errMsg("없는 아이디입니다.");
                } elseif($email != $row['email']){
                    errMsg("이메일을 확인해주세요");
                } else{
                    echo 
                    "<script>
                        location.href='changePw.php?userid=".$row['userid']."';
                    </script>";
                }
                
            break;

            case 'changePw':
                $userid = $_POST['userid'];
                $pw1 = $_POST['pw1'];
                $pw2 = $_POST['pw2'];
    
                $stmt = $db -> prepare("SELECT * FROM register WHERE userid=:userid");
                $stmt -> bindParam("userid",$userid);
                $stmt -> execute();
                $user = $stmt -> fetch();
    
                $sql = $db -> prepare("UPDATE register set pw=:pw WHERE userid=:userid");
                $sql -> bindParam("pw",$pw1);
                $sql -> bindParam("userid",$userid);
                if(!$pw1 || !$pw2){
                    errMsg("비밀번호를 입력해주세요.");
                } elseif($pw1 != $pw2){
                    errMsg("비밀번호가 일치하지 않습니다.");
                } elseif($pw1 == $user['pw']){
                    errMsg("사용 불가능한 비밀번호 입니다.");
                } 
                $sql -> execute();
                header('location:login.php');
            break;
    }
?>
   ```

## 작동 화면
- 현재 완성된 인증시스템 화면입니다.

https://user-images.githubusercontent.com/102213509/208898405-57128a6e-87ae-4fee-9cab-480b61d254a1.mp4


## 코드 중 확인받고 싶은 부분
### 로그인 중복 여부 확인 부분이 먹통이 되는 이유를 알고 싶습니다.
- 관련 파일 : register.php, checkId.php
 - register.php
  ```
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
   ```

 - checkId.php
  ```
   <?php
    require_once('../db/db.php');
    $userid = $_GET['userid'];

    if(!$userid){
        echo "
        <p>아이디를 입력해주세요.</p>
        <center><input type=button value=창닫기 onclick='self.close()'></center>
        ";
    } else{
        $sql = $db -> prepare("SELECT * FROM register WHERE userid=:userid");
        $sql -> bindParam(':userid',$userid);
        $sql -> execute();
        $count = $sql -> rowCount();

            if($count<1){
                echo "
                <p>사용 가능한 아이디입니다.</p>
                <center><input type=button value=창닫기 onclick='self.close()'></center>
                ";
            } else{
                echo "
                <p>이미 존재하는 아이디입니다.</p>
                <center><input type=button value=창닫기 onclick='self.close()'></center>
                ";
            }
    }
?>
<!DOCTYPE html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>중복확인</title>
</head>
</html>
   ```


## 프로젝트 진행 중 이슈
### 대학교 시험기간 & 코로나19 감염으로 인한 개발 일정 차질
- 1인 프로젝트 개발 기간 중 2주 -> 시험기간 및 팀프로젝트로 인해 모든 팀의 팀장을 맡고 있어 팀프로젝트에 대한 마무리와 발표 및 보고 작업으로 인해 어쩔 수 없이 개발 일정이 밀리게 됨.
- 나머지 1주 -> 코로나19 감염으로 인한 격리로 인해 좋지 못한 컨디션으로 개발을 하는 데에 있어 큰 어려움이 있었음.

### 회원가입 시 로그인 중복 여부를 확인하는 부분이 먹통이 되는 현상
- 로그인 중복 여부를 확인하기 위해, 1)비어있는 경우, 2)이미 있는 아이디의 경우로 나누어 작성했으나, 전혀 먹히지 않는 현상 발생.
- 이에 대한 해결방법 -> 크게 문제가 되지 않는 기능이기 때문에 로그인 중복 여부를 확인하지 않는 방식을 우선 사용함(차후 다른 방법으로 구현이 가능하다면 하고 싶음)

> 1. 아이디가 비어 있는 경우
- 아이디 텍스트 필드가 비어 있는 경우 "아이디를 입력해주세요"라는 팝업이 뜰 수 있도록 구성
- 그러나, 버튼 클릭 시 아무 반응 없음.


> 2. 이미 있는 아이디를 작성한 경우
- DB에 일치하는 아이디가 입력된 경우, "아이디가 중복되었습니다"와 같은 팝업이 뜨고, 재작성할 수 있도록 구성
- 그러나, 이 역시 버튼 클릭 시 아무 반응 없음.
 
 ## 참고
- 세션기반 인증서버 API : https://velog.io/@paulkim/Session-%EA%B3%BC-%ED%86%A0%ED%81%B0%EC%9D%84-%EC%9D%B4%EC%9A%A9%ED%95%9C-%EC%9C%A0%EC%A0%80-%EC%9D%B8%EC%A6%9D%EC%97%90-%EB%8C%80%ED%95%B4%EC%84%9C
- 비밀번호 암호화 함수 사용법 : https://www.codingfactory.net/11707
