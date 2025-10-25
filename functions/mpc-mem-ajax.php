<?php
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'mpcPWdConfirmedTransfer' && !empty($_POST['SenderId'])) {
    //get all database connection
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $tzne = date_default_timezone_set('Africa/Lagos');
	$date = date('d/n/Y, g:i:s a');

     $senderId = $_POST['SenderId'];
     $senderPhone = $_POST['SenderPhone'];
     $senderAcctType = $_POST['SenderActType'];
     $senderbyName = __mpcReturnByPhoneMember($conn, $senderPhone)[4];

     //sender total balance
     $senderBalance = $_POST['SelectedAccountBalance'];
     $senderSendAmount = $_POST['SendAmount'];
     //sender Pwd confirmed
     $senderPwdPass = $_POST['SenderPasswordConfirm'];

     //info about receiver
     $ReceiverId = $_POST['ReceiverId'];
     $ReceiverPh = $_POST['ReceiverPhone'];
     $ReceiverAcctType = $_POST['receiverCreditAccountType'];
     $ReceiverAcctNo = $_POST['ReceiverAccountNumber'];
     $ReceiverByName = __mpcReturnByPhoneMember($conn, $ReceiverPh)[4];

     $notificationStatus = 0;//it means no body has ready or seen it before, it a new notification;
     $notificationSender = getSystemName($conn)[1];
     $systemName = getSystemName($conn)[1];
     $transactionTypeSender = 'Debit';
     $transactionTypeReceiver = 'Credit';
     
    //start processing and calculation
    $RemainingBalance = $senderBalance - $senderSendAmount;
//check and detemine which table to insert and update
//SENDER FIRST
    if($senderAcctType == 'SHARES'){
        $tbl = "mpc_account_shares";
        $tblCol1 = 'shares_member_id'; //col1
        $tblCol2 = 'shares_member_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $SenderAccountByName = 'Shares contribution';

    }else if($senderAcctType == 'DEPOSIT'){
        $tbl = "mpc_fixed_deposit";
        $tblCol1 = 'fixed_mem_id'; //col1
        $tblCol2 = 'fixed_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $SenderAccountByName = 'Fixed deposit';
    }else if($senderAcctType == 'SPECIAL'){
        $tbl = "mpc_special_saving";
        $tblCol1 = 'mem_id'; //col1
        $tblCol2 = 'mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $SenderAccountByName = 'Special saving';
    }else if($senderAcctType == 'THRIFT'){
        $tbl = "mpc_thrift_saving";
        $tblCol1 = 'thrift_mem_id'; //col1
        $tblCol2 = 'thrift_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $SenderAccountByName = 'Thrift saving';
    }else if($senderAcctType == 'WELFARE'){
        $tbl = "mpc_welfare_contribution";
        $tblCol1 = 'welfare_mem_id'; //col1
        $tblCol2 = 'welfare_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $SenderAccountByName = 'Welfare contribution';
    }
     
//RECEIVERs TABLE START

    if($ReceiverAcctType == 'SHARES') {
        $Rtbl = 'mpc_account_shares';
        $tcol1 = 'shares_member_id'; //col1
        $tcol2 = 'shares_member_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $actName = 'Shares contribution';

   }else if($ReceiverAcctType == 'FIXED'){
        $Rtbl = 'mpc_fixed_deposit';
        $tcol1 = 'fixed_mem_id'; //col1
        $tcol2 = 'fixed_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $actName = 'Fixed deposit';

   }else if($ReceiverAcctType == 'SPECIAL'){
        $Rtbl = 'mpc_special_saving';
        $tcol1 = 'mem_id'; //col1
        $tcol2 = 'mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $actName = 'Special saving';

   }else if($ReceiverAcctType == 'THRIFT'){
        $Rtbl = 'mpc_thrift_saving';
        $tcol1 = 'thrift_mem_id'; //col1
        $tcol2 = 'thrift_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $actName = 'Thrift saving';

    }else if($ReceiverAcctType == 'WELFARE'){
        $Rtbl = 'mpc_welfare_contribution';
        $tcol1 = 'welfare_mem_id'; //col1
        $tcol2 = 'welfare_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $actName = 'Welfare contribution';
    }

    //trying to add existing or current receiver member balance to new transfer amount then return new balance
    $currentBalanceReceiverNewBal = __mpcMemberAccountBal__($conn, $Rtbl, $ReceiverId, $ReceiverPh, $tcol1, $tcol2)[2] + $senderSendAmount;
   //echo __mpcMemberAccountBal__($conn, $Rtbl, $ReceiverId, $ReceiverPh, $tcol1,  $tcol2)[2];

    //transfer member new balance (-) subtract transfer amount then return new balance
    $sendNewBalance = __mpcMemberAccountBal__($conn, $tbl, $senderId, $senderPhone, $tblCol1,  $tblCol2)[2] - $senderSendAmount; //balance minus subtracted amount = new balance

    $creditTxt = 0; //this is debit, so credit will be 0 from here
    //let check and confirmed password first
    if(!password_verify($senderPwdPass, __mpcReturnByPhoneMember($conn, $senderPhone)[17])) {
        $Err = "Password Error, password verify Error";
        echo $Err;
        exit();
    }else {
         

        if($senderBalance < $senderSendAmount){
            $Err = 'Insuffient Fund, You cannot transfer more than your current balance.';
            $notiTxt = "$senderbyName, Your balance is too low, you cannot transfer more than what you have on your account, Reduce the amount and try again...";
            

            __mpc_notify__($conn, $notiTxt, 5, $senderPhone, $senderId, 0, 0, $notificationSender); //NOTIFY MEMBER WHAT HAPPEND
            echo $Err;
            exit();
        }
        
        //check first to know if balance onn current account is 0 0 0 

        if(__mpcMemberAccountBal__($conn, $Rtbl, $ReceiverId, $ReceiverPh, $tcol1, $tcol2)[0] == 0 
            && __mpcMemberAccountBal__($conn, $Rtbl, $ReceiverId, $ReceiverPh, $tcol1, $tcol2)[1] == 0 
            && __mpcMemberAccountBal__($conn, $Rtbl, $ReceiverId, $ReceiverPh, $tcol1, $tcol2)[2] == 0){

            #update sql statment start here
            $sql = "UPDATE $Rtbl SET  $tblCol4='$currentBalanceReceiverNewBal', $tblCol5='$currentBalanceReceiverNewBal', date_time='$date' WHERE $tcol1='$ReceiverId' && $tcol2='$ReceiverPh'";
        }else{
            //add for receiver first
            $sql = "INSERT INTO $Rtbl ($tcol1, $tcol2, $tblCol3, $tblCol4, $tblCol5, date_time)VALUES('$ReceiverId', '$ReceiverPh', '0', '$currentBalanceReceiverNewBal', '$currentBalanceReceiverNewBal', '$date')";
        }

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
           $Err = "Unexpected error".mysqli_error($conn);
           echo $Err;
           exit();
        }

        
        //mysqli_stmt_bind_param($stmt, 'ssss', $senderSendAmount, $currentBalanceReceiverNewBal, $ReceiverId, $ReceiverPh);
        if(mysqli_stmt_execute($stmt)){
            
            /**SMS CREDIT ALERT WILL START HERE
             * THEN MEMBER TRANSACTION HISTORY RECORD WILL START BELOW
             * 
             * TRANSFEREE ACCOUNT BALANCE SUBTRACT ON SYSTEM RECORD FOLLOW BELOW 
             * THEN DEBIT ALERT PROCESSOR
             * THEN AFTER TRANSACTION HISTORY RECORD START FOR TRANSFEREE
             */
            
            //credit alert for receiver
            $notTxtReceiver = "<h1 class=\"text-center\">Credit Notification<h1>";
            $notTxtReceiver .= "<h4>$ReceiverByName, your account $ReceiverAcctNo as been credited with $senderSendAmount, from $senderbyName.</h4>";
            $notTxtReceiver .= "<h4>Your $notificationSender $actName account is credited with $senderSendAmount on $date, balance: $currentBalanceReceiverNewBal.<h4>";
            $notType = '5';


            __mpcMemberSmsAlertCredit($conn, $ReceiverPh, $senderSendAmount, $currentBalanceReceiverNewBal, $ReceiverAcctNo, $actName, $senderbyName);//send sms credit alert to member
            //below is trying to notify receiver about new money and where it is coming from and sender name
            __mpc_notify__($conn, $notTxtReceiver, $notType, $ReceiverPh, $ReceiverId, $notificationStatus, $notificationStatus, $notificationSender);
            __mpc_memberTransaction_makeRecords__($conn, $senderId, $senderPhone, $ReceiverId, $ReceiverPh, $transactionTypeSender, $senderSendAmount, 'Successful', 0); //transaction history record saved, or save to member transaction history list
            


            /**BELOW CODE I WILL START PROCESSING MEMBER DEBIT FORM
             * I MEAN SENDER DEBIT ALERT AND BALANCE DEBIT
             * AND OTHER MESSAGE/ NOTIFICATION CONCERNING MEMBER DEBIT SOMETHING
             */

             $update2 = "INSERT INTO $tbl ($tblCol1, $tblCol2, $tblCol3, $tblCol4, $tblCol5, date_time)VALUES('$senderId', '$senderPhone', '$senderSendAmount', '$creditTxt', '$sendNewBalance', '$date')"; //SET debit=?, balance=? WHERE $tblCol1=? && $tblCol2=?";
             $stmt = mysqli_stmt_init($conn);
             if(!mysqli_stmt_prepare($stmt, $update2)){
                $Err = "TRANSFER STOP UNEXPECTEDLY, PLS CONTACT ADMIN FOR HELP..manful.";
                $notiTxt = "<h1 class=\"text-center\">System encounter an unexpected error, while trying to debit member account</h1>";
                $notiTxt .= "<h4>System encounter an unexpected error, while trying to debit member account.</h4>";
                $notiTxt .= "<h4>$notificationSender member $senderbyName did a transfer of $senderSendAmount, to a fellow GOODLIFE UYO MPCS member $ReceiverByName on $date, the transfered amount has been credited to the recievers account.</h4>";
                $notiTxt .= "<h4>System is unable to debit the transfer amount from the senders account, pls contact admin to debit member with this name $senderbyName, phone $senderPhone a total of $senderSendAmount, from his/her $SenderAccountByName account.</h4>";
                $notiTxt .= "<h5>$notificationSender</h5>";
                __mpc_notify__($conn, $notiTxt, 5, 0, 0, 0, 0, $notificationSender.' ERROR DETECTOR'); //NOTIFY MEMBER THAT WHAT HAPPEND
                echo $Err.mysqli_error($conn);
                exit();
             }
//runing below code means no error from the above code
          //   mysqli_stmt_bind_param($stmt, 'ssss', $senderSendAmount, $sendNewBalance, $senderId, $senderPhone);
             if(mysqli_stmt_execute($stmt)){

                //TRYING TO SEND A DEBIT ALERT MESSAGE TO MEMBER
                $senderAccountNumber = __mpcReturnByPhoneMember($conn, $senderPhone)[10];
                __mpcMemberSmsAlertDebit($conn, $senderPhone, $senderSendAmount, $sendNewBalance, $senderAccountNumber, $SenderAccountByName, $ReceiverByName);

                //debit alert for receiver
                $notTxtSender = "<h1 class=\"text-center\">Transfer Notification<h1>";
                $notTxtSender .= "<h4>$senderbyName, you recently transfer money from your $systemName $SenderAccountByName account to $ReceiverByName $systemName $ReceiverAcctType</h4>";
                $notTxtSender .= "<h4>You sent $senderSendAmount to $ReceiverByName $systemName $actName account on $date, your remaining balance: $sendNewBalance .<h4>";

                __mpc_notify__($conn, $notTxtSender, 5, $senderPhone, $senderId, $notificationStatus, $notificationStatus, $notificationSender);
                //__mpc_memberTransaction_makeRecords__($conn, $senderId, $senderPhone, $ReceiverId, $ReceiverPh, $transactionTypeSender, $senderSendAmount, 'Successful', 0); //transaction history record saved, or save to member transaction history list
                 
                //NOW ITS REMAINING TO RECORD ON MEMBER TRANSACTION RECORDS
                echo "Transfer OKAY";
             }    
        }
    }


}

