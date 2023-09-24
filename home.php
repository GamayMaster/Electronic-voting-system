<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Candidates</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: darkgray;
            background-size: cover;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: #333;
        }

        .navbar a.active {
            background-color: #fff;
            color: #333;
        }
        .navbar .right {
            float: right;
        }

        h1 {
            text-align: center;
            color: #0a66c2;
            font-family: "Courier New", Courier, monospace;
            font-size: 4vw;
            text-decoration: underline;
            text-shadow: 3px 3px 3px black;
        }

        span {
            color: aqua;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            margin-bottom: 50px;
        }

        .box {
            width: 20%;
            min-width: 30px;
            background-color: rgba(153, 206, 255, 0.8);
            text-align: center;
            margin-bottom: 30px;
            border: 5px solid black;
            border-radius: 60px;
            padding: 30px;
            color: white;
            margin: 10px 10px;
            padding-bottom: 5px;
            color: #000;
        }

        img {
            margin: 25px 10%;
            max-width: 70%;
            border-radius: 20px 20px 30px 30px;
            border-bottom: 2px solid gray;
            padding: 10px;
            border: 5px solid rgb(255, 255, 255);
        }

        @media (max-width: 768px) {
            .box {
                width: 45%;
            }
        }

        @media (max-width: 576px) {
            .box {
                width: 100%;
            }
        }

        ::-webkit-scrollbar {
            width: 0px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #555;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4070f4;
        }
    </style>
</head>
  <body>
    <h1>
      Welcome To :<br />
      Technology In Democracy
    </h1>
    <div class="container">
        <?php

            $link = new mysqli('localhost', 'admin', 'password123', 'voting_system');
            if ($link === false) {
                die('Could not connect: ' . mysql_error());
                exit();
            }

            $result = mysqli_query($link, 'SELECT * FROM candidate');
            if ($result->num_rows > 0) {
                while ($candidates = mysqli_fetch_assoc($result)) {
                    $can_name   = $candidates['candidate_name'];
                    $can_serial = $candidates['candidate_serial'];
                    $can_photo  = $candidates['candidate_photo'];
                    ?>        
                        <div class="box">
                            <img src="<?php echo './image/' . $can_photo ?>" alt="">
                            <h3><?php echo $can_name ?></h3>
                            <p><?php echo $can_serial ?></p>
                        </div>
                    <?php
                }
            }
            mysqli_close($link);

        ?>
    </div>
  </body>
</html>
