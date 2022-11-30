<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
require_once('auth.php');
require_once('MainClass.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home | Customer Help Portal</title>
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        main {
            height: 100%;
            display: flex;
            flex-flow: column;
        }
    </style>
</head>

<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Customer Help Portal
                </a>
                <div class="text-end">
                    <a href="./logout.php" class="btn btn btn-secondary bg-gradient rounded-0">Logout</a>
                </div>
            </div>
        </nav>
        <div class="container py-3" id="page-container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-8 col-sm-12 col-xs-12">
                    <div class="card shadow rounded-0">
                        <div class="card-body py-4">
                            <h1>Glad to see you, <?= ucwords($_SESSION['username'] . ' ') ?></h1>
                            <hr>
                            <p> Hello, We value you accepting us as your loyal service provider, we would thus want to ensure you enjoy all services without any inconviniencies!</p>
                            <button onclick="location.href='forgot-password.php'" type="button" class="btn btn-primary btn-lg btn-block">Reset Portal Password</button>

                            <button onclick="location.href='captcha-index.html'" type="button" class="btn btn-secondary btn-lg btn-block">Submit A Complaint</button>

                            <button onclick="location.href='https://www.trustpilot.com'" type="button" class="btn btn-success btn-lg btn-block">Leave a Trustpilot Review</button>
                            <hr>

                            <!--Getting User Real IP Address-->
                            <?php
                            function getUserIpAddr()
                            {
                                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                    //ip from share internet
                                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                    //ip pass from proxy
                                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                } else {
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                }
                                return $ip;
                            }

                            echo 'Your Current Real IP Address - ' . getUserIpAddr();

                            ?>
                        </div>
                        <div class="clear-fix mb-4"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
</body>

</html>