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
          <h4 class="card-title text-center">Reset Password</h4>
        </div>
        <div class="card-body py-4">
          <div class="container-fluid">

            <?php require_once("config.php");
            if (isset($_SESSION["login_sess"]))
            ?>
            <html>

            <title> Forgot Password - Customer Help Portal</title>

            <body>

              <form action="forgot_process.php" method="POST">
                <div class="login_form">
                  <div class="form-group">
                    <?php if (isset($_GET['err'])) {
                    $err = $_GET['err'];
                    echo '<p class="errmsg">No user found. </p>';
                  }
                  // If server error 
                  if (isset($_GET['servererr'])) {
                    echo "<p class='errmsg'>The server failed to send the message. Please try again later.</p>";
                  }
                  //if other issues 
                  if (isset($_GET['somethingwrong'])) {
                    echo '<p class="errmsg">Something went wrong.  </p>';
                  }
                  // If Success | Link sent 
                  if (isset($_GET['sent'])) {
                    echo "<div class='successmsg'>Reset link has been sent to your registered email id . Kindly check your email. </div>";
                  }
                    ?>
                    <?php if (!isset($_GET['sent'])) { ?>
                      <label class="label_txt">Username or Email </label>
                      <input type="text" name="login_var" value="<?php if (!empty($err)) {
                                                                    echo  $err;
                                                                  } ?>" class="form-control" required="">
                  </div>
                  <button type="submit" style='margin-top:10px' name="subforgot" class="btn btn-primary btn-group-lg form_btn">Send Link </button>
                <?php } ?>
                </div>
              </form>
              <br>
              <p>Have an account? <a href="login.php">Login</a> </p>
              <p>Don't have an account? <a href="registration.php">Sign up</a> </p>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
  </main>

</html>