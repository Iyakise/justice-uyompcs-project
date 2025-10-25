<?php
    	define('MPC-AUTORIZE-CALL', 'MPC-ADMIN');
    	define('__mpc_connection__', 'MPC-ADMIN');

        require_once dirname(__DIR__) ."/functions/mpc-func.php";
        require_once dirname(__DIR__) ."/functions/mpc-class.php";
        require_once dirname(__DIR__) ."/config/conn.php";

        if(isset($_SESSION['MPC_ADMIN_LOGIN_SUPE_SESSION'])) {
      		$path = __mpc_root__() . 'user/dashboard.php/?action=dashboard&k=sessionExist';
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
    <title>SignUp - <?php echo getSystemName($conn)[0]?></title>
	<link rel="shortcut-icon" type="image/x-icon" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="icon" type="image/x-icon" last-modified="Mon 12 Jan 2023" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/stylesheet.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
  <link rel="apple-touch-icon" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">

    <style>
        .form-container {
            margin-top:2em;
        }
    </style>
</head>
<body class="mpc-body" style="overflow-y: hidden;">
	<div class="icon-load" style="display:flex;justify-content:center;align-items:center;"></div>

	<div class="owl-carousel owl-theme mpc-m" style="z-index: 1;">
	<!-- mpc slider img start -->
		<div class="item mpc-item">
			<img src="<?php echo __mpc_root__()?>asset/img/bg7.jpg" alt="..." srcset="<?php echo __mpc_root__()?>asset/img/bg7.jpg">
		</div>

		<div class="item mpc-item">
			<img src="<?php echo __mpc_root__()?>asset/img/bg5.jpg" alt="..." srcset="<?php echo __mpc_root__()?>asset/img/bg5.jpg">
		</div>

		<div class="item mpc-item">
			<img src="<?php echo __mpc_root__()?>asset/img/bg6.jpg" alt="..." srcset="<?php echo __mpc_root__()?>asset/img/bg6.jpg">
		</div>

		<div class="item mpc-item">
			<img src="<?php echo __mpc_root__()?>asset/img/img5.jpg" alt="..." srcset="<?php echo __mpc_root__()?>asset/img/img5.jpg">
		</div>

		<div class="item mpc-item">
			<img src="<?php echo __mpc_root__()?>asset/img/img6.jpg" alt="..." srcset="<?php echo __mpc_root__()?>asset/img/img6.jpg">
		</div>
<!-- mpc slider end here-->
	</div>

	<div class="mpc-container mpc-m">
		<div class="brand">
			<img src="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[0]?>" title="<?php print getSystemName($conn)[1]?> LOGO" alt="LOGO" srcset="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[0]?>" class="mpc-logo shadow">
			<span class="rtn-txt"></span>
		</div>

		<div class="form-container">
			<div class="mpc-inp-cont">

				<input type="text" placeholder="Firstname" class="fn mpc-input">

				<input type="text" placeholder="Lastname" class="ln mpc-input">

				<input type="text" placeholder="Phone, Username, Email" class="usrPhEm mpc-input">
				<input type="password" placeholder="Password" class="pwd mpc-input">
				<input type="password" placeholder="Confirm password" class="cnfm-pwd mpc-input">

                <!-- security q-->
                <select name="sq" id="sq" class="sqSelect" title="SECURITY QUESTION">
                    <option value="">---</option>
                    <option value="What is your father's name">What is your father's name ?</option>
                    <option value="What is your mother's name">What is your mother's name ?</option>
                    <option value="Favorite place like to visit">Favorite place like to visit ?</option>
                    <option value="What is your birthday">What is your birthday ?</option>
                    <option value="First child's name">First child's name ?</option>
                    <option value="Most unforgetable experience">Most unforgetable experience ?</option>
                    <option value="Favorite class teacher in High School">Favorite class teacher in High School ?</option>
                    <option value="Favorite celebrity">Favorite celebrity ?</option>
                </select>

                <input type="text" placeholder="Security Answers" class="Sqans mpc-input" title="SECURITY ANSWER">

				<button type="button" class="UidUser-reg" onclick="UiduserRegister()">Register</button>

			</div>

			<div class="live-time">
					<h5 class="mpc-time">GOOD Life</h5>
			</div>

		</div>


	</div>

    <script src="<?php echo __mpc_root__()?>script/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/all.min.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.carousel.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.navigation.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.autoplay.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.animate.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.video.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.lazyload.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/owl.autorefresh.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo __mpc_root__()?>script/script.min.js" type="text/javascript"></script>
</body>
</html>
