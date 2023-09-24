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