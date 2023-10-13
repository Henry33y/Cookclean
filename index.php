<?php
	include('includes/db_config.php');
	session_start();

  // loggedIn User com_get_active_object
  $agent = new stdClass();
	
  // if login form is submitted
  if (isset($_POST["login-btn"])) {
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST["password"]);

    // checking db if there is a user with email and password
    if ($stmt=$mysqli->prepare("SELECT id, fullname , contact , email , type FROM users WHERE email=? AND password=?")) {

      $stmt->bind_param("ss", $email, $password);

      $stmt->execute();

      $stmt->bind_result($id, $fullname, $contact, $email , $type);

      while($stmt->fetch()) {

        $agent->id = $id;
        $agent->fullname = $fullname;
        $agent->contact = $contact;
		$agent->email = $email;
        $agent->type = $type;

        // storing user info in the session
        $_SESSION["agent"] = $agent;

      }

      $stmt->close();

    }

    // checking if sign in was not successful
    if (empty($_SESSION["agent"]) || !isset($_SESSION["agent"]) || $_SESSION["agent"]->id < 1) {
      $_SESSION["agent-signin-error"] = (object) array('type' => 'danger', 'message' => '<strong>Wrong credentials.</strong>. Please check and try again.');
    }

  }

  // checking if user is signed in already
  if (isset($_SESSION["agent"]) && $_SESSION["agent"]->id > 0) {
    header("Location:dashboard.php");
  }
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <link rel="stylesheet" href="public/front/assets/css/styleae52ae52.css?v=5">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta name="description" content="php Script">
  <meta name="keywords" content="bootstrap, mobile , mobile, html, Script, php, css ,service, bike" />

  <link rel="apple-touch-icon" sizes="180x180" href="public/front/assets/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="public/front/assets/img/favicon.png" sizes="32x32">
  <link rel="shortcut icon" href="public/front/assets/img/favicon.png">
  
  <script src="public/front/assets/js/lib/jquery-3.4.1.min.js"></script>
</head>

<body>

  <!-- App Header -->
  
  <!-- * App Header --><!-- App Capsule -->
<div id="appCapsule" class="container">
    <div class="row justify-content-md-center" >
		<?php

                  if (isset($_SESSION["agent-signin-error"])) {

                    ?>

                    <div class="alert alert-<?php echo $_SESSION["agent-signin-error"]->type; ?> alert-rounded"> <i class="ti-alert"></i> <?php echo $_SESSION["agent-signin-error"]->message; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>

                    <?php

                    unset($_SESSION["agent-signin-error"]);

                  }

        ?>
        <div class="col-md-12" >
            <div class="section mt-2 text-center">
		        <img src="public/front/assets/img/logo.png" class="imaged w-50" style="width: 150px !important;">
                <h2 class="mt-2">Login!</h2>
                <h4>Enter your staff email and password.</h4>
                            </div>
        </div>

        <div class="col-md-6" >
            <div class="section mb-5 p-2">

                <form action="" method="POST">
                    <div class="card">
                        <div class="card-body pb-1">
                            
							<!--<div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="tel">Telephone</label>
                                    <input type="text" class="form-control" name="tel" id="tel" placeholder="024xxxxxxx">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>-->
							<div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="tel">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="email@cookclean.net">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                            </div>
							<div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="*****">
                                    <i class="clear-input">
                                        <ion-icon name="key-outline"></ion-icon>
                                    </i>
                                </div>
                            </div>
							
                            
                        </div>
                    </div>


                    <div class="form-button-group  transparent">
                        <button type="submit" name="login-btn" class="btn btn-primary btn-lg btn-block" style="width:100%;" onclick=""> Login </button>
                        <!--<button type="button" name="login-btn" class="btn btn-success btn-lg btn-block" style="width:40%;" onclick="window.location.href = 'register.php';"> Sign up </button>-->
                       
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
<!-- * App Capsule -->



<script>
     ;
    (function ($, window, document, undefined) {
        $('document').ready(function () {

          setInterval(function(){ 
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                  $(this).remove(); 
              });
            }, 3000);

        });
    })(jQuery, window, document);
    </script>
    <!-- Jquery -->
    
    <!-- Bootstrap-->
    <script src="public/front/assets/js/lib/popper.min.js"></script>
    <script src="public/front/assets/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="../../unpkg.com/ionicons%405.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="public/front/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>

</body>

</html>