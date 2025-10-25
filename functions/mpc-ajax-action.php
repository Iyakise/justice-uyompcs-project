<?php

    if(isset($_GET['ajaxAction']) && !empty($_GET['ajaxAction'])) {
        //get all database connection
        define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
        define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

            /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
        require_once dirname(__DIR__) ."/config/conn.php";
        require_once dirname(__DIR__) ."/functions/mpc-func.php";

         if($_GET['ajaxAction'] == 'lastLogin'){

            $sql = "SELECT * FROM mpc_last_login ORDER BY last_login_id  DESC LIMIT 50";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                $Err = "Get login record fail, unexpectedly contact developer for help.";
                echo $Err.mysqli_error($conn);
                exit();
            }else {
                mysqli_stmt_execute($stmt);
                $d = mysqli_stmt_get_result($stmt);

                ?>

                <tr >
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">#</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">FirstName</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">LastNamed</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">User type</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">Action</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">Time</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">Date</th>
                    <th style="color:rgb(226, 145, 24);font-family:monospace;font-weight:normal">Profile</th>
                </tr>
            <?php

                while ($data = mysqli_fetch_array($d)) {


                $tbl = $data['users_from']; //where is this user comming from
                $idlastId = $data['user_id']; //last user id

                if($data['users_from'] == 'mpc_members'){
                    $q = 'name, user_profile';
                    $columnId = 'members_id';
                    $name1 = 'title';
                    $name2 = 'name';

                }else if($data['users_from'] == 'mpc_user') {

                    $q = 'user_fname, user_lname';
                    $columnId = 'user_id';
                    $name1 = 'user_fname';
                    $name2 = 'user_lname';

                }

                $q = mysqli_query($conn, "SELECT * FROM $tbl WHERE $columnId='$idlastId'");
                $n = mysqli_fetch_assoc($q);

              /*  if($data['users_type'] == 1){
                    $userType = 'super Admin';
                }else if($data['users_type'] == 2){
                    $userType = 'Admin';
                }else if($data['users_type'] == 3){
                    $userType = 'Editor';
                }else {
                    $userType = 'Member';
                }
                */
                $userType = __Adm__($data['users_type']);

                $imgUrl =  __mpc_root__() .'asset/img/'.  $n['user_profile'];
                ?>
                    <tr>
                        <td class="userById"><?php print $data['user_id']?></td>
                        <td><?php print $n[$name1]?></td>
                        <td><?php print $n[$name2]?></td>
                        <td><?php print $userType?></td>
                        <td><?php print $data['type']?></td>
                        <td><?php print $data['last_login_time']?></td>
                        <td><?php print $data['last_login_date']?></td>
                        <td><img src="<?php echo $imgUrl?>" srcset="<?php echo $imgUrl ?>" alt="user profile" title="<?php echo $n[$name1] .' '. $n[$name2]?> profile picture" class="shadow dboard-img"></td>
                    </tr>
                <?php
                }
            }
         }
    }



if(isset($_FILES['uploadPic']) && $_FILES['uploadPic'] !== ''){
    session_start();
    $userId = $_SESSION['MPC_ADMIN_LOGIN_ID_AS'];
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
    $tbl = 'mpc_user'; //TBLE
    $uid = 'user_id'; //USER ID

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
        if($pf === 'avatar.png') {
            //change profile picture to new one
            $upd = "UPDATE $tbl SET user_profile='$fileNewName' WHERE $uid='$userId'";
            if(mysqli_query($conn, $upd)) {
                //upload file now to directory specified
                if(move_uploaded_file($tmploc, $uploadPath.$fileNewName)){

                    //return the file name has json object to admin
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

//admin live query using different params

if(isset($_GET['qparam']) && !empty($_GET['qparam'] && $_GET['qparam'] == 'MpcMrAkpasam' && $_GET['dev'] == 'IyakiseR')){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $q = $_GET['Q'];
    $param = $_GET['Param'];

    $sql = "SELECT * FROM mpc_members WHERE $param  LIKE '%$q%'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error just happen while executing your query!";
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err;
        exit();
    }

    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    while ($data = mysqli_fetch_array($d)) {
        ?>

        <tr>
            <td><?php print $data['members_id']?></td>
            <td class="CreateLoanColor creatforThisMember" id="creatforThisMember" mpc-borrower="<?php print $data['name']?>" borrower-phone="<?php print $data['phone']?>" borrower-branch="<?php print $data['branch']?>" borrower-id="<?php print $data['members_id']?>" borrower-group="<?php print $data['groups']?>" title="CLICK TO CREATE LOAN FOR <?php print $data['name']?>">
                <span class="uid"><?php print $data['name']?> </span>
            </td>
            <td><?php print $data['phone']?></td>
            <td><?php print $data['religion']?></td>
            <td><?php print $data['occupation']?></td>
            <td><?php print $data['registration_number']?></td>
            <td><?php print $data['groups']?></td>
            <td><img src="<?php print __mpc_root__(). 'asset/img/'. $data['user_profile']?>" srcset="<?php print __mpc_root__(). 'asset/img/'. $data['user_profile']?>" title="<?php print $data['name']?>'s profile" alt="members profile" class="dboard-img"></td>

        </tr>

        <?php
    }
}

//create branch start here
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'YAKIseRAphael') {
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $brnName = $_POST['brn'];
    $location = $_POST['brnLocation'];
    $bmg = 'not assigned';
    $scheck = "SELECT * FROM mpc_branches WHERE branch_name='$brnName' && branch_location='$location'";
    if(mysqli_num_rows(mysqli_query($conn, $scheck))>0){
        $Err = 'THIS BRANCH ALREADY EXISTED';
        echo $Err;
        exit();
    }else{
    $sql = "INSERT INTO mpc_branches (branch_name, branch_location, branch_manager, credit_officer)VALUES(?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "UNEXPECTED ERROR WHILE TRYING TO CREATE BRANCH, PLEASE CONTACT DEVELOPER FOR HELP.";
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssss', $brnName, $location, $bmg, $bmg);
    if(mysqli_stmt_execute($stmt)){
        $Err = 'success';
        echo $Err;
        exit();
    }
}
}

//action to create mpc group
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'dataGroup'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $grpName = $_POST['grpName'];
    $grBranch = $_POST['groupBranch'];
    $nameId   = $_POST['adminId'];
    $v = 'not assigned';

    //try to configure date
    $tzne = date_default_timezone_set('Africa/Lagos');
    $dtime = date('d/n/Y, g:i:s a');

    if(mysqli_num_rows(mysqli_query($conn, "SELECT group_name, group_branch FROM mpc_available_group WHERE group_name='$grpName' && group_branch='$grBranch'"))>0){
        $Err = 'Sorry, group already existed in your branch';
        echo $Err;
        exit();
    }

    $sql = "INSERT INTO mpc_available_group (group_name, group_leader, group_branch, time_date, group_created_by, group_secretary)VALUES(?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected Error while processing your request';
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ssssss', $grpName, $v, $grBranch, $dtime, $nameId, $v);
    if(mysqli_stmt_execute($stmt)){
        $Err = "Group create successful, reload window to see result.";
        echo $Err;
        exit();
    }
}


//admin security quest verify here
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'SQcheCK' && !empty($_POST['SQans']) && !empty($_POST['dataType'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

     $sqanswer = $_POST['SQans']; //security answer, security answer to check and verify
     $datatype = $_POST['dataType']; //data type, what type of data is being deleted
     $actionId = $_POST['actionId']; //action id, table id that item will be deleted
     $adminId = $_POST['adminId']; //admin id, real admin id


     //get admin security answer and let confirm if what admin is tell us is a matched
     $adminSecurityAnswer = __mpcReturnByIdAll__($conn, $adminId)[7]; //admin security answer is here
   //
    if(!password_verify($sqanswer, $adminSecurityAnswer)) {
        $Err = "Security answer error, please verify and try again!"; //here it means admin securityanswer is wrong
        echo $Err;
        exit();
    }else {
        //echo "SECURITY ANSWER MATCH!";
        //echo __mpcReturnByIdAll__($conn, $adminId)[0];
        //$sql = "";
        //trying to check if it real a real admin that is trying to delete or carry out any action here
        //because at default on super admin that the system will assigned to will allowd to delete user, group and other stuff etc
        if($adminId != __mpcReturnByIdAll__($conn, $adminId)[0]){

            $newAdmin = __mpcReturnByIdAll__($conn, $adminId)[1] .' ' .__mpcReturnByIdAll__($conn, $adminId)[2]; //user access this file to here, this will have the person firstname and lastname
            $Err = "Security Answer matched!, $newAdmin, you are not allowed carried out this request, you have a limited priviledge.";
            echo $Err;
            exit();

        }

        $dataId = $actionId;

        //let's check if admin here want to delete his/her self
        if($datatype === 'user' && __mpcReturnByIdAll__($conn, $adminId)[0] == $actionId){ //AM TRYING TO CHECK IF SUPER ADMIN WANT TO DELETE HIS/HER SELF
            //
            $newAdmin = __mpcReturnByIdAll__($conn, $adminId)[1] .' ' .__mpcReturnByIdAll__($conn, $adminId)[2]; //user access this file to here, this will have the person firstname and lastname
            $Err = "Sorry, you cannot delete yourself, $newAdmin";
            echo $Err;
            exit();
        }

        if($datatype == 'group'){

            $updateReplace = 'Not assigned';
            $groupId = 'group_id';
            $tbl = 'mpc_available_group';
            $grpname = 'group_name';
            $tblCol = 'groups';
            $tbl1 = 'mpc_members';
            $whateIsAdminDoingHere = 'group'; //what is admin trying to do here
        /**thsi variable below will store the groupname about to delete */
            $groupName = __mpc_small_mini__($conn, 'column', $actionId, $grpname, $groupId, $tbl)['group_name']; //group name
            $groupDelId = __mpc_small_mini__($conn, 'column', $actionId, $groupId, $groupId, $tbl)[$groupId]; //group name

            if(is_int(__mpc_update__($conn, $groupName, $tbl1, $tblCol, $updateReplace)) && __mpc_update__($conn, $groupName, $tbl1, $tblCol, $updateReplace) == 1){


                __mpc_delete_data__($conn, $tbl, $dataId, $groupId, $groupName, 'Group');
                /**DATA IS SUCCESSFULLY DELETED FROM HERE */

                __mpcdocumented($conn, $groupDelId, $datatype, $adminId); //record what has been deleted
            }else {
                //try to delet admin data at once
                __mpc_delete_data__($conn, $tbl, $dataId, $groupId, $groupName, 'group');
                /**DATA IS SUCCESSFULLY DELETED FROM HERE */
                __mpcdocumented($conn, $groupDelId, $datatype, $adminId); //record what has been deleted
            }

        }else if($datatype == 'user'){
            $updateReplace = 'not assigned';
            $groupId = 'group_id';
            $tbl = 'mpc_branches';
            $grpname = 'group_name';
            $tblCol = 'branch_manager';
            $tbl1 = 'mpc_members';
            $whateIsAdminDoingHere = 'group'; //what is admin trying to do here
        /**thsi variable below will store the groupname about to delete */
           // $groupName = __mpc_small_mini__($conn, 'column', $actionId, $grpname, $groupId, $tbl)['group_name']; //group name
           // $groupDelId = __mpc_small_mini__($conn, 'column', $actionId, $groupId, $groupId, $tbl)[$groupId]; //group name

           $phoneAdmin = __mpcReturnByIdAll__($conn, $actionId)[0]; //admin id/phone/and data

           __mpc_update__($conn, $phoneAdmin, $tbl, $tblCol, $updateReplace); //update any matched data found if this user was assigned as branch managet
           __mpc_update__($conn, $phoneAdmin, $tbl, 'credit_officer', $updateReplace); //update any matched record found credit officer

            __mpc_delete_data__($conn, 'mpc_user', $dataId, 'user_id', 'User', 'STAFF'); //this line will delete user out completly

        }else if($datatype == 'member'){
            $updateReplace = 'not assigned';
            $groupId = 'group_leader';
            $tbl = 'mpc_available_group';
            $grpname = 'group_name';

            $tblCol = 'members_id';
            $tbl1 = 'mpc_members';
            $whateIsAdminDoingHere = 'group';
            $dataName = "Member";

            //$groupName = __mpc_small_mini__($conn, 'column', $actionId, $grpname, $groupId, $tbl)['group_name']; //group name
            //$groupDelId = __mpc_small_mini__($conn, 'column', $actionId, $groupId, $groupId, $tbl)[$groupId]; //group name

           // __mpc_update__($conn, $dataId, $data, $tbl, $tblCol, $updateReplace); //update any available user that was assign to this group
           __mpc_delete_data__($conn, $tbl1, $actionId, $tblCol, $dataName, 'mpc_members');

        }else if($datatype == 'branch'){
            $updateReplace = 'not assigned';
            $groupId = 'group_leader';
            $tbl = 'mpc_members';
            $grpname = 'group_name';

            $tblCol = 'branch';
            $bid = 'branch_id';
            $whateIsAdminDoingHere = 'group';
            $dataName = "Branch";

            $BranchByName = __mpc_small_mini__($conn, 'column', $actionId, 'branch_name', $bid, 'mpc_branches')['branch_name']; //BRANCH BY NAME

            if(__mpc_update__($conn, $BranchByName , $tbl, $tblCol, $updateReplace) == 1){
                //WHEN SUCCESSFULLY UPDATE THEN DO THIS
                __mpc_delete_data__($conn, 'mpc_branches', $actionId, $bid, $dataName, 'mpc_branches');
            }


        }

        //echo "welcome we are okay";
       // __mpc_update__($conn, $dataId, $data, $tbl, $tblCol, $updateReplace); //update any available user that was assign to this group


    }


}

//create user new
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == '@YAKISEETIM'){

    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $usr = $_POST['usr'];
    $pwd = $_POST['pwd'];
    $brn = $_POST['branch'];
    $prev = $_POST['prev'];
    $profile = 'avatar.png';
    $pending = 'Pending';

    //protect user pwd
    $pwdH = password_hash($pwd, PASSWORD_DEFAULT);
    //we are checking if user with this name username branch existed already
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_user WHERE user_fname='$fn' && user_lname='$ln' && user_username='$usr' && branch='$brn'")) >0){
        $Err = "Error, Duplicate user found!";
        echo $Err;
        exit();
    }
    $sql = "INSERT INTO mpc_user (user_fname, user_lname, user_username, user_pwd, user_previllege, user_profile, user_security_q, user_security_a, branch)VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error while trying to save user data";
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssssss", $fn, $ln, $usr, $pwdH, $prev, $profile, $pending, $pending, $brn);

    if(mysqli_stmt_execute($stmt)){
        $Err = 'success';
        echo $Err;
        exit();
    }

}

