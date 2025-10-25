<?php
	//TRYING TO PROTECT THIS HEADER FILE
	if(!defined('__MPC_GENERAL_PERMIT__')) {
		die("<h1> Access denied.</h1>");
	}
	//define('__mpc_connection__', '');
    define('MPC-AUTORIZE-CALL', 'MPC-ADMIN');
    require_once dirname(__DIR__) . "../../functions/mpc-func.php";
    require_once dirname(__DIR__) . "../../functions/mpc-class.php";
  //  require_once  __DIR__.'/../../config/conn.php';
    //require_once "../../functions/mpc-class.php";
	$systemLogo = new NewSettings;
?>	
<!DOCTYPE html>
<html lang="en" dir="ltr" class="mpc-html">
<head class="mpc-head">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="ONLINE LOAN disburse COMPANY, get loan loan, get all time off loan online, loan at one percent interest rate, get loan with no collateral">
	<meta name="keywords" content="Justice uyo Multi-purpose cooperative society, ONLINE LOAN disburse COMPANY, get loan loan, get all time off loan online, loan at one percent interest rate, get loan with no collateral">
	<meta name="robot" content="follow, index">
	<meta name="theme-color" content="#e29118">
    <title>Welcome - <?php echo getSystemName($conn)[0]?></title>
	<script  type="text/javascript" src="<?php echo __mpc_root__()?>script/jquery.min.js"></script>
  <link rel="shortcut-icon" type="image/x-icon" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="icon" type="image/x-icon" href="<?php echo __mpc_root__()?>/asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/mpc-mem.min.css?v=1.0.0">
	<link rel="manifest" href="<?php echo __mpc_root__()?>manifest.json">
	 <link rel="apple-touch-icon" href="<?php echo __mpc_root__()?>/asset/img/favicon.ico">
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-url.min.js"></script>
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-scroll-screen.js"></script>
    <!--script src="https://cdn.jsdelivr.net/npm/chart.js"></script-->

</head>
<body class="mpc-body mpc-offline mpc-popup mpc-session mpc-login-set">
   <header class="header">
		<span class="mpc-brand">
			<img src="<?php print __mpc_root__()?>asset/img/<?php echo $systemLogo->getSystemLogo($conn)[0]?>" alt="----" title="IMG" srcset="<?php print __mpc_root__()?>asset/img/<?php echo $systemLogo->getSystemLogo($conn)[0]?>" class="brand brand-logo navbar-brand">
		</span>


		<ul>
			<li>
				<a href="<?php echo __mpc_root__()?>">
					<i class="fa-home fas"></i>HOME
				</a>
			</li>

			<!--li>
				<a href="<?php //echo __mpc_root__()?>goodlife-blog-post">
					<i class="fas fa-blog"></i>BLOG
				</a>
			</li-->

			<li>
				<a href="<?php echo __mpc_root__()?>contact">
					<i class="fas fa-tachometer-alt"></i>CONTACT
				</a>
			</li>

			<li>
				<a href="<?php echo __mpc_root__()?>about">
					<i class="fas fa-radiation"></i>ABOUT
				</a>
			</li>

			<li>
				<a href="<?php echo __mpc_root__()?>calculator">
					<i class="fas fa-calculator"></i>CALCULATOR
				</a>
			</li>
			
			<li>
				<a href="<?php echo __mpc_root__()?>gallery">
					<i class="fa-regular fa-images"></i>gallery
				</a>
			</li>

			<li>
				<a href="<?php echo __mpc_root__()?>faqs">
					<i class="fas fa-question"></i>FAQS
				</a>
			</li>

			<li>
				<a href="<?php echo __mpc_root__()?>login">
					<i class="fa-sign-in fas"></i>SIGNIN
				</a>
			</li>
		</ul>



		<span class="mpc-toggler">
			<i class="fa-bars fa-2x fas"></i>
		</span>
   </header>
   <div class="mpc-toTop">
        <div class="mpc-toTop-wrap">
            <i class="fas fa-angle-double-up fa-2x"></i>
        </div>
   </div>
