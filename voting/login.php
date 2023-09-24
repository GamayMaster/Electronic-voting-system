<?php

session_start();

function clear($input)
{
  return strip_tags(htmlspecialchars(trim($input)));
}

$link = new mysqli('localhost', 'admin', 'password123', 'voting_system');
if ($link === false) {
  die('Could not connect: ' . mysql_error());
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Signup Form</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }

      body {
        width: 100%;
        height: 100%;
        background: #eee;
        text-align: center;
        justify-content: center;
        justify-items: center;
      }

      form {
        overflow: hidden;
      }

      .alert {
        width: 500px;
        margin: 250px auto;
        background-color: #fff;
        padding: 20px;
        border: 3px solid #333;
        /* border-radius: 4px; */
      }

      .alert h2 {
        margin-bottom: 20px;
      }

      .alert p {
        margin-bottom: 20px;
      }

      .alert button {
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      .continer {
        width: 300px;
        height: 250px;
        margin: 0 auto;
        margin-top: 100px;
        background-color: #fff;
        padding: 40px;
        border: 3px solid #333;
      }

      .continer h2 {
        margin-bottom: 20px;
      }

      .continer input[type="text"],
      .continer input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      .btnLogin {
        width: 100%;
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
    </style>
    <script>
      function toggle(val) {
        const sections = ['login', 'notFound', 'before', 'refresh'];

        for (var i = 0; i < sections.length; i++) {
          if (val !== sections[i]) {
            document.getElementById(sections[i]).style.display = 'none';
          } else {
            document.getElementById(sections[i]).style.display = 'block';
          }
        }
      }
    </script>
  </head>
  <body>
    <section id="login" style="display: block;">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="continer">
              <h2>Log In</h2>
              <input type="text" name="voter-user" placeholder="Username" required><br>
              <input type="password" name="voter-pass" placeholder="Password" required><br>
              <input type="submit" value="login" class="btnLogin" name="btnLogin-voter">
            </div>
          </form>
    </section>
    <section id="notFound" style="display: none;">
        <div class="alert">
            <h2>ERROR!</h2>
            <p>This username and/or password are not found!</p>
            <button onclick="window.location.href = 'index.php';">Refresh screen</button>
          </div>
    </section>
    <section id="before" style="display: none;">
        <div class="alert">
            <h2>ERROR!</h2>
            <p>You made the selection process before!</p>
            <button onclick="window.location.href = 'index.php';">OK</button>
          </div>
    </section>
    <section id="refresh" style="display: none;">
        <div class="alert">
            <h2>ERROR!</h2>
            <p>This username and/or password are empty!</p>
            <button onclick="window.location.href = 'index.php';">Refresh screen</button>
          </div>
    </section>
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        /* check student login */
        if (isset($_POST['btnLogin-voter'])) {
          $voter_user  = $_POST['voter-user'];
          $voter_pass  = $_POST['voter-pass'];
      
          if (empty($voter_user) || empty($voter_pass)) {
            session_destroy();
            ?>
            <script>toggle('refresh')</script>
            <?php
          }
          else {
            $voter_user  = clear($voter_user);
            $voter_pass  = clear($voter_pass);
            if ((($voter_user = filter_var($voter_user, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)) !== false) && 
                (($voter_pass = filter_var($voter_pass, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)) !== false)) {
                // select query
                $select = "SELECT * FROM voter WHERE voter_username='" . $voter_user . "' AND voter_password='" . $voter_pass . "';";
                $result = mysqli_query($link, $select);
      
                if ($result->num_rows > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    if ($row['voter_username'] === $voter_user && $row['voter_password'] === $voter_pass) {
                      $voter_id = intval($row['voter_id']);
                      $check = mysqli_query($link, "SELECT voter_id FROM check_voter_login WHERE voter_id=". $voter_id);
                      if (mysqli_num_rows($check) > 0) {
                        while ($ck = mysqli_fetch_assoc($check)) {
                          if (intval($ck['voter_id']) === $voter_id) {
                            session_destroy();
                            ?>
                            <script>toggle('before')</script>
                            <?php
                          } else {
                            $check_date = "INSERT INTO check_voter_login(voter_id, voter_voting_date) VALUE(" . $voter_id . ", '" . date('m-d-Y h:i:s A', time()) . "');";
                            mysqli_query($link, $check_date);
                            $_SESSION['voter_id'] = $voter_id;
                            header('location: voting.php');
                          }
                        }
                      } else {
                        $check_date = "INSERT INTO check_voter_login(voter_id, voter_voting_date) VALUE(" . $voter_id . ", '" . date('m-d-Y h:i:s A', time()) . "');";
                        mysqli_query($link, $check_date);
                        $_SESSION['voter_id'] = $voter_id;
                        header('location: voting.php');
                      }
                    } else {
                      session_destroy();
                      ?>
                      <script>toggle('notFound')</script>
                      <?php
                    }
                  }
                } else {
                  session_destroy();
                  ?>
                  <script>toggle('notFound')</script>
                  <?php
                }
      
                mysqli_close($link);
              }
          }
        }
      
      }
    ?>
  </body>
</html>
