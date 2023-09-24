<?php

session_start();

$link = new mysqli('localhost', 'admin', 'password123', 'voting_system');
if ($link === false) {
    die('Could not connect: ' . mysql_error());
    exit();
}

$parse = parse_ini_file('settings.ini', FALSE, INI_SCANNER_RAW);
$votes_count = intval($parse['_votes_count']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>voting page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body{
            background-image: url(1.jpg);
            background-size: cover;
        }

        h1{
            text-align: center;
            color: #000;
            font-family: 'Courier New', Courier, monospace;
            font-size: 4vw;
            text-decoration: underline;
            text-shadow: 3px 3px 3px black;
        }

        span{
            color: aqua;
        }

        .container{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .box{
            width: 20%;
            min-width: 30px;
            background-color: rgba(153, 206, 255, 0.8);
            text-align: center;
            margin-bottom: 30px;
            border: 5px solid black;
            border-radius: 60px;
            padding: 30px;
            color: white;
            margin: 10px 10px ;
            padding-bottom: 5px;
            color: #000;
        }

        img{
            margin: 25px 10%;
            max-width: 70%;
            border-radius: 20px 20px 30px 30px;
            border-bottom: 2px solid gray;
            padding: 10px;
            border: 5px solid rgb(255, 255, 255);
        }

        .checkbox-label {
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        form {
            overflow: hidden;
        }

        .btnVoter {
            text-align: center;
            margin: 40px;
        }

        .btnSub {
            padding: 10px 20px;
            font-size: 20px;
            background-color: #fff;
            border: 2px solid #333;
            color: #000;
            /* border: none; */
            border-radius: 15px;
            cursor: pointer;
        }

        .alert {
            width: 500px;
            margin: 250px auto;
            background-color: #fff;
            padding: 20px;
            border: 3px solid #333;
            z-index: 1000px;
            text-align: center;
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

        .btnSub:hover, .btnSub:focus {
            background: #16fe21;
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
    <script>
        function toggle(val) {
            const sections = ['voting', 'error', 'success'];

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
    <section id="voting" style="display: block;">
        <h1>voting system</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="container">
                <?php

                    $result = mysqli_query($link, 'SELECT * FROM candidate');
                    if ($result->num_rows > 0) {
                        while ($candidates = mysqli_fetch_assoc($result)) {
                            $can_name   = $candidates['candidate_name'];
                            $can_serial = $candidates['candidate_serial'];
                            $can_photo  = $candidates['candidate_photo'];
                            ?>        
                                <div class="box">
                                    <img src="<?php echo './image/' . $can_photo; ?>" alt="">
                                    <h3><?php echo $can_name; ?></h3>
                                    <p><?php echo $can_serial; ?></p>
                                    <label class="checkbox-label">
                                        <input type="checkbox" id="" name="serial[]" value="<?php echo $can_serial; ?>"> vote
                                    </label>
                                </div>
                            <?php
                        }
                    }
                    $result->close();

                ?>
            </div>
            <div class="btnVoter">
                <input type="submit" class="btnSub" value="Submit" name="btnSub">
            </div>
        </form>
    </section>
    <section id="error" style="display: none;">
        <div class="alert">
            <h2>ERROR!</h2>
            <p><?php echo 'You are allowed to choose ' . $votes_count . ' only' ; ?></p>
            <button onclick="window.location.href = 'voting.php';">OK</button>
        </div>
    </section>
    <section id="success" style="display: none;">
        <div class="alert">
            <h2>Successfull</h2>
        </div>
    </section>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {       
            if (isset($_POST['btnSub'])) {
                $serials = $_POST['serial'];
                $ser_num = count($serials);
                $ser_num = intval($ser_num);
                if ($ser_num === $votes_count) {
                    foreach ($serials as $serial) {
                        $serial = intval($serial);
                        if ($serial) {
                            $update = "UPDATE result_of_voting SET candidate_counter=candidate_counter + 1 WHERE candidate_serial=" . $serial;
                            mysqli_query($link, $update);
                        }
                    }
                    mysqli_close($link);
                    session_destroy();
                    ?>
                    <script>
                        toggle('success');
                        window.location.href = 'index.php';
                    </script>
                    <?php
                } else {
                    ?>
                    <script>toggle('error');</script>
                    <?php
                }
            }
        }
    ?>
</body>
</html>