//member notification
if(isset($_GET['X']) && $_GET['X'] == 'MEMpErM' && !empty($_GET['X']) && !empty($_GET['MEMpH']) && !empty($_GET['MEMId'])){
    //get all database connection
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $memphone = $_GET['MEMpH'];
    $memid = $_GET['MEMId'];
    $views = 0;

    $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification WHERE notification_for=? && notification_for_id=? && views=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'ERROR';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssi', $memphone, $memid, $views);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    echo $data['notification_id'];
}

if(isset($_FILES['uploadPic']) && !empty($_FILES['uploadPic'])){
    session_start();
    $userId = $_SESSION['MPC_MEMB_LOGIN_ID_AS'];
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    //start processing image
    $name = $_FILES['uploadPic']['name'];
    $size = $_FILES['uploadPic']['size'];
    $error = $_FILES['uploadPic']['error'];
    $type = $_FILES['uploadPic']['type'];
    $tmploc = $_FILES['uploadPic']['tmp_name'];
   //echo $userId = $_GET['mpcUserId'];
    $tbl = 'mpc_members'; //TBLE
    $uid = 'members_id'; //USER ID

    $allowd = ['jpg', 'jpeg', 'png'];
    $file_ext = explode('.', $name);
    $fileRealExt = strtolower(end($file_ext));
    $allowedSize = 2000000;
    $uploadPath = "../asset/img/";
    $fileNewName = 'goodlife_mpc_'.time().'.'.$fileRealExt;
    if(!in_array($fileRealExt, $allowd)){
        $Err = 'This file is not allowed';
        echo $Err;
        exit();
    }else if($size > $allowedSize){
        $Err = 'File size too big';
        echo $Err;
        exit();
    }else if($error !== 0) {
        $Err = 'Unexpected error, please try again';
        echo $Err;
        exit();
    }else {
         //trying to get the defaault upload profile something
        //trying to get user/member/admin profile data start here
        $sql = "SELECT user_profile FROM $tbl WHERE $uid=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $Err = 'Unexpected error, please try again';
            echo $Err;
            exit();
        }
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);
       $pf = mysqli_fetch_assoc($d)['user_profile'];


        //check to know if this is the first time admin is trying to update his/her profile
        if($pf === 'avartar1.png') {
            //change profile picture to new one
            $upd = "UPDATE $tbl SET user_profile='$fileNewName', status='1' WHERE $uid='$userId'";
            if(mysqli_query($conn, $upd)) {
                //upload file now to directory specified
                if(move_uploaded_file($tmploc, $uploadPath.$fileNewName)){
                    
                    //return the file name has json object to admin
                    //trying to verify member ACCOUNT STATUS HEREstatus
                    $upd2 = "UPDATE mpc_member_verification SET verify_status='1' WHERE verify_for='$userId'";
                    mysqli_query($conn, $upd2);


                    echo $fileNewName;
                    exit();
                }
            }
        }else{
            //try to delete the first uploaded profile picture
            //u know that we dont want to much file on the site
            $deletPath = '../asset/img/'.$pf; // to delete profile picture is stored here
            if(unlink($deletPath)) {
                //from here we have delete our file then let process the new one
                //change profile picture to new one
            $upd = "UPDATE $tbl SET user_profile='$fileNewName' WHERE $uid='$userId'";
                if(mysqli_query($conn, $upd)) {
                    //upload file now to directory specified
                    if(move_uploaded_file($tmploc, $uploadPath.$fileNewName)){
                        //check to determine what the server is telling us;
                        echo $fileNewName;
                        exit();
                    }
                }
            }
        }
    }
}

