<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <title>Add Employee</title>
    <style>
      body {
        font-family: Consolas, monospace;
        font-family: 12px;
      }
    </style>
  </head>
  <body>
    <h1>Add Employee</h1>
    <form action="employees_insert.php" method="POST">
      <p><input type="no" name="no" placeholder="NO" required></p>
      <p><input type="userid" name="userid" required></p>
      <p><input type="pw" name="pw" placeholder="password" required></p>
      <p><input type="text" name="name" placeholder="name" required></p>
      <p><select name="sex" required>
        <option value="male" selected>male</option>
        <option value="famale">famale</option>
      </select></p>
      <p><input type="tel" name="tel" required></p>
      <p><input type="email" name="email" required></p>
      <button>ADD</button>
    </form>
  </body>
</html>