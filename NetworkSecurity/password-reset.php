<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Help Portal</title>
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>
    <?php
    require_once('config.php');
    ?>

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        main {
            height: calc(100%);
            width: calc(100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>


<body class="bg-dark bg-gradient">

    <main>

        <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 mb-4">
            <h1 class="text-light text-center">Customer Help Portal</h1>
        </div>
        <div class="col-lg-3 col-md-8 col-sm-12 col-xs-12">
            <div class="card shadow rounded-0">
                <div class="card-header py-1">
                    <h4 class="card-title text-center">Set New Password</h4>
                </div>
                <div class="card-body py-4">
                    <div class="container-fluid">

                        <?php
                        if (isset($_GET['token'])) {
                            $token = $_GET['token'];
                        }
                        //form for submit 
                        if (isset($_POST['sub_set'])) {
                            extract($_POST);
                            if ($password == '') {
                                $error[] = 'Please enter the password.';
                            }
                            if ($passwordConfirm == '') {
                                $error[] = 'Please confirm the password.';
                            }
                            if ($password != $passwordConfirm) {
                                $error[] = 'Passwords do not match.';
                            }
                            if (strlen($password) < 10) { // min 
                                $error[] = 'The password is 10 characters long.';
                            }
                            if (strlen($password) > 15) { // Max 
                                $error[] = 'Password: Max length 15 Characters Not allowed';
                            }
                            $fetchresultok = mysqli_query($dbc, "SELECT email FROM pass_reset WHERE token='$token'");
                            if ($res = mysqli_fetch_array($fetchresultok)) {
                                $email = $res['email'];
                            }
                            if (isset($email) != '') {
                                $emailtok = $email;
                            } else {
                                $error[] = 'Link has been expired or something missing ';
                                $hide = 1;
                            }
                            if (!isset($error)) {
                                $options = array("cost" => 4);
                                $password = password_hash($password, PASSWORD_BCRYPT, $options);
                                $resultresetpass = mysqli_query($dbc, "UPDATE users SET password='$password' WHERE email='$emailtok'");
                                if ($resultresetpass) {
                                    $success = "<div class='successmsg'><span style='font-size:100px;'>&#9989;</span> <br> Your password has been updated successfully. <br>  <a href='login.php' style='color:#0000FF;'>Login here.</a></div>";

                                    $resultdel = mysqli_query($dbc, "DELETE FROM pass_reset WHERE token='$token'");
                                    $hide = 1;
                                }
                            }
                        }
                        ?>
                        <div class="login_form">
                            <form action="" method="POST">
                                <div class="form-group">

                                    <?php
                                    if (isset($error)) {
                                        foreach ($error as $error) {
                                            echo '<div class="errmsg">' . $error . '</div><br>';
                                        }
                                    }
                                    if (isset($success)) {
                                        echo $success;
                                    }
                                    ?>
                                    <?php if (!isset($hide)) { ?>
                                        <label class="label_txt">Password </label>
                                        <input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,15}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 10 to 15 characters" maxlength="15" minlength="10" required>
                                </div>
                                <div class="form-group">
                                    <label class="label_txt">Confirm Password </label>
                                    <input type="password" name="passwordConfirm" class="form-control" required>
                                </div>
                                <button type="submit" name="sub_set" class="btn btn-primary btn-group-lg form_btn">Reset Password</button>
                            <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</html>