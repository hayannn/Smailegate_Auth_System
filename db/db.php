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