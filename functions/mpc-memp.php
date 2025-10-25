<?php

if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'MPC-members'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $usrname = $_POST['usr'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM mpc_members WHERE phone='$usrname' || email='$usrname'";
    //check first if there is any user with this phone number or email
    if(!mysqli_num_rows(mysqli_query($conn, $sql))>0) {
        $Err = "Password or username Error";
        echo $Err;
        exit();
    }
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error while processing request";
        print $Err;
        exit();
    }
    //mysqli_stmt_bind_param($stmt, "s", $usrname, $usrname);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    $uidId = $data['members_id'];
    $uidName = $data['name'];
    $uidPhone = $data['phone'];
    $uidEmail= $data['email'];
    $uidStatus= $data['status'];
    $uidgroup = $data['groups'];
    $uidReg = $data['registration_number'];
    $uidVPhone = $data['v_ph'];
    $uidVemail = $data['v_em'];
    $uidPass = $data['mem_pwd'];

    //TRYING TO CHECK IF MEMBER LOGIN PASSWORD MATCH
    //THE HATCH PASSWORD I MEAN PROTECTED PASSWORD INSIDE DATABASE tble
    if(!password_verify($pwd, $uidPass)) {
        $Err = "Password or Username Error";
        echo $Err;
       exit();
    }
    //SETTING DEFAULT TIME-ZONE TO AFRICA LAGOS
    $tzon = date_default_timezone_set('Africa/Lagos');
    $date = date('d/n/Y, g:i:s a');
    $from = 'mpc_members';
    $usrType = 5;
    $actionType = 'Login';

    session_start();

    $_SESSION['MPC_MEMB_LOGIN_ID_AS'] = $uidId;
    $_SESSION['MPC_MEMB_LOGIN_NAME_AS'] = $uidName;
    $_SESSION['MPC_MEMB_LOGIN_PHONE_AS'] = $uidPhone;
    $_SESSION['MPC_MEMB_LOGIN_EMAIL_AS'] = $uidEmail;
    $_SESSION['MPC_MEMB_LOGIN_STATUS_AS'] = $uidStatus;
    $_SESSION['MPC_MEMB_LOGIN_GROUP_AS'] = $uidgroup;
    $_SESSION['MPC_MEMB_LOGIN_REG_AS'] = $uidReg;
    $_SESSION['MPC_MEMB_LOGIN_PH_V_AS'] = $uidVPhone;
    $_SESSION['MPC_MEMB_LOGIN_EM_V_AS'] = $uidVemail;
    $_SESSION['MPC_MEMB_LOGIN_vERYIFY_KEY'] = 1;

    $prtect = password_hash($uidName, PASSWORD_DEFAULT);
    setcookie('__mpc_member__', $prtect, 0, '/');
    setcookie('__mpc_mem_login__', 'true', 0, '/');

     $redirect = __mpc_root__();

     $Err = "success";

    echo $Err;
    __mpc_login_record($conn, $uidId, $from, $usrType, $actionType); //record member login time admin
    exit();
}

//member register
if(isset($_POST['PERM']) && $_POST['PERM'] == 'mpcMemReg@Online' && !empty($_POST['PERM'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    //SETTING DEFAULT TIME-ZONE TO AFRICA LAGOS
    $tzon = date_default_timezone_set('Africa/Lagos');
    $date = date('d/n/Y, g:i:s a');

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $newPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $v = 'pending';
    $v1 = 0;
    $profile = 'avartar1.png';

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE phone='$phone' && name='$name' "))>0){
        $Err = "Please Login, information already exist "; //. __mpcReturnByPhoneMember($conn, $phone)[12];
        echo $Err;
        exit();
    }
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE phone='$email' "))>0){
        $Err = "Email already exist.!";
        echo $Err;
        exit();
    }

    //save user data 
    $sql = "INSERT INTO mpc_members (title, sex, date_of_birth, name, contact_addr, permanent_addr, phone, lga, place_of_birth, religion, email, occupation, business_addr, church, any_coop, coop_name, mem_pwd, declaration, registration_number, groups, registration_date, status, v_ph, v_em, user_profile, branch)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    //INIT SQL CONNECTION
    $stmt = mysqli_stmt_init($conn);
    //check for possible connection error
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error occured";
       /* $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        */
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss", $v, $v, $v, $name, $v, $v, $phone, $v, $v, $v, $email, $v, $v, $v, $v, $v, $newPwd, $v, $v, $v, $date, $v1, $v1, $v1, $profile, $v);
    if(mysqli_stmt_execute($stmt)){
        $Err = "Reg successful";
        echo $Err;
        $notType = 5;
        $status = 0;
        $notTxt = trim("
                    <h1 class=\"mpc-noti-h1 text-center\">NEW USER SIGN UP</h1>
                    <p>A new user with this name $name, has registered on our platform, on this date $date</p>
                    <p>At default, some functionalites on the newly registered member dashboard will be disabled and deactivated till the admin fill in some required data to activated the new account.</p>

                    <h5>Below are the neccessary things needed before members account can be activated</h5>
                    <ol>
                        <li>Admin generated account number</li>
                        <li>Registration number</li>
                        <li>Member verify Phone number</li>
                        <li>Email verify address</li>
                        <li>Etc</li>
                        
                    </ol>
                    <p>Please contact Admin to activate this account, to enable this user have full access to the system.</p>
                    <p>Notification is Auto-generated</p>
                    ");
        
                //notification type paramether defination
                /**1 => supa admin
                 * 2 => admin
                 * 3 => staff
                 * 4 = > member
                 * 5 staff, admin and supa admin will see the notification
                 */

                 //notification status paramether defination
                /**0 => not read
                 * 1 => Supa admin read
                 * 2 => members read
                 * 3 = > supa admin read
                 *
                 */
                $lastId = mysqli_stmt_insert_id($stmt);
                __mpc_memp_misc__($conn, 'mpc_account_shares', '', ['shares_member_id', 'shares_member_phone', 'credit', 'debit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, 0]);
                __mpc_memp_misc__($conn, 'mpc_welfare_contribution', '', ['welfare_mem_id', 'welfare_mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, 0]);
                __mpc_memp_misc__($conn, 'mpc_thrift_saving', '', ['thrift_mem_id', 'thrift_mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, 0]);
                __mpc_memp_misc__($conn, 'mpc_special_saving', '', ['mem_id', 'mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, 0]);
                __mpc_memp_misc__($conn, 'mpc_fixed_deposit', '', ['fixed_mem_id', 'fixed_mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, 0]);
                /**MEMBERS ACCOUNT VERIFICATION STATUS START HERE */
        $sql2 = "INSERT INTO mpc_member_verification (verify_for, verify_for_phone, verify_phone, verify_email, verify_status, verify_bank_account, verify_quarantor)VALUES('$lastId', '$phone', '0', '0', '0', '0', '0')";
        mysqli_query($conn, $sql2);


        __mpc_notify__($conn, $notTxt, $notType, 'N/A', '0', $status, $status, '@SELF_SEND_noReply');

        exit();
    }

    

}