//SEND PHONE NUMBER VERIFICATION CODE
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] == 'memVPERM'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $tzne = date_default_timezone_set('Africa/Lagos');
	$date = date('d/n/Y');
	$time = date('g:i:s a');

    $memberPhone = $_GET['ph'];
    $bin2hex = bin2hex(random_bytes(3));

    $key = strtoupper('mpc-' .$bin2hex);
    $status = 0; //status is zero which means it has not been verified

    $sql = "INSERT INTO mpc_passcode (pass_code, time, date, for_id, status)VALUES(?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "UNEXPECTED ERROR";
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'sssss', $key, $time, $date, $memberPhone, $status);
    if(mysqli_stmt_execute($stmt)){
        $Err = "OKAY";
        echo $Err;

        __mpc_send_anyting__($conn, $memberPhone, $key); //MPC FUNCTION TO SEND ANYTHING
        $notTxt = "<h2>Phone number verification request</h2>";
        $notTxt .= "<h5>You request for a phone number confirmation request on $date, $time..<h5>";
        $notTxt .= "<h5>Our system has received your request, and it has sent a code to $memberPhone</h5>";
        $notTxt .= "<h5>The code will drop on your device within a second</h5>";
        $sender = "@SELF_SEND_noReply";
        $rtnStatus = 0; //zero means we dont want any success message after notifiacation is sent;
        $notStatus = 0; //notification status at default 0 means that no body has read it yet
        /**1 means supa admin read
         * 2 means admin read
         * 3 means staff mead first
         * 4 means member read
         */

        $memberId = __mpcReturnByPhoneMember($conn, $memberPhone)[0];

        __mpc_notify__($conn, $notTxt, 5, $memberPhone, $memberId, $notStatus, $rtnStatus, $sender);// MEMBER NOTIFICATION

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
}