//TRYING TO ADD NEW MEMBER BY ADMIN HERE
//LLOAN COOPERATIVE MEMBERS
if(isset($_POST['mpcMemberAdd']) && !empty($_POST['mpcMemberAdd']) /*&& $_POST['PERM'] === 'mpcMemberAdd'*/){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $txone = date_default_timezone_set('Africa/Lagos');
    $dte = date('d/n/Y, g:i:s a');

    $data = json_decode($_POST['mpcMemberAdd'], false);

    // print_r($data);
    // exit();

    $name = $data->memName;
    $ctAddr = $data->ctAddr;
    $accNo = $data->AccNo;
    $phone = $data->phone;
    $pwd = $data->pwd;
    $branch = $data->branch;
    $presentMda = $data->presentMda;
    $poolingMda = $data->poolingMda;
    // new lines of code start here
    $gender = $data->gender;
    $dob = $data->dob;
    $gRank = $data->gRank;
    $dAppointment = $data->dAppointment;
    $dRetirment = $data->dRetirment;
    $MaritalStatus = $data->MaritalStatus;

    $NextOfkin = $data->NextOfkin;
    $relationship = $data->relationship;
    $nextOfkinAddr = $data->nextOfkinAddr;

   // $group = $_POST['group'];

    $group = 'UNAVAILABLE';
    $newPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $v = 'pending';
    $v1 = 0;
    $profile = 'avartar1.png';

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE phone='$phone' && name='$name' "))>0){
        $Err = "Error, duplicate member, member with this name and phone number already exist.!";
        echo $Err;
        exit();
    }
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE phone='$phone' "))>0){
        $Err = "Error, duplicate Phone, member with this phone number already exist.!";
        echo $Err;
        exit();
    }
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE registration_number='$accNo' "))>0){
        $Err = "Error, duplicate Staff ID NO., Member with this ID ($accNo) already exist.!";
        echo $Err;
        exit();
    }

    /**
     * JUSTICE UYO MPCS COLUMNS NAMES THAT STORE DIFFERENT DATA NOW
     * AFTER NEW UPDATE
     * permanent_addr => NOW [STORES POOLING MDA]
     * COLUMN lga => NOW STORES [PRESENT MDA/DEPARTMENT]
     * place_of_birth => NOW STORES [RANK/GRADE LEVEL];
     * 
     * 
     */
    $sql = "INSERT INTO mpc_members (
            title, sex, date_of_birth, name, contact_addr, 
            permanent_addr, phone, lga, place_of_birth, 
            religion, email, occupation, business_addr, 
            church, any_coop, coop_name, mem_pwd, 
            declaration, registration_number, groups, 
            registration_date, status, v_ph, v_em, 
            user_profile, branch)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $declaration = "I $name, hereby declare that the above personal information os true and correct. I do promise to abide by the Rules and Regulations/Bye-laws governing the Cooperative Society.";


    //INIT SQL CONNECTION
    $stmt = mysqli_stmt_init($conn);
    //check for possible connection error
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error while trying to save members info, contact developer for help";
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss", 
                                    $v, $gender, $dob, $name, $ctAddr, $poolingMda, $phone, 
                                    $presentMda, $gRank, $dAppointment, $v, $dRetirment, $MaritalStatus, $v, $v, $v, 
                                    $newPwd, $declaration, $accNo, $group, $dte, 
                                    $v1, $v1, $v1, $profile, $branch);
   
    if(mysqli_stmt_execute($stmt)){
        $lastId = mysqli_stmt_insert_id($stmt);

//next of kin processor start here
        $nextOf = "INSERT INTO mpc_next_of_kin (next_of_kin_for_phone, next_of_kin_for_id, next_kin_name, next_kin_relationship, next_kin_addre, next_kin_phone)VALUES('$phone', '$lastId', '$NextOfkin', '$relationship', '$nextOfkinAddr', '$group')";
        $conn->query($nextOf); //processing next of kin information here

        __mpc_memp_misc__($conn, 'mpc_account_shares', '', ['shares_member_id', 'shares_member_phone', 'credit', 'debit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, $dte]);
        __mpc_memp_misc__($conn, 'mpc_welfare_contribution', '', ['welfare_mem_id', 'welfare_mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, $dte]);
        __mpc_memp_misc__($conn, 'mpc_thrift_saving', '', ['thrift_mem_id', 'thrift_mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, $dte]);
        __mpc_memp_misc__($conn, 'mpc_special_saving', '', ['mem_id', 'mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, $dte]);
        __mpc_memp_misc__($conn, 'mpc_fixed_deposit', '', ['fixed_mem_id', 'fixed_mem_phone', 'debit', 'credit', 'balance', 'date_time'], [$lastId, $phone, 0, 0, 0, $dte]);
       // __mpc_memp_misc__($conn, 'mpc_account_shares', '', ['shares_member_id', 'shares_member_phone', 'credit', 'debit', 'balance'], [$lastId, $phone, 0, 0, 0]);
      //  __mpc_memp_misc__($conn, 'mpc_account_shares', '', ['shares_member_id', 'shares_member_phone', 'credit', 'debit', 'balance'], [$lastId, $phone, 0, 0, 0]);

      /**MEMBERS ACCOUNT VERIFICATION STATUS START HERE */
        $sql2 = "INSERT INTO mpc_member_verification (verify_for, verify_for_phone, verify_phone, verify_email, verify_status, verify_bank_account, verify_quarantor)VALUES('$lastId', '$phone', '1', '0', '0', '0', '0')";
        mysqli_query($conn, $sql2);
        $Err = "successful";
        echo $Err;
        exit();
    }
}

if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] == 'myYakiseMYmpc' && !empty($_GET['q'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $q = $_GET['q']; //actual search query from admin

    $sql = "SELECT * FROM mpc_members WHERE name LIKE '%$q%' || phone LIKE '%$q%' || registration_number LIKE'%$q%'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error, while conducting search on members table, contact developer for help";
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err.mysqli_error($conn);
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
?>
<table class="table table-bordered border-dark">
    <tr>
        <td>#</td>
        <td>Title </td>
        <td>Name </td>
        <td>Contact Address</td>
        <td>Phone </td>
        <td>Group </td>
        <td>Branch </td>
        <td>Account No.</td>
        <td>Profile</td>
        <td>status</td>
    </tr>


<?php

    while ($data = mysqli_fetch_array($d)) {
       // ['members_id', 'title', 'name', 'contact_addr', 'phone', 'groups', 'branch', 'registration_number', 'user_profile', 'status', ''];
    $col1 = 'members_id';
	$col2 = 'title';
	$col3 = 'name';
	$col4 = 'contact_addr';
	$col5 = 'phone';
	$col6 = 'groups';
	$col7 = 'branch';
	$col8 = 'registration_number';
	$col9 = 'user_profile';
	$col10 = 'status';
	//collect data here

        if($data[$col9] == 0){
			$status = "<i class=\"fas fa-user-times\" title=\"Account not Activated\"></i> Not activated";
		}else {
			$status = "<i class=\"fas fa-user-check\" title=\"Account Activated\"></i> Activated";
			//3057319887
		}
		?>
		<tr>
			<td>
				<?php echo $data[$col1]?>
				<a href="<?php echo __mpc_root__()?>dashboard.php/?action=verifyAction&actionId=<?php echo $data[$col1]?>&t=member&r1=Settings&r2=createMember" class="rmv-item" target="_blank" rel="noopener noreferrer">
					<i class="fa-trash-alt fas "></i>
				</a>
			</td>
			<td><?php echo $data[$col2]?></td>
			<td><?php echo $data[$col3]?></td>
			<td><?php echo $data[$col4]?></td>
			<td><?php echo $data[$col5]?></td>
			<td><?php echo $data[$col6]?></td>
			<td><?php echo $data[$col7]?></td>
			<td><?php echo $data[$col8]?></td>
			<td><img src="<?php echo __mpc_root__().'asset/img/'. $data[$col9]?>" alt="member pics" srcset="<?php echo __mpc_root__().'asset/img/'. $data[$col9]?>" class="dboard-img"></td>
			<td class="member-status"><?php echo $status?></td>
		</tr>
    <?php
    }
    echo "</table>";

}

//LISTEN TO WHEN ADMIN WANT TO SET BRANCH & CREDIT OFFICEERS
if(isset($_GET['PERM']) && $_GET['PERM'] == 'AssignbMG' && !empty($_GET['PERM']) && !empty($_GET['x1'])) {
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

      $branchManager = $_GET['x1'];
      $creditOfficer = $_GET['x2'];
      $tblId = $_GET['tblId'];



     $sql = "UPDATE mpc_branches SET branch_manager=?, credit_officer=? WHERE branch_id=?";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'System encounter some error while processing your request, please contact developer for help';
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo $Err;
        exit();
     }
     mysqli_stmt_bind_param($stmt, "sss", $branchManager, $creditOfficer, $tblId);
     if(mysqli_stmt_execute($stmt)) {
        $Err = 'Update Successfull';
        echo $Err;
        exit();
     }

}

//mpc admin notification
//check if the is any notification
if(isset($_GET['qry']) && $_GET['qry'] == 'CheckAvailNotify' && !empty($_GET['qry'])) {
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $q = $_GET['prev'];
    $adminId = $_GET['admId'];
    $AminUsername = __mpcReturnByIdAll__($conn, $adminId)[3];
    $type = 5;
    $status = 0;

//|| notification_for='$Amin_username' && notification_for_id='$adminId'

    if($q == 1 || $q == 4){
        $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification  WHERE status='$status' || notification_for='$AminUsername' && notification_for_id='$adminId' && type='$type'";

    }else if($q == 2 || $q == 3 || $q == 5){
        $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification  WHERE notification_for='$AminUsername' && notification_for_id='$adminId' && views='0'";
    }

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'count error';
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    echo $data['notification_id'];


}

if(isset($_POST['PERM']) && $_POST['PERM'] == 'MPCmemASKPERM' && !empty($_POST['Query'])){

    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

   $accNo = $_POST['Query'];
    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE registration_number='$accNo'")) >0) {

        $Err = "Account not found!";
        echo $Err;
        mysqli_close($conn); // closing database connection here
        exit();
    }
   $sql = "SELECT * FROM mpc_members WHERE registration_number=?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)) {
        $Err = "ERROR 500";
        echo $Err;
        exit();
   }

   mysqli_stmt_bind_param($stmt, 's', $accNo);
   mysqli_stmt_execute($stmt);
   $d = mysqli_stmt_get_result($stmt);
   $data = mysqli_fetch_array($d);

   $uid = $data['members_id'];
   $uphone = $data['phone'];
  // echo ;
   echo "<i class=\"rtnAccountName\" memid=\"$uid\" memPh=\"$uphone\" style=\"display:block;\">". $data['name'] ."</i>";

   mysqli_stmt_close($stmt); //close out prepared statment
   mysqli_close($conn); //close mysql connection;
}

//set intresst start below
if(isset($_POST['PERMI']) && !empty($_POST['PERMI']) && $_POST['PERMI'] === 'PLEASEsetRate'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $RateType = $_POST['rateType'];
    $RateValue = $_POST['rateValue'];

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_intrest_rate WHERE intrest_for='$RateType'")) >0){

        $Err = "Error, duplicate found, you have already create this \" $RateType \", please try updating...";
        echo $Err;
        exit();
    }

    $sql = "INSERT INTO mpc_intrest_rate (intrest_for, intrest_value)VALUES(?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected error";
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ss', $RateType, $RateValue);
    if(mysqli_stmt_execute($stmt)){
        $Err = 'Intrest rateSaved';
        echo $Err;
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }

}

///frequently asked question
if(isset($_POST['PERMITED']) && $_POST['PERMITED'] == 'DOUbleFaqS' && $_POST['PERMITED'] !== ''){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

     $title = $_POST['title']; //faqs title
     $content = $_POST['Content']; //faqs content

     if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_faqs WHERE faqs_title='$title'")) >0){
        $Err = 'ERROR, duplicate FAQS already exist!';
        echo $Err;
        exit();
     }
     $sql = "INSERT INTO mpc_faqs (faqs_title, faqs_contents)VALUES('$title', '$content')";
     if(mysqli_query($conn, $sql)){
        $Err = 'FAQS SAVED';
        echo $Err;
        exit();
     }

}

//function mpc admin get member by account
if(isset($_GET['xkey']) && !empty($_GET['xkey']) && $_GET['xkey'] === 'MPCsyAKISE'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";


    $accNo = $_GET['query'];
    if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE registration_number='$accNo'")) >0) {

        $Err = "Account not found!";
        $arr = ['Name'=> $Err];
        echo json_encode($arr);
        mysqli_close($conn); // closing database connection here
        exit();
    }

        $sql = "SELECT * FROM mpc_members WHERE registration_number=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
                $Err = "ERROR 500";
                $arr = ['Name'=> $Err];
                echo json_encode($arr);
                exit();
        }

        mysqli_stmt_bind_param($stmt, 's', $accNo);
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_array($d);

        $uid = $data['members_id'];
        $uphone = $data['phone'];
        // echo ;
        $arr = ['uid' => $data['members_id'], 'Name'=> $data['name'], 'Phone' => $data['phone']];
        echo json_encode($arr);

   mysqli_stmt_close($stmt); //close out prepared statment
   mysqli_close($conn); //close mysql connection;

}

//send and credit member account
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'aDDcREditTomember@mpcs'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $accNo = $_POST['Acctno'];
    $Acctype = $_POST['AcctType'];
    $DepositorName = $_POST['depositorName'];
    $DepositorPhone = $_POST['depositorPhone'];
    $AdminOrcashCollector = $_POST['adminId'];
    $ReceiverId = $_POST['mpcReceiverId'];
    $ReceiverPhone = $_POST['mpcReceiverPhone'];
    $DepositAmount = $_POST['Amount'];

    $tzne = date_default_timezone_set('Africa/Lagos');
    $dtime = date('d/n/Y, g:i:s a');
    $referenceCode = 'MPCS-'.time();

    $ReceiverByName = __mpcReturnByPhoneMember($conn, $ReceiverPhone)[4];
    $ReceiverAcctNo = __mpcReturnByPhoneMember($conn, $ReceiverPhone)[10];

    $transactionTypeSender = 'Debit';
    $notificationStatus = 0;//it means no body has ready or seen it before, it a new notification;
    $notificationSender = getSystemName($conn)[1];
    $depositPlatform = 'Counter Deposit';
    $debit = 0;

        if($Acctype == 'SHARES'){
        $tbl = "mpc_account_shares";
        $tblCol1 = 'shares_member_id'; //col1
        $tblCol2 = 'shares_member_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $ReceiverAcctTypeByName = 'Shares contribution';
        $incr = 'shares_id';

    }/*else if($Acctype == 'FIXED'){
        $tbl = "mpc_fixed_deposit";
        $tblCol1 = 'fixed_mem_id'; //col1
        $tblCol2 = 'fixed_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $ReceiverAcctTypeByName = 'Fixed deposit';
    }*/else if($Acctype == 'SPECIAL'){
        $tbl = "mpc_special_saving";
        $tblCol1 = 'mem_id'; //col1
        $tblCol2 = 'mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $ReceiverAcctTypeByName = 'Special saving';
        $incr = 'special_id';
    }else if($Acctype == 'THRIFT'){
        $tbl = "mpc_thrift_saving";
        $tblCol1 = 'thrift_mem_id'; //col1
        $tblCol2 = 'thrift_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $ReceiverAcctTypeByName = 'Thrift saving';
        $incr = 'thrift_id';
    }/*else if($Acctype == 'WELFARE'){
        $tbl = "mpc_welfare_contribution";
        $tblCol1 = 'welfare_mem_id'; //col1
        $tblCol2 = 'welfare_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $ReceiverAcctTypeByName = 'Welfare contribution';
    }*/


     //trying to add existing or current receiver member balance to new transfer amount then return new balance

    $currentBalanceReceiverNewBal = __mpcMemberAccountBal__($conn, $tbl, $ReceiverId, $ReceiverPhone, $tblCol1, $tblCol2, $incr)[2] + $DepositAmount; //MEMBERS ACCOUNT BALANCE(CURRENT ACCOUNT BALANCE + NEW DEPOSIT AMOUNT)

     //echo __mpcMemberAccountBal__($conn, $Rtbl, $ReceiverId, $ReceiverPh, $tcol1,  $tcol2)[2];

/*FROM THIS PLACE BELOW
* WHAT I WILL DO,  I WILL CHECK IF MEMBER HAS ALEADY MADE ANY DEPOSIT
*ELSE UPDATE FIRST  0 0 0
*/
$debit = __mpcMemberAccountBal__($conn, $tbl, $ReceiverId, $ReceiverPhone, $tblCol1, $tblCol2, $incr)[0];
$credit = __mpcMemberAccountBal__($conn, $tbl, $ReceiverId, $ReceiverPhone, $tblCol1, $tblCol2, $incr)[1];
$balance = __mpcMemberAccountBal__($conn, $tbl, $ReceiverId, $ReceiverPhone, $tblCol1, $tblCol2, $incr)[2];
if($debit == 0 && $credit == 0 && $balance == 0){

    $sql = "UPDATE $tbl SET credit='$DepositAmount', balance='$currentBalanceReceiverNewBal' WHERE $tblCol1='$ReceiverId' && $tblCol2='$ReceiverPhone'";
}else {
    $sql = "INSERT INTO $tbl ($tblCol1, $tblCol2, $tblCol3, $tblCol4, $tblCol5, date_time)VALUES('$ReceiverId', '$ReceiverPhone', '$debit', '$DepositAmount', '$currentBalanceReceiverNewBal', '$dtime')";
}

     

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected Error, Contact developer Asap...";
        echo $Err;
        exit();
    }

  // mysqli_stmt_bind_param($stmt, 'ssssss',$ReceiverId, $ReceiverPhone, $debit, $DepositAmount, $currentBalanceReceiverNewBal, $dtime);
    if(mysqli_stmt_execute($stmt)){

        $sql = "INSERT INTO mpc_deposit_transaction (depositor, depositor_phone, depositor_for, deposit_casher, dep_platform, dep_reference, deposit_amount, time_date, account_number)VALUES('$DepositorName', '$DepositorPhone', '$ReceiverAcctTypeByName', '$AdminOrcashCollector', '$depositPlatform', '$referenceCode', '$DepositAmount', '$dtime', '$accNo')";
        
        mysqli_query($conn, $sql); ///let the system make record of all deposit

        //from here MEMBER SPECIFIC ACCOUNT HAS BEEN CREDITED WITH
        $companyName = getSystemName($conn)[1];
        //credit alert for receiver
        $notTxtReceiver = "<h1 class=\"text-center\">Credit Notification<h1>";
        $notTxtReceiver .= "<h4>$ReceiverByName, your account $ReceiverAcctNo as been credited with $DepositAmount, from $DepositorName.</h4>";
        $notTxtReceiver .= "<h4>Your $companyName $ReceiverAcctTypeByName account is credited with $DepositAmount on $dtime, balance: $currentBalanceReceiverNewBal.<h4>";
        $notType = '5';


    //__mpcMemberSmsAlertCredit($conn, $ReceiverPhone, $DepositAmount, $currentBalanceReceiverNewBal, $ReceiverAcctNo, $ReceiverAcctTypeByName, $DepositorName);//send sms credit alert to member
    //below is trying to notify receiver about new money and where it is coming from and sender name
    __mpc_notify__($conn, $notTxtReceiver, $notType, $ReceiverPhone, $ReceiverId, $notificationStatus, $notificationStatus, $notificationSender);
    __mpc_memberTransaction_makeRecords__($conn, 0, 0, $ReceiverId, $ReceiverPhone, $transactionTypeSender, $DepositAmount, 'Successful', 0); //transaction history record saved, or save to member transaction history list

        $Err = "Deposit Add";
        echo $Err;
        exit();

    }

}

//function that create loan for member
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] === 'LoanKEYpermPCs@Yakise'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    //try to configure date
    $tzne = date_default_timezone_set('Africa/Lagos');
    $date = date('d/n/Y');
    $time = date('g:i:s a');
    $loanMonth = date('F');
    $loanYear = date('Y');

     $borrowerId = $_POST['borrowerId']; //borrower id
     $interestType = $_POST['interestType']; //interest type
     $BorrowBranch = $_POST['Bbranch']; //borrowed branch
     $BorrowedAmount = $_POST['Lamount']; //borrowed amount here
     $totalLoanMonth = $_POST['LoanRun']; //loan run on
     $loanCreator = $_POST['Creator']; //loan creator id
     $BorrowerPhone = $_POST['borrowerPhone']; //borrower phone
     $MontlyIntrest = $_POST['MonthlyInt']; //monthly intrest rate
     $MonthlyRepayment = $_POST['MontlyRepay']; //monthly repayment
     $totalToRepayment = $_POST['TotalRepayment']; //totalrepayment

     $v = 0;
   // $borrowerId = $_POST['borrowerId'];
   // $borrowerId = $_POST['borrowerId'];
   $BorrowerName = __mpcReturnByPhoneMember($conn, $BorrowerPhone)[4];
//checking below is for member with pending loan approval request
   if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_loan_member WHERE mem_id='$borrowerId' && mem_phone='$BorrowerPhone' && loan_status='$v'")) >0 ){
        $Err = "$BorrowerName, Already has a loan Request that is pending Approval!";
        echo $Err;
        exit();
   }
   //checking if member has a loan account running already
   $status = 1;
   if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_loan_member WHERE mem_id='$borrowerId' && mem_phone='$BorrowerPhone' && loan_status='$status'")) >0 ){
    $Err = "$BorrowerName, Already has an ongoing loan running </br>which as not yet been completed!";
    echo $Err;
    exit();
}

   $sql = "INSERT INTO mpc_loan_member (mem_id, mem_phone, company_interest, monthly_payment, loan_month, loan_year, total_running_month, total_month_paid, total_month_remaining, interest_rate_type, member_branch, penalty, time, date, created_by, loan_amount,total_amount_to_repay, loan_status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
 /*  $sql = "INSERT INTO mpc_loan_member (mem_id, mem_phone, company_interest, monthly_payment, loan_month, loan_year, total_running_month, total_month_paid, total_month_remaining, interest_rate_type, member_branch, time, date, created_by, loan_amount,total_amount_to_repay, loan_status)VALUES('$borrowerId', '$BorrowerPhone', '$MontlyIntrest', '$MonthlyRepayment', '$loanMonth', '$loanYear', '$totalLoanMonth', '$v', '$totalLoanMonth', '$interestType', '$BorrowBranch', '$time', '$date', '$loanCreator', '$BorrowedAmount', '$totalToRepayment', '$v');";
   if(mysqli_query($conn, $sql)){
        echo "Yesssssss 0";
   }else {
    echo "nnnnnnooooooooooooo".mysqli_error($conn);
   }
   */
/*
   $loanCreatorByName = __mpcReturnByIdAll__($conn, $loanCreator)[1] . ' ' .__mpcReturnByIdAll__($conn, $loanCreator)[1];
    $notTxt = "<h1>LOAN APPROVAL REQUEST</h1>";
    $notTxt .= "<h5>You have a pending loan approval request of $BorrowedAmount</h5";
    $notTxt .= "<p>$loanCreatorByName, create loan of $BorrowedAmount for $BorrowerName, on $date $time.</p>";
    $notTxt .= "This loan will run for the total of $totalLoanMonth month(s), $BorrowerName, will be make a monthly repayment of &#8358; $MonthlyRepayment... Total Repayment is &#8385; $totalToRepayment </p>";
    $sender = 'GOODLIFE MPCS SELF';
    $notType = 1;
    $notStatus = 0;
    $rtnStatus = 0;
    $notForId = 1;
    $notificationFor = __mpc_SupaAdminOnly($conn, $notForId);

   __mpc_notify__($conn, $notTxt, $notType, $notificationFor, $notForId, $notStatus, $rtnStatus, $sender);
   */
 $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected Error, pls contact developer'.mysqli_error($conn);
        echo $Err;
        exit();
    }
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssssss', $borrowerId, $BorrowerPhone, $MontlyIntrest, $MonthlyRepayment, $loanMonth, $loanYear, $totalLoanMonth, $v, $totalLoanMonth, $interestType, $BorrowBranch, $v, $time, $date, $loanCreator, $BorrowedAmount, $totalToRepayment, $v);

    if(mysqli_stmt_execute($stmt)){
        $Err = 'LOAN CREATED';

        $loanCreatorByName = __mpcReturnByIdAll__($conn, $loanCreator)[1] . ' ' .__mpcReturnByIdAll__($conn, $loanCreator)[2];
        $notTxt = "<h1>LOAN APPROVAL REQUEST</h1>";
        $notTxt .= "<h5>You have a pending loan approval request of $BorrowedAmount</h5";
        $notTxt .= "<p>$loanCreatorByName, create loan of &#8358; $BorrowedAmount for $BorrowerName, on $date $time.</p>";
        $notTxt .= "<p>This loan will run for the total of $totalLoanMonth month(s), $BorrowerName, will be making a monthly repayment of &#8358; $MonthlyRepayment... Total Repayment is &#8385; $totalToRepayment </p>";
        $sender = 'GOODLIFE MPCS SELF';
        $notType = 1;
        $notStatus = 0;
        $rtnStatus = 0;
        $notForId = 1;
        $notificationFor = __mpc_SupaAdminOnly($conn, $notForId)[3];

        __mpc_notify__($conn, $notTxt, $notType, $notificationFor, $notForId, $notStatus, $rtnStatus, $sender);

        echo $Err;
        exit();
    }


}

//sender msg to staff adn admin
if(isset($_GET['Mparam']) && $_GET['Mparam'] !== '' && $_GET['Mparam'] === 'YakiseRaphaelIsgo'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $senderId = $_GET['senderId'];
    $senderPre = $_GET['senderPrev'];
    $senderMsg = $_GET['msg'];
    $senderSendTo = $_GET['sendTo'];

    $notificationFor = __mpcReturnByIdAll__($conn, $senderSendTo)[3];

    $senderFullname = __mpcReturnByIdAll__($conn, $senderId)[1] . ' ' . __mpcReturnByIdAll__($conn, $senderId)[2];

    $senderName = __mpcReturnByIdAll__($conn, $senderId)[3];
    $notificationMsg = $senderFullname . ' Said: '.$senderMsg;
    $rtnStatus = 1; //we need a success message to know if message has been sent
    $notType = 1;

    if($senderSendTo == 1){
    __mpc_notify__($conn, $notificationMsg , $notType, $notificationFor, $senderSendTo, 0, $rtnStatus, $senderName);

    }else {
        __mpc_notify__($conn, $notificationMsg , $notType, $notificationFor, $senderSendTo, $notType, $rtnStatus, $senderName);

    }

}

//bulky sms send
if(isset($_GET['bulkySms']) && $_GET['bulkySms'] === 'MpcsYAkiseETIm' && !empty($_GET['bulkySms'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $numbers = $_GET['n'];
    $msg = $_GET['msg'];


    //call bulk sms send function
    __send_mpc_bulky__($numbers, $msg);
}

//ASSIGNED MEMBERS TO GROUP
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'aDDMEMbeRtOMPCGROUP'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $goupId = $_POST['groupId'];
    $memId = $_POST['memberId'];
    $memPh = $_POST['membPhone'];

    $groupName = __mpc_group_Info($conn, $goupId)[1];

    //groupname
    //$member = __mpcReturnByPhoneMember($conn, $phone)[];

    //check if member is already assign to this group

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE groups='$groupName' && members_id='$memId' "))>0){
        $Err = 'Sorry, this member is already assigned to this group';
        echo $Err;
        exit();
    }

    $sql = "UPDATE mpc_members SET groups=? WHERE members_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'ss', $groupName, $memId);

    if(mysqli_stmt_execute($stmt)){
        $Err = 'mpc-ADDED';
        echo $Err;
        exit();
    }


}
//get and return members that are inside a particular group
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'CHECKGROUPMEMBER'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $q = $_GET['mpcs'];
    $myq = $q;

    $sql = "SELECT * FROM mpc_members WHERE groups='$q' ORDER BY members_id DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected Error while loading group members";
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Profile</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


