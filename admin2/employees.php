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