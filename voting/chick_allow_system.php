<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        body {
            width: 100%;
            height: 100%;
        }

        .continer {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 300px;
            color: #fff;
            background: linear-gradient(to top, #333, #555, #777, #555, #333);
            text-align: center;
            border-radius: 25px;
            padding: 20px;
        }

        .p1 {
            font-size: 30px;
            margin-top: 50px;
        }

        .s {
            font-size: 25px;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <?php
        $parse = parse_ini_file(__DIR__ . '../settings.ini', FALSE, INI_SCANNER_RAW);

        $start_date = $parse['_start_date'];
        $start_time = $parse['_start_time'];
        $end_date   = $parse['_end_date'];
        $end_time   = $parse['_end_time'];
        $now_date   = date('d-m-Y', time());


        if (((strtotime($now_date) >= strtotime($start_date)) && (strtotime($now_date) <= strtotime($end_date)))
            && ((time() >= strtotime($start_time)) && (time() <= strtotime($end_time)))) {
            header('location: login.php');
        }
        else {
    ?>
            <div class="continer">
                <p class="p1">The page is not allowed to be used now</p>
                <p class="s">The time available to use the page</p>
                <p class="s"><?php echo 'Date: ' . $start_date . ' to ' . $end_date ?></p>
                <p class="s"><?php echo 'Time: ' . $start_time . ' to ' . $end_time ?></p>
            </div>
    <?php
        }
    ?>
</body>
</html>