<?php

    while($data = mysqli_fetch_array($d)){
        ?>


                <tr>
                    <td><?php echo $data['members_id']?></td>
                    <td><?php echo $data['name']?></td>
                    <td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" alt="<?php echo $data['name']?> picture" title="<?php echo $data['name']?> profile picture" class="dboard-img"></td>
                    <td><input type="number" class="setStyle createLoanInput mpc-table-input-fullwidth" placeholder="Amount"></td>
                    <td><button class="mpc-btn mpc-adm-grp-loan-auto mpc-btn-fullWidth" mpc-member-phone="<?php echo $data['phone']?>" mpc-member-id="<?php echo $data['members_id']?>">Create loan</button></td>
                </tr>
        <?php
    }
    ?>
            </tbody>
            <caption><?php echo $myq?> </caption>
        </table>
    <?php
}


if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] === 'KEYGROUPmpcYakise'){
    date_default_timezone_set('Africa/lagos');
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $dte = date('d/n/Y');
    $time = date('g:i:s a');
    $MonthByname = date('F');

    $borrowerId = $_POST['BorrowerId'];
    $borrowerPh = $_POST['BorrowerPh'];
    $AmountBorrow = $_POST['BorrowdAmount'];
    $MontlyReturn = $_POST['BorrowerMonthlyRepay'];
    $TotalToReturn = $_POST['borrowerTotalReturn'];
    $Cinterest = $_POST['companyMonthlyInterest'];

    $GroupName = $_POST['BorrowerByGroup'];
    $groupId = __mpc_group_InfoByname($conn, $GroupName)[0];
    $MonthTotal = $_POST['TotalRunningMonth'];

    //loan status
    $stat1 = 0;
    $stat2 = 1;

    //now runn check to know if member has a current existing loan
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_group_loan_request WHERE member_group_name='$GroupName' && group_id='$groupId' && member_id='$borrowerId' && member_phone='$borrowerPh' && status='$stat1' /*|| status='$stat2'*/"))>0){
        $Err = 'Member Already have an Existing group loan!';
        echo $Err;
        exit();
    }

    $sql = "INSERT INTO mpc_group_loan_request (member_group_name, group_id, member_id, member_phone, comp_interest, penalty, member_m_repay, total_amount_to_repay, total_running_month, amount_requested, request_date, request_time, month_by_name, status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error, contact deveoper'.mysqli_error($conn);
        echo $Err;
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $GroupName, $groupId, $borrowerId, $borrowerPh, $Cinterest, $stat1, $MontlyReturn, $TotalToReturn, $MonthTotal, $AmountBorrow, $dte, $time, $MonthByname, $stat1);
    if(mysqli_stmt_execute($stmt)){
        $Err = 'Group loan success';
        echo $Err;
        exit();
    }
}

//goodlife contactus us form toggle
if(isset($_GET['PERM']) && $_GET['PERM'] === 'TOGGLEb' && $_GET['PERM'] !== ''){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $q = $_GET['Xquery'];
    $id = 1;

    $sql = "UPDATE mpc_general_settings SET mpc_contactus_form=? WHERE settings_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'si', $q, $id);
    if(mysqli_stmt_execute($stmt)){
        $Err = 'Contact us form has been successfully turn ' . $q;
        echo $Err;
    }
}

//contact us
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] == 'MPCconTACTUSKEY'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $name = $_POST['ln'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];
    $stat = 0;

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_contact_messages WHERE sender_name='$name' && sender_phone='$phone' && status='$stat' || sender_phone='$phone' && status='$stat'")) >0){
        $Err = "$name, thanks for your interest to contact us, We are processing your previous message!";
        echo $Err;
        exit();
    }

    $sql = "INSERT INTO mpc_contact_messages (sender_name, sender_email, sender_phone, sender_subject, sender_message, status)VALUES(?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error';
        echo $Err;
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'sssssi', $name, $mail, $phone, $subject, $msg, $stat);
    if(mysqli_stmt_execute($stmt)){
        $Err = 'ContactUs saved';
        echo $Err;

        $notitxt = "<h5>New user unread message, from Goodlife MPCS contact us form!</h5>";
        $notitxt .= "<h5>$name, sent GOODLIFE MPCS a new message using contact us page, please navigate to contact us, to read full message!</h5>";
        $stat = 0;
         $usrname = __mpcReturnByIdAll__($conn, 1)[3];
        $adminId = __mpcReturnByIdAll__($conn, 1)[0];

       __mpc_notify__($conn, $notitxt, 1, $usrname, $adminId, $stat, 0, 'GOODLIFE UYO MPCS');
        //__mpc_notify__($conn, $notificationMsg , $notType, $notificationFor, $senderSendTo, 0, $rtnStatus, $senderName);
        exit();
    }

}

//here it means admin is trying to search for member
if(isset($_GET['xmem']) && !empty($_GET['xmem']) && $_GET['xmem'] === 'MpcsmeMberInfo'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $parameter = $_GET['qry'];
    $query = $_GET['param'];

    //starting sql query here
     $sql = "SELECT * FROM mpc_members WHERE $parameter LIKE '%$query%'";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Error processing request';
        echo $Err;
        exit();
     }
    // mysqli_stmt_bind_param($stmt, 's', $query);
     mysqli_stmt_execute($stmt);
     $d = mysqli_stmt_get_result($stmt);
     //;
     while($data = mysqli_fetch_array($d)){

        $pathToImg = __mpc_root__() . 'asset/img/'. $data['user_profile'];
		$memberId = $data['members_id'];
        $phone = $data['phone'];

		$linkPath = __mpc_root__() . "user/dashboard.php/?action=Settings&r=memberInfo&rtn=settings&k1=$phone&k2=$memberId&showInput=true";
        $img = "<img mpc-membId=\"$phone\" src=\"$pathToImg\" srcset=\"$pathToImg\" class=\"dboard-img memberInfoPicture\">";

        echo "<div class=\"memberwrap\">";
        echo $spellIt = "<h6><a href=\"$linkPath\" class=\"mpc-memberLink\">" .$data['name'] ."</a></h6>";

        echo $img;
        echo "</div>";
     }


}

//member information update start here
if(isset($_POST['UPDATEMEMBERINFO']) /*&& $_POST['UPDATEMEMBERINFO'] === 'PLEASeaLlowUpdaTE'*/ && !empty($_POST['UPDATEMEMBERINFO'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $data = json_decode($_POST["UPDATEMEMBERINFO"], false);
 
  

    // $branch = $_POST['branch'];
    // $anycoop = $_POST['anycoop'];
    // $coopName = $_POST['coopName'];
    $title = $data->title;
    $gender = $data->gender;
    $dob = $data->dob;
    $polling = $data->poolingMda;
    $preMda = $data->preMda;
    $RnkGradle = $data->RnkGradle;
    $DAppointment = $data->DAppointment;
    $email = $data->email;
    $DRetirement = $data->DRetirement;
    $MaritalStatus = $data->MaritalStatus;
    $MnextofKin = $data->MnextofKin;
    $nextofKinAddr = $data->nextofKinAddr;
    $nextofkinRelationship = $data->relationshipWithNextOfKin;
    $memberPhone = $data->memberPhone; //memberPhone
    $memberId = $data->memberId; //memberId

    $memberNewPhone = $data->memberNewPhone;
    $memberName = $data->memberName;
    $staffId = $data->memberStaffId;


    //checking if member has already been assigned to a new branch
    //then this code below willl prevent reassigning member to another group
    // if(__mpcReturnByPhoneMember($conn, $memberPhone)[16] != 'pending'){
    //     $branch = __mpcReturnByPhoneMember($conn, $memberPhone)[16];
    // }
    // //check to make sure account number as not been assigned to another member account
    // if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_member WHERE registration_number='$accountDigit'"))>0){
    //     $Err = 'ERROR, duplicate account number, account has already been assigned to another account!';
    //     echo $Err;
    //     exit();
    // }

    
    //below is running update code
    $sql = "UPDATE mpc_members SET name='$memberName', phone='$memberNewPhone', registration_number='$staffId', title='$title', sex='$gender', date_of_birth='$dob', permanent_addr='$polling', lga='$preMda',
    place_of_birth='$RnkGradle', religion='$DAppointment', email='$email', occupation='$DRetirement', business_addr='$MaritalStatus' WHERE members_id='$memberId' && phone='$memberPhone'";

   // $sql = "UPDATE mpc_members SET title='$title', sex='$gender', date_of_birth='$dob', permanent_addr='$polling', lga='$preMda',
   // place_of_birth='$RnkGradle', religion='$DAppointment', email='$email', occupation='$DRetirement', business_addr='$MaritalStatus'/*,
   // church='$church', any_coop='$anycoop', coop_name='$coopName', declaration=\"$declaration\", branch='$branch',
  //  registration_number='$accountDigit' WHERE phone='$memberPhone' && members_id='$memberId'*/

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error occur';
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_execute($stmt)){

        /**TRYING TO UPDATE PHONE NUMBER STATUS IF
         * PHONE NUMBER IS NOT PENDING ANYMORE
         * I MEAN IF ADMIN HAS SUCCESSFULLY UPDATE
         */
        //ADD NEXT OF KIN TO MEMBER
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_next_of_kin WHERE next_of_kin_for_phone='$memberPhone' && next_of_kin_for_id='$memberId'")) >0)
        {
            $Err = 'Member Info updated successfully, But next of kin is ignored because member already have next of kin.';
            print $Err;
            exit();
        }

        $Sql = "INSERT INTO mpc_next_of_kin (next_of_kin_for_phone, next_of_kin_for_id, next_kin_name, next_kin_relationship, next_kin_addre, next_kin_phone)
                VALUES('$memberPhone', '$memberId', '$MnextofKin', '$nextofkinRelationship', '$nextofKinAddr', 'UNAVAILABLE')";
        mysqli_query($conn, $Sql);

        $upd = "UPDATE mpc_member_verification SET verify_phone='1' WHERE verify_for='$memberId' && verify_for_phone='$memberPhone'";
        mysqli_query($conn, $upd);
        $Err = 'Info Updated';
        echo $Err;
        exit();
    }
}

//function getting all outstanding loan waiting approval here
if(isset($_POST['PERM']) && $_POST['PERM'] === 'pKYVest' && !empty($_POST['PERM'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $stat = 0;
    $qry = $_POST['qrySend'];

    if($qry === 'Group'){
        $sql = "SELECT * FROM mpc_group_loan_request WHERE status='$stat' LIMIT 100";
        $phoneColumn = 'member_phone'; //member phone
        $columnIdName =  'group_loan_id';//member grouploan increment  id
        $montlyRepay = 'member_m_repay'; //member monthly repayment
        $companyIntrest = 'comp_interest'; //companyInterest
        $amountReq = 'amount_requested';
        $totalRepayment = 'total_amount_to_repay';
        $groupName = 'member_group_name';
        $status = 'status'; //loan status
        $type = 'Group';

    }else if($qry === 'Regular'){
        $sql = "SELECT * FROM mpc_loan_member WHERE loan_status='$stat' LIMIT 100";
        $phoneColumn = 'mem_phone';
        $columnIdName = 'loan_id';
        $montlyRepay = 'monthly_payment';
        $companyIntrest = 'company_interest';
        $amountReq = 'loan_amount';
        $totalRepayment = 'total_amount_to_repay'; //memer total repayment
        $groupName = 'date';
        $status = 'loan_status'; //loan status
        $type = 'Regular';


        $Tc1 = 'Profile';
        $Tc2 = 'M. Repayment';
        $Tc3 = 'C. Interest';
        $Tc4 = 'Request amount';
        $Tc5 = 'Total Repayment';
        $Tc6 = 'Group name';
        $Tc7 = 'Status';
        $Tc8 = 'Action';
        $tbn = "Approve";
        $newClassName = "mpc-loan-approvedClicked";



    }elseif ($qry == 'ONLINE') {
        $sql = "SELECT * FROM mpc_loan_request_online WHERE status='0' LIMIT 100";

        $phoneColumn = 'uid_ph';
        $columnIdName = 'uid';
        $montlyRepay = 'uid_ph';
        $companyIntrest = 'amount';
        $amountReq = 'reason';
        $totalRepayment = 'request_date'; //memer total repayment
        $groupName = 'loan_trackId';
        $status = 'status'; //loan status
        $type = 'ONLINE';
        // $name;


        $Tc1 = 'Profile';
        $Tc2 = 'Phone';
        $Tc3 = 'Amount Requested';
        $Tc4 = 'Reason';
        $Tc5 = 'Date Requested';
        $Tc6 = 'Tracking Code';
        $Tc7 = 'Status';
        $Tc8 = 'Action';
        $tbn = "take action";
        $newClassName = "mpxc-online-loan-approve-RQ";

        
    }

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Error occured';
        echo $Err.mysqli_error($conn);
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped border-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th><?php echo $Tc1?></th>
                <th><?php echo $Tc2?></th>
                <th><?php echo $Tc3?></th>
                <th><?php echo $Tc4?></th>
                <th><?php echo $Tc5?></th>
                <th><?php echo $Tc6?></th>
                <th><?php echo $Tc7?></th>
                <th><?php echo $Tc8?></th>
            </tr>
        </thead>

    <?php
    while ($data = mysqli_fetch_array($d)) {

       $name = __mpcReturnByPhoneMember($conn, $data[$phoneColumn])[4];
       $memberId = __mpcReturnByPhoneMember($conn, $data[$phoneColumn])[0];

       if($data[$status] == 0){
            $currentStatus = 'Pending';
       }
        //get profile picture
        $profile = __mpc_root__() . 'asset/img/' .__mpcReturnByPhoneMember($conn, $data[$phoneColumn])[18];
        ?>
        <tr>
        <td> <?php echo $data[$columnIdName]?></td>
        <td> <?php echo $name ?></td>
        <td> <?php echo "<img src=\"$profile\" srcset=\"$profile\" class=\"dboard-img\">"; ?></td>
        <td class="M-repay">&#8358; <?php echo $data[$montlyRepay]?></td>
        <td class="C-int">&#8358; <?php echo $data[$companyIntrest]?></td>
        <td class="R-amount">&#8358; <?php echo $data[$amountReq]?></td>
        <td class="T-repay">&#8358; <?php echo $data[$totalRepayment]?></td>
        <td ><?php echo $data[$groupName]?></td>
        <td ><?php echo $currentStatus?></td>
        <td> <button name="<?php echo $name?>" amountRQ="<?php echo $data[$companyIntrest]?>" class="mpc-btn mpc-disabled <?php echo $newClassName?>" mpc-gr-id="<?php echo $data[$groupName]?>" mpc-memid="<?php echo $memberId?>" mpc_memph="<?php echo $data[$phoneColumn]?>" mpc-loan-tblId="<?php echo $data[$columnIdName]?>" mpc-type="<?php echo $type;?>" mpc-approved-incre="<?php echo $data[$columnIdName]?>"><?php echo $tbn?></button></td>

        </tr>

        <?php
    }
echo "</table></div>";
              //  (); //take action to approved loan

}

///GETTING GROUP LOAN BY GROUP NAME START HERE
//function getting all outstanding loan waiting approval here
if(isset($_POST['PERM']) && $_POST['PERM'] === 'groupLOANBYgROUP' && !empty($_POST['PERM'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";
    $stat = 0;
     $qry = $_POST['grpSend'];

    //if($qry === 'Group'){
        $sql = "SELECT * FROM mpc_group_loan_request WHERE member_group_name='$qry' && status='$stat' LIMIT 100";

        $phoneColumn = 'member_phone'; //member phone
        $columnIdName =  'group_loan_id';//member grouploan increment  id
        $montlyRepay = 'member_m_repay'; //member monthly repayment
        $companyIntrest = 'comp_interest'; //companyInterest
        $amountReq = 'amount_requested';
        $totalRepayment = 'total_amount_to_repay';
        $groupName = 'member_group_name';
        $status = 'status'; //loan status
        $type = 'Group';

    //}

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Error occured';
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    ?>
    <div class="table-responsive">
    <table class="table table-bordered table-striped border-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Profile</th>
                <th>M. Repayment</th>
                <th>C. Interest</th>
                <th>Request amount</th>
                <th>Total Repayment</th>
                <th>Group name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

    <?php
    while ($data = mysqli_fetch_array($d)) {

       $name = __mpcReturnByPhoneMember($conn, $data[$phoneColumn])[4];
       $memberId = __mpcReturnByPhoneMember($conn, $data[$phoneColumn])[0];

       if($data[$status] == 0){
            $currentStatus = 'Pending';
       }
        //get profile picture
        $profile = __mpc_root__() . 'asset/img/' .__mpcReturnByPhoneMember($conn, $data[$phoneColumn])[18];
        ?>
        <tr>
        <td> <?php echo $data[$columnIdName]?></td>
        <td> <?php echo $name ?></td>
        <td> <?php echo "<img src=\"$profile\" srcset=\"$profile\" class=\"dboard-img\">"; ?></td>
        <td class="M-repay">&#8358; <?php echo $data[$montlyRepay]?></td>
        <td class="C-int">&#8358; <?php echo $data[$companyIntrest]?></td>
        <td class="R-amount">&#8358; <?php echo $data[$amountReq]?></td>
        <td class="T-repay">&#8358; <?php echo $data[$totalRepayment]?></td>
        <td ><?php echo $data[$groupName]?></td>
        <td ><?php echo $currentStatus?></td>
        <td> <button class="mpc-btn mpc-loan-approvedClicked mpc-disabled" mpc-approved-incre="<?php echo $data[$columnIdName]?>" mpc-gr-id="<?php echo $data[$groupName]?>"  mpc-memid="<?php echo $memberId?>" mpc_memph="<?php echo $data[$phoneColumn]?>" mpc-loan-tblId="<?php echo $data[$columnIdName]?>" mpc-type="<?php echo $type;?>">Approved</button></td>

        </tr>


        <?php
    }
?>
    <caption class="sumMpcCaption">
        <?php
                    /**
                     * function TO SUM TOTAL AMOUNT GROUP BY GROUP IS REQUESTING
                     * THIS FUNCTION ACCEPTS SEVEN PARAMETERS
                     * PARAM1 = [DB CONNECTION]
                     * PARMA2 = [WHERE TO COUNT OR TABLE TO COUNT]
                     * PARAM3 = [GROUP NAME]
                     * PARAM4 = [SPECIFIC COLUMN TO SUM]
                     * PARAM5 = TABLE ID]
                     * PARAM6 = [COLUMN FO WHERE CLAUSE]
                     * PARAM7 = [TABLE NAME]
                     */
                    $groupName = $qry;

                    $ColumntoDoCount = 'amount_requested';
                    $TblId = 'group_loan_id';
                    $tblColumn = 'member_group_name';
                    $tbl = 'mpc_group_loan_request';



                   echo "This group <span class=\"HighLight\">\"$groupName\"</span>, is requesting for: &#8358;". __mpc_total_calculate__($conn, 'group', $groupName, $ColumntoDoCount, $TblId, $tblColumn, $tbl);
                ?>
    </caption>
<?php

echo "</table></div>";
}

//loan activator code start below
if(isset($_POST['PERMS']) && !empty($_POST['PERMS']) && $_POST['PERMS'] === 'KEYActivatOR'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    date_default_timezone_set('Africa/Lagos');
    $dateNum = date('d/m/y');
    $dte = date('F');

    $loanType = $_POST['LoanType'];
    $loanTableId = $_POST['LoanTblid'];
    $memberid = $_POST['memberId'];
    $phone = $_POST['memberPhone'];
    $activator = $_POST['loanActivator'];
    $groupDate = $_POST['groupDate']; //this is returning group if it group/ date if it a reqular loan
    $status = 1;

    $memberName = __mpcReturnByPhoneMember($conn, $phone)[4];


    if($loanType == 'Group'){
        /**
                     * function TO SUM TOTAL AMOUNT GROUP BY GROUP IS REQUESTING
                     * THIS FUNCTION ACCEPTS SEVEN PARAMETERS
                     * PARAM1 = [DB CONNECTION]
                     * PARMA2 = [WHERE TO COUNT OR TABLE TO COUNT]
                     * PARAM3 = [GROUP NAME]
                     * PARAM4 = [SPECIFIC COLUMN TO SUM]
                     * PARAM5 = TABLE ID]
                     * PARAM6 = [COLUMN FO WHERE CLAUSE]
                     * PARAM7 = [TABLE NAME]
                     */
        $groupName = $groupDate;
        $ColumntoDoCount = 'amount_requested';
        $TblId = 'group_loan_id';
        $tblColumn = 'member_group_name';
        $tbl = 'mpc_group_loan_request';
        $arrayOfColumns1 = ['amount_requested']; //amount requested
        $arrayOfColumns2 = ['total_amount_to_repay']; //amount to repay

        $amountRq = __get_memberLoanAmount__($conn, 'member_id', 'member_phone', $memberid, $phone, $tbl, $arrayOfColumns1); //amount requested
        $amountTotal = __get_memberLoanAmount__($conn, 'member_id', 'member_phone', $memberid, $phone, $tbl, $arrayOfColumns2); //total amount to repay

        //$

      //echo  $groupTotal = __mpc_total_calculate__($conn, 'group', $groupName, $ColumntoDoCount, $TblId, $tblColumn, $tbl);
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_loan_approval_info WHERE member_id='$memberid' && member_phone='$phone' && status='$status'"))>0){
        $Err = "$memberName, already has an approved loan currently Active!";
        echo $Err;
        exit();
    }



    //$sql = "INSERT INTO mpc_loan_approval_info (approved_date, approval_month, loan_type, approved_by, loan_identifier, total_amount, amount_to_return, member_id, member_phone, status)VALUES('$dateNum', '$dte', '$loanType', '$activator', '$groupDate', '$amountRq', '$amountTotal',  '$memberid', '$phone', '$status')";
    $sql = "INSERT INTO mpc_loan_approval_info (approved_date, approval_month, loan_type, approved_by, loan_identifier, total_amount, amount_to_return, member_id, approved_loan_tbl_id, member_phone, status)VALUES(?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error';
        echo $Err;
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssssssss", $dateNum, $dte, $loanType, $activator, $groupDate, $amountRq, $amountTotal,  $memberid, $loanTableId, $phone, $status);
    if(mysqli_stmt_execute($stmt)){

        $upd = "UPDATE mpc_group_loan_request SET status='$status' WHERE member_id='$memberid' && member_phone='$phone'";
        mysqli_query($conn, $upd);



        $approvedByName = __mpcReturnByIdAll__($conn, $activator)[1] . ' ' .__mpcReturnByIdAll__($conn, $activator)[2]; //loan approvedby name
        $memberName = __mpcReturnByPhoneMember($conn, $phone)[4];
        $notFor = __mpcReturnByIdAll__($conn, 1)[3];
        $notForId = __mpcReturnByIdAll__($conn, 1)[0];
        $notStatus = 0;
        $rtnStatus = 0;
        $sender = '@MPC SELF SEND';


        $notTxt = "<h1>GROUP LOAN APPROVAL NOTIFICATION</h1>";
        $notTxt .= "<h4>$approvedByName, Approved a loan request of &#8358; $amountRq for $memberName.</h4>";
        $notTxt .= "<h4>$memberName is a member of $groupName group, $memberName will be returning a total of &#8358; $amountTotal. </h4>";
        $notTxt .= "<h4>Total amount is subject change if $memberName failed to make return in a weekly/monthly interval.</h4>";

        __mpc_notify__($conn, $notTxt, 1, $notFor, $notForId, $notStatus, $rtnStatus, $sender);
    }


    echo $Err = "Loan Approved"; //loan approved success message here; disbursement





    }else if($loanType == 'Regular'){

        /*$groupName = $groupDate;
        $ColumntoDoCount = 'amount_requested';
        $TblId = 'group_loan_id';
        $tblColumn = 'member_group_name'; */
        $tbl = 'mpc_loan_member';
        $arrayOfColumns1 = ['loan_amount']; //amount requested
        $arrayOfColumns2 = ['total_amount_to_repay']; //amount to repay

         $amountRq = __get_memberLoanAmount__($conn, 'mem_id', 'mem_phone', $memberid, $phone, $tbl, $arrayOfColumns1); //amount requested
        $amountTotal = __get_memberLoanAmount__($conn, 'mem_id', 'mem_phone', $memberid, $phone, $tbl, $arrayOfColumns2); //total amount to repay

        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_loan_approval_info WHERE member_id='$memberid' && member_phone='$phone' && status='$status'"))>0){
            $Err = "$memberName, already has an approved loan currently running!";
            echo $Err;
            exit();
        }

        $sql = "INSERT INTO mpc_loan_approval_info (approved_date, approval_month, loan_type, approved_by, loan_identifier, total_amount, amount_to_return, member_id, approved_loan_tbl_id, member_phone, status)VALUES('$dateNum', '$dte', '$loanType', '$activator', '$loanType', '$amountRq', '$amountTotal', '$memberid', '$loanTableId', '$phone', '$status')";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $Err = 'Unexpected error';
            echo $Err;
            exit();
        }


       // mysqli_stmt_bind_param($stmt, 'ssssssssss', $dateNum, $dte, $loanType, $activator, $loanType, $amountRq, $amountTotal, $memberid, $memberPhone, $status);
        if(mysqli_stmt_execute($stmt)){
            $upd = "UPDATE mpc_loan_member SET loan_status='$status' WHERE mem_id='$memberid' && mem_phone='$phone'";
            mysqli_query($conn, $upd);

            echo $Err = "Loan Approved"; //loan approved success message here;

        $approvedByName = __mpcReturnByIdAll__($conn, $activator)[1] . ' ' .__mpcReturnByIdAll__($conn, $activator)[2]; //loan approvedby name
        $memberName = __mpcReturnByPhoneMember($conn, $phone)[4];
        $notFor = __mpcReturnByIdAll__($conn, 1)[3];
        $notForId = __mpcReturnByIdAll__($conn, 1)[0];
        $notStatus = 0;
        $rtnStatus = 0;
        $sender = '@MPC SELF SEND';


        $notTxt = "<h1>REGULAR LOAN APPROVAL NOTIFICATION</h1>";
        $notTxt .= "<h4>$approvedByName, Approved a regular loan request of &#8358; $amountRq for $memberName.</h4>";
        $notTxt .= "<h4>$memberName will be returning a total of &#8358; $amountTotal. </h4>";
        $notTxt .= "<h4>Total amount is subject change if $memberName failed to make return in a weekly/monthly interval.</h4>";

        __mpc_notify__($conn, $notTxt, 1, $notFor, $notForId, $notStatus, $rtnStatus, $sender);

        }

    }


}

//gurantor search box query return here
if(isset($_GET['PERMQ']) && !empty($_GET['PERMQ']) && $_GET['PERMQ'] == 'loadMembersForguarantor'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $qr = $_GET['gquery']; //search query or paramether sent from query

    $sql = "SELECT * FROM mpc_members WHERE name LIKE '%$qr%' ORDER BY members_id DESC";
	if(!$query = mysqli_query($conn, $sql)){
		$Err = 'SYSTEM ENCOUNTER AN UNEXPECTED ERROR';
		echo $Err;
		exit();
	}
	?>
	<div class="table-responsive">
		<table class="table table-striped table-border dark-border">
	<?php

	while($data = mysqli_fetch_array($query)){
		?>
			<tr>
				<td class="mpc-td-name"><?php echo $data['name']?></td>
				<td class="mpc-td-img"><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" alt="pics" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" class="dboard-img"></td>
				<td class="mpc-td-width"><input type="text" class="mpc-disabled mpc-qinfo setStyle quarantorName" placeholder="Guarantor Name"></td>
				<td class="mpc-td-width"><input type="number" class="mpc-disabled mpc-qinfo setStyle quarantorPhone" placeholder="Guarantor Phone"></td>
				<td class="mpc-td-width"><input type="text" class="mpc-disabled mpc-qinfo setStyle quarantorAddr" placeholder="Address(optional)"></td>

                <!-- witness two start here -->
                <!-- <td class="mpc-td-width"><input type="text" class="mpc-qinfo setStyle quarantorTwoName mpc-disabled" placeholder="Name of Witness 2"></td>
                <td class="mpc-td-width"><input type="number" class="mpc-qinfo setStyle quarantorTwoPhone mpc-disabled" placeholder="Witness 2 Phone "></td>
                <td class="mpc-td-width"><input type="text" class="mpc-qinfo setStyle quarantorTwoAddr mpc-disabled" placeholder="Address(optional)"></td> -->
                <!-- witness two end here -->
				<td class="mpc-td-btn"><button class="mpc-disabled mpc-btn Adding-mpc-quarantor" mpc-qurantor-for="<?php echo $data['phone']?>" mpc-qurantor-for-id="<?php echo $data['members_id']?>">Add guarantor</button></td>
			</tr>
		<?php
	}
	echo "<table></div>";
}

//function that add member gurantor
if(isset($_POST['witnessMpc']) && !empty($_POST['witnessMpc']) /*&& $_POST['witnessMpc'] === 'MPCADD@guarantor'*/){
    $tzne = date_default_timezone_set('Africa/lagos');
    $dayOfTheMonth = date('l d'); 
    $monthOfTheYear = date('m'); 

    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_POST['witnessMpc'], false);


    
    //print_r($data);
    $guarantorName = $data->gname; //guarantor for id
    $gforPhone = $data->gphone; //guarantor for id
    $gforAddre = $data->gaddress; //guarantor for id
    $loanguarantorInputer = $data->inputer; //guarantor saver transporter


    // $guarantorTwoName = $data->gname2; //justice (uyo) is using witness instead of gurantor (witness two info start here)
    // $gforPhoneTwo = $data->gname2Phone; //guarantor for phone
    // $gforAddreTwo = $data->gname2Addr; //guarantor for address

    $guarantorTwoName = 'UNAVAILABLE'; //justice (uyo) is using witness instead of gurantor (witness two info start here)
    $gforPhoneTwo = 'UNAVAILABLE'; //guarantor for phone
    $gforAddreTwo = 'UNAVAILABLE'; //guarantor for address

    $memberPhone = $data->ownerPhone;
    $memberId = $data->ownerId;

    

    $name = __mpcReturnByPhoneMember($conn, $memberPhone)[4];
    
    $nominee_declaration = __NomineeInfo($conn, $memberPhone, $guarantorName, $gforPhone, $gforAddre);

    
    //pls let do some checking here
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_guarantors WHERE gurantor_for='$memberPhone' && gurantor_for_id='$memberId' && guarantor_phone='$gforPhone' && gurantors_name='$guarantorName' "))>0){

        $Err = "SORRY $name, Has a Witness already!";
        echo $Err;
        exit();
    }

    $sql = "INSERT INTO mpc_guarantors (gurantor_for, gurantor_for_id, gurantors_name, guarantor_phone, guarantors_address, guarantor_two_name, guarantor_two_phone, guarantor_two_address, nominee_txt, gurantor_inputer)VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'Unexpected error while processing request, pls contact developer ASAP!';
        echo $Err;
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $memberPhone, $memberId, $guarantorName, $gforPhone, $gforAddre, $guarantorTwoName, $gforPhoneTwo, $gforAddreTwo, $nominee_declaration, $loanguarantorInputer);
        if(mysqli_stmt_execute($stmt)){

            $upd = "UPDATE mpc_member_verification SET verify_quarantor='1' WHERE verify_for='$memberId' && verify_for_phone='$memberPhone'";
            mysqli_query($conn, $upd);

            $Err = "Witness assigned successful To $name";
            echo $Err;
            exit();
        }
    }
 
}

