<?php

function clear($input)
{
  return strip_tags(htmlspecialchars(trim($input)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $link = new mysqli('', '', '', '');
  if ($link === false) {
      die('Could not connect: ' . mysql_error());
      exit();
  }
  /* check student login */
  if (isset($_POST['btn_login'])) {
    $admin_user  = $_POST['admin_user'];
    $admin_pass  = $_POST['admin_pass'];

    if (!empty($admin_user) && !empty($admin_pass)) {
      $admin_user  = clear($admin_user);
      $admin_pass  = clear($admin_pass);
      if ((($admin_user = filter_var($admin_user, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)) !== false) && 
          (($admin_pass = filter_var($admin_pass, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)) !== false)) {
          // select query
          $select = "SELECT * FROM admin_table_info WHERE admin_username='" . $admin_user . "' AND admin_password='" . $admin_pass . "';";
          $result = mysqli_query($link, $select);

          if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              if ($row['admin_username'] === $admin_user && $row['admin_password'] === $admin_pass) {
                $_SESSION['admin_id'] = $row['admin_id'];
                header('location: control.php');
              } else {
                echo 'This username and/or password are not found!<br>';
                sleep(5);
                header('location: login.php');
              }
            }
          } else {
            echo 'This username and/or password are not found!<br>';
            sleep(5);
            header('location: login.php');
          }

          // close connection with database
          mysqli_close($link);
        }
    } else {
      echo 'This username and/or password are empty!<br>';
      sleep(5);
      header('location: login.php');
    }
  }

} else {
  echo 'This page cannot accessed directly<br>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login page</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', 'sans-serif';
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: darkgray;
    }

    .content {
      position: relative;
      width: 400px;
      height: 420px;
      background: #fff;
      /* background-color: #000; */
      /* box-shadow: 0 0 60px #eee; */
      border-radius: 20px;
      padding: 40px;
      border: 2px solid #000;
    }

    .box {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
    }

    h2 {
      font-size: 30px;
      text-align: center;
      color: #000;
    }

    .input-box {
      position: relative;
      margin: 30px 0;
      border-bottom: 2px solid #000;
    }

    .input-box input {
      width: 320px;
      height: 40px;
      font-size: 16px;
      color: #000;
      padding: 0 5px;
      background-color: transparent;
      border: none;
      outline: none;
    }

    button {
      position: relative;
      width: 100%;
      height: 40px;
      background: #0ef;
      box-shadow: 0 0 10px #0ef;
      font-size: 16px;
      color: #000;
      font-weight: 500;
      cursor: pointer;
      border-radius: 30px;
      border: none;
      outline: none;
    }
  </style>
</head>
<body>
  <div class="content">
    <div class="box">
      <form action="./check_admin_login.php" method="post">
        <h2>Admin Login</h2>
        <div class="input-box">
          <input type="text" placeholder="Username" name="admin_user" required />
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name="admin_pass" required />
        </div>
        <button type="submit" name="btn_login">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