//load member transactions history
if(isset($_GET['Tperm']) && $_GET['Tperm'] == 'MpcYakise' && !empty($_GET['Tperm'])){
     define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

     $val = $_GET['val'];
     $ph = $_GET['phone'];
    $id = $_GET['id'];
    $systemName = getSystemName($conn)[1];


     if($val === 'CR'){
        $sql = "SELECT * FROM mpc_transaction_history WHERE transaction_to_id='$id' && transaction_to='$ph' ORDER BY transaction_id DESC LIMIT 20";

        $type =  'Credit '."<i class=\"fas fa-angle-double-down\" style=\"color:green;\"></i>";
     }else if($val === 'DR'){
        $sql = "SELECT * FROM mpc_transaction_history WHERE transaction_from_id='$id' && transaction_from='$ph' ORDER BY transaction_id DESC LIMIT 20";
        $type = 'Debit '."<i class=\"fas fa-angle-double-up\" style=\"color:red;\"></i>";
     }

     ?>
        <table class="table table-bordered table-striped fixed border-dark table-hovered">
            <tr>
                <td>#</td>
                <td>From</td>
                <td>To</td>
                <td>Account No.</td>
                <td>Amount</td>
                <td>Status</td>
                <td>Type</td>
                <td>Time</td>
            </tr>
     <?php
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'UNEXPECTED ERROR';
        echo $Err;
        exit();
     }
     mysqli_stmt_execute($stmt);
     $d = mysqli_stmt_get_result($stmt);
     while($data = mysqli_fetch_assoc($d)){
        $TransfromId = $data['transaction_from_id'];
		$TransfromPhone = $data['transaction_from'];

		$TransToId = $data['transaction_to_id'];
		$TransToPhone = $data['transaction_to'];
        
        if($TransfromPhone == 0){
            $fromName = $systemName;
        }else {
            $fromName = __mpcReturnByPhoneMember($conn, $TransfromPhone)[4]; //money to sender name
        }

       
		$ToName = __mpcReturnByPhoneMember($conn, $TransToPhone)[4]; //sender to receiver name
		$acctnNo = __mpcReturnByPhoneMember($conn, $TransToPhone)[10]; //sender to receiver name
		//$VerifyAccountPhoneNumber = __mpcReturnByPhoneMember($conn, $TransfromPhone)[5]; //s
        //__mpcReturnByPhoneMember
        ?>
            
            <tr>
				<td> <?php echo $data['transaction_id']?></td>
				<td> <?php echo $fromName?></td>
				<td> <?php echo $ToName?></td>
				<td> <?php echo $acctnNo?></td>
				<td>&#8358; <?php echo $data['transaction_amount']?></td>
				<td>
					<?php 
					 	if($data['transaction_status'] == 'Successful'){
							$Err = "Success <i class=\"fas fa-check\" style=\"color:green;\"></i>";
							echo $Err;
							//exit();
						}else {
							$Err = "Decline <i class=\"fas fa-xmark\" style=\"color:red;\"></i>";
							echo $Err;
							//exit();
						}
					
					?>
				</td>
                <td><?php echo $type?></td>
                <td><?php echo $data['transaction_date_time']?></td>
            </tr>
        <?php
     }
}