//function that get members repayement
if(isset($_GET['xmpcq']) && !empty($_GET['xmpcq']) && $_GET['xmpcq'] === 'repayGroupGEt'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $query = $_GET['qparam'];
    $groupId = __mpc_group_InfoByname($conn, $query)[0];
    $status = 1;
    $sql = "SELECT * FROM mpc_group_loan_request WHERE status='$status' && member_group_name='$query' && group_id='$groupId'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unexpected Error";
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $col1 = 'member_phone';
    $whereToCount = 'group'; //function sum parameter =(group)
    //amount paid data start here
    $groupName = $query; //group get here by name
    $ColumntoDoCount = 'amount_paid'; //amount this group paid
    $tblId = 'member_id'; //db members id
    $tblColumn = 'member_group_name'; //table column
    $tbl = 'mpc_group_loan_repayment'; //db table name
    //amount paid data stop here
    $TotalAmountPaidByGroup = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $tblId, $tblColumn, $tbl);


    //amount borrowed data start here
    $groupName = $query; //group get here by name
    $ColumntoDoCount = 'total_amount_to_repay'; //amount this group paid
    $tblId = 'group_loan_id'; //db members id
    $tblColumn = 'member_group_name'; //table column
    $tbl = 'mpc_group_loan_request'; //db table name
    //amount borrowed data end here
    if($TotalAmountPaidByGroup == ''){
        $TotalAmountPaidByGroup = 0;
    }

    $mygroupid = __mpc_group_InfoByname($conn, $query)[0];
    $penaltyBygroup = __sumTotalPenalty__($conn, $query, $mygroupid, 'group'); // total penalty charge this group


     $TotalAmountBorrowedByGroup = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $tblId, $tblColumn, $tbl) + $penaltyBygroup;

    //trying to check if amount paid is
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hovered">

<?php


    $penaltyUri = __mpc_root__() . "user/dashboard.php/?action=inputData&qparam=penality&group=$query&k=group"; //admin is using this link to set penalty for defaulters
    echo "<caption> This group <span class=\"HighLight\">\"$query\"</span> paid <span class=\"HighLight\">&#8358; $TotalAmountPaidByGroup </span> of <span class=\"HighLight\">&#8358; $TotalAmountBorrowedByGroup</span><br> <a href=\"$penaltyUri\">Add penalty for defaulters</a></caption>";

    while($data = mysqli_fetch_array($d)){

        $name = __mpcReturnByPhoneMember($conn, $data[$col1])[4];
        $imgPath = __mpc_root__() . 'asset/img/'. __mpcReturnByPhoneMember($conn, $data[$col1])[18];

        //below is payment info for member
        //i mean amount return by each group member
        $memberPhone = $data[$col1];
        $memberId = $data['member_id'];
        $sumwhereColumn1 = 'member_id';
        $sumwhereColumn2 = 'member_phone';
        $tb = 'mpc_group_loan_repayment';
        $sumColumn = 'amount_paid';

        $amountPaidAlreadyByMember = __mpc_member_totalPaid__($conn, $memberId, $memberPhone, $sumwhereColumn1, $sumwhereColumn2, $tb, $sumColumn);
        ?>
        <tr>
            <td><?php echo $data['group_loan_id']?></td>
            <td><?php echo $name?></td>
            <td><img src="<?php echo $imgPath?>" title="<?php echo $name.'\'s profile' ?>" srcset="<?php echo $imgPath?>" class="dboard-img" alt="profile"></td>
            <td>
            <select class="adm-select mpc-qinfo mpc-repaymenTcheck mpc-disabled" title="SELECT REPAYMENT TYPE FOR MEMBER">
                <option value="">-----</option>
                <option value="Weekly">WEEKLY</option>
                <option value="Monthly">MONTHLY</option>
            </select>
            </td>
            <td>
                <input type="text" placeholder="Enter amount" class="setStyle mpc-member-returnAmount mpc-qinfo mpc-disabled" title="ENTER AMOUNT PAID BY MEMBER">
            </td>
            <td title="<?php echo$name?> made a total of &#8358; <?php echo$amountPaidAlreadyByMember?> repayment">&#8358; <?php echo $amountPaidAlreadyByMember?></td>
            <td>
                <button class="mpc-btn mpc-btn-fullWidth mpc-member-repayment-invoker mpc-disabled" mpc-repaymentgroup="<?php echo $data['member_group_name']?>" mpc-repayer-phone="<?php echo $data['member_phone']?>" mpc-member-id="<?php echo $data['member_id']?>"  mpc-tbl-id="<?php echo $data['group_loan_id']?>">Saved</button>
            </td>
        </tr>
        <?php
    }

    echo "</table></div>";
}

//responding to loan repayment
if(isset($_POST['PERM']) && !empty($_POST['PERM']) && $_POST['PERM'] === 'MPCQgroupRepayment'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    date_default_timezone_set('Africa/Lagos');
    $dateAndTime = date('d/m/y, h:i:s a');
    $monthbyname = date('F');
    $fullYear = date('Y');


    $payerId = $_POST['payerId'];
    $payerPhone = $_POST['payerPhone'];
    $payerGroup = $_POST['payerGroup'];
    $payerPayAmount = $_POST['payerPayAmount'];
    $repaymentForTblid = $_POST['tblId']; //member is make repayment for this loan
    $payPayType = strtolower($_POST['payPayType']);


    $name = __mpcReturnByPhoneMember($conn, $payerPhone)[4]; //member by name
    $Branch = __mpcReturnByPhoneMember($conn, $payerPhone)[16]; //member branch by name
    $cashCollector = $_POST['cashCollector']; //cash collector

    $tbl = 'mpc_group_loan_request';
    $tblCol1 = 'member_id';
    $tblCol2 = 'member_phone';
    $selectedColumn = 'member_m_repay';
    $compareCol1 = $payerId;
    $compareCol2 = $payerPhone;


    if($payPayType === 'weekly'){

        $selectedColumnInterest = 'comp_interest';

        $monthlyRepayGroup =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2) / 4;

        $CompanyInterest =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumnInterest, $compareCol1, $compareCol2) / 4;

    }else if($payPayType === 'monthly'){
        $selectedColumnInterest = 'comp_interest';

        $monthlyRepayGroup =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2);

        $CompanyInterest =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumnInterest, $compareCol1, $compareCol2);

    }

    //check to see if amount paid is less than what the system is expecting from member
    if($payerPayAmount < $monthlyRepayGroup){
        $Err = "System is expecting &#8358; $monthlyRepayGroup from $name, according to $payPayType </br>repayment schedule";
        echo $Err;
        exit();
    }



    $sql = "INSERT INTO mpc_group_loan_repayment (member_id, member_phone, member_group_name, amount_paid, paid_for_type, repayment_for_track, cash_collector, month_by_name, date_and_time, status)VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Fail to saved member payment";
        echo $Err;
        exit();
    }else {
       // echo $dte;
       $status = 1;
        mysqli_stmt_bind_param($stmt, 'sssssssssi', $payerId, $payerPhone, $payerGroup, $payerPayAmount, $payPayType, $repaymentForTblid, $cashCollector, $monthbyname, $dateAndTime, $status);

        if(mysqli_stmt_execute($stmt)){


            __mpc_earnings__($conn, $CompanyInterest, $monthbyname, $fullYear, $Branch); //recordd goodlife earning here


            //if member payment total payment plus all penalties is equals to what he is supposed to pay
            //then the sysetm will mark him coplete automatic
            $sumColumn = 'amount_paid';
            $col1 = 'member_id';
            $col2 = 'member_phone';
            $tbl1 = 'mpc_group_loan_repayment';
            $totalAmountPaidByMember = __mpc_member_totalPaid__($conn, $payerId, $payerPhone, $col1, $col2, $tbl1, $sumColumn);

            $tbl2 = 'mpc_group_loan_request';
            $tb2Col1 = 'member_id';
            $tb2Col2 = 'member_phone';

            $totalAmountForMemberRepayment = __get_member_total_amountFor_repayment__($conn, $payerId, $payerPhone, $tbl2, $tb2Col1, $tb2Col2);


            if($totalAmountPaidByMember >= $totalAmountForMemberRepayment){
                $status = 3;

                $update = "UPDATE mpc_group_loan_request SET status='$status' WHERE member_id='$payerId' && member_phone='$payerPhone'";
                mysqli_query($conn, $update);

                //update all payment made by each member
                //let other component know that member has finished processing loan
                $sql2 = "UPDATE mpc_group_loan_repayment SET status='0' WHERE member_id='$payerId' && member_phone='$payerPhone' ";
                mysqli_query($conn, $sql2);


                //last update for group member
                //running update on last table let everything on the system understand that member has compted all repayment
                $update3 = "UPDATE mpc_loan_approval_info SET status='0' WHERE member_id='$payerId' && member_phone='$payerPhone'";
                mysqli_query($conn, $update3);

            }
        }
    }

}

//function to add penalty for member
if(isset($_GET['xpenalty']) && $_GET['xpenalty'] !== '' && $_GET['xpenalty'] === 'CODE4ATMANFUL'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $memberphone = $_GET['penaltyPhone']; //penalize member phone
    $memberId = $_GET['penaltyid']; //penalize member id
    $penalty = $_GET['penaltyType']; //penalty type
    $penaltyCategory = $_GET['penaltyFor']; //penalty category group loan or regular loan

   if($penaltyCategory == 'regular-loan'){
        //regular loan member start here
        if($penalty === 'weekly'){
            $tbl = 'mpc_loan_member';
            $tblCol1 = 'mem_id';
            $tblCol2 = 'mem_phone';
            $selectedColumn = 'company_interest';
            $compareCol1 = $memberId;
            $compareCol2 = $memberphone;
            $penaltyColumn = 'penalty';

            $currentPenalty = __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $penaltyColumn, $compareCol1, $compareCol2);


            $PenaltyInterest = $currentPenalty + __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2) / 4 * 2;

        }else if($penalty === 'monthly'){
            $tbl = 'mpc_loan_member';
            $tblCol1 = 'mem_id';
            $tblCol2 = 'mem_phone';
            $selectedColumn = 'company_interest';
            $compareCol1 = $memberId;
            $compareCol2 = $memberphone;
            $penaltyColumn = 'penalty';

                $currentPenalty = __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $penaltyColumn, $compareCol1, $compareCol2);


                $PenaltyInterest = $currentPenalty  + __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2) * 2;

            }

   }else if($penaltyCategory == 'group-loan'){

    if($penalty === 'weekly'){
        $tbl = 'mpc_group_loan_request';
        $tblCol1 = 'member_id';
        $tblCol2 = 'member_phone';
        $selectedColumn = 'comp_interest';
        $compareCol1 = $memberId;
        $compareCol2 = $memberphone;
        $penaltyColumn = 'penalty';

        $currentPenalty = __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $penaltyColumn, $compareCol1, $compareCol2);


        $PenaltyInterest = $currentPenalty + __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2) / 4 * 2;

    }else if($penalty === 'monthly'){
        $tbl = 'mpc_group_loan_request';
        $tblCol1 = 'member_id';
        $tblCol2 = 'member_phone';
        $selectedColumn = 'comp_interest';
        $compareCol1 = $memberId;
        $compareCol2 = $memberphone;
        $penaltyColumn = 'penalty';

       $currentPenalty = __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $penaltyColumn, $compareCol1, $compareCol2);


       $PenaltyInterest = $currentPenalty  + __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2) * 2;

        }
   }


    $update = "UPDATE $tbl SET penalty='$PenaltyInterest' WHERE $tblCol1='$memberId' && $tblCol2='$memberphone'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $update)){
        $Err = 'Error Occur while processing request, contact deveoper for help';
        echo $Err;
        exit();
    }
    if(mysqli_stmt_execute($stmt)){
        $Err = 'penalty added';
        echo $Err;
        exit();
    }

}

