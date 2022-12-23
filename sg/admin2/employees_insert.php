<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Insert Employee</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
    </style>
  </head>
  <body>
    <?php
      $no = $_POST[ 'no' ];
      $userid = $_POST[ 'userid' ];
      $pw = $_POST[ 'pw' ];
      $name = $_POST[ 'name' ];
      $sex = $_POST[ 'sex' ];
      $tel = $_POST[ 'tel' ];
      $email = $_POST[ 'email' ];
      if ( is_null( $no ) ) {
        echo '<h1>Fail!</h1>';
      } else {
        $jb_conn = mysqli_connect( 'localhost', 'root', '2470', 'new' );
        $jb_sql = "INSERT INTO register ( no, userid, pw, name, sex, tel, email ) VALUES ( '$no', '$userid', '$pw', '$name', '$sex', '$tel', '$email');";
        mysqli_query( $jb_conn, $jb_sql );
        echo '<h1>Success!</h1>';
      }
    ?>
    <p>
      <a href="employees.php">Employees Lists</a>
      <a href="employees_add.php">Add Employee</a>
     </p>
  </body>
</html>