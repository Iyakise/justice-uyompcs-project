<?php session_start();
	define('MPC-AUTORIZE-CALL', 'MPC-ADMIN');
	define('__mpc_connection__', '../config/conn');

	require_once dirname(__DIR__) ."/functions/mpc-func.php";
	require_once dirname(__DIR__) ."/functions/mpc-class.php";
	require __mpc_connection__.'.php';

	if(isset($_SESSION['MPC_ADMIN_LOGIN_SUPE_SESSION'])) {
		$path = __mpc_root__() . 'user/dashboard.php/?action=dashboard&k=sessionExist';
		header("location:{$path}");
		exit();
	}

	$systemLogo = new NewSettings;
?>
<!DOCTYPE html>
<html lang="en-US" class="mpc-html" manifest="">
<head class="mpc-head">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - <?php echo getSystemName($conn)[1]?></title>
	<link rel="shortcut-icon" type="image/x-icon" href="<?php echo __mpc_root__()?>asset/img/favicon.ico">
	<link rel="icon" type="image/x-icon" href="<?php echo __mpc_root__()?>/asset/img/favicon.ico">
	 <link rel="apple-touch-icon" href="<?php echo __mpc_root__()?>/asset/img/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/stylesheet.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
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
			<img src="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[0]?>" title="<?php print getSystemName($conn)[1]?> LOGO " alt="LOGO" srcset="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[0]?>" class="mpc-logo shadow">
			<span class="rtn-txt">

				<?php
					if(isset($_GET['action']) && !empty($_GET['action'])){
						echo "Registration Success, login Now!";

						?>
	<script>
		var a, b, c;
			a = document.querySelector('.rtn-txt').classList.add('rtn-msg-succ');
			setTimeout(function(){
                __mpcTurnOffMsg();
            }, 4000)
	</script>
						<?php
					}
				?>
			</span>
		</div>

		<div class="form-container">
			<div class="mpc-inp-cont">
				<input type="text" placeholder="Username, Phone, Email" class="user-uid mpc-input">
				<input type="password" placeholder="Password" class="user-uidPass mpc-input">

				<button type="button" class="UidUser-login" onclick="__mpcLoginButton()">Login</button>
				<a href="#" class="forget-pwd">Forget password ?</a>
				<a href="<?php echo __mpc_root__()?>user/register.php" class="forget-pwd">SignUp</a>
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
	<script src="<?php echo __mpc_root__()?>script/script.min.js" type="text/javascript"></script>
</body>
</html>