//searching for member regular loan member start here
if(isset($_GET['qparam']) && !empty($_GET['qparam']) && $_GET['qparam'] === 'MPCREgular@members'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $searchQuery = $_GET['queryKey'];

    $sql = "SELECT * FROM mpc_loan_member WHERE mem_phone LIKE '%$searchQuery%'";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "UNEXPECTED ERROR OCCUR, CONTACT DEVELOPER FOR HELP";
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
	?>
	<table class="table table-hover table-striped table-bordered ">


	<?php
    while($data = mysqli_fetch_array($d)){
        $name = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[4];
		$img = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[18];

		//each member repayment info mation
		$memberPhone = $data['mem_phone'];
        $memberId = $data['mem_id'];
        $sumwhereColumn1 = 'member_id';
        $sumwhereColumn2 = 'member_phone';
        $tb = 'mpc_loan_member_repayment';
        $sumColumn = 'amount_paid';

        $amountPaidAlreadyByMember = __mpc_member_totalPaid__($conn, $memberId, $memberPhone, $sumwhereColumn1, $sumwhereColumn2, $tb, $sumColumn);

		if($amountPaidAlreadyByMember == ''){
			$amountPaidAlreadyByMember = 0;
		}
		?>
		<tr>
			<td><?php echo $data['loan_id']?></td>
			<td><?php echo $name?></td>
			<td>
				<img src="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" alt="<?php echo $name?> picture" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" class="dboard-img">
			</td>
			<td>
				<select  class="qinfo adm-select repayType">
					<option value="">-----</option>
					<option value="weekly">WEEKLY</option>
					<option value="monthly">MONTHLY</option>
				</select>
			</td>
			<td title="Total amount paid by <?php echo $name?> &#8358; <?php echo $amountPaidAlreadyByMember?>">
				&#8358;<?php echo $amountPaidAlreadyByMember?>
			</td>
			<td>
				<input type="text" placeholder="Enter amount" class="setStyle mpc-qinfo regular-loanAmountReturn">
			</td>

			<td>
				<button class="mpc-btn mpc-regular-loan-saved" memberid="<?php echo $memberId?>" memberphone="<?php echo $memberPhone?>">Save payment</button>
			</td>

	</tr>
		<?php
    }
    echo "</table>";
}

//sendRepaymentMPCmeMbers member regular repyyment
if(isset($_POST['PERM']) && $_POST['PERM'] === 'sendRepaymentMPCmeMbers' && !empty($_POST['PERM'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    date_default_timezone_set('Africa/Lagos');
    $dateAndTime = date('d/m/y, h:i:s a');
    $monthbyname = date('F');
    $fullYear = date('Y');

    $memberPhone = $_POST['memberPhone'];
    $memberid = $_POST['memberId'];
    $cashCollector = $_POST['cashCollector'];

    $amountpaidByMember= $_POST['amountPaid'];
    $memberPaymentType = $_POST['paymentType'];
    $paymentIsmadeFor = $_POST['tblId'];
    $Branch = __mpcReturnByPhoneMember($conn, $memberPhone)[16]; //member branch by name


    ///paste starrt here
    $tbl = 'mpc_group_loan_request';
    $tblCol1 = 'mem_id';
    $tblCol2 = 'mem_phone';
    $selectedColumn = 'monthly_payment';
    $compareCol1 = $memberid;
    $compareCol2 = $memberPhone;
    $tbl = 'mpc_loan_member';
    $name = __mpcReturnByPhoneMember($conn, $memberPhone)[4];


    if($memberPaymentType === 'weekly'){

        $selectedColumnInterest = 'company_interest';

       $memberMontlyrepayment =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2) / 4;

        $CompanyInterest =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumnInterest, $compareCol1, $compareCol2) / 4;

    }else if($memberPaymentType === 'monthly'){
        $selectedColumnInterest = 'company_interest';

        $memberMontlyrepayment =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2);

        $CompanyInterest =  __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumnInterest, $compareCol1, $compareCol2);

    }

    //check to see if amount paid is less than what the system is expecting from member
    if($amountpaidByMember < $memberMontlyrepayment){
        $Err = "System is expecting &#8358; $memberMontlyrepayment from $name, </br>according to $memberPaymentType repayment schedule";
       echo $Err;
       exit();
    }

    //__mpc_earnings__($conn, $CompanyInterest, $monthbyname, $fullYear, $Branch); //recordd goodlife earning here
    $sql = "INSERT INTO mpc_loan_member_repayment (member_id, member_phone, amount_paid, paid_for_type, repayment_for_track, cash_collector, month_by_name, date_and_time, status)VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Unpexpected error";
        echo $Err;
        exit();
    }
    $status = 1;
    mysqli_stmt_bind_param($stmt, 'sssssssss', $memberid, $memberPhone, $amountpaidByMember, $memberPaymentType, $paymentIsmadeFor, $cashCollector, $monthbyname, $dateAndTime, $status);
    if(mysqli_stmt_execute($stmt)){

        __mpc_earnings__($conn, $CompanyInterest, $monthbyname, $fullYear, $Branch); //recordd goodlife earning here



        //if member payment total payment plus all penalties is equals to what he is supposed to pay
            //then the sysetm will mark him coplete automatic
            $sumColumn = 'amount_paid';
            $col1 = 'member_id';
            $col2 = 'member_phone';
            $tbl1 = 'mpc_loan_member_repayment';
            $totalAmountPaidByMember = __mpc_member_totalPaid__($conn, $memberid, $memberPhone, $col1, $col2, $tbl1, $sumColumn);

            $tbl2 = 'mpc_loan_member';
            $tb2Col1 = 'mem_id';
            $tb2Col2 = 'mem_phone';

            $totalAmountForMemberRepayment = __get_member_total_amountFor_repayment__($conn, $memberid, $memberPhone, $tbl2, $tb2Col1, $tb2Col2);

        //check and mark members loan has complete
        if($totalAmountPaidByMember >= $totalAmountForMemberRepayment){
            $status = 3;
            //UPDATE AND CHANGE LOAN STATUS TO 3 MEANS LOAN IS REPAYMENT IS COMPLETED
            $upd = "UPDATE mpc_loan_member SET loan_status='$status' WHERE mem_id='$memberid' && mem_phone='$memberPhone' ";
            mysqli_query($conn, $upd);

            //SECOND UPDATE HERE IS FOR LET THE SYSTEM KNOWS THAT MEMBER HAS COMPLETED ALL REPAYMENT PLUS PENALTY
            $stat2 = 0;
            $update = "UPDATE mpc_loan_member_repayment SET status='$stat2' WHERE member_id='$memberid' && member_phone='$memberPhone'";

            //running update on last table let everything on the system understand that member has compted all repayment
            $update3 = "UPDATE mpc_loan_approval_info SET status='$stat2' WHERE member_id='$memberPhone' && member_phone='$memberid'";
            mysqli_query($conn, $update3);
        }
    }

}

//function that find loan transaction
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'mpcLoanTransactionFilter'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

     $q = $_GET['type'];
     if($_GET['type'] === 'Group'){
        $sql = "SELECT * FROM mpc_loan_approval_info WHERE loan_type !='Regular' ORDER BY approval_id DESC LIMIT 100";

     }else if($_GET['type'] === 'Regular'){

        $sql = "SELECT * FROM mpc_loan_approval_info WHERE loan_type !='Group' ORDER BY approval_id DESC LIMIT 100";

     }else if($_GET['type'] === 'All'){
        $sql = "SELECT * FROM mpc_loan_approval_info  ORDER BY approval_id DESC LIMIT 100";

     }

     $stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'LOAD FAILED';
		print $Err;
		exit();
	}
	//mysqli_stmt_bind_param($stmt,)
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
?>
    <table class="table table-border table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Profil</th>
            <th>type</th>
            <th>B. Amount</th>
            <th>R. Amount</th>
            <th>Approved by</th>
            <th>penalty</th>
            <th>Group</th>
            <th>Total paid</th>
        </tr>
    </thead>
<?php
	while ($data = mysqli_fetch_array($d)) {

		$name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4]; //member name
		$img = __mpcReturnByPhoneMember($conn, $data['member_phone'])[18]; //member profile picture
		$approvedBy = __mpcReturnByIdAll__($conn, $data['approved_by'])[1] .' '. __mpcReturnByIdAll__($conn, $data['approved_by'])[2]; //staff name who approved this loan firstname and lastname

        //getting total amount paid by members
		if($data['loan_type'] === 'Group'){
			$tbl = 'mpc_group_loan_repayment';
			$tblCol = $data['approved_loan_tbl_id'];
			$sumColumnName = 'amount_paid';

			$amountPaid = __sum_member_eachLOAN($conn, $data['member_id'], $data['member_phone'], $tblCol, $sumColumnName, $tbl);
			if($amountPaid < 0 || $amountPaid == ''){
				$amountPaid = 0;
			}

		}else {
			$tbl = 'mpc_loan_member_repayment';
			$tblCol = $data['approved_loan_tbl_id'];
			$sumColumnName = 'amount_paid';

			$amountPaid = __sum_member_eachLOAN($conn, $data['member_id'], $data['member_phone'], $tblCol, $sumColumnName, $tbl);
			if($amountPaid < 0 || $amountPaid == ''){
				$amountPaid = 0;
			}
		}

		//get penalty
		$tb_id = $data['approved_loan_tbl_id'];
		if($data['loan_type'] === 'Group'){
			$sql1 = "SELECT penalty FROM mpc_group_loan_request WHERE group_loan_id='$tb_id'";
			$sql1Q = mysqli_query($conn, $sql1);
			$penalty = mysqli_fetch_assoc($sql1Q)['penalty'];

		}else if($data['loan_type'] === 'Regular'){
			$sql1 = "SELECT penalty FROM mpc_loan_member WHERE loan_id='$tb_id'";
			$sql1Q = mysqli_query($conn, $sql1);
			$penalty = mysqli_fetch_assoc($sql1Q)['penalty'];
		}
		?>
		<tr>
			<td><?php echo $data['approval_id']?></td>
			<td><?php echo $name?></td>
			<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" alt="" class="dboard-img" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>"></td>
			<td><?php echo $data['loan_type']?></td>
			<td class="rep">&#8358; <?php echo $data['total_amount']?></td>
			<td class="rep">&#8358; <?php echo $data['amount_to_return']?></td>
			<td><?php echo $approvedBy?></td>
			<td class="rep">&#8358; <?php echo $penalty?></td>
			<td><?php echo $data['loan_identifier']?></td>
			<td><?php echo $amountPaid?></td>
		</tr>
		<?php
	}
	?>
    </table>
<script>
	let allAmount = document.querySelectorAll('.rep');
		for (let x = 0; x < allAmount.length; x++) {
			var Amount, items, rtn;
			const item = allAmount[x].innerText;

			Amount = item.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

			rtn = document.querySelectorAll('.rep')[x];
			rtn.innerText = Amount;
		}
</script>
	<?php

}

//FILTER BY KEY SEARCH
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'filterWithMPCinpuT'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $key = $_GET['key'];
    $type = $_GET['type'];

    if($type === 'Regular'){
        $sql = "SELECT * FROM mpc_loan_approval_info WHERE member_phone LIKE '%$key%' && loan_type='$type'";
    }else if($type === 'Group'){
        $sql = "SELECT * FROM mpc_loan_approval_info WHERE loan_identifier LIKE '%$key%' && loan_type='$type'";
    }

    //code processor start here
    $stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'LOAD FAILED';
		print $Err;
		exit();
	}
	//mysqli_stmt_bind_param($stmt,)
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
?>
    <table class="table table-border table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Profil</th>
            <th>type</th>
            <th>B. Amount</th>
            <th>R. Amount</th>
            <th>Approved by</th>
            <th>penalty</th>
            <th>Group</th>
            <th>Amount paid</th>
        </tr>
    </thead>
<?php
	while ($data = mysqli_fetch_array($d)) {

		$name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4]; //member name
		$img = __mpcReturnByPhoneMember($conn, $data['member_phone'])[18]; //member profile picture
		$approvedBy = __mpcReturnByIdAll__($conn, $data['approved_by'])[1] .' '. __mpcReturnByIdAll__($conn, $data['approved_by'])[2]; //staff name who approved this loan firstname and lastname

 //getting total amount paid by members
 if($data['loan_type'] === 'Group'){
    $tbl = 'mpc_group_loan_repayment';
    $tblCol = $data['approved_loan_tbl_id'];
    $sumColumnName = 'amount_paid';

    $amountPaid = __sum_member_eachLOAN($conn, $data['member_id'], $data['member_phone'], $tblCol, $sumColumnName, $tbl);
    if($amountPaid < 0 || $amountPaid == ''){
        $amountPaid = 0;
    }

}else {
    $tbl = 'mpc_loan_member_repayment';
    $tblCol = $data['approved_loan_tbl_id'];
    $sumColumnName = 'amount_paid';

    $amountPaid = __sum_member_eachLOAN($conn, $data['member_id'], $data['member_phone'], $tblCol, $sumColumnName, $tbl);
    if($amountPaid < 0 || $amountPaid == ''){
        $amountPaid = 0;
    }
}

		//get penalty
		$tb_id = $data['approved_loan_tbl_id'];
		if($data['loan_type'] === 'Group'){
			$sql1 = "SELECT penalty FROM mpc_group_loan_request WHERE group_loan_id='$tb_id'";
			$sql1Q = mysqli_query($conn, $sql1);
			$penalty = mysqli_fetch_assoc($sql1Q)['penalty'];

		}else if($data['loan_type'] === 'Regular'){
			$sql1 = "SELECT penalty FROM mpc_loan_member WHERE loan_id='$tb_id'";
			$sql1Q = mysqli_query($conn, $sql1);
			$penalty = mysqli_fetch_assoc($sql1Q)['penalty'];
		}
		?>
		<tr>
			<td><?php echo $data['approval_id']?></td>
			<td><?php echo $name?></td>
			<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" alt="" class="dboard-img" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>"></td>
			<td><?php echo $data['loan_type']?></td>
			<td class="rep">&#8358; <?php echo $data['total_amount']?></td>
			<td class="rep">&#8358; <?php echo $data['amount_to_return']?></td>
			<td><?php echo $approvedBy?></td>
			<td class="rep">&#8358; <?php echo $penalty?></td>
			<td><?php echo $data['loan_identifier']?></td>
			<td class="rep"><?php echo $amountPaid?></td>
		</tr>
		<?php
	}
	?>
    </table>
<script>
	let amountcalc = document.querySelectorAll('.rep');
		for (let x = 0; x < amountcalc.length; x++) {
			var Amount, items, rtn;
			const item = amountcalc[x].innerText;

			Amount = item.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

			rtn = document.querySelectorAll('.rep')[x];
			rtn.innerText = Amount;
		}
</script>
	<?php
}

//search for deposit using reference code
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'Xquerympc'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $query = $_GET['Q'];

    $sql = "SELECT * FROM mpc_deposit_transaction WHERE depositor_phone LIKE '%$query%' || dep_reference LIKE '%$query%'";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "SEARCH ERROR";
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
?>
<table class="table table-border table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Account owner</th>
            <th>Account Number</th>
            <th>Amount deposit</th>
            <th>Deposit Account type</th>
            <th>Depositor Name</th>
            <th>Depositor Phone</th>
            <th>Reference code</th>
            <th>Time</th>

        </tr>
    </thead>
<?php
    while($data = mysqli_fetch_array($d)){
		$name = __mpcReturnByAccountMember($conn, $data['account_number'])[4];
?>
	<tr>
		<td><?php echo $data['deposit_id']?></td>
		<td><?php echo $name?></td>
		<td><?php echo $data['account_number']?></td>
		<td class="mpc-admGroup"><?php echo $data['deposit_amount']?></td>
		<td><?php echo $data['depositor_for']?></td>
		<td><?php echo $data['depositor']?></td>
		<td><?php echo $data['depositor_phone']?></td>
		<td><?php echo $data['dep_reference']?></td>
		<td><?php echo $data['time_date']?></td>
	</tr>
<?php
    }

    echo "</table>";

}

//function that allowed admin to pull out resources
//am trying to get account for all regular loan
if(isset($_GET['PERM']) && !empty($_GET['PERM']) &&  $_GET['PERM'] == 'mpcQueryLOad'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $sql = "SELECT * FROM mpc_loan_member ORDER BY loan_id DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Error loading Regular";
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);

    $whereToCount1 = 'regular';
    $groupName1 = date('F');
    $ColumntoDoCount1 = 'loan_amount';
    $TblId1 = 'loan_id';
    $tblColumn1 = 'loan_month';
    $tbl1 = 'mpc_loan_member';
?>
<table class="table table-border table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Profile</th>
            <th>Amount</th>
        </tr>
    </thead>
<?php

    $totalInRegularLoan = __mpc_totalDisburstment($conn, 'regular');

    while($data = mysqli_fetch_array($d)){
        $name = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[4];

        $imgPath = __mpc_root__() ."asset/img/". __mpcReturnByPhoneMember($conn, $data['mem_phone'])[18];

        ?>
        <tr>
            <td><?php echo $data['loan_id']?></td>
            <td><?php echo $name?></td>
            <td><img src="<?php echo $imgPath?>" srcset="<?php echo $imgPath?>" class="dboard-img"></td>
            <td>&#8358; <span class="amountEach"><?php echo $data['loan_amount']?></span></td>
        </tr>
        <?php
    }
    ?>
        <caption>TOTAL: &#8358; <span class="amountEach"><?php echo $totalInRegularLoan?></span></caption>
    <?php
echo "</table>";

}

if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'MPCgroupLOANdISBURSE'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $sql = "SELECT * FROM mpc_group_loan_request ORDER BY group_loan_id DESC";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = "Error loading Regular";
        echo $Err;
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);

?>
<table class="table table-border table-hover table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Profile</th>
            <th>Amount</th>
        </tr>
    </thead>
<?php

    $totalInRegularLoan = __mpc_totalDisburstment($conn, 'group');

    while($data = mysqli_fetch_array($d)){
        $name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4];

        $imgPath = __mpc_root__() ."asset/img/". __mpcReturnByPhoneMember($conn, $data['member_phone'])[18];

        ?>
        <tr>
            <td><?php echo $data['group_loan_id']?></td>
            <td><?php echo $name?></td>
            <td><img src="<?php echo $imgPath?>" srcset="<?php echo $imgPath?>" class="dboard-img"></td>
            <td>&#8358; <span class="amountEach"><?php echo $data['amount_requested']?></span></td>
        </tr>
        <?php
    }
    ?>
        <caption>TOTAL: &#8358; <span class="amountEach"><?php echo $totalInRegularLoan?></span></caption>
    <?php
echo "</table>";
}

//loading disbursement for earch category here
//regular and loan group loan
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'disbursementMonth'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

     $MonthByname = $_GET['monthname'];


//GROUP LOAN START HERE
$sql = "SELECT * FROM mpc_group_loan_request WHERE month_by_name LIKE '%$MonthByname%' ORDER BY group_loan_id DESC";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "Error loading Regular";
			echo $Err;
			exit();
		}
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);

		$whereToCount = 'group';
		$groupName = $MonthByname;
		$ColumntoDoCount = 'amount_requested';
		$TblId = 'group_loan_id';
		$tblColumn = 'month_by_name';
		$tbl = 'mpc_group_loan_request';


		$totalInRegularLoan = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $TblId, $tblColumn, $tbl);
?>

<div class="accout-sec-one group-mpc table-responsive">
	<table class="table table-border table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Profile</th>
				<th>Amount</th>
			</tr>
			</thead>


<?php

		while($data = mysqli_fetch_array($d)){
			$name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4];

			$imgPath = __mpc_root__() ."asset/img/". __mpcReturnByPhoneMember($conn, $data['member_phone'])[18];

			?>
			<tr>
				<td><?php echo $data['group_loan_id']?></td>
				<td><?php echo $name?></td>
				<td><img src="<?php echo $imgPath?>" srcset="<?php echo $imgPath?>" class="dboard-img"></td>
				<td>&#8358; <span class="amountEach"><?php echo $data['amount_requested']?></span></td>
			</tr>
			<?php
		}
		?>
			<caption>TOTAL: &#8358; <span class="amountEach"><?php echo $totalInRegularLoan?></span></caption>
		<?php
        echo "</table>
		</div>";



