<?php session_start(); ///starting login session check
	define('MPC-AUTORIZE-CALL', 'MPC-ADMIN');
	define('__mpc_connection__', __DIR__);

	require_once dirname(__DIR__) ."/functions/mpc-func.php";
	require_once dirname(__DIR__) ."/config/conn.php";

if(!isset($_SESSION['MPC_ADMIN_LOGIN_SUPE_SESSION'])) {
    $url = __mpc_root__() ."user/index.php/?sess=lgnexpire";
    header("location: $url");
    exit();
}

    require_once dirname(__DIR__) . '/functions/mpc-class.php';
    $systemLogo = new NewSettings; //THIS LINE RETURNS COMPANY LOGO;

        $id = $_SESSION['MPC_ADMIN_LOGIN_ID_AS'];
        $fn = $_SESSION['MPC_ADMIN_LOGIN_FN_AS'];
        $ln = $_SESSION['MPC_ADMIN_LOGIN_LN_AS'];
        $usrname = $_SESSION['MPC_ADMIN_LOGIN_USR_AS'];
        $prev = $_SESSION['MPC_ADMIN_LOGIN_PRV_AS'];
        $sq = $_SESSION['MPC_ADMIN_LOGIN_SQ_AS'];
        $branch = $_SESSION['MPC_ADMIN_LOGIN_BRANCH_AS'];