//TrackQry loan online tracker
if(isset($_POST['TrackQry']) && $_POST['TrackQry'] !== '')
{
     define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_POST['TrackQry'], false);    
    $sanitize = $conn->real_escape_string($data->searchKey);

    if($data->USRkey == 'PermPermited')
    {
        $sql = "SELECT * FROM mpc_loan_request_online WHERE loan_trackId LIKE '%$sanitize%' LIMIT 10";
        $stmt = $conn->query($sql);

        while($data = $stmt->fetch_assoc()){
    $name = __mpcReturnByPhoneMember($conn, $data['uid_ph'])[4];

if($data['status'] == 0){
    $d = 'PENDING';
    $trColor = 'bg-warning text-light';
}elseif($data['status'] == 1){
    $d = 'APPROVED';
    $trColor = 'bg-success text-light';
}elseif($data['status'] == 2){
    $d = 'DECLINED';
    $trColor = 'bg-danger text-light';
}elseif($data['status'] == 3){
    $d = 'COMPLETED';
    $trColor = 'bg-muted text-light';
}
            ?>
            <tr>
                <td><?php echo $data['uid']?></td>
                <td><?php echo $name?></td>
                <td><?php echo $data['amount']?></td>
                <td><?php echo $data['request_date']?></td>
                <td><?php echo $data['approval_message']?></td>
                <td><?php echo $data['approved_date']?></td>
                <td class="<?php echo $trColor?>"><?php echo $d?></td>
            </tr>
            <?php
        }

    }
}