/**REGULAR LOAN START BELOW */
    $sql = "SELECT * FROM mpc_loan_member WHERE loan_month LIKE '%$MonthByname%' ORDER BY loan_id DESC";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "Error loading Regular";
			echo $Err;
			exit();
		}
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);

		$whereToCount1 = 'regular';
		$groupName1 = $MonthByname;
		$ColumntoDoCount1 = 'loan_amount';
		$TblId1 = 'loan_id';
		$tblColumn1 = 'loan_month';
		$tbl1 = 'mpc_loan_member';


		$totalInRegularLoan = __mpc_total_calculate__($conn, $whereToCount1, $groupName1, $ColumntoDoCount1, $TblId1, $tblColumn1, $tbl1);
?>

<div class="accout-sec-one group-mpc table-responsive">
	<table class="table table-border table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Profile</th>
				<th>Amount</th>
			</tr>
			</thead>


<?php

		while($data = mysqli_fetch_array($d)){
			$name = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[4];

			$imgPath = __mpc_root__() ."asset/img/". __mpcReturnByPhoneMember($conn, $data['mem_phone'])[18];

			?>
			<tr>
				<td><?php echo $data['loan_id']?></td>
				<td><?php echo $name?></td>
				<td><img src="<?php echo $imgPath?>" srcset="<?php echo $imgPath?>" class="dboard-img"></td>
				<td>&#8358; <span class="amountEach"><?php echo $data['loan_amount']?></span></td>
			</tr>
			<?php
		}
		?>
			<caption>TOTAL: &#8358; <span class="amountEach"><?php echo $totalInRegularLoan?></span></caption>
		<?php
        echo "</table>
		</div>";


}

//FILTER GROUP REPAYMENT
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'FILTERPARams'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

      $MonthByname = $_GET['mpcLastkey'];

    if($MonthByname === 'GROUP'){
?>
<table class="table table-bordered table-hover table-striped ">
    <thead>
        <tr>
            <th>#</th>
            <th title="MEMBER GROUP">Group</th>
            <th title="MEMBER NAME">Member Name</th>
            <th title="MEMBER PROFILE">Profile</th>
            <th title="BORROWED AMOUNT BY MEMBER">B. Amount</th>
            <th title="MONTLY RETURN">M. return</th>
            <th title="WEEKLY RETURN">W. return</th>
            <th title="MEMBER PENALTY">penalty</th>
            <th title="TOTAL AMOUNT MEMBER TO RETURN">Total</th>
            <th title="TOTAL AMOUNT PAID BY MEMBER">Paid</th>
            <th title="OUTSTANDING AMOUNT">Outstanding</th>
        </tr>
    </thead>
<?php
        $type = 'group';
        $month = date('F');
        __mpc_collectSheet__($conn, $type, $month);

    echo "</table>";



    }else {
        ?>
<table class="table table-bordered table-hover table-striped ">
    <thead>
        <tr>
            <th>#</th>
            <!--th title="MEMBER GROUP">Group</th-->
            <th title="MEMBER NAME">Member Name</th>
            <th title="MEMBER PROFILE">Profile</th>
            <th title="BORROWED AMOUNT BY MEMBER">B. Amount</th>
            <th title="MONTLY RETURN">M. return</th>
            <th title="WEEKLY RETURN">W. return</th>
            <th title="MEMBER PENALTY">penalty</th>
            <th title="TOTAL AMOUNT MEMBER TO RETURN">Total</th>
            <th title="TOTAL AMOUNT PAID BY MEMBER">Paid</th>
            <!--th title="LOAN ACTIVE MONTH ">Active Month</th-->
            <th title="OUTSTANDING AMOUNT">Outstanding</th>
        </tr>
    </thead>
<?php
        $type = 'regular';
        $month = date('F');
        __mpc_collectSheet__($conn, $type, $month);

    echo "</table>";
    }

}

//MPC COLLECTION SHEET QUERY USING INPUT SEARCH
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'cSHEEtfilter'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

     $searchQuery = strtolower($_GET['key1']);
     $selectionType = $_GET['key2']; //return group || reqular

     if($selectionType === 'GROUP'){
        if($searchQuery === 'all'){
            $sql = "SELECT * FROM mpc_group_loan_request ORDER BY group_loan_id DESC LIMIT 100";
        }else{
            $sql = "SELECT * FROM mpc_group_loan_request WHERE month_by_name LIKE '%$searchQuery%' LIMIT 100";
        }
        //regular processor start here
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $Err = "SQL query ERROR";
            echo $Err;
        }
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);
        ?>
        <table class="table table-bordered table-hover table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th title="MEMBER GROUP">Group</th>
                    <th title="MEMBER NAME">Member Name</th>
                    <th title="MEMBER PROFILE">Profile</th>
                    <th title="BORROWED AMOUNT BY MEMBER">B. Amount</th>
                    <th title="MONTLY RETURN">M. return</th>
                    <th title="WEEKLY RETURN">W. return</th>
                    <th title="MEMBER PENALTY">penalty</th>
                    <th title="TOTAL AMOUNT MEMBER TO RETURN">Total</th>
                    <th title="TOTAL AMOUNT PAID BY MEMBER">Paid</th>
                    <th title="Outstanding amount">Outstandig</th>
                </tr>
            </thead>
        <?php
        while($data = mysqli_fetch_array($d)){
			$name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4];
			$imgPath = __mpc_root__() . 'asset/img/' .__mpcReturnByPhoneMember($conn, $data['member_phone'])[18];


			//below is payment info for member
        //i mean amount return by each group member
        $memberPhone = $data['member_phone'];
        $memberId = $data['member_id'];
        $sumwhereColumn1 = 'member_id';
        $sumwhereColumn2 = 'member_phone';
        $tb = 'mpc_group_loan_repayment';
        $sumColumn = 'amount_paid';

        $amountPaidAlreadyByMember = __mpc_member_totalPaid__($conn, $memberId, $memberPhone, $sumwhereColumn1, $sumwhereColumn2, $tb, $sumColumn);
		if($amountPaidAlreadyByMember == '' || $amountPaidAlreadyByMember < 0){
			$amountPaidAlreadyByMember = 0;
		}
		/**GETTING MEMBERS REPAYMENT TOTAL
			 * MEMBER ID, MEMBER PHONE
			 * TBL NAME, COL1, COL2
			 */
			$memberid = $data['member_id'];
			$memberphone = $data['member_phone'];
			$tbl = 'mpc_group_loan_request';
			$col1 = 'member_id';
			$col2 = 'member_phone';

			$TotalRepayment = __get_member_total_amountFor_repayment__($conn, $memberid, $memberphone, $tbl, $col1, $col2);

			?>
			<tr>
				<td><?php print $data['group_loan_id']?></td>
				<td title="<?php echo $name?> is a member of <?php print $data['member_group_name']?>"><?php print $data['member_group_name']?></td>
				<td title="<?php echo $name?>"><?php print $name?></td>
				<td title="<?php echo $name?>'s picture"><img src="<?php print $imgPath?>" alt="pics" srcset="<?php print $imgPath?>" class="dboard-img"></td>
				<td title="<?php echo $name?> requested for &#8358; <?php  echo $data['amount_requested']?>">&#8358; <span class="amountEach"><?php echo $data['amount_requested']?></span></td>
				<td title="<?php echo $name?> is to return &#8358; <?php echo $data['member_m_repay']?> in a monthly shedule">&#8358; <span class="amountEach"><?php echo $data['member_m_repay']?></span></td>
				<td title="<?php echo $name?> is to return &#8358; <?php echo $data['member_m_repay'] / 4?> in a weekly shedule"> &#8358; <span class="amountEach"><?php echo $data['member_m_repay'] / 4?></span></td>
				<td title="<?php echo $name?> total penalty is &#8358; <?php echo $data['penalty']?>">&#8358; <span class="amountEach"><?php echo $data['penalty']?></span></td>
				<td title="<?php echo $name?> total Repayment plus penalty is &#8358; <?php echo $TotalRepayment?>">&#8358; <span class="amountEach"><?php echo $TotalRepayment?></span></td>
				<td title="<?php echo $name?> paid &#8358; <?php echo $amountPaidAlreadyByMember?>">&#8358; <span class="amountEach"><?php echo $amountPaidAlreadyByMember?></span></td>
				<td title="<?php echo $name?> Outstanding amount &#8358; <?php echo $TotalRepayment - $amountPaidAlreadyByMember?>">&#8358; <span class="amountEach"><?php echo $TotalRepayment - $amountPaidAlreadyByMember?></span></td>
			</tr>
			<?php
		}
        echo "</table>";

        //GROUP LOAN QUERY ENDS HERE
     }else if($selectionType === 'REGULAR'){

        //check to know what admin is saying
        if($searchQuery === 'all'){
            $sql = "SELECT * FROM mpc_loan_member ORDER BY loan_id DESC LIMIT 100";

        }else{
            $sql = "SELECT * FROM mpc_loan_member WHERE loan_month LIKE '%$searchQuery%' ORDER BY loan_month DESC LIMIT 100";
        }

        //regular processor start here
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $Err = "SQL query ERROR";
            echo $Err;
        }
        mysqli_stmt_execute($stmt);
        $d = mysqli_stmt_get_result($stmt);
?>
<table class="table table-bordered table-hover table-striped ">
    <thead>
        <tr>
            <th>#</th>
            <!--th title="MEMBER GROUP">Group</th-->
            <th title="MEMBER NAME">Member Name</th>
            <th title="MEMBER PROFILE">Profile</th>
            <th title="BORROWED AMOUNT BY MEMBER">B. Amount</th>
            <th title="MONTLY RETURN">M. return</th>
            <th title="WEEKLY RETURN">W. return</th>
            <th title="MEMBER PENALTY">penalty</th>
            <th title="TOTAL AMOUNT MEMBER TO RETURN">Total</th>
            <th title="TOTAL AMOUNT PAID BY MEMBER">Paid</th>
            <th title="OUTSTANDING AMOUNT ">Outstanding</th>
        </tr>
    </thead>
<?php
        while($data = mysqli_fetch_array($d)){
			$name = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[4];
			$imgPath = __mpc_root__() . 'asset/img/' .__mpcReturnByPhoneMember($conn, $data['mem_phone'])[18];


			//below is payment info for member
        //i mean amount return by each group member
        $memberPhone = $data['mem_phone'];
        $memberId = $data['mem_id'];
        $sumwhereColumn1 = 'member_id';
        $sumwhereColumn2 = 'member_phone';
        $tb = 'mpc_loan_member_repayment';
        $sumColumn = 'amount_paid';

        $amountPaidAlreadyByMember = __mpc_member_totalPaid__($conn, $memberId, $memberPhone, $sumwhereColumn1, $sumwhereColumn2, $tb, $sumColumn);
		if($amountPaidAlreadyByMember == '' || $amountPaidAlreadyByMember < 0){
			$amountPaidAlreadyByMember = 0;
		}
		/**GETTING MEMBERS REPAYMENT TOTAL
			 * MEMBER ID, MEMBER PHONE
			 * TBL NAME, COL1, COL2
			 */
			$memberid = $data['mem_id'];
			$memberphone = $data['mem_phone'];
			$tbl = 'mpc_loan_member';
			$col1 = 'mem_id';
			$col2 = 'mem_phone';

			$TotalRepayment = __get_member_total_amountFor_repayment__($conn, $memberid, $memberphone, $tbl, $col1, $col2);

			?>
			<tr>
				<td><?php print $data['mem_id']?></td>
				<!--td title="<?php echo $name?> is a member of <?php //print $data['member_group_name']?>"><?php // print $data['member_group_name']?></td-->
				<td title="<?php echo $name?>"><?php print $name?></td>
				<td title="<?php echo $name?>'s picture"><img src="<?php print $imgPath?>" alt="pics" srcset="<?php print $imgPath?>" class="dboard-img"></td>
				<td title="<?php echo $name?> requested for &#8358; <?php  echo $data['loan_amount']?>">&#8358; <span class="amountEach"><?php echo $data['loan_amount']?></span></td>
				<td title="<?php echo $name?> is to return &#8358; <?php echo $data['monthly_payment']?> in a monthly shedule">&#8358; <span class="amountEach"><?php echo $data['monthly_payment']?></span></td>
				<td title="<?php echo $name?> is to return &#8358; <?php echo $data['monthly_payment'] / 4?> in a weekly shedule"> &#8358; <span class="amountEach"><?php echo $data['monthly_payment'] / 4?></span></td>
				<td title="<?php echo $name?> total penalty is &#8358; <?php echo $data['penalty']?>">&#8358; <span class="amountEach"><?php echo $data['penalty']?></span></td>
				<td title="<?php echo $name?> total Repayment plus penalty is &#8358; <?php echo $TotalRepayment?>">&#8358; <span class="amountEach"><?php echo $TotalRepayment?></span></td>
				<td title="<?php echo $name?> paid &#8358; <?php echo $amountPaidAlreadyByMember?>">&#8358; <span class="amountEach"><?php echo $amountPaidAlreadyByMember?></span></td>
				<td title="<?php echo $name?> Outstanding amount is &#8358; <?php echo $TotalRepayment - $amountPaidAlreadyByMember?>">&#8358; <span class="amountEach"><?php echo $TotalRepayment - $amountPaidAlreadyByMember?></span></td>


			</tr>
			<?php
		}
        echo "</table>";

     }


}

//getting saving notifcation
if(isset($_GET['PERM']) && !empty($_GET['PERM']) && $_GET['PERM'] === 'mpcTestimony'){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $name = $_GET['k'];
    $msg = $_GET['k1'];

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_member_testimony WHERE testifier='$name' && status='0' "))>0){

        print $Err = "Thanks for your message, we are still reviewing your message!";
        exit();
    }

    $sql = "INSERT INTO mpc_testimony (name, message, status)VALUES ('$name', '$msg', '0')";
    if(mysqli_query($conn, $sql)){
        $Err = "Testimony saved";
        echo $Err;
        $notTxt = "<h4>member testimony</h4>";
        $notTxt .= "<h6>There is a new user testimony that need to be review before approving.<h6>";
        $notTxt .= "<h6>At default member/all testimony is in a pending mood till you approved it</h6>";

        $notFor = __mpcReturnByIdAll__($conn, 1)[4];
        $notForId = __mpcReturnByIdAll__($conn, 1)[0];

        __mpc_notify__($conn, $notTxt, 5, $notFor, $notForId, 0, 0, '@MPC SELF SEND');
        exit();
    }
}


//handle system settings here
if(isset($_GET['systemSettings'])){
 //   header("Content-Type: application/json; charset=UTF-8");

    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
   // require_once dirname(__DIR__) ."/functions/mpc-func.php";
    require_once dirname(__DIR__) ."/functions/mpc-class.php";

    $data = json_decode(file_get_contents('php://input'), true);
   // echo json_encode(['msg' => 'manful', 'err' => 'computer']);
  //  echo json_encode("manful computer");
   //  http_response_code(400);
    $appShort = $data['appSHORT'];
    $appLONG = $data['appLONG'];
    $appTITLE = $data['appTitle'];



    $ins = new NewSettings;

    $result = $ins->SystemSettins('mpc_system_info', $appShort, $appLONG, $appTITLE, $conn);

    if($result){
         echo json_encode(['msg'=> 'ACTION PROSESSED SUCCESSFUL', 'code' => 200]);
    }else{
        echo json_encode(['msg' => 'ACTION FAILED, DUE TO UNEXPECTED ERROR', 'code' => 4400]);
    }

}

//company logo upload here
if(isset($_FILES['logoUpload'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-class.php";   
    $fileName = $_FILES['logoUpload']['name'];
    $fileSize = $_FILES['logoUpload']['size'];
    $fileType = $_FILES['logoUpload']['type'];
    $fileError = $_FILES['logoUpload']['error'];
    $fileLoc = $_FILES['logoUpload']['tmp_name'];



    $size = 1000000;
    $allowFile = ['png', 'jpg', 'jpeg', 'ico'];
    $uploadDir = '../asset/img/';
    $file_ext = explode('.', $fileName);
    $fileRealExt = strtolower(end($file_ext));

    $newName = time(). '.'.$fileRealExt;
    $err;
    $moveFile = $uploadDir . $newName;
//error if file size is morethan allow size
    if($fileSize > $size){
        $err = 'file size error, fileSize is '. $fileSize . 'kb';
        echo json_encode(['msg'=> $err, 'code'=> '#4100']);

        die();
    }
// $file_ext;
    if(!in_array($fileRealExt, $allowFile)){
        $err = 'file not allowed';
        echo json_encode(['msg'=> $err, 'code'=> '#4200']);
        die();
    }

    if($fileError !== 0){
        $err = "Unexpected error, try again later";
        echo json_encode(['msg'=> $err, 'code'=> '#4300']);

        die();
    }


    $systemId = new NewSettings;


     if($systemId->getSystemLogo($conn)[0] === 'logo.png'){
    //     $sql = "UPDATE mpc_general_settings SET COMPANY_LOGO='$newName' WHERE settings_id=1";

        if($systemId->updateSystemLogo($conn, 'logo', $newName)){

            //upload logo now
            if(move_uploaded_file($fileLoc, $moveFile)){
                echo json_encode(['msg' => 'Application logo update successful', 'code'=> 200]);
            }else {
                echo json_encode(['msg'=> 'Database update failed', 'code'=> '#4000']);
            }
        }
       // echo "nooo";
     }else {
       // echo "yess";
        $delete = $uploadDir . $systemId->getSystemLogo($conn)[0]; //delete previous logo out
        if(unlink($delete)){
            if($systemId->updateSystemLogo($conn, 'logo', $newName)){

                if(move_uploaded_file($fileLoc, $moveFile)){
                    echo json_encode(['msg' => 'Application logo update successful', 'code'=> 200]);
                }else {
                    echo json_encode(['msg'=> 'Database update failed', 'code'=> '#4000']);
                }
            }
        }

     }
    
}


if(isset($_FILES['SYSTEMFAVICON'])){
    
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-class.php";   
    $fileName = $_FILES['SYSTEMFAVICON']['name'];
    $fileSize = $_FILES['SYSTEMFAVICON']['size'];
    $fileType = $_FILES['SYSTEMFAVICON']['type'];
    $fileError = $_FILES['SYSTEMFAVICON']['error'];
    $fileLoc = $_FILES['SYSTEMFAVICON']['tmp_name'];

    $size = 1000000;
    $allowFile = ['png', 'jpg', 'jpeg', 'ico'];
    $uploadDir = '../asset/img/';
    $file_ext = explode('.', $fileName);
    $fileRealExt = strtolower(end($file_ext));

    $newName =  'favicon.'.$fileRealExt;
    $err;
    $moveFile = $uploadDir . $newName;
//error if file size is morethan allow size
    if($fileSize > $size){
        $err = 'file size error, fileSize is '. $fileSize . 'kb';
        echo json_encode(['msg'=> $err, 'code'=> '#4100']);

        die();
    }
// $file_ext;
    if(!in_array($fileRealExt, $allowFile)){
        $err = 'file not allowed';
        echo json_encode(['msg'=> $err, 'code'=> '#4200']);
        die();
    }

    if($fileError !== 0){
        $err = "Unexpected error, try again later";
        echo json_encode(['msg'=> $err, 'code'=> '#4300']);

        die();
    }


    $systemId = new NewSettings;


   // if($systemId->getSystemLogo($conn)[0] === 'logo.png'){
    //     $sql = "UPDATE mpc_general_settings SET COMPANY_LOGO='$newName' WHERE settings_id=1";

        if($systemId->updateSystemLogo($conn, 'FAVICON', $newName)){

            //upload logo now
            if(move_uploaded_file($fileLoc, $moveFile)){
                echo json_encode(['msg' => 'Application FAVICON update successful', 'code'=> 200]);
            }else {
                echo json_encode(['msg'=> 'Database update failed', 'code'=> '#4000']);
            }
        }
       
    // }

}

//update website social media links
if(isset($_POST['urlParam']) && $_POST['urlParam'] !== '' /*&& $_GET['urlParam'] == 'SOCIALlinks'*/){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-class.php";

    //header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
    //$data = json_decode(file_get_contents('php://input'), false);
    $data = json_decode($_POST['urlParam'], false);

    $facebook = $data->Facebook;
    $whatsapp = $data->Whatsapp;
    $instagram = $data->Instagram;
    $twitter = $data->Twitter;
    $youtube = $data->Youtube;
    $linkedin = $data->Linkedin;
    
    $update = new socialUpdate($conn, $facebook, $whatsapp, $instagram, $twitter, $youtube, $linkedin);
    if($update->updateSocialLink()){
        echo json_encode(['msg' => 'Social Media link update successful', 'code'=> '#MPC200']);
    }else{
        echo json_encode(['msg' => 'Social media link update failed, unexpected error occur please try again!', 'code'=> '#MPC301']);
    }
}

//this function here will update good life mpcs mandate form
if(isset($_POST['requestSender']) && $_POST['requestSender'] !== ''){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    require_once dirname(__DIR__) ."/config/conn.php";

    $data = json_decode($_POST['requestSender'], false);

   // $firstname = $_POST['firstinput'];
    date_default_timezone_set('Africa/Lagos');
    $dte = $dtime = date('d/n/Y, g:i:s a');

    $share = $data->shares;
    $thrift = $data->thrift;
    $special = $data->special;
    $memberId = $data->memberId;
    $memberphone = $data->memberPhone;

    $sql = "INSERT INTO mpc_member_mandate (mandate_user_id, mandate_for_phone, shares, thrift_saving, special_saving, date_time)VALUES('$memberId', '$memberphone', '$share', '$thrift', '$special', '$dte')";

    if($conn->query($sql)){
        echo "Success";
        die();
    }
}


//admin search for member with missing data
if(isset($_POST['Xmlsdata']) && $_POST['Xmlsdata'] !== '')
{
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-func.php";

    $data = $_POST['Xmlsdata'];
//lga LIKE '%$data%'


    $sql = "SELECT * FROM mpc_members WHERE name LIKE '%$data%' || phone LIKE '%$data%' || occupation LIKE '%$data%' || registration_number LIKE '%$data%'";

    $stmt = $conn->query($sql);

    print_r(mysqli_error($conn));
    ?>
<table class="table table-bordered border-dark table-striped table-hover">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Profile</th>
        <th>Department</th>
        <th>Staff ID</th>
        <!-- <th>#</th> -->
    </thead>

    <?php

    while ($data = $stmt->fetch_assoc()) {
    $ph = $data['phone'];
    $id = $data['members_id'];
    $tx = "sal34rl34lcl3l4ljcsdlklfasldflllsdfjasdlfljsdljfaldlfasdlfljsdr9345304034owsljesadlflasdjflsldfjasldfjoewurowelaslkdslkajldflasdjfsdo43904uaslksldsdfois97asdokasdfolsadkf";
	$tx .= "salldfll34l3lsldasdmanful_computer&kdklasdlflluiu34o992302lkkdk9430weqwopwerqwerqqqd3344uyo";
	$a = bin2hex($tx);
    // $a = bin2hex(random_byte(70));
$link = __mpc_root__()."user/dashboard.php/?a=$a&action=Settings&r=missingData&v=$ph&id=$id";
?>
<tr>
    <td><?php echo $data['members_id']?></td>
    <td><a href="<?php echo $link?>"><?php echo $data['name']?></a></td>
    <td><img style="width: 60px;height: 60px;" src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" class="__system_notice__"></td>
    <td><?php echo $data['lga']?></td>
    <td><?php echo $data['registration_number']?></td>
</tr>

<?php
    }

    echo "</table>";
}

//special saving
if(isset($_POST['XsmsSpecial']) && !empty($_POST['XsmsSpecial']))
{
     define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-func.php";

    $data = json_decode($_POST['XsmsSpecial'], false);

    $uid = $data->uid;    
    $phone = $data->phone; 

    $date = $data->date;    
    $debit = $data->debit;    
    $credit = $data->credit;   

$tbl = "mpc_special_saving";
$tblCol1 = 'mem_id'; //col1
$tblCol2 = 'mem_phone'; //col2
$tid = 'special_id';

if($credit == 0){
    $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1, $tblCol2, $tid)[2] - $debit;

}else if($debit == 0){
$balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1, $tblCol2, $tid)[2] + $credit;

}


    $sql = "SELECT * FROM mpc_special_saving WHERE mem_id='$uid' && mem_phone='$phone'";

    $st1 = $conn->query($sql);
    // if($st1->num_rows > 1 ){
    $row = $st1->fetch_assoc();

        if($row['debit'] == 0 && $row['credit'] == 0 && $row['balance'] == 0)
        {
            $upSql = "UPDATE mpc_special_saving SET debit='$debit', credit='$credit', balance='$balance', date_time='$date' WHERE mem_id='$uid' && mem_phone='$phone'";

            if($conn->query($upSql)){
                echo json_encode(['msg' => 'Record added successful', 'code' => 200, 'bal' => $balance]);
            }
            exit();

        }

    $sql = "INSERT INTO mpc_special_saving (mem_id, mem_phone, debit, credit, balance, date_time)VALUES('$uid', '$phone', '$debit', '$credit', '$balance', '$date')";
    $stmt = $conn->query($sql);


    if($stmt){
        echo json_encode(['msg' => 'Record added successful', 'code' => 200, 'bal' => $balance]);
    }else{
        echo json_encode(['msg' => 'Record add fail', 'code' => 400]);
    }
}

