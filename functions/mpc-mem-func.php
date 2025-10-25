<?php
/**MPC MEMBERS FUNCTION STARTY HERE
 * EVERYTHIN ABOUT MEMBER WILL BE WRITTEN HERE
 */
if(!defined('MPC-AUTORIZE-CALL')) {
	die('<h1 class="mpc-enter">ACCESS DENIED</h1>');
}

function __mpc_getAccountBalance__($conn, $memId, $memPhone){

    //share start here
    $sql = "SELECT * FROM mpc_account_shares WHERE shares_member_id='$memId' && shares_member_phone='$memPhone' ORDER BY shares_id DESC";
    $sq = mysqli_query($conn,  $sql);
    $shareFetch = mysqli_fetch_array($sq);

    $shareBalance = $shareFetch['balance'];

    //share end here

    //mpc_fixed_deposit start here
    $sql = "SELECT * FROM mpc_fixed_deposit WHERE fixed_mem_id='$memId' && fixed_mem_phone='$memPhone' ORDER BY mpc_fixed_id DESC";
    $fq = mysqli_query($conn,  $sql);
    $FixFetch = mysqli_fetch_array($fq);

    $fixedBalance= $FixFetch['balance'];

    //fixed end here

    //mpc_special_saving start here
    $sql = "SELECT * FROM mpc_special_saving WHERE mem_id='$memId' && mem_phone='$memPhone' ORDER BY special_id DESC";
    $spq = mysqli_query($conn,  $sql);
    $spFetch = mysqli_fetch_array($spq);

    $specialF = $spFetch['balance'];

    //mpc_special_saving end here

    //mpc_thrift_saving start here
    $sql = "SELECT * FROM mpc_thrift_saving WHERE thrift_mem_id='$memId' && thrift_mem_phone='$memPhone' ORDER BY thrift_id DESC";
    $thrq = mysqli_query($conn,  $sql);
    $thrifF = mysqli_fetch_array($thrq);

    $thrifthF = $thrifF['balance'];

    //mpc_thrift_saving end here

    //mpc_welfare_contribution start here
    $sql = "SELECT * FROM mpc_welfare_contribution WHERE welfare_mem_id='$memId' && welfare_mem_phone='$memPhone' ORDER BY welfare_id DESC";
    $welfareq = mysqli_query($conn,  $sql);
    $welF = mysqli_fetch_array($welfareq);

    $welfarBal = $welF['balance'];

    //mpc_welfare_contribution end here
    ?>
    <option value="<?php echo $shareBalance?>" class="optionVal" transferAccountType="SHARES">SHARES ACCOUNT</option>
    <option value="<?php echo $fixedBalance?>" class="optionVal" transferAccountType="DEPOSIT">FIXED DEPOSIT ACCOUNT</option>
    <option value="<?php echo $specialF?>" class="optionVal" transferAccountType="SPECIAL">SPECIAL SAVING</option>
    <option value="<?php echo $thrifthF?>"  class="optionVal"transferAccountType="THRIFT">THRIFT SAVING</option>
    <option value="<?php echo $welfarBal?>" class="optionVal" transferAccountType="WELFARE">WELFARE CONTRIBUTION</option>

    <?php

}

//count and display notification for members
function __mpcTotalMemberNotificationCount__($conn, $memId, $memPhone){
    $views = 0;

    $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification WHERE notification_for=? && notification_for_id=? && views=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'ERROR';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssi', $memPhone, $memId, $views);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    return $data['notification_id'];
}

//function to display function
function __mpcDisplayNotificationShort__($conn, $id, $phone){
    $views = 0;
    $sql = "SELECT * FROM mpc_notification WHERE notification_for=? && notification_for_id=? && views=? ORDER BY notification_id DESC LIMIT 20";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'ERROR';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssi', $phone, $id, $views);
    mysqli_stmt_execute($stmt);

    $d = mysqli_stmt_get_result($stmt);
    while($data = mysqli_fetch_array($d)){
        ?>
        <tr>
            <td><?php echo $data['notification_id']?></td>
            <td><?php echo $data['notification_sender']?></td>
            <td>

                <?php
                    echo substr($data['notification'], 0, 100). '...';
                ?>

            </td>
            <td><?php echo $data['time_and_date']?></td>
            <td>
                <a href="<?php echo __mpc_root__()?>dashboard.php/?action=MyNotifications&Read=readSingle&Key=<?php echo $data['notification_id']?>" class="view-btn">Read more...</a>

            </td>
        </tr>

        <?php
    }
}

