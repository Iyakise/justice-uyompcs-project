<?php

  if(isset($_POST['MPCP']) && $_POST['MPCP'] == 'MPCADMIN_perm' && !empty($_POST['MPCP'])) {

        define ('__mpc_connection__', 'manf'); //db connecntin define constant
        define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";



    $fn = $_POST['FN'];
    $ln = $_POST['LN'];
    $usr = $_POST['USER'];
    $pass = $_POST['PWD'];
    $sq = $_POST['SQ'];
    $sqAns = $_POST['SQans'];
    $avatar = 'avatar.png';
    $prev = 1;
    $tbl = 'mpc_user';
    $branch = "Justice (UYO) Secretariat Complex, Uyo";
    $columns = ['user_fname', 'user_lname', 'user_username', 'user_pwd', 'user_previllege', 'user_profile', 'user_security_q', 'user_security_a', 'branch'];

    //let procted our user information
    $ptedUser = password_hash($usr, PASSWORD_DEFAULT); //PROTECT USERNAME. MAIL, PHONE
    $ptedPass = password_hash($pass, PASSWORD_DEFAULT); //PROCTED PASSWORD
    $ptedAns = password_hash($sqAns, PASSWORD_DEFAULT);
//trying to know if any data existed in users table
   // $data = [$fn, $ln, $ptedUser, $ptedPass, $prev, $avatar, $sq, $ptedAns];
   $sql = "SELECT * FROM $tbl";
   $qury = mysqli_query($conn, $sql);
   $row = mysqli_num_rows($qury);
   
   if($row < 1) {
    __mpc_dump($conn, $fn, $ln, $usr, $ptedPass, $prev, $avatar, $sq, $ptedAns, $columns, $tbl, $branch); //dump data 
    exit();
   }else {
    $Err = "Admin Users count limit, please contact system developer for help.";
      $Err.= __mpcDeveloper__()[0];
      $Err.= __mpcDeveloper__()[1];
      $Err.= __mpcDeveloper__()[2];
      $Err.= __mpcDeveloper__()[3];
      $Err.= __mpcDeveloper__()[4];
      echo $Err;

    exit();
   }

   /*
   if(!mysqli_num_rows(mysqli_query($conn, )) > 4){
      
    __mpc_dump($conn, $fn, $ln, $usr, $ptedPass, $prev, $avatar, $sq, $ptedAns, $columns, $tbl); //dump data 
      
    }else{
       
      $Err = "Admin Users count limit, please contact system developer for help.";
      $Err.= __mpcDeveloper__()[0];
      $Err.= __mpcDeveloper__()[1];
      $Err.= __mpcDeveloper__()[2];
      $Err.= __mpcDeveloper__()[3];
      $Err.= __mpcDeveloper__()[4];
      echo $Err;
      exit();
    } */



 }

 //ADMIN LOGIN DATA REQUEST
 if(isset($_POST['PERMIT']) && $_POST['PERMIT'] !== '' && $_POST['PERMIT'] == 'GOODMPC') {
  define ('__mpc_connection__', 'MPC-GOOD-LIFE'); //db connecntin define constant
  define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

/**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
require_once dirname(__DIR__) ."/config/conn.php";
require_once dirname(__DIR__) ."/functions/mpc-func.php";
    //let start processing user information
    $usr = $_POST['Usr']; //user phone, username, email
    $pwd = $_POST['Pwdpass']; //user pwd pass
    $Tbl = 'mpc_user';
    $cookieName = '__MPC_LOGIN__';
    $cookieVal = 'true';

    //try to select
    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $Tbl WHERE user_username='$usr'"))>0) {
      $Err = "Invalid username or Password";

      echo $Err;
      exit(); //we are telling php to end the script here if password is not correct, username is not correct or probably no single row match users record;
    }

    $sql = "SELECT * FROM $Tbl WHERE user_username=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      $Err = "Unexpected Error, trying to sign-in Admin, please call system developer for help.";
      $Err.= __mpcDeveloper__()[0];
      $Err.= __mpcDeveloper__()[1];
      $Err.= __mpcDeveloper__()[2];
      $Err.= __mpcDeveloper__()[3];
      $Err.= __mpcDeveloper__()[4];
      echo $Err;
      exit(); //we are telling php to end the script here if any error occur while trying to login;
    }
    mysqli_stmt_bind_param($stmt, 's', $usr);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);
    
    //return user information to process login 
    $id = $data['user_id'];
    $fn = $data['user_fname'];
    $ln = $data['user_lname'];
    $usrname = $data['user_username'];
    $dbpwd = $data['user_pwd'];
    $prev = $data['user_previllege'];
    $sq = $data['user_security_q'];
    $brnch = $data['branch'];
    $from = 'mpc_user';
    $usrType = $prev; // to be change later for admin current prev
    $actionType = 'Login';

    //try to verify login password
    if(!password_verify($pwd, $dbpwd)) {
      $Err = "Invalid username or Password";
      echo $Err;
      exit(); //we are telling php to end the script here if password is not correct;
    }
    session_start();
    //from here we are processing user login information
    $ip = $_SERVER['REMOTE_ADDR']; //current login ip
    $_SESSION['MPC_ADMIN_LOGIN_ID_AS'] = $id;
    $_SESSION['MPC_ADMIN_LOGIN_FN_AS'] = $fn;
    $_SESSION['MPC_ADMIN_LOGIN_LN_AS'] = $ln;
    $_SESSION['MPC_ADMIN_LOGIN_USR_AS'] = $usrname;
    $_SESSION['MPC_ADMIN_LOGIN_PRV_AS'] = $prev;
    $_SESSION['MPC_ADMIN_LOGIN_SQ_AS'] = $sq;
    $_SESSION['MPC_ADMIN_LOGIN_IP_AS'] = $ip;
    $_SESSION['MPC_ADMIN_LOGIN_BRANCH_AS'] = $brnch;
    $_SESSION['MPC_ADMIN_LOGIN_SUPE_SESSION'] = 1;

    __mpc_login_record($conn, $id, $from, $usrType, $actionType); //record usr login time admin
    setcookie($cookieName, $cookieVal, 0, '/');

    setcookie('__MPC-ADM-IP__', $ip, 0, '/');

    $Err = 'LOGIN SUCCESS';
    print $Err;
    exit();

 }





 
  if(isset($_GET['action']) && $_GET['action'] !== '') {
    header("Content-Type: application/json; charset=UTF-8");

        define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
        define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        //try to get our correct nigerian time here
        //time zone first 
        $tzone = date_default_timezone_set('Africa/Lagos');
        $dte = date('Y-m-d H:i:s'); //

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data =  json_decode($_GET['action'], false) ;
    $ttl =  "$data->Title"; //Member prefered title
    $sex =  $data->Sex; //member gender
    $dob =  $data->Dob; //Member date of b.
    $name =  $data->Name; //Member name
    $cAddr =  $data->Caddr; //Member contact address
    $pAddr =  $data->Paddr; //Member permenent Address
    $phone =  $data->Phone; //Member Phone number
    $lga =  $data->Lga; //Member local goverment
    $email =  $data->Email; //Member email
    $occupation =  $data->Occup; //Memeber occupation / nature of business
    $BuzAddr =  $data->BusAddr; //Member business address
    $church =  $data->Church; //Members church
    $Pbirth =  $data->Pbirth; //Members place of birth
    $reli =  $data->Reli; //Members religion

    // next of kin info start here
    $nextOfKin =  $data->Nextkin; //next of kin contact address
    $relationShip =  $data->NkinRel; //next of kin contact address
    $NcontactAdd =  $data->NkinAddr; //next of kin contact address
    $Nphone =  $data->NkinPhone; //nexw of kin phone
    $pwd = password_hash($phone, PASSWORD_DEFAULT); //MEMBERS PASSWORD

//convert all member information into one array
    $columns = ['title', 'sex', 'date_of_birth', 'name', 'contact_addr', 'permanent_addr', 'phone', 'lga', 'place_of_birth', 'religion', 'email', 'occupation', 'business_addr', 'church', 'declaration', 'registration_number', 'groups', 'registration_date', 'status']; //db columns into array

    $data = [$ttl, $sex, $dob, $name, $cAddr, $pAddr, $phone, $lga, $Pbirth, $reli, $email, $occupation, $BuzAddr, $church, 'penging', 'pending', 'pending', 'pending', 0]; //dump data into array
    $tbl = 'mpc_members';
    $v = 'pending';
    $stat = 0;

    //check for duplicate phone number
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tbl WHERE phone='$phone'")) >0) {
      header("Content-Type: application/Json");
      $Err = "Duplicate phone number, number '$phone', already assign to another member's account";
      echo json_encode($Err);
      exit();
    }

    //check for duplicate phone number
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tbl WHERE email='$email'")) >0) {
      header("Content-Type: application/Json");
      $Err = "Duplicate Mail, mail =>'$email', already assigned to another member's account";
      echo json_encode($Err);
      exit();
    }
    

    $sql = "INSERT INTO $tbl (`title`, `sex`, `date_of_birth`, `name`, `contact_addr`, `permanent_addr`, `phone`, `lga`, `place_of_birth`, `religion`, `email`, `occupation`, `business_addr`, `church`, `any_coop`, `coop_name`, `mem_pwd`, `declaration`, `registration_number`, `groups`, `registration_date`, `status`, `v_ph`, `v_em`)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Content-Type: application/Json");
      $Err = "Unexpected error occur while processing member information, contact developer for help.";
      $Err.= __mpcDeveloper__()[0];
      $Err.= __mpcDeveloper__()[1];
      $Err.= __mpcDeveloper__()[2];
      $Err.= __mpcDeveloper__()[3];
      $Err.= __mpcDeveloper__()[4];
      echo json_encode($Err);
      exit(); //php eill end this code from here

    }else {
      mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssss", $ttl, $sex, $dob, $name, $cAddr, $pAddr, $phone, $lga, $Pbirth, $reli, $email, $occupation, $BuzAddr, $church, $v, $v, $pwd, $v, $v, $v, $dte, $stat, $stat, $stat);
      if(mysqli_stmt_execute($stmt)) {
        $lastId = mysqli_stmt_insert_id($stmt);

        $tbl1 = 'mpc_guarantors';
  

        //insert data in guarantor table
          $sql2 = "INSERT INTO mpc_guarantors (gurantor_for, gurantor_for_id, gurantors_name, guarantor_phone)VALUES('$phone', $lastId, '0', '0')";
          $sql3 = "INSERT INTO mpc_next_of_kin (next_of_kin_for_phone, next_of_kin_for_id, next_kin_name, next_kin_relationship, next_kin_addre, next_kin_phone)VALUES('$phone', $lastId, '$nextOfKin', '$relationShip', '$NcontactAdd', '$Nphone')";
                
          mysqli_query($conn, $sql2);
          mysqli_query($conn, $sql3); //dump

          setcookie('LastUserId', $lastId, 0, '/');
          $arr = array('LastId' => $lastId, 'lastName' => $name, 'stepOne' => 'Mpc');

          header("Content-Type: application/Json");

            echo json_encode($arr);
          //$Err = "STEP ONE DONE";
         // echo $Err;
          exit();      
      }
    }
      
      
  }

  //function update other memeber details
  if(isset($_GET['x']) && !empty($_GET['x']) && $_GET['Perm'] == 'YakiseR') {
    header("Content-Type: application/json; charset=UTF-8");
    //echo $_GET['x'];
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant
        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
        require_once dirname(__DIR__) ."/config/conn.php";
        require_once dirname(__DIR__) ."/functions/mpc-func.php";

      $data = json_decode($_GET['x'], false);
      $accNo = $data->AccNo; //member account number
      $BankName = $data->BankName; //member bank name
      $AcctName = $data->AccName; //member account name
      $AnyCoop = $data->AnyOther; //member anyOther cooperative
      $CoopName = $data->CoopName; //member account number
      $gurantorName = $data->GurantorName; //member guarantor name
      $gurantorPhone = $data->GurantorPhone; //member guantor phone number
      $declaration = $data->Declaration; //member account declaration
      $memBerId = $data->Crrntuser; //current usr id
      $status = 1;
      //$accNo = $data->AccNo; //member account number

      //get phone number for tbl mpc_mem_account
      $get = "SELECT phone FROM mpc_members WHERE members_id= '$memBerId'";
      if(!$g = mysqli_query($conn, $get)){
        //if any unexpected error occur while trying to get usr date
        $Err = 'Unexpected error, while trying to retreived user data';
        echo $Err;
        exit();
      }
      $userPhone = mysqli_fetch_array($g)['phone']; // any user that require thsi code, this varable has information about their phone



      //insert user account details
      $sql = "INSERT INTO mpc_mem_account (user_id, user_phone, account_name, account_number, bank_type)VALUES(?,?,?,?,?)";
      $stmt = mysqli_stmt_init($conn);

      //check for any err that might arise unexpectedly
      if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error while trying to save user account information, please contact system developer for help';
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err;
        exit();
      }
      mysqli_stmt_bind_param($stmt, 'issss', $memBerId, $userPhone, $AcctName, $accNo, $BankName);
      if(mysqli_stmt_execute($stmt)) {
        //once this code run up to this point it means that we need ot update user
        //from memeber table
        $sql = "UPDATE mpc_members SET declaration=?, status=?, any_coop=?, coop_name=? WHERE members_id=? && phone=?";
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          $Err = "Unexpected error, while trying to update members declaration, please contact system developer..";
          $Err.= __mpcDeveloper__()[0];
          $Err.= __mpcDeveloper__()[1];
          $Err.= __mpcDeveloper__()[2];
          $Err.= __mpcDeveloper__()[3];
          $Err.= __mpcDeveloper__()[4];
          echo $Err;
          exit();
        }
        mysqli_stmt_bind_param($stmt, 'sissss', $declaration, $status, $AnyCoop, $CoopName , $memBerId, $userPhone);
        //we belive that from here it is done then, let drink and make merrys to that
        if(mysqli_stmt_execute($stmt)) {
          mysqli_query($conn, "UPDATE mpc_guarantors SET gurantors_name='$gurantorName', guarantor_phone='$gurantorPhone' WHERE gurantor_for='$userPhone' && gurantor_for_id='$memBerId'");
          $Err = 'SUCCESS';
          echo $Err;
          exit();
        }
      }
  }



//get company earning monthly
if(isset($_GET['mpcEarning']) && $_GET['mpcEarning'] !== '' && $_GET['mpcEarning'] == 'earningMonthly'){
  //first thng load database connection
  header("Content-Type: application/json; charset=UTF-8");
  //echo $_GET['x'];
  define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
  define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant
  /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
  require_once dirname(__DIR__) ."/config/conn.php";
  require_once dirname(__DIR__) ."/functions/mpc-func.php";

  $query = $_GET['q'];
  //print_r($conn);
  /*
  $sql = "SELECT SUM(January, Febuary, March, April, May, June, July, August, September, October, November, December) FROM mpc_earnings WHERE year=?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
      $err = "error occur";
      json_encode($err);
      exit();
  }
  mysqli_stmt_bind_param($stmt, 's', $query);
  mysqli_stmt_execute($stmt);
  $d = mysqli_stmt_get_result($stmt);
  $data = mysqli_fetch_array($d);
  */
  $JAN = __companyEarning($conn, 'January', $query, 'monthly'); //JANUARY EARNING
  $FEB = __companyEarning($conn, 'Febuary', $query, 'monthly'); //FEBUARY EARNING
  $MAR = __companyEarning($conn, 'March', $query, 'monthly'); //MARCH EARNING
  $APR = __companyEarning($conn, 'April', $query, 'monthly'); //APRIL EARNING
  $MAY = __companyEarning($conn, 'May', $query, 'monthly'); //MAY EARNING
  $JUN = __companyEarning($conn, 'June', $query, 'monthly'); //JUNE EARNING
  $JUL = __companyEarning($conn, 'July', $query, 'monthly'); //JULY EARNING
  $AUG = __companyEarning($conn, 'August', $query, 'monthly'); //AUGUST EARNING
  $SEPT = __companyEarning($conn, 'September', $query, 'monthly'); //SEPTEMBER EARNING
  $OCT = __companyEarning($conn, 'October', $query, 'monthly'); //OCTOBER EARNING
  $NOV = __companyEarning($conn, 'November', $query, 'monthly'); //NOVEMBER EARNING
  $DEC = __companyEarning($conn, 'December', $query, 'monthly'); //DECEMBER EARNING


  $rtn = ['jan' => $JAN, 'feb' => $FEB,'mar'=> $MAR,'Apr'=> $APR, 'may' => $MAY,'jun'=> $JUN, 'jul'=> $JUL, 'Aug' => $AUG,'sept'=> $SEPT,'oct'=> $OCT,'nov'=> $NOV, 'Dec' => $DEC, 'yrs' => $query];
  echo json_encode($rtn);
}


if(isset($_GET['PERMdEPOSIT']) && $_GET['PERMdEPOSIT'] !== '' && $_GET['PERMdEPOSIT'] === 'getMPcdeposit'){
    //first thng load database connection
    header("Content-Type: application/json; charset=UTF-8");
    //echo $_GET['x'];
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant
    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
  

   $deposit = __mpc_counterAll($conn, 'deposit');
   $active = __mpc_counterAll($conn, 'active loan');
   $loan = __mpc_counterAll($conn, 'loan');

    $arr = ['deposit' =>$deposit, 'Active' => $active, 'Loan' => $loan];
    echo json_encode($arr);


}