//SHARES SAVING START HERE
//special saving
if(isset($_POST['XsmsSharesSaving']) && !empty($_POST['XsmsSharesSaving']))
{
     define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-func.php";

    $data = json_decode($_POST['XsmsSharesSaving'], false);

    $uid = $data->uid;    
    $phone = $data->phone; 

    $date = $data->date;    
    $debit = $data->debit;    
    $credit = $data->credit;   

$tbl = "mpc_account_shares";
$tblCol1 = 'shares_member_id'; //col1
$tblCol2 = 'shares_member_phone'; //col2
$tid = 'shares_id';

if($credit == 0){
    $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1, $tblCol2, $tid)[2] - $debit;

}else if($debit == 0){
$balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1, $tblCol2, $tid)[2] + $credit;

}


    $sql = "SELECT * FROM mpc_account_shares WHERE shares_member_id='$uid' && shares_member_phone='$phone'";

    $st1 = $conn->query($sql);
    // if($st1->num_rows > 1 ){
    $row = $st1->fetch_assoc();

        if($row['debit'] == 0 && $row['credit'] == 0 && $row['balance'] == 0)
        {
            $upSql = "UPDATE mpc_account_shares SET debit='$debit', credit='$credit', balance='$balance', date_time='$date' WHERE shares_member_id='$uid' && shares_member_phone='$phone'";

            if($conn->query($upSql)){
                echo json_encode(['msg' => 'Record added successful', 'code' => 200, 'bal' => $balance]);
            }
            exit();

        }

    $sql = "INSERT INTO mpc_account_shares (shares_member_id, shares_member_phone, debit, credit, balance, date_time)VALUES('$uid', '$phone', '$debit', '$credit', '$balance', '$date')";
    $stmt = $conn->query($sql);


    if($stmt){
        echo json_encode(['msg' => 'Record added successful', 'code' => 200, 'bal' => $balance]);
    }else{
        echo json_encode(['msg' => 'Record add fail', 'code' => 400]);
    }
}

//THRIFT SAVING START HERE
//THRIFT saving
if(isset($_POST['XsmsThriftSaving']) && !empty($_POST['XsmsThriftSaving']))
{
     define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-func.php";

    $data = json_decode($_POST['XsmsThriftSaving'], false);

    $uid = $data->uid;    
    $phone = $data->phone; 

    $date = $data->date;    
    $debit = $data->debit;    
    $credit = $data->credit;   

$tbl = "mpc_thrift_saving";
$tblCol1 = 'thrift_mem_id'; //col1
$tblCol2 = 'thrift_mem_phone'; //col2
$tid = 'thrift_id';

if($credit == 0){
    $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1, $tblCol2, $tid)[2] - $debit;

}else if($debit == 0){
$balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1, $tblCol2, $tid)[2] + $credit;

}


    $sql = "SELECT * FROM mpc_thrift_saving WHERE thrift_mem_id='$uid' && thrift_mem_phone='$phone'";

    $st1 = $conn->query($sql);
    // if($st1->num_rows > 1 ){
    $row = $st1->fetch_assoc();

        if($row['debit'] == 0 && $row['credit'] == 0 && $row['balance'] == 0)
        {
            $upSql = "UPDATE mpc_thrift_saving SET debit='$debit', credit='$credit', balance='$balance', date_time='$date' WHERE thrift_mem_id='$uid' && thrift_mem_phone='$phone'";

            if($conn->query($upSql)){
                echo json_encode(['msg' => 'Record added successful', 'code' => 200, 'bal' => $balance]);
            }
            exit();

        }

    $sql = "INSERT INTO mpc_thrift_saving (thrift_mem_id, thrift_mem_phone, debit, credit, balance, date_time)VALUES('$uid', '$phone', '$debit', '$credit', '$balance', '$date')";
    $stmt = $conn->query($sql);


    if($stmt){
        echo json_encode(['msg' => 'Record added successful', 'code' => 200, 'bal' => $balance]);
    }else{
        echo json_encode(['msg' => 'Record add fail', 'code' => 400]);
    }
}


//paste star hre