//mpc member notification read
function __mpcAllowedMemberReadNotification__($conn, $id){

    $sql = "SELECT * FROM mpc_notification WHERE notification_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'ERROR';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    $upd = "UPDATE mpc_notification SET views='1' WHERE notification_id='$id'";
    mysqli_query($conn, $upd);

    $arr = [$data['notification'], $data['time_and_date'], $data['notification_sender'], $data['views']];
    return $arr;
}

//function to check  check if members account has been activated
function getStatus($conn, $phone, $Id){

     $sql = "SELECT * FROM mpc_member_verification WHERE verify_for=? && verify_for_phone=?";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Members status get failed";
        echo $Err;
        exit();
    }

        mysqli_stmt_bind_param($stmt, 'ss', $Id, $phone);
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_array($d);

        $arr = [$data['verification_id'], $data['verify_phone'], $data['verify_email'], $data['verify_status'], $data['verify_bank_account'], $data['verify_quarantor']];
        return $arr;


}

function __mpc_memberGetAccount_All__($conn, $id, $phone, $colName1, $colName2, $tbl, $increment){

    //start without wasting too much time
    $sql = "SELECT * FROM $tbl WHERE $colName1=? && $colName2=? ORDER BY $colName1 DESC LIMIT 100";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Error occured';
        echo $Err;
    }else {
        mysqli_stmt_bind_param($stmt, 'ss',  $id, $phone);
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);

        //trying to get all data at once
        while($data = mysqli_fetch_array($d)){
            ?>
                <tr>
                    <td class="mpc-countGroup"><?php echo $increment?></td>
                    <td class="mpc-countGroup"><?php echo '&#8358;'.$data['debit']?></td>
                    <td class="mpc-countGroup"><?php echo '&#8358;'.$data['credit']?></td>
                    <td class="mpc-countGroup blnce"><?php echo '&#8358;'.$data['balance']?></td>
                    <td class="mpc-countGroup"><?php echo $data['date_time']?></td>
                </tr>
            <?php
        }
    }
}



//function to check if admin has created any loan for member
function __mpc_member_Single_status_($conn, $id, $phone) {

    require_once 'mpc-func.php';

    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_loan_member WHERE mem_id='$id' && mem_phone='$phone' "))>0){
        $Err = "<span class=\"color:gray;font-family:monospace;\">UNAVAILABLE</span>";
        echo $Err;
       // exit();
    }else {

    $sql = "SELECT * FROM mpc_loan_member WHERE mem_id=? && mem_phone=? ORDER BY loan_id DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "ERROR";
        echo $Err;
        exit();
    }else{

    mysqli_stmt_bind_param($stmt, 'ss', $id, $phone);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    if($data['loan_status'] == 0){
        $id = $data['loan_id'];
        $url = __mpc_root__() ."dashboard.php/?action=loan&lId={$id}&key=Pending";
        $Err = "<span style=\"color:red;\"><a style=\"color:inherit;text-decoration:none;\"href=\"$url\">Pending</a></span>";
        echo $data['total_amount_to_repay'] .' ' .$Err;

    }else if($data['loan_status'] == 1){

        $id = $data['loan_id'];
        $url = __mpc_root__() ."dashboard.php/?action=loan&lId={$id}&key=Running";
        $Err = "<span style=\"color:green;\"><a style=\"color:inherit;text-decoration:none;\"href=\"$url\">Runing</a></span>";
        echo $data['total_amount_to_repay'] .' ' .$Err;

    }else if($data['loan_status'] == 3){

        $id = $data['loan_id'];
        $url = __mpc_root__() ."dashboard.php/?action=loan&lId={$id}&key=Complete";
        $Err = "<span style=\"color:grey;\"><a style=\"color:inherit;text-decoration:none;\"href=\"$url\">Complete</a></span>";
        echo $data['total_amount_to_repay'] .' ' .$Err;

    }else if($data['loan_status'] == 2){
        $id = $data['loan_id'];
        $url = __mpc_root__() ."dashboard.php/?action=loan&lId={$id}&key=Not approved";
        $Err = "<span style=\"color:red;\"><a style=\"color:inherit;text-decoration:none;\"href=\"$url\">Not Approved</a></span>";
        echo $data['total_amount_to_repay'] .' ' .$Err;
    }

}
}

}


