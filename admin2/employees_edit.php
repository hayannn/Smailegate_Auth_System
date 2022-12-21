<?php
  $edit_no = $_POST[ 'edit_no' ];
  $jb_conn = mysqli_connect( 'localhost', 'root', '2470', 'new' );
  $jb_sql_edit = "SELECT * FROM register WHERE no = $edit_no;";
  $jb_result = mysqli_query( $jb_conn, $jb_sql_edit );
  $jb_row = mysqli_fetch_array( $jb_result );
?>

<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Edit Employee</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
    </style>
  </head>
  <body>
    <h1>Edit Employee</h1>
    <form action="employees_update.php" method="POST">
      <input type="hidden" name="no" value="<?php echo $jb_row[ 'no' ]; ?>">
      <p>NO <?php echo $jb_row[ 'no' ]; ?></p>
      <p>userid<input type="text" name="userid" value="<?php echo $jb_row[ 'userid' ]; ?>" required></p>
      <p>pw <input type="text" name="pw" value="<?php echo $jb_row[ 'pw' ]; ?>" required></p>
      <p>name <input type="text" name="name" value="<?php echo $jb_row[ 'name' ]; ?>" required></p>
      <p>sex
      <input type="checkbox" name="sex" value="male" checked>남&nbsp;&nbsp;
      <input type="checkbox" name="sex" value="female">여
      </select></p>




      <p>tel<input type="text" name="tel" value="<?php echo $jb_row[ 'tel' ]; ?>" required></p>
      <p>email<input type="text" name="email" value="<?php echo $jb_row[ 'email' ]; ?>" required></p>
      <button>Edit</button>
    </form>
  </body>
</html>