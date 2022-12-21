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