?>
<!DOCTYPE html>
<html lang="en-US" class="mpc-html" manifest="">
<head class="mpc-head">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" user-scalable="no">
    <meta name="keywords" content="Loan management system, online loan disbursment ">
	<title><?php echo getSystemName($conn)[1]?> - Admin</title>
	<link rel="shortcut-icon" href="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="icon" href="<?php echo __mpc_root__()?>/asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/stylesheet.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/toastify.css">
    <!--link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"-->
	<link rel="manifest" href="<?php echo __mpc_root__()?>manifest.json">
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/jquery.min.js"></script>
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-url.min.js"></script>
	<script  type="module" src="<?php echo __mpc_root__()?>script/api.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!--script  type="text/javascript" src="<?php //echo __mpc_root__()?>script/chart.js"></script-->
    <!--script src="https://cdn.jsdelivr.net/npm/chart.umd.js.map"></script-->
    <script src="<?php echo __mpc_root__()?>asset/tinymce.min.js"></script>
    <style>
        *{
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>
</head>
<body class="dsb-body session-expire offlineState mpc-body-class mpc-popup">

    <!--mpc load start-->
    <div class="mpc-ani-container"></div>
    
    <div class="mpc-sidebar mpc-m">
        <nav class="mpc-nav">
            <ul class="mpc-ul">
                <li>
                    <a href="#" class="a-logo">
                        <img src="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[0]?>" srcset="<?php echo __mpc_root__()?>asset/img/<?php print $systemLogo->getSystemLogo($conn)[0]?>" alt="LOGO" class="mpc-dsb-logo">

                        <span class="nav-item cmpy"><?php echo getSystemName($conn)[1]?></span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=dashboard&r=dboard" class="mpc-dsb-link">
                        <i class="fas fa-desktop" title="DASHBOARD"></i>

                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>

                <!--li>
                    <a href="<?php //echo __mpc_root__()?>user/dashboard.php/?action=addClient&r=client" class="mpc-dsb-link">
                        <i class="fas fa-user" title="ADD CLIENT"></i>

                        <span class="nav-item">Add client</span>
                    </a>
                </li-->

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=ltransaction&r=lt" class="mpc-dsb-link">
                        <i class="fas fa-wallet" title="LOAN TRANSACTION"></i>

                        <span class="nav-item">Check Loan Transaction</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=dTransactions&r=dt" class="mpc-dsb-link">
                        <i class="fas fa-hand-holding-usd" title="DEPOSITE TRANSACTION"></i>

                        <span class="nav-item">Deposit transaction</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=accounting&r=act" class="mpc-dsb-link">
                        <i class="fas fa-pen-alt " title="DUES"></i>

                        <span class="nav-item">Dues</span>
                    </a>
                </li>

                

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=inputData&r=iData&rtn=id" class="mpc-dsb-link">
                        <i class="fas fa-edit" title="INPUT DATA"></i>

                        <span class="nav-item">Input records</span>
                    </a>
                </li>


                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=CreateLoan&r=cloan&rtn=cloan" class="mpc-dsb-link">
                        <i class="fas fa-check-circle" title="CREATE LOAN"></i>

                        <span class="nav-item">Loan Request</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=ActivateLoan&r=activateLoan&rtn=aloan" class="mpc-dsb-link">
                        <i class="fas fa-broadcast-tower" title="LOAN REPAYMENTS"></i>

                        <span class="nav-item">Loan Repayments</span>
                    </a>
                </li>

                <li>
                   <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=addLoanTransaction&r=addLoan&rtn=gloan" class="mpc-dsb-link">
                       <!-- <i class="fas fa-loan" title="CREATE GROUPS"></i> -->
                       <i class="fa-solid fa-money-bill" title="ADD LOAN TRANSACTION"></i>

                       <span class="nav-item">Add Loan Transaction</span>
                   </a>
                </li>
                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=chkRetirement&r=rtire&rtn=crtire" class="mpc-dsb-link">
                        <i class="fas fa-blind" title="CHECK RETIREMENT"></i>

                        <span class="nav-item">Check Retirement</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=moveFunds&r=funds&rtn=mfunds" class="mpc-dsb-link">
                        <i class="fab fa-bitcoin" title="MOVE FUNDS"></i>

                        <span class="nav-item">Move funds</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Bulksms&r=Bsms&rtn=cloan" class="mpc-dsb-link">
                        <i class="fas fa-sms" title="BULK SMS"></i>

                        <span class="nav-item">Bulk sms</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=Settings&r=allsettings&rtn=settings" class="mpc-dsb-link">
                        <i class="fas fa-cog" title="SETTINGS"></i>

                        <span class="nav-item">Settings</span>
                    </a>
                </li>











                <li>
                    <a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=LogOut&v=true" class="mpc-dsb-link logout" style="/*position:absolute;*/">
                        <i class="fa-sign-out-alt fas" title="LOGOUT SESSION"></i>

                        <span class="nav-item">Log out</span>
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>

    <div class="mpc-main-content mpc-m">
        <div class="NormalMode main-item-top toggler" title="Toggle dark/light mode"> <i class="fas fa-cog"></i></div>
        <div class="main-item-top notify">
            <i class="fa-bell fas" title="NOTIFICATION"></i>
            <a class="mpc-NOtification" href="<?php echo __mpc_root__()?>user/dashboard.php/?action=CheckNotification&prev=<?php echo $prev?>&id=<?php echo $id?>">
                <sup class="adm-noti" role="notification">0</sup>
            </a>
        </div>

        <div class="main-item-top">
            <img src="<?php print __mpc_root__()?>asset/img/<?php echo __admin_profile(__mpcConn__(), $id, 'mpc_user'); ?>" alt="Adm" class="adm-pix">
        </div>

        <div class="main-item-top">
            <select name="adm-slect" id="" class="adm-select">
                <option value="">----</option>
                <option value="profile">Profile</option>
                <option value="pwd">Password</option>
                <option value="Logout">Logout</option>
            </select>
        </div>
        
    </div>
    <div class="mpc-admin-info-container">
        <div class="mpc-adm-tempHide">
            <i class="fa fa-bars fa-2x"></i>
        </div>
		<div class="mpc-adm-info ">
			<div class="user-type admin-db-details  shadow" title="<?php print $fn . ' ' . $ln?>, You where given the role of <?php echo __Adm__($prev)?>">
				<i class="fab fa-accessible-icon"></i>
				<h6 class="adm-prev" mpc-prevType="<?php echo $prev?>" mpc-adm-prev="<?php echo __Adm__($prev)?>" mpc-admId="<?php echo $id?>"><?php echo __Adm__($prev)?></h6>
			</div>

			<div class="user-name admin-db-details  shadow" title="<?php print $fn . ' ' . $ln?>, Welcome to GOOD-LIFE MPCs LIMITED">
				<i class="fas fa-user"></i>
				<h6 class="mpc-db-name">
					<?php print $fn . ' ' . $ln?>
				</h6>
				
			</div>

			<div class="user-type admin-db-details  shadow" title="<?php print $fn . ' ' . $ln?>, Your current branch is <?php echo $branch?>">
				<i class="fas fa-map-marker-alt"></i>
				<h6 class="">
					<?php echo $branch?>
				</h6>
			</div>

		</div>
	</div>

    <div class="content-display mpc-m">
        <div class="mpc-load-allData">
            <h5 class="mpc-admin-ds-notify"></h5>
            <div class="mpc-content-by-content">

       <?php

            //getting all querys using php super global variable 
            if(isset($_GET['action']) && !empty($_GET['action'])) {
                if($_GET['action'] == 'addClient') {
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";

                }else if($_GET['action'] == 'ltransaction') {
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php"; //processing only transaction load transaction only
                }else if($_GET['action'] == 'dTransactions'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php"; //processing only deposit transaction only
                }else if($_GET['action'] == 'accounting') {
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] == 'cSheet'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] == 'dashboard'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] == 'LogOut' && $_GET['v'] == 'true'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php"; //sending logout request
                }else if($_GET['action'] == 'inputData') {
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php"; //allowed admin input record
                }else if($_GET['action'] == 'CreateLoan') {
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php"; //allowed admin input record
                }else if($_GET['action'] == 'Settings'/* && $_GET['r'] == 'allsettings'*/){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php"; //allowed to create some settings add user
                }else if($_GET['action'] == 'verifyAction' && !empty($_GET['actionId'])){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] == 'CheckNotification'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'AdminRead' && $_GET['v'] === 'true'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'sendMsg'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'Bulksms'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] == 'addLoanTransaction'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'AssignGroupMember'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'ActivateLoan'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'GeneralSettings'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'chkRetirement'){
                    require_once dirname(__DIR__) ."/functions/mpc-tools.php";
                }else if($_GET['action'] === 'moveFunds' && $_GET['r'] == 'funds'){
                    require_once dirname(__DIR__) . '/functions/mpc-tools.php';
                }else if($_GET['action'] === 'Bugsfixed' && $_GET['r'] == 'fbugs'){
                    require_once dirname(__DIR__) . '/functions/mpc-tools.php';
                }else if($_GET['action'] === 'Dues'){
                    require_once dirname(__DIR__) . '/functions/mpc-tools.php';
                }
            }
            
       ?>
            </div>
        </div>
    </div>


    <script src="<?php echo __mpc_root__()?>script/all.min.js"></script>
    <script src="<?php echo __mpc_root__()?>script/dsboard.min.js" type="text/javascript"></script>	
    <script src="<?php echo __mpc_root__()?>script/mpc-chart.min.js" type="text/javascript"></script>	
    <script src="<?php echo __mpc_root__()?>script/bootstrap.min.js" type="text/javascript"></script>	
    <script src="<?php echo __mpc_root__()?>script/toastify.js" type="text/javascript"></script>	
    <script src="<?php echo __mpc_root__()?>script/mpc-jkl43lkjdsdf0ds34jkl.min.js" type="text/javascript"></script>	

    <script type="text/javascript">
        var a, b, c, d, e, script;

            a = "<?php echo $_GET['action']?>";

            title = "<?php echo getSystemName($conn)[1]?> - " + a;

            document.title = title;

            b = document.querySelector('.mpc-adm-tempHide');
          //  c = document.querySelector('.mpc-adm-tempHide svg');

            b.addEventListener('click', () =>{
                c = document.querySelector('.mpc-adm-tempHide svg');
                d = document.querySelector('.mpc-adm-info');
               // c.classList.remove('fa-bars');
               // c.classList.add('fa-xmark');

                if(c.classList.contains('fa-bars')){
                    c.classList.remove('fa-bars');
                    c.classList.add('fa-xmark');

                    d.classList.remove('tmp-Show');
                    d.classList.add('tmp-Hide');
                }else {
                    c.classList.remove('fa-xmark');
                    c.classList.add('fa-bars');

                    d.classList.remove('tmp-Hide');
                    d.classList.add('tmp-Show');
                    
                }
            })

    </script>
    <noscript>
        <h1>YOUR BROWSER DO NOT CURRENTLY SUPPORT JAVASCRIPT, YOU WILL BE LIMITED TO SO MANY FEATURES ON  THIS WEBSITES</h1>
    </noscript>
</body>
</html>