//function to check if admin has created any loan for member
function __mpc_member_singleLoanInfo($conn, $id, $phone) {

    require_once 'mpc-func.php';

    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_loan_member WHERE mem_id='$id' && mem_phone='$phone' "))>0){
        $Err = "<caption class=\"color:gray;font-family:monospace;\">LOAN UNAVAILABLE</caption>";
        echo $Err;
        //exit();
    }else {



    $sql = "SELECT * FROM mpc_loan_member WHERE mem_id=? && mem_phone=? ORDER BY loan_id DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "ERROR";
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ss', $id, $phone);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    ?>
    <tr>
        <td>Name:</td>
        <td><?php echo $data['mem_phone']?></td>
    </tr>

    <tr>
        <td>Interest type:</td>
        <td><?php echo $data['interest_rate_type']?></td>
    </tr>

    <tr>
        <td>Monthly Repay.:</td>
        <td>&#8358;<?php echo $data['monthly_payment']?></td>
    </tr>
    <tr>
        <td>Loan last:</td>
        <td><?php echo $data['total_running_month']?></td>
    </tr>
    <tr>
        <td>Month paid:</td>
        <td><?php echo $data['total_month_paid']?></td>
    </tr>
    <tr>
        <td>Month Remaining:</td>
        <td><?php echo $data['total_month_remaining']?></td>
    </tr>
    <tr>
        <td>Date:</td>
        <td><?php echo $data['date']?></td>
    </tr>
    <tr>
        <td>M. Remaining:</td>
        <td><?php echo $data['total_month_remaining']?></td>
    </tr>
    <tr>
        <td>TOTAL:</td>
        <td>&#8358;<?php echo $data['total_amount_to_repay']?></td>
    </tr>
    <tr>
        <td>LOAN STATUS:</td>
        <td><?php echo $data['loan_status']?></td>
    </tr>
    <?php
    }

}

//LOAN STATUS CHECK
function __loanStatus($statuskey){
    if($statuskey == 0){
        echo "<i style=\"color:red;font-weight:600;\">PENDING</i>";
    }else if($statuskey == 1){
        echo "<i style=\"color:green;font-weight:600;\">ACTIVE</i>";
    }else if($statuskey == 2){
        echo "<i style=\"color:red;font-weight:600;\">NOT APPROVED</i>";
    }else if($statuskey == 3){
        echo "<i style=\"color:gray;font-weight:600;\">COMPLETED<i class=\"fas fa-check\"></i></i>";
    }
}

