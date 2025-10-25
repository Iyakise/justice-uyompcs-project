<?php session_start();
// Enable full error reporting
// error_reporting(E_ALL | E_STRICT); // Includes notices, warnings, deprecated, and strict standards

// // Display errors on screen (for local testing only)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

// // Log errors to a file too
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/php-error.log');

    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__FILE__). "/functions/mpc-func.php";
    require_once dirname(__FILE__). "/functions/mpc-mem-func.php";
    require_once dirname(__FILE__). "/functions/mpc-class.php";

    if(!isset($_SESSION['MPC_MEMB_LOGIN_vERYIFY_KEY'])){
        $url = __mpc_root__() . "login.php/action=sessExp";

        header("location:$url");
    }
    $systemLogo = new NewSettings;
    define('__mpc_connection__', '/config/conn');
    require_once dirname(__FILE__).__mpc_connection__. ".php";
    //membe section variable
    $uidId = $_SESSION['MPC_MEMB_LOGIN_ID_AS'];
    $uidName = $_SESSION['MPC_MEMB_LOGIN_NAME_AS'];
    $uidPhone = $_SESSION['MPC_MEMB_LOGIN_PHONE_AS'];
    $uidEmail = $_SESSION['MPC_MEMB_LOGIN_EMAIL_AS'];
    $uidStatus = $_SESSION['MPC_MEMB_LOGIN_STATUS_AS'];
    $uidgroup = $_SESSION['MPC_MEMB_LOGIN_GROUP_AS'];
    $uidReg = $_SESSION['MPC_MEMB_LOGIN_REG_AS'];
    $uidVPhone = $_SESSION['MPC_MEMB_LOGIN_PH_V_AS'];
    $uidVemail = $_SESSION['MPC_MEMB_LOGIN_EM_V_AS'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="mpc-html">
<head class="mpc-head">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo "GOOD LIFE MICROFINANCE BANK, MULIT-PURPOSE COOPERATIVE" ?>">
    <meta name="keywords" content="<?php echo "GOOD LIFE MICROFINANCE BANK, MULIT-PURPOSE COOPERATIVE" ?>">
    <meta name="robot" content="index, follow, *">
    <meta name="theme-color" content="#e29118">
    <title><?php echo getSystemName($conn)[0]?> - Members Dashboard</title>
    <link rel="shortcut-icon" type="text/css" href="<?php echo __mpc_root__()?>asset/img/favicon.ico">
	<link rel="icon" type="text/css" href="<?php echo __mpc_root__()?>/asset/img/<?php print $systemLogo->getSystemLogo($conn)[1]?>">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/stylesheet.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/mpc-mem.min.css?v=0.0.0.1">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/owl.theme.green.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo __mpc_root__()?>css/bootstrap.min.css">
    <link rel="manifest" href="<?php echo __mpc_root__()?>manifest.json">
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/jquery.min.js"></script>
	<script  type="application/javascript" src="<?php echo __mpc_root__()?>script/mpc-url.min.js"></script>
    <!--script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script-->
    <!--script src="https://cdn.jsdelivr.net/npm/chart.js"></script-->
</head>
<body class="dsb-body offlineState mpc-body-class mpc-popup session-expire anytime-pop">
    <!--mpc load start-->
    <div class="mpc-ani-container"></div>
    
    <!--MEMBER SIDEBAR NAV STARTT-->
    <div class="navigation">
        <img title="<?php print getSystemName($conn)[2]?> LOGO" src="<?php echo __mpc_root__()?>asset/img/logo.jpg" alt="" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $systemLogo->getSystemLogo($conn)[0]?>" class="mpc-mLogo">
        <ul>
            <li class="list  dboard">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=dashboard" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-desktop" title="DASHBOARD"></i></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="list trzn">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=transactions" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-wallet" title="TRANSACTION"></i></span>
                    <span class="title">Transactions</span>
                </a>
            </li>

            <!-- <li class="list mloan">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=loan" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-vote-yea" title="LOAN"></i></span>
                    <span class="title">Loan</span>
                </a>
            </li> -->

            <li class="list Lrpay">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=Repayloan" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-people-carry" title="REPAY LOAN"></i></span>
                    <span class="title">Repay loan</span>
                </a>
            </li>

            <li class="list tfer">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=transfer" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-right-left" title="TRANSFER"></i></span>
                    <span class="title">Transfer</span>
                </a>
            </li>
            
            <li class="list RQl">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=RequestLoad" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-shekel-sign" title="Request LOAN"></i></span>

                    <span class="title">Request Loan</span>
                </a>
                <span class="loanApproval">
                    <?php echo __myLoanRequest($conn, $uidId, $uidPhone)?>
                </span>
            </li>

            <li class="list settnz">
                <b></b>
                <b></b>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=uidMemberSettings" class="mpc-m-navLink">
                    <span class="icon"><i class="fas fa-cog" title="TRANSFER"></i>
                        <span class="fa-shake __mpcnew_ p-1">New</span>
                    </span>
                    <span class="title">Settings</span>
                </a>
            </li>
        </ul>
    </div>
    <style type="text/css">
    .__mpcnew_{
        width:20px;
        height: 20px;
        background: red;
        position: absolute;
        line-height:0;
        top: 40px;
        left: 20px;
        color:#fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        text-align: center;
    }
</style>
    <div class="toggler">
        <i class="fas fa-bars"></i>
    </div>
    
    <div class="mpc-memb-content-wrapper">
        <div class="mpc-memb-top-tools-wrap">
            <span class="item toggle-darkMode-light">
                <i class="fas fa-sun"></i>
            </span>

            <span class="item notification">
                <i class="fas fa-bell"></i>
                <span class="notification-wrapper">
                    <a href="<?php echo __mpc_root__()?>dashboard.php/?action=MyNotifications">
                        <i class="subNoti">0</i>
                    </a>
                </span>
            </span>

            <span class="item profile">
                <?php 
                

                $img =  __mpcReturnByPhoneMember($conn, $uidPhone)[18];
                ?>
                <img src="<?php echo __mpc_root__()?>asset/img/<?php echo  $img?>" alt="Pics" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo  $img?>" class="dboard-img">
            </span>


            <!--span class="item memb-pSelect">
                <select class="adm-select" id="">
                    <option value="">----</option>
                    <option value="profile">profile pics</option>
                    <option value="profile">profile</option>
                    <option value="profile">password</option>
                    <option value="profile">profile</option>
                    
                </select>
            </span-->
        </div>

        <div class="mpc-mem-Inner-padder">
            <!-- content side by side-->
            <h5 class="Usr-rtn rtn-data" mpcmemberphone="<?php echo $uidPhone?>" mpcmemberid="<?php echo $uidId?>" mpcMemVph="<?php echo $uidVPhone?>" mpcMemVem="<?php echo $uidVemail?>"></h5>
            <div class="mpc-memb-data">
        
<?php
/***ALL MEMBERS GET REQUEST WILL BE RECIEVED HERE
 * TASK IS GOING TO PERFORM HERE
 */
    if(isset($_GET['action'])){
        if($_GET['action'] === 'dashboard'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'transactions'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'loan'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'Repayloan'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'transfer'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'uidMemberSettings'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'MyNotifications'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }else if($_GET['action'] === 'RequestLoad'){
            require_once dirname(__FILE__) .'/functions/mpc-m-tool.php';
        }
    }


?>
            </div>
        </div>
    </div>
    <script>
          //adding toggle class to to mpc member navigattion sidebar
        var list, menuItem, togglerSvg, navigation, logo, darkModeSwith;
        menuItem = document.querySelector('.toggler');
        
        navigation = document.querySelector('.navigation');
        logo = document.querySelector('.mpc-mLogo');
        menuItem.addEventListener('click', function() {
            togglerSvg = document.querySelector('.toggler svg');
            if(togglerSvg.classList.contains('fa-bars')) {
                togglerSvg.classList.remove('fa-bars');
                togglerSvg.classList.add('fa-xmark');
            }else {
                togglerSvg.classList.remove('fa-xmark');
                togglerSvg.classList.add('fa-bars');
            }

            this.classList.toggle('active')
            navigation.classList.toggle('active'); //adding classlist to expand sidebar naviagation links;
            logo.classList.toggle('active'); //add active class to logo
        });


        list = document.querySelectorAll('.list');
        
        for (let i = 0; i < list.length; i++) {
            list[i].addEventListener('click', function(){

               // this.classList.toggle('active')
                let j = 0;
                while (j < list.length) {
                    list[j++].className = 'list';

                }
                list[i].classList.add('active');
            })
                
            
            
        }

        darkModeSwith = document.querySelector('.toggle-darkMode-light');
        darkModeSwith.addEventListener('click', function(){
            var innerSvg = document.querySelector('.toggle-darkMode-light svg');

            if(innerSvg.classList.contains('fa-sun')){
                innerSvg.classList.remove('fa-sun'); //removing the sun icon
                innerSvg.classList.add('fa-moon'); //adding moon icon here

                
            }else {
                innerSvg.classList.remove('fa-moon'); //removing the moon icon
                innerSvg.classList.add('fa-sun'); //adding sun icon here
            }

            this.classList.toggle('memberDarkMode');
        })

        /**TRYING TO CREATE A POP UP TO TELL MEMBER THAT ACCOUNT IS NOT ACTIVATED START HERE BELOW */
        var notificationData, a, b, c, d, e, f, g, h;
            notificationData = document.querySelector('.Usr-rtn');
            a = notificationData.getAttribute('mpcMemVph');
            b = notificationData.getAttribute('mpcMemVem');

            if(a == 0 && b == 0){
                //check if account is activated
                //if not asked member to activated his or her account
               // document.querySelector('.anytime-pop').appendChild(__checkMpcStatus__()); //check and activae

                //__mpcMemberPOPup__()// popup box/dialogue box close
            }

            /**@abstract MEMBER NAVIGATION TRACKING START */
            var title, newtitle
            title = "<?php echo $_GET['action']?>";
            if(title == 'uidMemberSettings'){
                title = 'Settings';
            }
            document.title = title + ' - <?php echo getSystemName($conn)[1]?>';
            
        
    </script>
    <script src="<?php echo __mpc_root__()?>script/all.min.js"></script>
    <!--script src="<?php //echo __mpc_root__()?>script/mpc-chart.min.js" type="text/javascript"></script-->	
    <script src="<?php echo __mpc_root__()?>script/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo __mpc_root__()?>script/mpc-mem-dboard.min.js" type="text/javascript"></script>
    

</body>
</html>