//query user
if(isset($_POST['SendingSeach']) && !empty($_POST['SendingSeach'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    require_once dirname(__DIR__) ."/config/conn.php";
    require "mpc-func.php";

    $data = json_decode($_POST['SendingSeach'], false);

    $sql = "SELECT *
            FROM mpc_members
            WHERE name LIKE '%$data->search%' || 
            phone LIKE '%$data->search%' ||
            registration_number LIKE '%$data->search%'";
    $stmt = $conn->query($sql);
?>
<table class="table table-hover table-striped table-border">
    <thead>
        <th>#</th>
        <th>Name</th>
        <th>Account No.</th>
        <th>Profile</th>
        <th></th>
        <!-- <th>#</th> -->
    </thead>
<?php
    while($data = $stmt->fetch_assoc()){
	$imgPath  = __mpc_root__() ."asset/img/" . $data['user_profile'];

?>
<tr>
    <td><?php echo $data['members_id']?></td>
    <td><?php echo $data['name']?></td>
    <td><?php echo $data['registration_number']?></td>
    <td><img src="<?php print $imgPath?>" class="dboard-img" title="<?php echo $data['user_profile']?>" srcset="<?php print $imgPath?>"></td>
    <td>
        <button class="mpc-btn add-memberTodebit" name="<?php echo $data['name']?>" acc="<?php echo $data['registration_number']?>" uid="<?php echo $data['members_id']?>" ph="<?php echo $data['phone']?>">Add</button>
    </td>
</tr>
<?php
    }
}


//get my balance ere
if(isset($_GET['DXLS']) && !empty($_GET['DXLS'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    require_once dirname(__DIR__) ."/config/conn.php";
    require "mpc-func.php";
    
    $data = json_decode($_GET['DXLS'], false);
    $Account = $data->Account;
    $uid = $data->uid;
    $phone = $data->phone;

    if($Account == 'SHARES'){
        $tbl = "mpc_account_shares";
        $col1 = 'shares_member_id';
        $col2 = 'shares_member_phone';
        $incr = 'shares_id';

    }else if($Account == 'THRIFT'){
        $tbl = "mpc_thrift_saving";
        $col1 = 'thrift_mem_id';
        $col2 = 'thrift_mem_phone';
        $incr = 'thrift_id';
    }else if($Account == 'SPECIAL'){
        $tbl = "mpc_special_saving";
        $col1 = 'mem_id';
        $col2 = 'mem_phone';
        $incr = 'special_id';
    }else if($Account == 'FIXED'){
        $tbl = "mpc_fixed_deposit";
        $col1 = 'fixed_mem_id';
        $col2 = 'fixed_mem_phone';
        $incr = 'mpc_fixed_id';
    }else if($Account == 'WELFARE'){
        $tbl = "mpc_welfare_contribution";
        $col1 = 'welfare_mem_id';
        $col2 = 'welfare_mem_phone';
        $incr = 'welfare_id';
    }

    //getting member balance
    $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $col1, $col2, $incr)[2];

    echo json_encode(['balance' => $balance, 'status' => 200]);

    die;
}

//process members account debit info
if(isset($_POST['debitThatFuckenMember']) && !empty($_POST['debitThatFuckenMember']))
{
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    require_once dirname(__DIR__) ."/config/conn.php";
    require "mpc-func.php";
    
    $data = json_decode($_POST['debitThatFuckenMember'], false);

    $uid = $data->uid;
    $phone = $data->phone;
    $balance = $data->balance;
    $debit = $data->debit;
    $debitor = $data->debitorId;
    $reasonForDebit = $data->reasonForDebit;
    $accountType = $data->accountType;
    $accountDigit = $data->accountDigit;

    if($accountType == 'SHARES'){
        $tbl = "mpc_account_shares";
        $col1 = 'shares_member_id';
        $col2 = 'shares_member_phone';
        $incr = 'shares_id';

    }else if($accountType == 'THRIFT'){
        $tbl = "mpc_thrift_saving";
        $col1 = 'thrift_mem_id';
        $col2 = 'thrift_mem_phone';
        $incr = 'thrift_id';
    }else if($accountType == 'SPECIAL'){
        $tbl = "mpc_special_saving";
        $col1 = 'mem_id';
        $col2 = 'mem_phone';
        $incr = 'special_id';
    }else if($accountType == 'FIXED'){
        $tbl = "mpc_fixed_deposit";
        $col1 = 'fixed_mem_id';
        $col2 = 'fixed_mem_phone';
        $incr = 'mpc_fixed_id';
    }else if($accountType == 'WELFARE'){
        $tbl = "mpc_welfare_contribution";
        $col1 = 'welfare_mem_id';
        $col2 = 'welfare_mem_phone';
        $incr = 'welfare_id';
    }

    //configure correct date and time here
    $tzne = date_default_timezone_set('Africa/Lagos');
    $dtime = date('d/n/Y, g:i:s a');
    $dtme = date('Y-m-d g:i:s');

    $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $col1, $col2, $incr)[2];

    if($balance == 0)
    {
        echo json_encode(['msg' => 'Transaction Decline, insufficient amount on this account', 'code', 3200]);
        die;
    }

    $newBalance = $balance - $debit; //DEBIT MEMBERS ACCOUNT AND RETURN NEW BALANCE
    $crdt = 0;

    $sql = "INSERT INTO $tbl 
                ($col1, $col2, debit, credit, balance, date_time)
                VALUES(?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssss', $uid, $phone, $debit, $crdt, $newBalance, $dtime);
    $exe = $stmt->execute();
    if($exe){
        $ins = "INSERT INTO mpc_debit_info 
                (debit_owner_id, debit_owner_ph, account_no, debit_account_type, 
                debit_officer, debit_amount, date_time, description)
                VALUES('$uid', '$phone', '$accountDigit', '$accountType', '$debitor', '$debit', '$dtme', '$reasonForDebit')";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param('isssisss', $uid, $phone, $accountDigit, $accountType, $debitor, $debit, $dtme, $reasonForDebit);
        // $stmt->execute();
        $conn->query($ins);

        // <a href=\"$link\" target=\"_blank\">check now</a>
// $link = __mpc_root__() + 'dashboard.php?action=checkDebit';
        echo json_encode(['msg'=> 'Debited successfully', 'balance' => $newBalance, 'code' => 200]);
$notxt = "<p>Your Justice (UYO) MPCS $accountType SAVINGS account has been debited with &#8358; $debit on $dtme.</p>";
$notxt .= "<p>Description: $reasonForDebit </p>";
$notxt .= "Sender: " .getSystemName($conn)[1];
$sender = getSystemName($conn)[1];

__mpc_notify__($conn, $notxt, 4, $phone, $uid, 0, 0, $sender);

//record so that members can see that their account was debited a certain amount.
//let them see their debit information
__mpc_memberTransaction_makeRecords__($conn, 0, 0, $uid, $phone, 'System Debit (GOODLIFE UYO MPCS)', $debit, 'Successful', 0);
// send notification to user
        die();
    }

}

//loan request
if(isset($_POST['XLoanRsqt'])){
    $data = json_decode($_POST['XLoanRsqt'], false);
    if($data->Permition == 'loanProcessor'){
             define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
            define('MPC-AUTORIZE-CALL', '');
            require_once dirname(__DIR__) ."/config/conn.php";
            require_once "mpc-func.php";


        $uid = $data->uid;
        $phone = $data->uidPhone;
        $amountRQ = $data->amount;
        $loanInfo = $data->loanInfo;
        date_default_timezone_set('Africa/Lagos');
        $dte = date('d/m/Y h:i:s');
        $status = 0;
        $trackId = '#'.uniqid();
        $monthbyname = date('F');

        $sql = "SELECT * FROM mpc_loan_request_online WHERE uid='$uid' && uid_ph='$phone' && status=0 || status=2";
        $stmt = $conn->query($sql);
        if($stmt->num_rows >0){
            echo json_encode(['uid' => $uid, 'msg' => 'you have a pending or uncompleted loan request', 'code' => 420]);
            die();
        }

        $sql = "INSERT INTO mpc_loan_request_online (uid, uid_ph, amount, reason, status, loan_trackId, request_date, month_by_name, approved_date, approval_message, approved_by)VALUES('$uid','$phone', '$amountRQ','$loanInfo', '$status','$trackId', '$dte', '$monthbyname', 'pending', 'pending', '0')";
        if($conn->query($sql)){
            echo json_encode(['msg' => 'Loan application sent successful', 'code'=> 200, 'track' => $trackId]);
        }
        
        echo mysqli_error($conn);
    }
    // echo $data;
}


//PASTE START HERE
//ONLINE LOAN APPROVAL REQUEST FROM ADMIN
if(isset($_POST['ApprovedLoan']) && !empty($_POST['ApprovedLoan'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-func.php";

    $data = json_decode($_POST['ApprovedLoan'], false);
    $uid = $data->uid;
    $phone = $data->phone;
    $comment = $data->cmmt;
    $adminId = $data->admId;

   date_default_timezone_set('Africa/Lagos');
    $dte = date('d/m/Y h:i:s');

    $sql = "UPDATE mpc_loan_request_online SET approved_date='$dte', status='1', approval_message='$comment', approved_by='$adminId' WHERE uid='$uid' && uid_ph='$phone'";
    if($conn->query($sql)){
        echo json_encode(['msg' => 'You have successfully approved this loan', 'status' => '#200']);
    }else{
        echo json_encode(['msg' => 'Loan approval Attempt fail unexpectedly, please contact developer for help...', 'status' => '#3200']);

    }

}

//ONLINE LOAN DECLINE REQUEST FROM ADMIN
if(isset($_POST['DeclineLoan']) && !empty($_POST['DeclineLoan'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define('MPC-AUTORIZE-CALL', '');
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once "mpc-func.php";

    $data = json_decode($_POST['DeclineLoan'], false);
    $uid = $data->uid;
    $phone = $data->phone;
    $comment = $data->cmmt;
    $adminId = $data->admId;

   date_default_timezone_set('Africa/Lagos');
    $dte = date('d/m/Y h:i:s');

    $sql = "UPDATE mpc_loan_request_online SET approved_date='$dte', status='1', approval_message='$comment', approved_by='$adminId' WHERE uid='$uid' && uid_ph='$phone'";
    if($conn->query($sql)){
        echo json_encode(['msg' => 'LOAN DECLINE SUCCESSFUL', 'status' => '#200']);
    }else{
        echo json_encode(['msg' => 'Loan decline Attempt fail unexpectedly, please contact developer for help...', 'status' => '#3200']);

    }

}

//JUSTICEuYOLOanTracker loan tracker start here
if(isset($_POST['JUSTICEuYOLOanTracker']) && !empty($_POST['JUSTICEuYOLOanTracker']))
{
    $data = json_decode($_POST['JUSTICEuYOLOanTracker'], false);

    if($data->permition === 'AdminIsPermited')
    {
        define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
        define('MPC-AUTORIZE-CALL', '');
        require_once dirname(__DIR__) ."/config/conn.php";
        require_once "mpc-func.php";



        $searchQuery = $data->tracker;
        $db = $conn->real_escape_string($searchQuery);

        ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped border-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Profile</th>
                            <th>Phone</th>
                            <th>Amount Requested</th>
                            <th>Reason</th>
                            <th>Date Requested</th>
                            <th>Tracking Code</th>
                            <th>Status</th>
                            <th>Action</th>
                            <!-- <th>Date Requested</th> -->
                        </tr>
                    </thead>
<?php

$sql = "SELECT * FROM mpc_loan_request_online WHERE loan_trackId LIKE '%$db%'";
$stmt = $conn->query($sql);

while ($data = $stmt->fetch_assoc()) {
    $name = __mpcReturnByPhoneMember($conn, $data['uid_ph'])[4];
    // $memberId = __mpcReturnByPhoneMember($conn, $data[$phoneColumn])[0];

    if($data['status'] == 0){
        $tx = 'Pending';
        $disa = '';
        $ttl = 'title="Click to activate"';
    }elseif($data['status'] == 1){
        $tx = '<i class="fas fa-user-check text-success"></i>Approved';
        $disa = 'disabled';
        $ttl = 'title="Loan Already Approved"';

    }else if($data['status'] == 2){
        $tx = 'Not Approved';
        $disa = '';
        $ttl = 'title="Loan not approved, Click to Approve"';

    }else if($data['status'] == 3){
        $tx = 'Completed';
        $disa = 'disabled';
        $ttl = 'title="Loan completed, member already completed payment"';

    }
    $profile = __mpc_root__() . 'asset/img/' .__mpcReturnByPhoneMember($conn, $data['uid_ph'])[18];
?>
<tbody>
    <tr>
        <td><?php echo $data['ID']?></td>
        <td><?php echo  $name?></td>
        <td><?php echo "<img src=\"$profile\" srcset=\"$profile\" class=\"dboard-img\">"; ?></td>
        <td><?php echo $data['uid_ph']?></td>
        <td>&#8358; <?php echo $data['amount']?></td>
        <td><p><?php echo $data['reason']?></p></td>
        <td><?php echo $data['request_date']?></td>
        <td><?php echo $data['loan_trackId']?></td>
        <td class="text-center"><?php echo $tx?></td>
        <td>
            <button <?php echo $disa .' '. $ttl?> name="<?php echo $name?>" amountRQ="<?php echo $data['amount']?>" class="mpc-btn mpc-disabled mpxc-online-loan-approve-RQ" mpc-gr-id="<?php //echo $data[$groupName]?>" mpc-memid="<?php echo $data['uid']?>" mpc_memph="<?php echo $data['uid_ph']?>" mpc-loan-tblId="<?php //echo $data[$columnIdName]?>" mpc-type="<?php //echo $type;?>" mpc-approved-incre="<?php //echo $data[$columnIdName]?>">Take action</button>
        </td>
    </tr>
</tbody>
<?php
}


?>
    </div>
<?php
    }
}



/// new update start here for withdrawal and loan info
if(isset($_POST['_dkl4kdklsk04_Aprksxl490dlsd43_']) && !empty($_POST['_dkl4kdklsk04_Aprksxl490dlsd43_'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    require_once dirname(__DIR__) ."/config/conn.php";
    require "mpc-func.php";

    $data = json_decode($_POST['_dkl4kdklsk04_Aprksxl490dlsd43_']);
    $memberId = $data->uid;
    $memberPhone = $data->phone;
    $AdminMsg = $data->appMsg;
    $AdminId = $data->disburser; //disburse by
    $dataId = $data->tid; //data table id 
    $ibaadAkuk = $data->ibaadAkuk; //data table id ibaadAkuk
    $transactionType = "Loan Application"; //transaction status
    $transactionStatus = "Successful";
    $rtn = 0;
    date_default_timezone_set('Africa/Lagos');
    $dte = date('Y-m-d H:i:s');

    $sql = "UPDATE mpc_loan_request_online SET approval_message='$AdminMsg', approved_date='$dte', approved_by='$AdminId', status='1' WHERE uid='$memberId' && uid_ph='$memberPhone' && ID='$dataId'";
    if(! $conn->query($sql)){
        echo json_encode(['code' => '#400', 'msg' => mysqli_error($conn)]);
        die();
    }

    // MOVE APPROVED AMOUNT TO MEMBER TRANSACTION HISTORY
    __mpc_memberTransaction_makeRecords__($conn, 0, 0, $memberId, $memberPhone, $transactionType, $ibaadAkuk, $transactionStatus, $rtn);
    // ---------------------------------------------------------------------------
    //----------------------------------------------------------------------------
    //----------------------------------------------------------------------------

    $notificationStatus = 0;//it means no body has ready or seen it before, it a new notification;
     $notificationSender = getSystemName($conn)[1];
     $systemName = getSystemName($conn)[1];
     $notificationSender = $systemName;

    // $bankNo = __bankingInfo($conn, $memberId, $memberPhone)['r']; //bank name
    // $bType = __bankingInfo($conn, $memberId, $memberPhone)['s']; //bank type
    //  // $bNa = __bankingInfo($conn, $uid, $memberPhone)['r'];

    $TXT = "<h5>Loan Request Approved</h5>";
    $TXT .= "<h5>Your Loan request process successful</h5>";
    $TXT .= "<h5>This is the response from $systemName ". $AdminMsg ."</h5>";
    

   __mpc_notify__($conn, $TXT, 4, $memberPhone, $memberId, 0, $notificationStatus, $notificationSender); //NOTIFY 

    echo json_encode(['code' => '#200', 'msg' => 'Loan Request approval is successful']);
    die();
}


//admin decline loan request here online
if(isset($_POST['_mpcDclineArequesksxl490dlsd43_']) && !empty($_POST['_mpcDclineArequesksxl490dlsd43_']))
{
  define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    require_once dirname(__DIR__) ."/config/conn.php";
    require "mpc-func.php";

    $data = json_decode($_POST['_mpcDclineArequesksxl490dlsd43_']);
    $memberId = $data->uid;
    $memberPhone = $data->phone;
    $AdminMsg = $data->appMsg;
    $AdminId = $data->disburser; //disburse by
    $dataId = $data->tid; //data table id 
    $ibaadAkuk = $data->ibaadAkuk; //data table id ibaadAkuk
    $transactionType = "Debit Withdrawal"; //transaction status
    $transactionStatus = "Decline/Rejected";
    $rtn = 0;
    date_default_timezone_set('Africa/Lagos');
    $dtme = date('Y-m-d g:i:s');
    $systemName = getSystemName($conn)[1];


    $sql = "UPDATE mpc_loan_request_online SET approval_message='$AdminMsg', approved_date='$dtme', approved_by='$AdminId', status='2' WHERE uid='$memberId' && uid_ph='$memberPhone' && ID='$dataId'";
    if(! $conn->query($sql)){
        echo json_encode(['code' => '#400', 'msg' => mysqli_error($conn)]);
        die();
    }

    // $tble = __getWithdrawalTbl($conn, $dataId);
    // if(strtolower($tble) == 'mpc_account_shares'){
    //     $tbl = "mpc_account_shares";
    //     $tblCol1 = 'shares_member_id'; //col1
    //     $tblCol2 = 'shares_member_phone'; //col2
    //     $tblCol3 = 'debit'; //col2
    //     $tblCol4 = 'credit'; //col2
    //     $tblCol5 = 'balance'; //col2
    //     $tbl_incre = 'shares_id';
    //     $accountName = "GOODLIFE UYO MPCS SHARE ACCOUNT";

    // }else if(strtolower($tble) == 'mpc_fixed_deposit'){
    //     $tbl = "mpc_fixed_deposit";
    //     $tblCol1 = 'fixed_mem_id'; //col1
    //     $tblCol2 = 'fixed_mem_phone'; //col2
    //     $tblCol3 = 'debit'; //col2
    //     $tblCol4 = 'credit'; //col2
    //     $tblCol5 = 'balance'; //col2
    //     $tbl_incre = 'mpc_fixed_id';
    //     $accountName = "GOODLIFE UYO MPCS FIXED DEPOSIT ACCOUNT";

    // }else if(strtolower($tble) == 'mpc_special_saving'){
    //     $tbl = "mpc_special_saving";
    //     $tblCol1 = 'mem_id'; //col1
    //     $tblCol2 = 'mem_phone'; //col2
    //     $tblCol3 = 'debit'; //col2
    //     $tblCol4 = 'credit'; //col2
    //     $tblCol5 = 'balance'; //col2
    //     $tbl_incre = 'special_id';
    //     $accountName = "GOODLIFE UYO MPCS SHARE ACCOUNT";
    // }else if(strtolower($tble) == 'mpc_thrift_saving'){
    //     $tbl = "mpc_thrift_saving";
    //     $tblCol1 = 'thrift_mem_id'; //col1
    //     $tblCol2 = 'thrift_mem_phone'; //col2
    //     $tblCol3 = 'debit'; //col2
    //     $tblCol4 = 'credit'; //col2
    //     $tblCol5 = 'balance'; //col2
    //     $tbl_incre = 'thrift_id';
    //     $accountName = "GOODLIFE UYO MPCS THRIFT SAVINGS ACCOUNT";

    // }else if(strtolower($tble) == 'mpc_welfare_contribution'){
    //     $tbl = "mpc_welfare_contribution";
    //     $tblCol1 = 'welfare_mem_id'; //col1
    //     $tblCol2 = 'welfare_mem_phone'; //col2
    //     $tblCol3 = 'debit'; //col2
    //     $tblCol4 = 'credit'; //col2
    //     $tblCol5 = 'balance'; //col2
    //     $tbl_incre = 'welfare_id';
    //     $accountName = "GOODLIFE UYO MPCS WELFARE CONTRIBUTION ACCOUNT";
    // }

    // $balance = __mpcMemberAccountBal__($conn, $tbl, $memberId, $memberPhone, $tblCol1,  $tblCol2, $tbl_incre)[2] + $ibaadAkuk;
    //     //update for last
    // $lastIdBeforeInsert = __mpcMemberAccountBal__($conn, $tbl, $memberId, $memberPhone, $tblCol1,  $tblCol2, $tbl_incre)[3];
    // $updSql = "UPDATE $tbl SET ifono='0' WHERE $tbl_incre='$lastIdBeforeInsert' && $tblCol1='$memberId' && $tblCol2='$memberPhone'";
    // $conn->query($updSql);


    // $refundSql = "INSERT INTO $tble ($tblCol1, $tblCol2, $tblCol3, $tblCol4, $tblCol5, date_time, ifono)VALUES('$memberId', '$memberPhone', '0', '$ibaadAkuk', '$balance', '$dtme', '1')";
    // $conn->query($refundSql); //refund member account here//
    // //REFUND MEMBERS ACCOUNT HERE

   $membername = __mpcReturnByPhoneMember($conn, $memberPhone)[4];
   if(__mpcReturnByPhoneMember($conn, $memberPhone)[2] == 'male' || __mpcReturnByPhoneMember($conn, $memberPhone)[4] == 'M'){
    $gender = "His";
   }else if(__mpcReturnByPhoneMember($conn, $memberPhone)[2] == 'female' || __mpcReturnByPhoneMember($conn, $memberPhone)[4] == 'F'){
        $gender = "Her";
   }else{
        $gender = "His/Her";
   }

   // $tomail = 'yakiseetim24@gmail.com';
   // $subject = "$systemName member Withdrawal Declined";
   // $msg = "$membername Withdrawal request of N $ibaadAkuk FROM $gender $accountName has been declined by $systemName admin this is what the admin said \"$AdminMsg\"";

     /*
        ----------------------------------------------
        |                                              |
        |    SEND MAIL TO SUPER ADMIN HERE             |
    */
        // __goodLifeMail__($tomail, $subject, $msg, 1);
    /*
        |                                              |
        |                                              |
        ----------------------------------------------
     */

    // MOVE APPROVED AMOUNT TO MEMBER TRANSACTION HISTORY
    __mpc_memberTransaction_makeRecords__($conn, 0, 0, $memberId, $memberPhone, $transactionType, $ibaadAkuk, $transactionStatus, $rtn);
    // ---------------------------------------------------------------------------
    //----------------------------------------------------------------------------
    //----------------------------------------------------------------------------

    $notificationStatus = 0;//it means no body has ready or seen it before, it a new notification;
     $notificationSender = getSystemName($conn)[1];
     $systemName = getSystemName($conn)[1];
     $notificationSender = $systemName;

    // $bankNo = __bankingInfo($conn, $memberId, $memberPhone)['r']; //bank name
    // $bType = __bankingInfo($conn, $memberId, $memberPhone)['s']; //bank type
     // $bNa = __bankingInfo($conn, $uid, $memberPhone)['r'];

    $TXT = "<h5>Loan Application Rejected/Declined</h5>";
    $TXT .= "<h5>Your Loan request of $ibaadAkuk was declined on $dtme.</h5>";
    $TXT .= "<h5>This is the response from $systemName => \"$AdminMsg\" <=</h5>";
    $TXT .= "<h5>We appologize for inconvienence this might have caused you, If you thing is a mistake, you can re-apply or contact $systemName.  </h5>";
   //  $TXT .= "$systemName";
    

   __mpc_notify__($conn, $TXT, 4, $memberPhone, $memberId, 0, $notificationStatus, $notificationSender); //NOTIFY 

    echo json_encode(['code' => '#200', 'msg' => 'Loan application request declined successful']);
    die();
}

//check for 
if(isset($_GET['pRQ']) && !empty($_GET['pRQ']) && $_GET['data'] == 'xmmkk4kkdcmdk4__dskkalk4dad')
{
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_GET['data'], false);

    // $uid = $data->UID;
    // $ph = $data->PHONE;

    $sql = "SELECT * FROM mpc_loan_request_online WHERE status=1 || status=2";
    $stmt = $conn->query($sql);
    if( ! $stmt->num_rows > 0){
        echo "<h3 class=\"text-center\">No data found</h3>";
        die();
    }else{
        while($rows = $stmt->fetch_assoc()){
    if($rows['status'] == 0){
        $txt = 'Pending';
        $tclass = "alert-dark p-2 text-dark";
    }else if($rows['status'] == 1){
        $txt = '<i class="fas fa-check"></i> Approved';
        $tclass = "bg-success p-2 text-light xkykess";
    }else if($rows['status'] == 2){
        $txt = '<i class="fas fa-xmark"></i> Declined';
        $tclass = "bg-danger p-2 text-light xkykess";
    }

    $AdminName = __mpcReturnByIdAll__($conn, $rows['approved_by'])[1] .' '.__mpcReturnByIdAll__($conn, $rows['approved_by'])[2];
            ?>
            <div class="_sddu34y_ mpc-fancy-styled">
                <div class="jdallk423">
                    <h5 class="_xmlxxx">Amount</h5>
                    <h5 class="zxed">&#8358; <?php echo $rows['amount']?></h5>
                </div>

                <!-- <div class="jdallk423">
                    <h5 class="_xmlxxx">Amount</h5>
                    <h5 class="zxed">#&8583;<?php //echo $rows['amount']?></h5>
                </div> -->

                <div class="jdallk423">
                    <h5 class="_xmlxxx">Goodlife MPCS says</h5>
                    <h5 class="zxed dckadd"><?php echo $rows['approval_message']?></h5>
                </div>
                <div class="jdallk423">
                    <h5 class="_xmlxxx">Date/time</h5>
                    <h5 class="zxed"><?php echo $rows['approved_date']?></h5>
                </div>
                <div class="jdallk423">
                    <h5 class="_xmlxxx">Approved/Declined by</h5>
                    <h5 class="zxed"><?php echo $AdminName?></h5>
                </div>
                <div class="jdallk423">
                    <h5 class="_xmlxxx">Status</h5>
                    <h5 class="<?php echo $tclass?>"><?php echo $txt?></h5>
                </div>
            </div>
            <?php
        }
    }
}

// function to search for retired members
if(isset($_POST['sendData']) && $_POST['sendData'] !== ''){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_POST['sendData'], false);
    $Q = $data->queryStringRetire;

    $sql = "SELECT * FROM mpc_members WHERE name LIKE '%$Q%' || phone LIKE '%$Q%' || religion LIKE '%$Q%' ORDER BY members_id DESC LIMIT 50";
    $stmt = $conn->query($sql);
?>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>profile</td>
            <td>Date Appointed</td>
            <td>Years worked</td>
            <td>Yrs. Remaining</td>
            <td>Status</td>
            <!-- <td>Name</td> -->
        </tr>
    </thead>
  
<?php  while ($data = $stmt->fetch_assoc()) {
            $yrsToServed = 30;
            $yrs = calculateYears($data['religion'])['yrs'];
            $mnt = calculateYears($data['religion'])['mnt'];
            $dys = calculateYears($data['religion'])['dys'];
            $hrs = calculateYears($data['religion'])['hrs'];
            $mins = calculateYears($data['religion'])['mins'];
            $sec = calculateYears($data['religion'])['sec'];
            // $yrs = calculateYears($data['religion'])['yrs'];
    if($yrsToServed - $yrs  <= 0){
        $tk = "Due for Retirment";
        $cls = "alert-danger";
    }else{
        $tk = "Not Due for Retirment";
        $cls = "alert-success";
    }
?>
    <tr>
        <td><?php echo $data['members_id']?></td>
        <td><?php echo $data['name']?></td>
        <td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" class="dboard-img" title="<?php echo $data['name']?>'s profile picture" role="image"></td>
        <td><?php echo $data['religion']?></td>
        <td><?php echo 'Worked for ' .$yrs .' years, '. $mnt .' Month '. $hrs .' hours, ' . $mins . ' minutes ' . $sec . ' Seconds'?></td>
        <td><?php echo $yrsToServed - $yrs . ' Years'?></td>
        <td><span class="<?php echo $cls?> h-100 d-block p-1"><?php echo $tk?></span></td>


    </tr>
<?php
        }
echo "</table>";
}

//show balance
if(isset($_POST['ReturnBalanceToMove']) && !empty($_POST['ReturnBalanceToMove'])){
        define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_POST['ReturnBalanceToMove'], false);

    $uid = $data->uid;
    $phone = $data->phone;
    $type = $data->type;

    //$tble = __getWithdrawalTbl($conn, $dataId);
    if(strtolower($type) == 'shares'){
        $tbl = "mpc_account_shares";
        $tblCol1 = 'shares_member_id'; //col1
        $tblCol2 = 'shares_member_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $tbl_incre = 'shares_id';
        $accountName = "GOODLIFE UYO MPCS SHARE ACCOUNT";

    }else if(strtolower($type) == 'thrift'){
        $tbl = "mpc_fixed_deposit";
        $tblCol1 = 'fixed_mem_id'; //col1
        $tblCol2 = 'fixed_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $tbl_incre = 'mpc_fixed_id';
        $accountName = "GOODLIFE UYO MPCS FIXED DEPOSIT ACCOUNT";

    }

// echo $tbl;
   // $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1,  $tblCol2, $tbl_incre)[2];
    //print_r($balance);
  //  echo json_encode(['balance' => $balance, 'msg' => 'balance fetch']);

    $sql = "SELECT * FROM $tbl WHERE $tblCol1='$uid' && $tblCol2='$phone'  ORDER BY $tbl_incre DESC LIMIT 1";
    $stmt = $conn->query($sql);
    if($stmt->num_rows >0){
        $balance = $stmt->fetch_assoc()['balance'];
         echo json_encode(['balance' => $balance, 'msg' => 'balance fetch']);
         die;
    }

     echo json_encode(['balance' => 0.00, 'msg' => 'Cannot detect members account balance']);

}


//show curent balance
if(isset($_POST['ShowCurrentBalance']) && !empty($_POST['ShowCurrentBalance'])){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_POST['ShowCurrentBalance'], false);

    $uid = $data->uid;
    $phone = $data->phone;
    $type = $data->type;

    //$tble = __getWithdrawalTbl($conn, $dataId);
    if(strtolower($type) == 'special'){
        $tbl = "mpc_special_saving";
        $tblCol1 = 'mem_id'; //col1
        $tblCol2 = 'mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $tbl_incre = 'special_id';

    }

// echo $tbl;
   // $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1,  $tblCol2, $tbl_incre)[2];
    //print_r($balance);
  //  echo json_encode(['balance' => $balance, 'msg' => 'balance fetch']);

    $sql = "SELECT * FROM $tbl WHERE $tblCol1='$uid' && $tblCol2='$phone'  ORDER BY $tbl_incre DESC LIMIT 1";
    $stmt = $conn->query($sql);
    if($stmt->num_rows >0){
        $balance = $stmt->fetch_assoc()['balance'];
         echo json_encode(['balance' => $balance, 'msg' => 'balance fetch']);
         die;
    }

     echo json_encode(['balance' => 0.00, 'msg' => 'Cannot detect members account balance']);
}


//function to process and debit members account
if(isset($_POST['xxmklskd'])  && $_POST['xxmklskd'] !== ''){
    define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
    define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

    /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
    require_once dirname(__DIR__) ."/config/conn.php";
    require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $data = json_decode($_POST['xxmklskd'], false);
    $uid = $data->uid;
    $phone = $data->phone;
    $type = $data->acct;
    date_default_timezone_set('Africa/Lagos');
    $dtime = date('Y-m-d H:i:s');

    if(strtolower($type) == 'shares'){
        $tbl = "mpc_account_shares";
        $tblCol1 = 'shares_member_id'; //col1
        $tblCol2 = 'shares_member_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $tbl_incre = 'shares_id';
        $accountName = "GOODLIFE UYO MPCS SHARE ACCOUNT";

    }else if(strtolower($type) == 'thrift'){
        $tbl = "mpc_fixed_deposit";
        $tblCol1 = 'fixed_mem_id'; //col1
        $tblCol2 = 'fixed_mem_phone'; //col2
        $tblCol3 = 'debit'; //col2
        $tblCol4 = 'credit'; //col2
        $tblCol5 = 'balance'; //col2
        $tbl_incre = 'mpc_fixed_id';
        $accountName = "JUSTICE UYO MPCS THRIFT DEPOSIT ACCOUNT";

    }


    $transactionTypeSender = 'Debit';
    $notificationStatus = 0;//it means no body has ready or seen it before, it a new notification;
    $notificationSender = getSystemName($conn)[1];
    $depositPlatform = 'Counter Deposit';
    $debit = 0;


    $balance = __mpcMemberAccountBal__($conn, $tbl, $uid, $phone, $tblCol1,  $tblCol2, $tbl_incre)[2];// + $ibaadAkuk;

    $sql = "INSERT INTO mpc_special_saving (mem_id, mem_phone, debit, credit, balance, date_time)VALUES($uid, $phone, 0, $balance, $dtime)";
    
    if($conn->query($sql)){
        $sql2 = "INSERT INTO $tbl ($tblCol1, $tblCol2, $tblCol3, $tblCol4, $tblCol5, date_time)VALUES($uid, $phone, $balance, 0, 0, $dtime)";

        if($conn->$sql2){
            $txt = "<h5>Funds transfer Notification</h5>";
            $txt .= "<h6>Your funds has been successfully transfered to your $notificationSender special savings account...</h6>";
            $txt.= "<h6>We want to let you know that your funds is save and secure with our server 24/7</h6>";
            __mpc_notify__($conn, $txt, 5, $phone, $uid, 0, 0, $notificationSender);
        }
    }


}