//function to load group loan
function __mpc_sendGroupLoan__($conn, $group){

if($group != 'Pending'){
	//echo "<h4>Group Name: ".$group . "</h4>";
    $sql = "SELECT * FROM mpc_group_loan_request WHERE member_group_name='$group' ";
    $qury = mysqli_query($conn, $sql);

    if(! mysqli_num_rows($qury) >0){
        echo "<caption>GROUP LOAN UNAVAILABLE NOW</caption>";
        return;
    }
    $col1 = 'member_phone';
    $whereToCount = 'group'; //function sum parameter =(group)
    //amount paid data start here
    $groupName = $group; //group get here by name
    $ColumntoDoCount = 'amount_paid'; //amount this group paid
    $tblId = 'member_id'; //db members id
    $tblColumn = 'member_group_name'; //table column
    $tbl = 'mpc_group_loan_repayment'; //db table name
    //amount paid data stop here
    $TotalAmountPaidByGroup = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $tblId, $tblColumn, $tbl);
    if($TotalAmountPaidByGroup === '' || $TotalAmountPaidByGroup === null){
        $TotalAmountPaidByGroup = 0;
    }
//information for total repayment plus all emeber penalty
    $tb = 'mpc_group_loan_request';
    $tbId = 'group_loan_id'; //member tbl id
    $ColumnCounting = 'total_amount_to_repay'; //amount this group paid
    //$tblId = 'group_loan_id'; //db members id
    $tblColumn = 'member_group_name'; //table column
    $tbl = 'mpc_group_loan_request'; //db table name

    //$mygroupid = __mpc_group_InfoByname($conn, $groupName)[0];
    $penaltyBygroup = __sumTotalPenalty__($conn, $groupName, __mpc_group_InfoByname($conn, $group)[0], 'group'); // total penalty charge this group


    $TotalAmountBorrowedByGroup = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumnCounting, $tbId, $tblColumn, $tb) + $penaltyBygroup;


    while ($data = mysqli_fetch_array($qury)) {
        $name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4];
        $img = __mpcReturnByPhoneMember($conn, $data['member_phone'])[18];


        ?>
        <tr>
            <td><?php echo $data['group_loan_id']?></td>
            <td><?php echo $name?></td>
            <td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" alt="pics" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" class="dboard-img"></td>
            <td class="amountBorrowed">&#8358;<?php echo $data['amount_requested']?></td>
            <td class="amountRepay">&#8358;<?php echo $data['member_m_repay']?></td>
            <td class="weeklyR">&#8358;<?php echo $data['member_m_repay'] / 4?></td>
            <td class="penalty">&#8358;<?php echo $data['penalty']?></td>
            <td class="status"><?php echo __loanStatus($data['status'])?></td>
        </tr>

<script>
    var monthlyRepayment = document.querySelectorAll('.amountBorrowed');

for (let i = 0; i < monthlyRepayment.length; i++) {
    let element, payment, items;
        element = monthlyRepayment[i].innerText;

        payment = element.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        items = document.querySelectorAll('.amountBorrowed')[i].innerHTML = payment

    //element.innerHTML = 'manful';
}

var mRepay = document.querySelectorAll('.amountRepay');

for (let i = 0; i < mRepay.length; i++) {
    let element, payment, items;
        element = mRepay[i].innerText;

        payment = element.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        items = document.querySelectorAll('.amountRepay')[i].innerHTML = payment

    //element.innerHTML = 'manful';
}


var wRepay = document.querySelectorAll('.weeklyR');
for (let i = 0; i < wRepay.length; i++) {
    let element, payment, items;
        element = wRepay[i].innerText;

        payment = element.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        items = document.querySelectorAll('.weeklyR')[i].innerHTML = payment

    //element.innerHTML = 'manful';
}

var wpenalty = document.querySelectorAll('.penalty');
for (let i = 0; i < wpenalty.length; i++) {
    let element, payment, items;
        element = wpenalty[i].innerText;

        payment = element.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        items = document.querySelectorAll('.penalty')[i].innerHTML = payment

    //element.innerHTML = 'manful';
}
</script>
        <?php
    }
    ?>
        <caption>Your group Paid: &#8358; <b><span class="amount-mpc-Paid test"><?php echo $TotalAmountPaidByGroup?></span></b> of &#8358; <b><span class="amount-mpc-Paid"><?php echo $TotalAmountBorrowedByGroup?></span></b></caption>
    <?php
}else {
    echo "<caption style=\"text-align:center;\">CURRENTLY YOU HAVE NOT BEEN ASSIGNED TO ANY GROUP, CONTACT ADMIN</caption>";

}

}


//check if member has an online loan request
function __myLoanRequest($conn, $uid, $phone){
    $sql = "SELECT COUNT(*) AS ID FROM mpc_loan_request_online WHERE uid='$uid' && uid_ph='$phone'";
    $stmt = $conn->query($sql);

    $data = $stmt->fetch_assoc();
    
    return $data['ID'];
}
