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