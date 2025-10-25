<?php
define('MPC-AUTORIZE-CALL', '');
define('__mpc_connection__', '');
    require_once dirname(__FILE__) . "/functions/mpc-func.php";
    require dirname(__FILE__) . "/functions/mpc-class.php";
    require dirname(__FILE__) . "/config/conn.php";

    $systemLogo = new NewSettings;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Register - <?php echo getSystemName($conn)[0]?></title>
    <script  type="text/javascript" src="<?php echo __mpc_root__()?>script/jquery.min.js"></script>
    <link rel="shortcut-icon" type="image/x-icon" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="icon" type="image/x-icon" href="<?php echo __mpc_root__()?>/asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/mpc-mem.min.css?v=1.0.0">
  <link rel="apple-touch-icon" href="<?php echo __mpc_root__()?>/asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-url.min.js"></script>

</head>
<body class="mpc-login">
    <div class="mpc-container">
        <span class="borderLine"></span>
        <div class="mpc-mem-login-wrap">
            <h2>Sign up</h2>
            <div class="reg-inp">
                <input type="text" placeholder="Fullname" class="mpc-input name">
            </div>

            <div class="reg-inp">
                <input type="text" placeholder="Phone" class="mpc-input phone">
            </div>

            <div class="reg-inp">
                <input type="email" placeholder="Email" class="mpc-input email">
            </div>

            <div class="reg-inp">
                <input type="password" placeholder="Password" class="mpc-input pwd">
            </div>

            <div class="reg-inp">
                <input type="password" placeholder="Confirmed password" class="mpc-input cpwd">
            </div>

            <div class="mpc-link">
                <a href="<?php echo __mpc_root__()?>login" class="mpc-lnk">Login</a>
            </div>
            <button class="mpc-membersLogin-butt" onclick="mpcmembersLoginbutt()">Register</button>
            <span class="mpc-txt"></span>
        </div>
    </div>
    <script src="<?php echo __mpc_root__()?>script/mpc-memb-script.min.js"></script>
</body>
</html>
