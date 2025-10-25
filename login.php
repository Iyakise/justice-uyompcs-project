<?php session_start();
define('MPC-AUTORIZE-CALL', '');
define('__mpc_connection__', '/config/conn');

    require_once dirname(__FILE__) . "/functions/mpc-func.php";
    require_once dirname(__FILE__) . "/functions/mpc-class.php";
    require_once dirname(__FILE__) .__mpc_connection__. ".php";

    if(isset($_SESSION['MPC_MEMB_LOGIN_vERYIFY_KEY'])) {
      $path = __mpc_root__() . 'dashboard.php/?action=dashboard&k=sessionExist';
      header("location:{$path}");
      exit();
    }
    $systemLogo = new NewSettings;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Login - <?php echo getSystemName($conn)[0]?></title>
    <script src="<?php echo __mpc_root__()?>script/jquery.min.js"></script>
    <link rel="shortcut-icon" type="text/css" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>>
	<link rel="icon" type="text/css" href="<?php echo __mpc_root__()?>/asset/img/<?php echo $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/mpc-mem.min.css?v=1.0.0">
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-url.min.js"></script>
</head>
<body class="mpc-login">
    <div class="mpc-container mpc-m">
        <span class="borderLine"></span>
        <div class="mpc-mem-login-wrap">
            <h2>Sign in</h2>
            <div class="mpc-inputBox-wrap">
                <input type="text" placeholder="Phone or Email" class="mpc-input mpc-usr" require>
                <!--span>Username</span>
                <i></i-->
            </div>

            <div class="mpc-inputBox-wrap">
                <input type="password" placeholder="Password" class="mpc-input mpc-pwd" require>
                <!--span>Password</span>
                <i></i-->
            </div>

            <div class="mpc-link">
                <a href="#" class="mpc-lnk">Forgot password</a>
                <a href="<?php echo __mpc_root__()?>signup.php" class="mpc-lnk">Signup</a>
            </div>
            <button class="mpc-membersLogin-butt" onclick="mpc_memberslogin()">Login</button>
            <span class="mpc-txt">manful computer</span>

        </div>
    </div>

    <script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-memb-script.min.js"></script>
</body>
</html>
