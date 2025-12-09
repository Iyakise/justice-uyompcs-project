<?php
/* multi line comment
* at default this major functio will be written here
*/
if(!defined('MPC-AUTORIZE-CALL')) {
	die('<h1 class="mpc-enter">ACCESS DENIED</h1>');
}

//defined root directory

function __mpc_root__(){
	//try to defined root directory
	//for all the system resources

	$root = "http://localhost/justice/";

	return $root;
}

function __mpc_responQuery() {

}

function __mpc_Multiple_tble($conn, $tbl, $col, $data, $qmark, $bindS, $rtnStatus='') {
	//$uid, $ufrom, $utype, $ulogTime, $ulogDate,
	//start all at once
	/**THIS FUNCTION AT DEFAULT WILL KNOW ANY TABLE
	 * AND WILL ALSO DUMP DATA TO ANY TABLE
	 * NO MATER THE SIZE OF THE TABLE
	 * COLUMS AND DATA VALUES THAT TABLE ACCEPT
	 */
	 $dataImplode = implode(', ', $data);

	 $columnImplode = implode(', ', $col);
	 $qmarkImplode = implode(', ', $qmark);

	 $bindStringImplode = implode('', $bindS);


	$dtype = "'$bindStringImplode'";


	 $sql = "INSERT INTO $tbl ($columnImplode) VALUES ($dataImplode)";

	if(!mysqli_query($conn, $sql)) {
		$Err = 'UNEXPECTED ERROR, table configuration ERROR';
		echo $Err.mysqli_error($conn);
		exit();
	}else {
		if($rtnStatus != '') {
			$msg = 'REQUEST SUCCESS';

			return $msg;
		}
	}

}

//mpc developer information
function __mpcDeveloper__() {
	$name = "</br><i class=\"fas fa-user\"></i> Name: Yakise Raphael</br>";
	$phone = "<i class=\"fas fa-phone fas fa-phone\"></i> Phone: +2348121369607, +2349069053009 </br>";
	$faceBook = "<i class=\"fas fa-facebook\"></i> Facebook: Iyakise Raphael</br>";
	$whatapp = "<i class=\"far fa-whatsapp\"></i> Whatsapp: +2349069053009</br>";
	$instagram = "<i class=\"far fa-instagram\"></i> Instagram: yakise_official</br>";

	$rtn = [$name, $phone, $faceBook, $whatapp, $instagram];
	return $rtn;
}

//function to dump admin data once
function __mpc_dump($conn, $fn, $ln, $usr, $ps, $prev, $profile, $sq, $sqAns, $columns, $tbl, $branch) {

	//columns
	 $imp_column = implode(',', $columns);
	 //dump data
	//  $dumpData = implode(',', $data);

	 $checkCol = $columns[2];

	//start\
	$check = "SELECT * FROM $tbl WHERE user_username='$usr'";
	if(mysqli_num_rows(mysqli_query($conn, $check))){
		$Err = "Another user with \"<span class=\"mpc-underline\">$usr</span>\", already Exist, Use phone, username, Email instead of <span class=\"mpc-underline\">$usr</span>";
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit(); //IF THE ABOVE CODE RUNS THEN EXIT() WILL STOP IT FROM HERE

	}
	//start\
	$sql = "INSERT INTO $tbl ($imp_column)VALUES(?,?,?,?,?,?,?,?,?)";

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		$Err = 'System Encounter an unexpected error while trying to save admin data, contact system developer for help!,';
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
	}else {
	mysqli_stmt_bind_param($stmt, "sssssssss", $fn, $ln, $usr, $ps, $prev, $profile, $sq, $sqAns, $branch);
		if(mysqli_stmt_execute($stmt)) {
			$tzne = date_default_timezone_set('Africa/Lagos');
    		$date = date('d/n/Y');
			$time = date('g:i:s a');

			$lstId = mysqli_stmt_insert_id($stmt);
			//$from = 'mpc_user';
			$tbl = 'mpc_last_login';
			$col = ['user_id', 'users_from', 'users_type', 'last_login_time', 'last_login_date', 'type'];
			$data = [$lstId, "'mpc_user'", "'1'", "'$time'", "'$date'", "'registration'"];
			$qmark = ['?', '?', '?', '?', '?'];
			$bindS = ['s', 's', 's', 's', 's'];

			//__mpc_Multiple_tble($conn, $tbl, $col, [$lstId, 'mpc_user', 'pending', 'pending', 'pending'], ['?', '?', '?', '?', '?'], ['s', 's', 's', 's', 's'], ''); //mpc master function is here, it perform the unexpected actions

		__mpc_Multiple_tble($conn, $tbl, $col, $data , $qmark, $bindS, '');
			echo "successful";
		}else {
			$Err = "Registration Failed, contact developer for help.";
			$Err.= __mpcDeveloper__()[0];
			$Err.= __mpcDeveloper__()[1];
			$Err.= __mpcDeveloper__()[2];
			$Err.= __mpcDeveloper__()[3];
			$Err.= __mpcDeveloper__()[4];
			echo $Err.mysqli_error($conn);
		}
	}

}

//function to dump admin data once
function __mpc_dumpAdmin($conn, $fn, $ln, $usr, $ps, $prev, $profile, $sq, $sqAns, $columns, $tbl) {

	//columns
	 $imp_column = implode(',', $columns);
	 //dump data
	//  $dumpData = implode(',', $data);
	$checkCol = $columns[3];
	//start\
	$check = "SELECT * FROM $tbl WHERE $checkCol=$usr";
	if(mysqli_num_rows(mysqli_query($conn, $check))){
		$Err = "Another user with $usr, already Exist";
		exit();
	}else{
		$sql = "INSERT INTO $tbl ($imp_column)VALUES(?,?,?,?,?,?,?,?)";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			$Err = 'System Encounter an unexpected error while trying to save admin data, contact system developer for help!,';
			$Err.= __mpcDeveloper__()[0];
			$Err.= __mpcDeveloper__()[1];
			$Err.= __mpcDeveloper__()[2];
			$Err.= __mpcDeveloper__()[3];
			$Err.= __mpcDeveloper__()[4];
			echo $Err;
		}else {
		mysqli_stmt_bind_param($stmt, "ssssssss", $fn, $ln, $usr, $ps, $prev, $profile, $sq, $sqAns /*$dumpData*/);
			if(mysqli_stmt_execute($stmt)) {
				echo "successful";
			}else {
				$Err = "Registration Failed, contact developer for help.";
				$Err.= __mpcDeveloper__()[0];
				$Err.= __mpcDeveloper__()[1];
				$Err.= __mpcDeveloper__()[2];
				$Err.= __mpcDeveloper__()[3];
				$Err.= __mpcDeveloper__()[4];
				echo $Err;
			}
		}
	}


}

//dump users informaton then return json object
function __mpc_dump_member__($conn, $tbl, $columns, $data) {

	$columnImplode = implode(',', $columns);
	$dataImplode = implode(',', $data);


	//start
	$sql = "INSERT INTO $tbl ($columnImplode) VALUES($dataImplode)";
	if(! $q = mysqli_query($conn, $sql)) {
		$Err = "Unexpected error, while Processing Memeber data, contact system developer for help";
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit();
	}else {
		echo $memberId-> mysqli_insert_id($q);
	}
}

//user logout
function __logoutMpc_admin($id, $from, $type, $redirect, $logoutType, $conn) {
	$tzone = date_default_timezone_set('Africa/Lagos');
	 $time = date('h:i:s a');
	 $date = date('d/m/Y');
	//start code ehre
	$sql = "INSERT INTO mpc_last_login (user_id, users_from, users_type, last_login_time, last_login_date, type)VALUES(?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		echo "Unexpected Error, user logout";
		exit();
	}
	mysqli_stmt_bind_param($stmt, "isssss", $id, $from, $type, $time, $date, $logoutType);
	if(mysqli_stmt_execute($stmt))  {
		//session_start(); //start session to logout users
	if($from == 'mpc_user'){


		unset($_SESSION['MPC_ADMIN_LOGIN_SUPE_SESSION']);
		session_unset();
		session_destroy();

		?>
			<script>
				window.location.replace("<?php echo $redirect?>");
			</script>
		<?php
		}else{
			unset($_SESSION['MPC_MEMB_LOGIN_vERYIFY_KEY']);
			session_unset();
			session_destroy();

		?>
			<script>
				window.location.replace("<?php echo $redirect?>");
			</script>
		<?php
		}
	}

}

//save admin last login
function __mpc_login_record($conn, $id, $from, $usrType, $actionType){
	$tzone = date_default_timezone_set('Africa/Lagos');
	 $time = date('h:i:s a');
	 $date = date('d/m/Y');
	//start code ehre
	$sql = "INSERT INTO mpc_last_login (user_id, users_from, users_type, last_login_time, last_login_date, type)VALUES(?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		echo "Unexpected Error, user logout";
		exit();
	}
	mysqli_stmt_bind_param($stmt, "isssss", $id, $from, $usrType, $time, $date, $actionType);
	mysqli_stmt_execute($stmt);
}

function __admin_profile($conn, $id, $tbl) {
	$sql = "SELECT user_profile FROM $tbl WHERE user_id=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unexpected Error, occur".mysqli_error($conn);
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	return $data['user_profile'];
}

function __load_mpc_members($conn) {
    //define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
   // define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

        /**LOAD DATABASE CONNECTION FILE AND OTHER REQUIRED FILES */
   // require_once dirname(__DIR__) ."/config/conn.php";
   // require_once dirname(__DIR__) ."/functions/mpc-func.php";

    $sql = "SELECT * FROM mpc_members ORDER BY members_id DESC LIMIT 50 ";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        $Err = "Error, unexpected error while loading members data";
        $Err.= __mpcDeveloper__()[0];
        $Err.= __mpcDeveloper__()[1];
        $Err.= __mpcDeveloper__()[2];
        $Err.= __mpcDeveloper__()[3];
        $Err.= __mpcDeveloper__()[4];
        echo json_encode($Err);
        exit();
    }
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    ?>

    <!--ul class="mpc-list-Members">
        <li>Name</li>
        <li>Occupation</li>
        <li>Phone</li>
        <li>Profile</li>
    </ul>


    <ul class="mpc-list-data"-->

<?php

    while($data = mysqli_fetch_array($d)){
		if($data['groups'] == 'pending'){
			$group = 'Not Assigned';
		}else {
			$group = $data['groups'];
		}
        ?>

        <tr>
            <td><?php print $data['members_id']?></td>
            <td class="CreateLoanColor creatforThisMember" id="creatforThisMember" mpc-borrower="<?php print $data['name']?>" borrower-phone="<?php print $data['phone']?>" borrower-branch="<?php print $data['branch']?>" borrower-id="<?php print $data['members_id']?>"  title="CLICK TO CREATE LOAN FOR <?php print $data['name']?>">
                <span class="uid"><?php print $data['name']?> </span>
            </td>
            <td><?php print $data['phone']?></td>
            <td><?php print $data['religion']?></td>
            <td><?php print $data['occupation']?></td>
            <td><?php print $data['registration_number']?></td>
            <td><?php print $group?></td>
            <td><img src="<?php print __mpc_root__(). 'asset/img/'. $data['user_profile']?>" srcset="<?php print __mpc_root__(). 'asset/img/'. $data['user_profile']?>" title="<?php print $data['name']?>'s profile" alt="members profile" class="dboard-img"></td>

        </tr>

        <?php
    }
    //echo "</table>";
}

//function that run determine who is Admin
function __Adm__($prev){

	if($prev == 1) {
		$d = 'SUPER-ADMIN';
		return $d;
	}else if($prev == 2){
		$d = 'ADMIN';
		return $d;
	}else if($prev == 3){
		$d = 'STAFF';
		return $d;
	}else if($prev == 4){
		$d = 'DEVELOPER';
		return $d;
	}else if($prev == 5){
		$d = 'SECRETARY';
		return $d;
	}else{
		$d = 'MEMBER';
		return $d;
	}
}

//function that get all the available users
function __mpc_availUser__($conn){
	//start here
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_user")) >0){
		$Err = "<h5 class=\"text-center\"> No single user found...</h5>";
		echo $Err;
		exit();
	}

	$sql = "SELECT * FROM mpc_user ORDER BY user_id DESC";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unexpected error popup while trying to load available users!";
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

	?>


	<?php
	while($data = mysqli_fetch_array($d)){
		$col1 = $data['user_id'];
		$target = 'user';
		$url = __mpc_root__() . "user/dashboard.php/?action=verifyAction&actionId=$col1&t=$target&r1=Settings&r2=createUser";
		?>

		<tr>
			<td><?php print $data['user_id']?>
			<a href="<?php echo $url?>" class="rmv-item" title="Remove this <?php echo $target .' '. $data['user_fname']?>"><i class="fa-trash-alt fa"></i></a>
		</td>
			<td><?php print $data['user_fname'] .' ' . $data['user_lname']?></td>
			<td><?php print $data['user_username']?></td>
			<td><?php print $data['branch']?></td>
			<td><?php print __Adm__($data['user_previllege'])?></td>
			<td>
				<img src="<?php echo __mpc_root__() .'asset/img/'. $data['user_profile']?>" alt="Users profile" srcset="<?php echo __mpc_root__() .'asset/img/'. $data['user_profile']?>" title="<?php print $data['user_fname'] .' ' . $data['user_lname']?> picture" class="dboard-img">
				</td>
		</tr>

		<?php
	}


}

//mpc add and omit previlege
function __mpc_omit_Add__($conn /*, $prev, $whattoselect, $branch, $tbl*/){

/*	if($prev == 1 || $prev == 4){
		$sql = "SELECT * FROM $tbl";
	}else if($prev == 2){
		$sql = "SELECT * FROM $tbl WHERE $whattoselect='$branch'";
	}else if($prev == 3){
		$sql = "SELECT * FROM $tbl WHERE $whattoselect='$branch'";
	}
*/		$sql = "SELECT * FROM mpc_branches ORDER BY branch_id DESC";
	if(!mysqli_num_rows(mysqli_query($conn, $sql)) >0){
		$Err = "<h4 class=\"text-center\"> No branch Found!</h4>";
		echo $Err;
		//exit();
	}else {
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Previlege check error, contact system developer for help';
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
?>
<table class="table border-dark table-bordered">
	<tr>
		<td># </td>
		<td>Branch</td>
		<td>Branch Location</td>
		<td>Manager</td>
		<td>Profile</td>
		<td>Credit officer</td>
	</tr>


<?php
	while($data = mysqli_fetch_array($d)){
		if(__mpc_branchMg__($conn, $data['branch_manager'])[1] == 'Unavailable'){
			$pix = "Unavailable";
		}else {
			$imgPath = __mpc_root__() .'/asset/img/' .__mpc_branchMg__($conn, $data['branch_id'])[1];
			$pix = "<img src=\"$imgPath\" srcset=\"$imgPath\" class=\"dboard-img\">";
		}
?>

	<tr>
		<td>
			<?php print $data['branch_id']?>
			<a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=verifyAction&actionId=<?php echo $data['branch_id']?>&t=branch&r1=Settings&r2=cBranch" target="_blank" class="rmv-item" rel="noopener noreferrer">
				<i class="fa-trash-alt fas"></i>
			</a>
		</td>
		<td><?php print $data['branch_name']?></td>
		<td><?php print $data['branch_location']?></td>
		<td><?php print __mpc_branchMg__($conn, $data['branch_manager'])[0]?></td>
		<td><?php print $pix?></td>
		<td><?php print $data['credit_officer']?></td>
	</tr>

<?php
	}

	echo "</table>";
	}
}

//checking user previlege
function __mpc_checkUserPrev__($prev, $response){
//msg = ACCESS_GRANTED
//msg = ACCESS_DENIED
//msg = ACCESS_REVOKE
//msg = ACCESS_GRANTED
	if($prev == 2){
		exit($response); //pages or information that admin wount be given access to

	}else if($prev == 3){

		exit($response); //pages or information that editor wount be given access to
	}
}

//branch manager by id returns name and profile
function __mpc_branchMg__($conn, $id){
//branch mg
	if($id == 'not assigned') {
		$name = 'Not Assigned';
		$profile = 'Unavailable';

		$arr = [$name, $profile];

		return $arr;
		exit();
	}

	$sql = "SELECT user_fname, user_lname, user_profile FROM mpc_user WHERE user_id=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "MG picture error";
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	$data = mysqli_fetch_array($d);
	$name = $data['user_fname'] /*try to concate fn and ln*/.' '. $data['user_lname'];
	$profile = $data['user_profile'];

	$arr = [$name, $profile];

	return $arr;
}

//mpc all branches by name
function __mpc_branchesName($conn, $tbl, $whattoselect, $whereId){
	$sql = "SELECT $whattoselect FROM $tbl ORDER BY $whereId DESC";
	if(!mysqli_num_rows(mysqli_query($conn, $sql)) >0){
		$Err = "<h4 class=\"text-center\"> No data Found!</h4>";
		echo $Err;
		//exit();
	}else {
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "$whattoselect get failed";
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit();
		}

	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	while($data = mysqli_fetch_array($d)){
		?>
			<option value="<?php print $data[$whattoselect]?>"> <?php print $data[$whattoselect]?></option>
		<?php
	}
}

//mpc display group
function __mpcAll_availableGroup__($conn, $privilege, $branch, $whattoselect, $tbl, $howToReturn, $uidUser, $target){
	/**this function will be aable to select any table and also return
	 * any type of data be it table
	 * it will be able to return array,
	 * table,
	 * options,
	 * list
	 */
	//print_r($whattoselect);
	if($privilege == 1 || $privilege == 4){
		$sql = "SELECT * FROM $tbl ORDER BY $whattoselect[0] DESC";
	}else if($privilege == 2 || $privilege == 3 || $privilege == 5){
		 $sql = "SELECT * FROM $tbl WHERE $whattoselect[2]='$branch' ORDER BY $whattoselect[0] DESC";
	}


	if(!mysqli_num_rows(mysqli_query($conn, $sql)) >0){ //tying to know if any record exist
		$Err = "No single record found, please try to create one";
		echo $Err;
	}

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unexpected error while gettting '$whattoselect[2]', please contact system developer ASAP.";
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt); //execute stmt request
	$d = mysqli_stmt_get_result($stmt);


	//we are trying to get all data remember
	//so while loop is okay right :) &#53b4v;
	while($data = mysqli_fetch_array($d)){
		if($howToReturn == 'table-data'){
		//	$td = "<tr><td>". $data[$whattoselect] ."</td></tr>";
			//print $td;
			if(is_array($whattoselect)){


				$col1 = $whattoselect[0];
				$col2 = $whattoselect[1];
				$col3 = $whattoselect[2];
				$col4 = $whattoselect[3];
				$col5 = $whattoselect[4];

				$assignUrl = __mpc_root__() . 'user/dashboard';

				$url = __mpc_root__() . "user/dashboard.php/?action=verifyAction&actionId=$data[$col1]&t=$target&r1=Settings&r2=createGroup";

				$td = "<tr><td class=\"mpc-data\" mpcs-dataId=\"$data[$col1]\">" .$data[$col1]. "<a href=\"$url\" title=\"Remove this $target\" class=\"rmv-item\" target=\"_blank\" rel=\"noopener noreferrer\"> <i class=\"fa fa-trash-alt\"></i></a></td>";
				$td .= "<td>" .$data[$col2]. "</td>";
				$td .= "<td>" .$data[$col3]. "</td>";
				$td .= "<td>" .$data[$col4]. "</td>";
				$td .= "<td>" . __Adm__($data[$col5])."</td>";
				$td .= "<td>" . "<a href=\"$assignUrl/?action=AssignGroupMember&grpId=$data[$col1]\"> Assign member</a>"."</td></tr>";

				//$td .= "<td>" .$data[$col5]. "</td></tr>";

				echo $td;
			}








		}else if($howToReturn == 'options'){
			//$optionvalue = $whattoselect[1];
			$td = "<option value=\"{$data[$whattoselect[1]]}\">". $data[$whattoselect[1]] ."</option>";
			print $td;
		}else if($howToReturn == 'list'){
			$td = "<li class=\"{$data[$whattoselect[0]]}\">". $data[$whattoselect[1]] ."</li>";
			print $td;
		}
	}


}

//function to return admin data information by id
function __mpcReturnByIdAll__($conn, $id){

		$sql = "SELECT * FROM mpc_user WHERE user_id=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = 'Unexpected error while retrieving admin information';
			$Err.= __mpcDeveloper__()[0];
			$Err.= __mpcDeveloper__()[1];
			$Err.= __mpcDeveloper__()[2];
			$Err.= __mpcDeveloper__()[3];
			$Err.= __mpcDeveloper__()[4];
			echo $Err;
			exit();
		}
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);

		$data = mysqli_fetch_array($d);

		$rtn = [$data['user_id'], $data['user_fname'], $data['user_lname'], $data['user_username'], $data['user_previllege'], $data['user_profile'], $data['user_security_q'], $data['user_security_a'], $data['branch']];

		return $rtn;
}

//function to return admin data information by id
function __mpcReturnByPhoneMember($conn, $phone){
	$sql = "SELECT * FROM mpc_members WHERE phone=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Unexpected error while retrieving admin information';
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 's', $phone);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	$data = mysqli_fetch_array($d);


//it return 18 items in the array starting from index 0
$rtn = [$data['members_id'], $data['title'], $data['sex'], $data['date_of_birth'], $data['name'], $data['phone'], $data['contact_addr'], $data['place_of_birth'], $data['email'],  $data['occupation'], $data['registration_number'], $data['groups'], $data['registration_date'],  $data['status'], $data['v_ph'], $data['v_em'], $data['branch'], $data['mem_pwd'], $data['user_profile'], $data['permanent_addr'], $data['lga'], $data['religion'], $data['business_addr'], $data['church'], $data['declaration']];

	return $rtn;
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}

//function to return admin data information by id
function __mpcReturnByAccountMember($conn, $account){

	$sql = "SELECT * FROM mpc_members WHERE registration_number=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Unexpected error while retrieving admin information';
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 's', $account);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	$data = mysqli_fetch_array($d);


//it return 18 items in the array starting from index 0
$rtn = [$data['members_id'], $data['title'], $data['sex'], $data['date_of_birth'], $data['name'], $data['phone'], $data['contact_addr'], $data['place_of_birth'], $data['email'],  $data['occupation'], $data['registration_number'], $data['groups'], $data['registration_date'],  $data['status'], $data['v_ph'], $data['v_em'], $data['branch'], $data['mem_pwd'], $data['user_profile'], $data['permanent_addr'], $data['lga'], $data['religion'], $data['business_addr'], $data['church'], $data['declaration']];

	return $rtn;
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}


//admin
function __mpc_small_mini__($conn, $req, $tblId, $whattoselect, $where,  $tbl){
//perform multiple action in one
			/**THIS PAGE AM USING IT TO VERIFY ADMIN BASE ON WHAT HE WANT TO DO
             * I MEAN HIS/HER ACTION
             * CODE FROM THIS VERIFICATION PAGE
             * THERE IS A FUNCTION BELOW CALLED __MPC_SMALL_MININ__();
             * THIS FUNCTION ACCEPT 6 (SIX) AGUMENT
             * [0] => DATABASE CONNECTION
             * [1] => COLUMN ['COUNT', 'COLUMN', 'ALL']
             * COUNT MEANS COUNT FROM A PARTICULAR TABLE
             * COLUMN MEANS SELECT A PARTICULAR COLUMN FROM A PARTICULAR TABLE
             * ALL MEANS SELECT ALL ROWS IN A TABLE WHERE DATA MATCH A PARTICULAR RECORD
             * [2] => TABLE ID WHICH QUERY WILL BE CONDUCTED
             * [3] => WHAT EXACTLY ARE YOU SELECTING INSIDE DATABASE
             * [4] => PASSING A WHERE CLAUSE TO THE DB QUERY
             * [5] => TABLE WHICH THIS QUERY WILL BE CARRIED ON
             */

	if($req == 'count') {
		 $sql = "SELECT COUNT(*) AS $tblId FROM $tbl WHERE $where='$whattoselect'";

		//"SELECT COUNT(*) AS key_id FROM diet_analytics_key";
		$rtn = $whattoselect;
	}else if($req == 'ALL'){
		$sql = "SELECT * FROM $tbl WHERE $where='$whattoselect'";
	}else if($req == 'column'){
		if(is_array($whattoselect)){
			$selectColumn = implode(',', $whattoselect); //convert select columns from array into a string with comma seperated
			$sql = "SELECT $selectColumn FROM $tbl";
		}else{
			 $sql = "SELECT $whattoselect FROM $tbl WHERE $where='$tblId'";
		}
		//echo $sql."</br>";
	}
	//echo $sql;
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unexpected error ";
		//echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	return $data;
}

/**GETTING FUNCTION THAT THAT UPDATE
 * \ MY NAME IS YAKISE RAPHAEL ETIM
 * I AM A NATIVE OF USE-OFFOT VILLAGE IN UYO LOCAL GOVERNMENT AREA
 *
*/
function __mpc_update__($conn, $data, $tbl, $tblCol, $updateReplace){

// "UPDATE $tbl SET $tblCol='$updateReplace' WHERE $tblCol='$data'";
	if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tbl WHERE $tblCol='$data'")) >0){

		$sql = "UPDATE $tbl SET $tblCol='$updateReplace' WHERE $tblCol='$data'";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "Unable to truncate $tbl";
			$Err.= __mpcDeveloper__()[0];
			$Err.= __mpcDeveloper__()[1];
			$Err.= __mpcDeveloper__()[2];
			$Err.= __mpcDeveloper__()[3];
			$Err.= __mpcDeveloper__()[4];
			echo $Err;
			exit();
		}else {

			if(mysqli_stmt_execute($stmt)){
				$Err = 1;
				return $Err;
			}else {
				$Err = 0;
				return $Err.mysqli_error($conn);
			}

		}
	}else {
		return 0;
	}



}

function __mpc_delete_data__($conn, $tble, $tblId, $tbleCol, $dataName, $userfrom){
	/**CHECKING IF DATA EXIST
	 * first agument
	 * connection to db
	 * table name
	 * table id
	 * table column
	 * actual delete data by name
	 */
	//echo "SELECT * FROM $tble WHERE $tbleCol='$tblId'";
	//echo "</br>";
	//echo "DELETE FROM $tble WHERE $tbleCol='$tblId'";
	//ECHO $sql = "DELETE FROM mpc_last_login WHERE last_login_id ='$tblId' && user_from='mpc_user'";


	if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tble WHERE $tbleCol='$tblId'"))>0){

		 $sql = "DELETE FROM $tble WHERE $tbleCol='$tblId'";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "Unexpected error, while trying to run Delete data on $dataName";
			echo $Err;
			exit();
		}

		if(mysqli_stmt_execute($stmt)){
			$Err = "successfully deleted";
			echo $Err;

			if(!empty($userfrom) && $userfrom == 'user'){
				//$user_from = $userfrom;


				$sql1 = "DELETE FROM mpc_last_login WHERE user_id='$tblId' && users_from='$userfrom'";
				mysqli_query($conn, $sql1);

			}else{

				$sql1 = "DELETE FROM mpc_last_login WHERE user_id='$tblId' && users_from='$userfrom'";
				mysqli_query($conn, $sql1);

				//MEMBER ACCOUNT DELETE ACTION START HERER
				__deleteMembersAccount__($conn, $tblId, 'mpc_welfare_contribution', 'welfare_mem_id'/**$phone */); //WELFARE CONTRIBUTION
				__deleteMembersAccount__($conn, $tblId, 'mpc_thrift_saving', 'thrift_mem_id'/**$phone */); //THRIFT SAVING
				__deleteMembersAccount__($conn, $tblId, 'mpc_special_saving', 'mem_id'/**$phone */); //SPECIAL SAVING
				__deleteMembersAccount__($conn, $tblId, 'mpc_member_verification', 'verify_for'/**$phone */); //MEMBERS VERIFICATION TABLE
				__deleteMembersAccount__($conn, $tblId, 'mpc_fixed_deposit', 'fixed_mem_id'/**$phone */); //FIXED DEPOSITE
				__deleteMembersAccount__($conn, $tblId, 'mpc_account_shares', 'shares_member_id'/**$phone */); //SHARE ACCOUNT

				//MEMBER ACCOUNT DELETE ACTION END HERER
			}

			// mysqli_stmt_close($stmt); //i comment this line out because it affecting order function from working
			 //mysqli_close($conn);//i comment this line out because it affecting order function from working
			 exit();
		}


	}else {
		echo $Err = "$dataName, Not in record list, reason maybe you have already deleted";
	}
}

//FOR THE PURPOSE OF KEEPING RECORD OF WHAT HAS BEEN DELETED FROM THE SYSTEM
//WE WILL DO IT THIS WAY, ALLOWED THE SYSTEM TO RECORD ANYTHING THAT AS BEEN DELETED
//FOR DOCUMENTATION PURPOSES
function __mpcdocumented($conn, $dataId, $datatype, $deleteBy){
	//start
	$dtzne = date_default_timezone_set('Africa/Lagos');
	$date = date('d/n/Y, g:i:s a');

	$sql = "INSERT INTO mpc_deleted_data_track (data_id, data_type, deleted_by, time_and_date)VALUES(?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unexpected error";
		echo $Err;
		exit();
	}else {
		mysqli_stmt_bind_param($stmt, 'ssss', $dataId, $datatype, $deleteBy, $date);
		mysqli_stmt_execute($stmt);
	}

}
//function mpc notification
//record notification
function __mpc_notify__($conn, $notTxt, $notType, $notFor, $notForId, $notStatus, $rtnStatus, $sender){
	$dtzne = date_default_timezone_set('Africa/Lagos');
	$date = date('d/n/Y, g:i:s a');
	$defaultView = 0;
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
                 * 2 => staff read
                 * 3 = > members read
                 *
                 */

	$sql = "INSERT INTO mpc_notification (notification_for, notification_for_id, notification_sender, notification, status, time_and_date, type, views)VALUES(?,?,?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Error, unexpected error occured";
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ssssssss", $notFor, $notForId, $sender, $notTxt, $notStatus, $date, $notType, $defaultView);

	if(mysqli_stmt_execute($stmt)){
		if(is_int($rtnStatus) && $rtnStatus === 1){
			$Err = 'MPCs notification Sent!';
			echo $Err;
			exit();
		}
	}
}

//function that delete members account info
function __deleteMembersAccount__($conn, $id, $tbl, $colname/**,$phone */) {
/**later i will convert this function
 * VALID DATA ACCEPTED BY THIS FUNCTION
 * [0] = DATABASE CONNECTION
 * [1] = ITEM ID THAT'S TO BE DELETED
 * [2] = TABLE NAME, THE DATABASE TABLE NAME TO DELETED DATA FROM
 * [3] = TABLE COLUMN BY NAME
  */
	$sql = "DELETE FROM $tbl WHERE $colname='$id'";
	mysqli_query($conn, $sql);
}

//get and return as table data
function __mpc_data__($conn, $prev, $tbleCol, $tble, $branch, $selcol=''){
	/**THIS FUNCTION WILL GET DATA INSIDE DB AND RETURN
	 * IT WILL RETURN DATA BASE ON WHAT ADMIN WANTS
	 * SUPER ADMIN AND DEVELOPER WILL HAVE ACCESS TO ALL DATA
	 * ADMIN WILL ONLY HAVE ACCESS TO HIS/HER BRANCH
	 * AGUMENT DEFINATION
	 * [0] DATABASE CONNECTION
	 * [1] PRIVILEGDE
	 * [2] TABLECOLUMN TO SELECT DATA FROM
	 * [3] TABLE TO GET DATA FROM
	 * [4] BRANCH TO GET DATA FROM
	 * [5] HOW TO RETURN DATA GET FROM DB
	 */

	if($prev == 1 || $prev == 4){
		$sql = "SELECT * FROM $tble ORDER BY $selcol[0] DESC LIMIT 100";
	}else if($prev == 2 || $prev == 4 || $prev == 5){
		// $sql = "SELECT * FROM $tble WHERE $tbleCol='$branch' ORDER BY $selcol[0] DESC LIMIT 50";
		$sql = "SELECT * FROM $tble ORDER BY $selcol[0] DESC LIMIT 50";

	}
	$col1 = '';
	$col2 = '';
	$col3 = '';
	$col4 = '';
	$col5 = '';
	$col6 = '';
	$col7 = '';
	$col8 = '';
	$col9 = '';
	$col10 = '';
	//collect data here
	$col0 = $selcol[0];
	$col1 = $selcol[1];
	$col2 = $selcol[2];
	$col3 = $selcol[3];
	$col4 = $selcol[4];
	$col5 = $selcol[5];
	$col6 = $selcol[6];
	$col7 = $selcol[7];
	$col8 = $selcol[8];
	$col9 = $selcol[9];
	$col10 = $selcol[10];
	//START STATEMENT
	//echo $sql;

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "UNEXPECTED ERROR WHILE TRYING TO GET $tbleCol";
		echo $Err.mysqli_error($conn);
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	while ($data = mysqli_fetch_array($d)) {
		if($data[$col9] == 0){
			$status = "<i class=\"fas fa-user-times\" title=\"Account not Activated\"></i> Not activated";
		}else {
			$status = "<i class=\"fas fa-user-check\" title=\"Account Activated\"></i> Activated";
			//3057319887
		}
		?>
		<tr>
			<td>
				<?php echo $data[$col0]?>
				<a href="<?php echo __mpc_root__()?>user/dashboard.php/?action=verifyAction&actionId=<?php echo $data[$col0]?>&t=member&r1=Settings&r2=createMember" class="rmv-item">
					<i class="fa-trash-alt fas "></i>
				</a>
			</td>
			<!--<td><?php //echo $data[$col1]?></td>-->
			<td><?php echo $data[$col2]?></td>
			<td><?php echo $data[$col3]?></td>
			<td><?php echo $data[$col4]?></td>
			<!--<td><?php //echo $data[$col5]?></td>-->
			<!--<td><?php //echo $data[$col6]?></td>-->
			<td><?php echo $data[$col7]?></td>
			<!-- <td><img src="<?php echo __mpc_root__().'asset/img/'. $data[$col8]?>" alt="member pics" srcset="<?php echo __mpc_root__().'asset/img/'. $data[$col8]?>" class="dboard-img"></td>
			<td class="member-status"><?php echo $status?></td> -->
		</tr>

		<?php
	}
}
/***function that check and return supa admin information only
*the is another function that return admin information
*the function accept two agguement, connection and admin phone
*then returns and array of information about admin
* in a place where i only want the real supa admin of the system
*then am out of phone numer/ i mean if am not able to get supa admin phone then this
*function below will perform the excert same thing
*/
function __mpc_SupaAdminOnly($conn, $superAdminId){
	$sql = "SELECT * FROM mpc_user WHERE user_id='$superAdminId'";
	if(!$q = mysqli_query($conn, $sql)){
		$Err = 'UNEXPECTED ERROR WHILE GETTING SUPA ADMIN';
		echo $Err;
		exit();
	}
	$data = mysqli_fetch_array($q);

	$rtn = [$data['user_id'], $data['user_fname'], $data['user_lname'], $data['user_username'], $data['user_previllege'], $data['user_profile'], $data['user_security_q'], $data['user_security_a'], $data['branch']];

	return $rtn;

}

//LOAD ALL BRANCHES FROM MPC BRANCH TABLE
function __mpc_branchWithoutMg__($conn, $privilege, $branch){
	$v = 'not assigned';
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_branches WHERE branch_manager='$v' && credit_officer='$v'"))>0){
		$Err = "<caption> No record found, its seems as if you dont have any pending branch without a Manager!</caption>";
		echo $Err;

		//exit();
	}

	$sql = "SELECT * FROM mpc_branches WHERE branch_manager=? && credit_officer=? LIMIT 50";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "UNPEXPECTED ERROR WHILE LOADING BRANCH";
		$Err.= __mpcDeveloper__()[0];
		$Err.= __mpcDeveloper__()[1];
		$Err.= __mpcDeveloper__()[2];
		$Err.= __mpcDeveloper__()[3];
		$Err.= __mpcDeveloper__()[4];
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $v, $v);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	while ($data = mysqli_fetch_array($d)) {
		?>
			<tr>
				<td><?php echo $data['branch_id']?></td>
				<td><?php echo $data['branch_name']?></td>
				<td><?php //a['branch_name']?>
					<select class="mpc-disabled LoanType adm-select assign-to" title="CHOOOSE MANAGER FOR THIS BRANCH <?php echo $data['branch_name']?>">
						<option value="">----</option>
						<?php
							__mpc_user__($conn, 'mpc_user', 'options', 'user_id');
							/**AVAILABLE USERS DISPLAY HERE */
						?>
					</select>
				</td>

				<td><?php //a['branch_name']?>
					<select class="mpc-disabled LoanType adm-select crOfficer" title="CHOOOSE CREDIT OFFICER FOR THIS BRANCH <?php echo $data['branch_name']?>">
						<option value="">----</option>
						<?php
							__mpc_user__($conn, 'mpc_user', 'options', 'user_id');
							/**AVAILABLE USERS DISPLAY HERE */
						?>
					</select>
				</td>

				<td>
					<button class="mpc-disabled mpc-loan-butt assign-BMg mpc-btn" style="width:100%;margin-top:0;" mpc-branchId="<?php echo $data['branch_id']?>" mpc-label="">SAVED</button>
				</td>
			</tr>

		<?php
	}
	?>
<script>
	var label, label1, label2, assignButt, xhr, rtnTxt;
		label = document.querySelectorAll('.assign-to');
		label1 = document.querySelectorAll('.crOfficer');
		label2 = document.querySelectorAll('.assign-BMg');
		rtnTxt = document.querySelector('.mpc-admin-ds-notify');
		for (let i = 0; i < label.length; i++) {
			const el1 = label[i];
			//set new attributes
			//do some magic

			el1.setAttribute('mpc-indent', 'data'+i);
			el1.classList.add('data'+i);
			//i++;
		}
		for (let i = 0; i < label1.length; i++) {
			const el1 = label1[i];
			//set new attributes
			//do some magic

			el1.classList.add('data1'+i);
			//i++;
		}

		for (let i = 0; i < label2.length; i++) {
			const el1 = label2[i];
			//set new attributes
			//do some magic

			el1.setAttribute('identifier1', 'data'+i);
			//i++;
		}

		for (let i = 0; i < label2.length; i++) {
			const el1 = label2[i];
			//set new attributes
			//do some magic

			el1.setAttribute('identifier2', 'data1'+i);
			//i++;
		}


		//SELECT ALL THE ASSIGNMENT BUTTON HERE AT ONCE
		assignButt = document.querySelectorAll('.assign-BMg');
		//LET LOOP THROUGH IT using for loop
		for (let x = 0; x < assignButt.length; x++) {
			assignButt[x].addEventListener('click', function(){
				var attr1, attr2, data1, data2, branchId, disabledJustclick;

				attr1 = this.getAttribute('identifier1');
				attr2 = this.getAttribute('identifier2');
				branchId = this.getAttribute('mpc-branchId');
				disabledJustclick = this;

				//get query data
				data1 = document.querySelector('.' + attr1);
				data2 = document.querySelector('.' + attr2);

				//alert(data1.value);

				if(data1.value == ''){
					data1.style.border = '1px solid #ff0000';
					data1.style.color = '#ff0000';
					rtnTxt.innerHTML = 'Select manager for this branch';
					rtnTxt.classList.add('to-red-color');
				}else if(data2.value == ''){
					data2.style.border = '1px solid #ff0000';
					data2.style.color = '#ff0000';
					rtnTxt.innerHTML = 'Select credit officer for this branch';
					rtnTxt.classList.add('to-red-color');
				}else {
					data2.style.border = 'none';
					data2.style.color = '#ffffff';

					data1.style.border = 'none';
					data1.style.color = '#ffffff';
					rtnTxt.innerHTML = '';
					rtnTxt.classList.remove('to-red-color');

//start ajax request here
					xhr = new XMLHttpRequest(); //create a new ajax request;
					xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?PERM=AssignbMG&x1='+data1.value + '&x2='+data2.value + '&tblId=' +branchId, true);
					xhr.onreadystatechange = function(){
						rtnTxt.innerHTML = 'PROCESSING REQUEST. please wait...';
						if(this.readyState == 4 && this.status == 200){


							if(this.response == 'Update Successfull'){
								rtnTxt.innerHTML =  'Request process successful...';//(__showOKaySuccess__()); //TRYING TO SHOW SUCCESS ANIMATION HERE FA-CHECK
								console.log(this.status);
								disabledJustclick.disabled = true;
								disabledJustclick.title = 'DISABLED, DON\'T CLICK AGAIN, BUTTON HAS BEEN DISABLED BY DEVELOPER';
							}else {
								rtnTxt.innerHTML = this.responseText;
								console.log(this.status);
							}
						}
					}
					xhr.send();
				}

			})

		}


</script>
	<?php
}

//count and display notification for members
function __mpcNotificationForAdmin__($conn, $AdminId, $AdminPrev){
    $views = 0;
    $AminUsername = __mpcReturnByIdAll__($conn, $AdminId)[3];

	if($AdminPrev == 1 || $AdminPrev == 4){
        $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification  WHERE type='5' || notification_for='$AminUsername' && notification_for_id='$AdminId' && status='$views'";

    }else if($AdminPrev == 2 || $AdminPrev == 3){
        $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification  WHERE notification_for='$AminUsername' && notification_for_id='$AdminId' && views='0' ";
    }else if($AdminPrev == 5){
        $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification  WHERE notification_for='$AminUsername' && notification_for_id='$AdminId' && views='0' ";

	}


   // $sql = "SELECT COUNT(*) AS notification_id FROM mpc_notification WHERE notification_for=? && notification_for_id=? && views=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        $Err = 'ERROR';
        echo $Err;
        exit();
    }
   // mysqli_stmt_bind_param($stmt, 'ssi', $memPhone, $memId, $views);
    mysqli_stmt_execute($stmt);
    $d = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_array($d);

    return $data['notification_id'];
}
//allowwed admin to read notification
function __showAdmin_Notification__($conn, $AdminId, $AdminPrev){
	$views = 0;
	$type = 5;
    $status = 0;
    $AminUsername = __mpcReturnByIdAll__($conn, $AdminId)[3];

	if($AdminPrev == 1 || $AdminPrev == 4){
        $sql = "SELECT * FROM mpc_notification  WHERE status='$status' || notification_for='$AminUsername' && notification_for_id='$AdminId' && type='$type' ORDER BY notification_id DESC";

    }else if($AdminPrev == 2 || $AdminPrev == 3 || $AdminPrev == 5){
        $sql = "SELECT * FROM mpc_notification  WHERE notification_for='$AminUsername' && notification_for_id='$AdminId' && views='0' ORDER BY notification_id DESC ";
    }

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unepxected Error... pls contact developer for help";
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	while($data = mysqli_fetch_array($d)){

		$notShort = substr($data['notification'], 0, 49) . '...';
		?>
		<tr>
			<td><?php echo $data['notification_id']?></td>
			<td><?php echo $data['notification_sender']?></td>
			<td><?php echo $notShort ?></td>
			<td><?php echo $data['time_and_date']?></td>
			<td><?php echo $data['notification_id']?></td>
			<td>
				<a href="<?php __mpc_root__()?>?action=AdminRead&v=true&notId=<?php echo $data['notification_id']?>&reader=<?php echo $AdminId ?>">
					<button class="mpc-btn" type="button">Read</button>
				</a>
			</td>
		</tr>

<?php
	}
}


//function to let admin read notificatin
function __mpcShowAdminNotification__($conn, $AdminId, $notifcationId){

	//CHECK FIRST TO AVOID UNECESSARY error
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT notification_id FROM mpc_notification WHERE notification_id='$notifcationId'"))>0){
		$Err = "Notification not found!";
		echo $Err;
		exit();
	}

	$sql = "SELECT * FROM mpc_notification WHERE notification_id=?";

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){

		$Err = "Notification load fail";
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 'i', $notifcationId);

	if(mysqli_stmt_execute($stmt)){
		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		if($AdminId == 1){
			$sql = "UPDATE mpc_notification SET status='1', type='1' WHERE notification_id='$notifcationId'";
		}else {
			$sql = "UPDATE mpc_notification SET views='1' WHERE notification_id='$notifcationId'";
		}

		mysqli_query($conn, $sql);

		//let return our notification back to admin right away
		return $data;
	}

}
//load user with name
function __mpc_user__($conn, $tble, $rtn, $order){
	$sql = "SELECT * FROM $tble ORDER BY $order DESC";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "USER GET FAILED";
		echo $Err;
	}else {
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);

		while ($data = mysqli_fetch_array($d)) {
			if($rtn == 'table-data'){
				?>
					<tr>
						<td><?php echo $data['user_id']?></td>
					</tr>
				<?php
			}else if($rtn == 'options'){
				$name = $data['user_fname'] .' '. $data['user_lname'];
				?>
					<option mpc-ownerId="<?php echo $data['user_id']?>" value="<?php echo $data['user_id']?>"><?php echo $name?></option>
				<?php
			}
		}
	}
}

//mpc add member miscellenouse data
function __mpc_memp_misc__($conn, $tbl, $rtnMSg, $col, $bindData){
	//let sstart here
	/**THIS FUNCTION WILL PERFORM MULTIPLE FUNCTION
	 * IT WILL ADD DATA IN ALL MPC ACCOUNT TABLE
	 */
	$memId = $bindData[0]; //member id
	$memPh = $bindData[1]; //member phone
	$memdr = $bindData[2]; //member cr ibad akuk s'suho
	$memCr = $bindData[3]; //ibad akuk se esio
	$memBl = $bindData[4]; //ibad akuk se isuho ata afid
	$memDate = $bindData[5]; //ibad akuk se isuho ata afid

//	echo $columns = implode(',' , $col);
	$colId = $col[0];
	$colPhone = $col[1];
	$colcredit = $col[2];
	$colDebit = $col[3];
	$colBalance = $col[4];
	$colDateTime = $col[5];

	$sql = "INSERT INTO $tbl ($colId, $colPhone, $colcredit, $colDebit, $colBalance, $colDateTime) VALUES('$memId', '$memPh', '$memdr', '$memCr', '$memBl', '$memDate')";
	if(mysqli_query($conn, $sql)){

		//on success message
		if($rtnMSg !== ''){
			//if need for success message
			echo "success";
		}
	}
}

//function to get members account balance
function __mpc_getMember_balance__($conn, $memberId, $membPhone, $tbl, $col1, $col2){
	/**AT DEFAULT THIS FUNCTION WILL GET MEMBERS
	 * ACCOUNT INFORMATION ON DIFFERENT ACCOUNT AVAILABLE
	 *
	 */
	$sql = "SELECT * FROM $tbl WHERE $col1=? && $col2=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		$Err = 'BADERR';
		return $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 'ss', $memberId, $membPhone);
	mysqli_stmt_execute($stmt);

	//get data
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	$arr = [$data['debit'], $data['credit'], $data['balance']];
	return $arr;
	exit();
}

//function to get member account balance
function __mpcMemberAccountBal__($conn, $tbl, $memId, $memPh, $tblCol1,  $tblCol2, $tbl_incre){
	$sql = "SELECT * FROM $tbl WHERE $tblCol1=? && $tblCol2=? ORDER BY $tbl_incre DESC";
	//echo $sql;
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)) {
		$Err = "Unexpected Err";
		echo $Err.mysqli_error($conn);
		exit();
	}
		mysqli_stmt_bind_param($stmt, 'ss', $memId, $memPh);
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		$arr = [$data['debit'], $data['credit'], $data['balance']];

		return $arr;
}

//send an SMS alert form both parties
function __mpcMemberSmsAlertDebit($conn, $phone, $amount, $bal, $acct, $acctByName, $to) {

/**bulk sms company information will start here
 * then continue below
 */
	$tzne = date_default_timezone_set('Africa/Lagos');
	$date = date('d/n/Y, g:i:s a');

	$msg = "Your account $acct, has been debited with $amount \r\n";
	$msg .= "Your $acctByName has been debited with $amount, to $to on $date \r\n";
	$msg .= "Balance: $bal. \r\n";
	$msg .= "GOODLIFE UYO MPCS";

	$sendPhone = '234'. substr($phone, -10, 11);
	/**BULK SMS SEND FUNCTION */


	$email = "your multitexter registered email ";
	$password = "Your password";
	$message = $msg;
	$sender_name = "GOODLIFE UYO MPCS";

	$recipients = $sendPhone; //"mobile numbers seperated by comma e.9 2348028828288,234900002000,234808887800";
	$forcednd = 1;
	$data = array("email" => $email, "password" => $password,"message"=>$message, "sender_name"=>$sender_name,"recipients"=>$recipients,"forcednd"=>$forcednd);
	$data_string = json_encode($data);
	$ch = curl_init('https://app.multitexter.com/v2/app/sms');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string))); $result = curl_exec($ch);

	$res_array = json_decode($result);
	print_r($res_array);

}

//send an SMS alert form both parties
function __mpcMemberSmsAlertCredit($conn, $Phone, $amount, $bal, $acct, $acctByName, $sender) {

	/**bulk sms company information will start here
	 * then continue below
	 */
		$tzne = date_default_timezone_set('Africa/Lagos');
		$date = date('d/n/Y, g:i:s a');

		$msg = "Your account $acct, has been credited with $amount \r\n";
		$msg .= "Your $acctByName has been credited with $amount, from $sender on $date \r\n";
		$msg .= "Balance: $bal. \r\n";
		$msg .= "JUSTICE UYO MPCS";

		$sendPhone = substr($Phone, -10, 11);
		$phoneAdd234 = '234'. $sendPhone;
		/**BULK SMS SEND FUNCTION */

		$email = "your multitexter registered email ";
		$password = "Your password";
		$message = $msg;
		$sender_name = "JUSTICE UYO MPCS";

		$recipients = $phoneAdd234; //"mobile numbers seperated by comma e.9 2348028828288,234900002000,234808887800";
		$forcednd = 1;
		$data = array("email" => $email, "password" => $password,"message"=>$message, "sender_name"=>$sender_name,"recipients"=>$recipients,"forcednd"=>$forcednd);
		$data_string = json_encode($data);
		$ch = curl_init('https://app.multitexter.com/v2/app/sms');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string))); $result = curl_exec($ch);

		$res_array = json_decode($result);
		print_r($res_array);

}

//FUNCTION THAT ALLOWED ADMIN TO SEND BULK SMS TO USER
function __send_mpc_bulky__($phoneArray, $msg){

		$email = "your multitexter registered email ";
		$password = "Your password";
		$message = $msg;
		$sender_name = "GOODLIFE UYO MPCS";

		$recipients = $phoneArray; //"mobile numbers seperated by comma e.9 2348028828288,234900002000,234808887800";
		$forcednd = 1;
		$data = array("email" => $email, "password" => $password,"message"=>$message, "sender_name"=>$sender_name,"recipients"=>$recipients,"forcednd"=>$forcednd);
		$data_string = json_encode($data);
		$ch = curl_init('https://app.multitexter.com/v2/app/sms');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string))); $result = curl_exec($ch);

		$res_array = json_decode($result);
		print_r($res_array);
}

//mpc transaction history make record
function __mpc_memberTransaction_makeRecords__($conn, $senderId, $senderPhone, $receiverId, $receiverPhone, $transactionType, $transactionAmount, $transactionStatus, $rtn){
	$tzne = date_default_timezone_set('Africa/Lagos');
	$date = date('d/n/Y, g:i:s a');
	$year = date('Y');

	$sql = "INSERT INTO mpc_transaction_history (transaction_from_id, transaction_from, transaction_to_id, transaction_to, transction_type, transaction_amount, transaction_status, transaction_date_time, year)VALUES(?,?,?,?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "UNEXPECTED ERROR OCCUR, PLS CONTACT SYSTEM DEVELOPER ASAP!!";
		echo $Err;
		exit();
	}

	mysqli_stmt_bind_param($stmt, 'sssssssss', $senderId, $senderPhone, $receiverId, $receiverPhone, $transactionType, $transactionAmount, $transactionStatus, $date, $year);
	if(mysqli_stmt_execute($stmt)){
		if($rtn == 1){
			$Err = "Transaction recorded successful";
			echo $Err;
			exit();
		}
	}
}

//function to send anything to any number within the cooperative
function __mpc_send_anyting__($conn, $phone, $msg){

	substr($phone, 0, 1);
	//add nigerian international code calling/dialing code
	$To = 234 .$phone;
	$from = 'GOODLIFE';

	//Send an SMS using Gatewayapi.com

    $email = "dietandhealthfoundation@gmail.com";
    $password = '*TkL$biUJGL3ZWm';
    $message = $msg;
    $sender_name = $from;
    $recipients = $To;
    $forcednd = 1;

    $data = array("email" => $email, "password" => $password,"message"=>$message, "sender_name"=>$sender_name,"recipients"=>$recipients,"forcednd"=>$forcednd);
    $data_string = json_encode($data);
    $ch = curl_init('https://app.multitexter.com/v2/app/sms');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
    $result = curl_exec($ch);
    $res_array = json_decode($result);
    print_r($res_array);
}


//function mpc member transaction
function __mpc__trans__($conn, $Phone, $id) {
	$sql = "SELECT * FROM mpc_transaction_history WHERE transaction_from_id='$id' && transaction_from='$Phone' /*|| transaction_to_id='$id' && transaction_to='$Phone' */ORDER BY transaction_id DESC LIMIT 20";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "Unexpected Error";
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	while($data = mysqli_fetch_array($d)){
		$TransfromId = $data['transaction_from_id'];
		$TransfromPhone = $data['transaction_from'];

		$TransToId = $data['transaction_to_id'];
		$TransToPhone = $data['transaction_to'];

		$fromName = __mpcReturnByPhoneMember($conn, $TransfromPhone)[4]; //money to sender name
		$ToName = __mpcReturnByPhoneMember($conn, $TransToPhone)[4]; //sender to receiver name
		$acctnNo = __mpcReturnByPhoneMember($conn, $TransToPhone)[10]; //sender to receiver name
		$VerifyAccountPhoneNumber = __mpcReturnByPhoneMember($conn, $TransfromPhone)[5]; //s

		if($data['transction_type'] == 'Debit' && $TransfromPhone !== $VerifyAccountPhoneNumber){
			$type =  'Credit '."<i class=\"fas fa-angle-double-down\" style=\"color:green;\"></i>";
		}else {
			$type = $data['transction_type'] .' '."<i class=\"fas fa-angle-double-up\" style=\"color:red;\"></i>";
		}
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

//function to get all available intrest rate
function __mpc_get_IntrestRate__($conn, $type){
	//start here
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_intrest_rate")) >0){
		$Err = "<caption>You have'nt set any interest rate yet!</caption>";
		echo $Err;

	}else {
		$sql = "SELECT * FROM mpc_intrest_rate ORDER BY intrest_id DESC LIMIT 20";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = 'Unexpected error';
			echo $Err;
			exit();
		}else {
			mysqli_stmt_execute($stmt);
			$d = mysqli_stmt_get_result($stmt);
			if($type == 'table'){
			while($data = mysqli_fetch_array($d)){
			?>
			<tr>
				<td><?php echo $data['intrest_id']?></td>
				<td><?php echo $data['intrest_for']?></td>
				<td><?php echo $data['intrest_value']?>%</td>
			</tr>
			<?php
				}
			}else if($type == 'options'){
				while($data = mysqli_fetch_array($d)){
					?>
						<option value="<?php echo $data['intrest_value']?>"><?php echo $data['intrest_for']?></option>
					<?php
				}
			}
		}
	}

}

//function that get admin faqs
function __mpc_faqs__($conn){

	//start to check for any available faqs
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_faqs"))>0){
		$Err = "No single frequently asked question found!";
		echo $Err;
	}else {
		$sql = "SELECT * FROM mpc_faqs ORDER BY faqs_id /*DESC*/";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "unexpected Error while loading frequently asked questions";
			echo $Err;
			exit();
		}
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
?>
			<div class="mpc-accordion">
                <ul>
<?php
		while($data = mysqli_fetch_array($d)){
			$uniqId = 'mpcAccordion-' .$data['faqs_id'];
			if($uniqId == 'mpcAccordion-1'){
				?>

					<li>
                    <input type="radio" name="accordion" id="<?php echo $uniqId?>" checked>
                    <label for="<?php echo $uniqId?>"><?php echo $data['faqs_title']?> </label>

                    <div class="Accordion-content">
                        <p> <?php echo $data['faqs_contents']?></p>
                    </div>
                    </li>

<?php
			}else{
			?>
                    <li>
                    <input type="radio" name="accordion" id="<?php echo $uniqId?>" >
                    <label for="<?php echo $uniqId?>"><?php echo $data['faqs_title']?> </label>

                    <div class="Accordion-content">
                        <p> <?php echo $data['faqs_contents']?></p>
                    </div>
                    </li>
			<?php
			}
		}
		?>
				</ul>
            </div>
		<?php
	}
}

//function return staff by name only
function __mpcStaffByName__($conn){
	$sql = "SELECT * FROM mpc_user ORDER BY user_id DESC";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'FAILED TO LOAD STAFF';
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	while($data = mysqli_fetch_array($d)){
		$name = $data['user_fname'] .' ' . $data['user_lname'];
		$staffId = $data['user_id'];


		$Err = "<option value=\"$staffId\">" . $name . "</option>";
		echo $Err;
	}
}

//getting all members phone numbers
function __mpc_member_phone__($conn){
	$sql = "SELECT phone FROM mpc_members";
	$stmt = mysqli_stmt_init($conn);

	//error check
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "PHONE NUMBER GET FAILED, PLS CONTACT DEVELOPER TO FIXED THIS ASAP...";
		echo $Err;
	}else{
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
		while($data = mysqli_fetch_assoc($d)){
			$num = $data['phone'];
			//remove the leading zero
			//$arr = [$num];
			//print_r($arr);
			  $zremove = '234'.substr($num, -10, 11). ', ';

			echo ltrim($zremove);

		}
	}
}

//TRYING TO CREATE A NEW FUNCTION THAT WILL
//COUNT AND RETURN HOW MANY MEMBERS ARE INSIDE A PARTICULAR GROUP
function __mpc_group_Info($conn, $id){

	$sql = "SELECT * FROM mpc_available_group WHERE group_id=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Unexpected error, while processing request';
		print $Err;
		die();
	}

	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);

	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	$arr = [$data['group_id'], $data['group_name'], $data['group_leader'], $data['group_branch'],$data['time_date'], $data['group_secretary'], $data['group_created_by']];

	return $arr;

}
//return group info using group name
function __mpc_group_InfoByname($conn, $name){

	if($name !='pending'){

		$sql = "SELECT * FROM mpc_available_group WHERE group_name=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = 'Unexpected error, while processing request';
			print $Err;
			die();
		}

		mysqli_stmt_bind_param($stmt, 's', $name);
		mysqli_stmt_execute($stmt);

		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		$arr = [$data['group_id'], $data['group_name'], $data['group_leader'], $data['group_branch'],$data['time_date'], $data['group_secretary'], $data['group_created_by']];

		return $arr;
	}


}

//trying to count available members in a group
function __groupMemberCount__($conn, $id){

	$GroupName = __mpc_group_Info($conn, $id)[1];

	$sql = "SELECT COUNT(*) AS members_id FROM mpc_members WHERE groups=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'ERR';
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 's', $GroupName);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	return $data['members_id'];
}

//trying to get all members of the cooperative with group
function __get__mpcMemberWithoutGroup__($conn, $groupId){
	$param = 'pending';
	//ECHO "SELECT * FROM mpc_members WHERE group='$param'";
	//if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_user")) >0){}
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_members WHERE groups='$param'"))>0){
		$Err = 'No single member found without group';
		echo $Err;

	}else {
		$sql = "SELECT * FROM mpc_members WHERE groups='$param' ORDER BY members_id DESC";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "Unexpected Error";
			echo $Err;

		}else{


		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);

		while($data = mysqli_fetch_assoc($d)){

			?>

				<tr>
					<td><?php echo$data['members_id']?></td>
					<td><?php echo$data['name']?></td>
					<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" class="dboard-img shadow"></td>
					<td>
						<button class="mpc-btn mpc-assigned-member-group" member-id="<?php echo$data['members_id']?>" mpc-group-id="<?php echo 	$groupId?>" mpc-mem-phone="<?php echo$data['phone']?>">Assign to group</button>
					</td>
				</tr>

			<?php
			}
		}
	}


}

//FUNCTION THAT CHECKED CONTACT US STATUS
function __mpc_contact_usStatus__($conn){

	$sql = "SELECT mpc_contactus_form FROM mpc_general_settings";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Error';
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d)['mpc_contactus_form'];

	if($data == 'ON'){
		$data = 'checked';
	}
	return $data;

}

//mpc getting admin generated pages
function __getPage__($conn, $id){
	$sql = "SELECT * FROM mpc_admin_generated_content WHERE content_id=?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = '<h5 class="text-center">Unexpected Error, while loading page<h5>';
		echo $Err;

	}else{
		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		$arr = [$data['content_id'], $data['content_name'], $data['content_content_text'], $data['status']];

		return $arr;
	}
}

//SAME CONTACT US information
function __save_mpc_ContAbout__($conn, $id, $data, $tryingToUpdateWhat){
	if($data == ''){
		$data = "<div class=\"mpc-temporary-page\"><h1 class=\"text-center\">sorry for letting you to see this, we are working on updating this page soon!</h1></div>";
	}
	$sql = "UPDATE mpc_admin_generated_content SET content_content_text=? WHERE content_id=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'unexpected error while trying to saved';
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 'si', $data, $id);
	mysqli_stmt_execute($stmt);

	if($tryingToUpdateWhat == 'About us'){
		$url = __mpc_root__() . 'about.php/';
		$showPreview = "<a href=\"$url\" target=\"_blank\">Preview</a>";
	}else if($tryingToUpdateWhat == 'Contact us'){
		$url = __mpc_root__() . 'contact.php/';
		$showPreview = "<a href=\"$url\" target=\"_blank\">Preview</a>";
	}

	$Err = "<h5>$tryingToUpdateWhat, Saved successfully! $showPreview</h5>";
	echo $Err;
}

//function getting mpcs
function _mpc_returnContactUs_forEdit__($conn, $id){
	$sql = "SELECT * FROM mpc_admin_generated_content WHERE content_id=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Fail to load data, please try again!';
		echo $Err;
		exit();
	}
	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	return $data;
}

//GETTING GOOODLIFE CONTACT US FORM
function __get_mpc_contactForm__($conn){

	if(__mpc_contact_usStatus__($conn) === 'checked'){
		echo "yesss";
	}
}

//function to load all members without branch title, gender/ incomplete account details
function __mpcMembers_withIncomplete__($conn){
	$key = 'pending';

	$sql = "SELECT * FROM mpc_members WHERE title='$key' && sex='$key' && date_of_birth='$key' ORDER BY members_id DESC";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Unexpected error';
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
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

//count all deposit transactions
function __mpcTotalCounter($conn, $whereToCount){

	if($whereToCount == 'deposit'){
		$sql = "SELECT COUNT(*) AS deposit_id FROM mpc_deposit_transaction";
		$qq = mysqli_query($conn, $sql);
		$f = mysqli_fetch_array($qq);

		echo $f['deposit_id'];
	}

	if($whereToCount == 'loan'){
		$sql = "SELECT COUNT(*) AS group_loan_id FROM mpc_group_loan_request";
		$qq = mysqli_query($conn, $sql);
		$f = mysqli_fetch_array($qq);

		$totalGroupLoan =  $f['group_loan_id'];

		$sql2 = "SELECT COUNT(*) AS loan_id FROM mpc_loan_member";
		$qq2 = mysqli_query($conn, $sql2);
		$f2 = mysqli_fetch_array($qq2);

		$totalRegular = $f2['loan_id'] + $totalGroupLoan;

		echo $totalRegular;

	}

	if($whereToCount == 'active loan'){
		$sql = "SELECT COUNT(*) AS group_loan_id FROM mpc_group_loan_request WHERE status='1'";
		$qq = mysqli_query($conn, $sql);
		$f = mysqli_fetch_array($qq);

		$totalGroupLoan =  $f['group_loan_id'];

		$sql2 = "SELECT COUNT(*) AS loan_id FROM mpc_loan_member WHERE loan_status='1'";
		$qq2 = mysqli_query($conn, $sql2);
		$f2 = mysqli_fetch_array($qq2);

		$totalRegular = $f2['loan_id'] + $totalGroupLoan;

		echo $totalRegular;

	}
}


//count all deposit transactions
function __mpc_counterAll($conn, $whereToCount){

	if($whereToCount == 'deposit'){
		$sql = "SELECT COUNT(*) AS deposit_id FROM mpc_deposit_transaction";
		$qq = mysqli_query($conn, $sql);
		$f = mysqli_fetch_array($qq);

		return $f['deposit_id'];
	}

	if($whereToCount == 'loan'){
		$sql = "SELECT COUNT(*) AS group_loan_id FROM mpc_group_loan_request";
		$qq = mysqli_query($conn, $sql);
		$f = mysqli_fetch_array($qq);

		$totalGroupLoan =  $f['group_loan_id'];

		$sql2 = "SELECT COUNT(*) AS loan_id FROM mpc_loan_member";
		$qq2 = mysqli_query($conn, $sql2);
		$f2 = mysqli_fetch_array($qq2);

		$totalRegular = $f2['loan_id'] + $totalGroupLoan;

		return $totalRegular;

	}

	if($whereToCount == 'active loan'){
		$sql = "SELECT COUNT(*) AS group_loan_id FROM mpc_group_loan_request WHERE status='1'";
		$qq = mysqli_query($conn, $sql);
		$f = mysqli_fetch_array($qq);

		$totalGroupLoan =  $f['group_loan_id'];

		$sql2 = "SELECT COUNT(*) AS loan_id FROM mpc_loan_member WHERE loan_status='1'";
		$qq2 = mysqli_query($conn, $sql2);
		$f2 = mysqli_fetch_array($qq2);

		$totalRegular = $f2['loan_id'] + $totalGroupLoan;

		return $totalRegular;

	}
}
//function that calculate total money is group is borrowing
function __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $TblId, $tblColumn, $tbl){

	if($whereToCount == 'group'){
		$sql = "SELECT SUM($ColumntoDoCount) AS $TblId FROM $tbl WHERE $tblColumn='$groupName'";
	}else if($whereToCount == 'regular'){
		$sql = "SELECT SUM($ColumntoDoCount) AS $TblId FROM $tbl WHERE $tblColumn='$groupName'";
	}

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "UNEXPECTED SUM ERROR";
		echo $Err.mysqli_error($conn);
	}else {
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		return $data[$TblId];
	}
}

//sumsum total amount disburst in regular loan
function __mpc_totalDisburstment($conn, $whereToCount){

	if($whereToCount == 'group'){
		$sql = "SELECT SUM(amount_requested) AS amount_requested FROM mpc_group_loan_request ";
		$return = 'amount_requested';
	}else if($whereToCount == 'regular'){
		$sql = "SELECT SUM(loan_amount) AS loan_amount FROM mpc_loan_member";

		$return = 'loan_amount';
	}

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "UNEXPECTED SUM ERROR";
		echo $Err.mysqli_error($conn);
	}else {
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		return $data[$return];
	}
}

//sum all penalty for group loan member and regualr loan
function __sumTotalPenalty__($conn, $groupName, $groupId, $type){
	$status = 1;
	if($type == 'group'){
		$sql = "SELECT SUM(penalty) AS penalty FROM mpc_group_loan_request WHERE group_id='$groupId' && member_group_name='$groupName' && status='$status'";

		if($q = mysqli_query($conn, $sql)){
			$ftch = mysqli_fetch_array($q);

			return $ftch['penalty'];
		}


	}

}

//fuction get all members out
function __mpcAllmembers__($conn){
	$sql = "SELECT * FROM mpc_members ORDER BY members_id DESC LIMIT 100";
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

		<td class="mpc-td-width"><input type="text" class="mpc-qinfo setStyle quarantorName mpc-disabled" placeholder="Name of Witness 1"></td>

		<td class="mpc-td-width"><input type="number" class="mpc-qinfo setStyle quarantorPhone mpc-disabled" placeholder="Witness 1 Phone "></td>

		<td class="mpc-td-width"><input type="text" class="mpc-qinfo setStyle quarantorAddr mpc-disabled" placeholder="Address(optional)"></td>

		<!-- witness two start here -->
		<!-- <td class="mpc-td-width"><input type="text" class="mpc-qinfo setStyle quarantorTwoName mpc-disabled" placeholder="Name of Witness 2"></td> -->

		<!-- <td class="mpc-td-width"><input type="number" class="mpc-qinfo setStyle quarantorTwoPhone mpc-disabled" placeholder="Witness 2 Phone "></td> -->

		<!-- <td class="mpc-td-width"><input type="text" class="mpc-qinfo setStyle quarantorTwoAddr mpc-disabled" placeholder="Address(optional)"></td> -->
		<!-- witness two end here -->

		<td class="mpc-td-btn"><button class="mpc-btn Adding-mpc-quarantor mpc-disabled" mpc-qurantor-for="<?php echo $data['phone']?>" mpc-qurantor-for-id="<?php echo $data['members_id']?>">Add Witness</button></td>
			</tr>
		<?php
	}
	echo "<table></div>";

}

//function to get
function __get_memberLoanAmount__($conn, $columnName1, $columnName2, $id, $phone, $tbl, $arrayOfColumns){
	/**FUNCTION FUNCTION ACCEPT 7 PARAMETER
	 * PARAM1 DB CONNNECTION
	 * QUERY COLUNM 1
	 * QUERY COLUMN2
	 * TBL MEMBER ID
	 * TBL MEMBER PHONE
	 * TBLE
	 * ARRAY OF COLUMNS TO RETURN
	 */
	$sql = "SELECT * FROM $tbl WHERE $columnName1='$id' && $columnName2='$phone' ";

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Unexpected error';
		echo $Err;
		exit();
	}else{
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($d);

		if(is_array($arrayOfColumns)){
			/*
			for ($i=0; $i < count($arrayOfColumns); $i++) {
				$inp = $data[$arrayOfColumns[$i]];

				echo $inp;
			}
			*/
			return $data[$arrayOfColumns[0]];
		}
	}
}

//function to get member monthly repayment
function __getMemberMonthlyRepayment($conn, $tbl, $tblCol1, $tblCol2, $selectedColumn, $compareCol1, $compareCol2){

	$sql = "SELECT $selectedColumn FROM $tbl WHERE $tblCol1='$compareCol1' && $tblCol2='$compareCol2'";
	if(!$q = mysqli_query($conn, $sql)){
		$Err = 'UNEXPECTED ERROR OCCUR';
		echo $Err.mysqli_error($conn);
		exit();
	}
	$data = mysqli_fetch_array($q);

	return $data[$selectedColumn];
}

//mpc company earnings monthly
function __mpc_earnings__($conn, $earning, $month, $year, $branch){

	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_earnings WHERE year='$year' && branch='$branch'")) >0){
		$Jan = 0;
		$Feb = 0;
		$Mar = 0;
		$Apr = 0;
		$May = 0;
		$Jun = 0;
		$Jul = 0;
		$Aug = 0;
		$Oct = 0;
		$Sept = 0;
		$Nov = 0;
		$Dec = 0;

		//if($month == 'january'){
		//	$Jan = $earning;
		//}


		switch (strtolower($month)) {
			case 'january':
				$Jan = $earning;
				break;

				case 'febuary':
				$Feb = $earning;
				break;

				case 'march':
				$Mar = $earning;
				break;

				case 'april':
				$Apr = $earning;
				break;

				case 'may':
				$May = $earning;
				break;

				case 'june':
				$Jun = $earning;
				break;

				case 'july':
				$Jul = $earning;
				break;

				case 'august':
				$Aug = $earning;
				break;

				case 'september':
				$Oct = $earning;
				break;

				case 'october':
				$Sept = $earning;
				break;

				case 'november':
				$Nov = $earning;
				break;

				case 'december':
				$Dec = $earning;
				break;

			default:
				# code...
				break;
		}

		//echo $Dec;
		$sql = "INSERT INTO mpc_earnings (January, Febuary, March, April, May, June, July, August, September, October, November, December, year, branch)VALUES('$Jan', '$Feb', '$Mar', '$Apr', '$May', '$Jun', '$Jul', '$Aug', '$Sept', '$Oct', '$Nov', '$Dec', $year, '$branch')";
		if(!mysqli_query($conn, $sql)){
			$Err = "Unexpected error";
			echo $Err.mysqli_error($conn);
			exit();
		}
	}

	 $month = ucfirst($month);
	 $CurrentEarningMOnth = $month;
	 //get current month earnings
	 $sql = "SELECT $month FROM mpc_earnings WHERE year='$year' && branch='$branch'";
	 $qqq = mysqli_query($conn, $sql);
	 $fetch = mysqli_fetch_array($qqq);
	 $currentMonthEarnings = $fetch[$month] + $earning; //getting database monthly earning then add current earning from member

		$columnUpdate = '';
		/*$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';
		$columnUpdate = '';*/

		//december
		switch (strtolower($month)) {
			case 'january':
				$columnUpdate = 'January';
				break;

				case 'febuary':
				$columnUpdate = 'Febuary';
				break;

				case 'march':
				$columnUpdate = 'March';
				break;

				case 'april':
				$columnUpdate = 'April';
				break;

				case 'may':
				$columnUpdate = 'May';
				break;

				case 'june':
				$columnUpdate = 'June';
				break;

				case 'july':
				$columnUpdate = 'July';
				break;

				case 'august':
				$columnUpdate = 'August';
				break;

				case 'september':
				$columnUpdate = 'September';
				break;

				case 'october':
				$columnUpdate = 'October';
				break;

				case 'november':
				$columnUpdate = 'November';
				break;

				case 'december':
				$columnUpdate = 'December';
				break;

			default:
				# code...
				break;
		}

		//echo $columnUpdate;
		$update = "UPDATE mpc_earnings SET $columnUpdate='$currentMonthEarnings' WHERE year='$year' && branch='$branch'";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $update)){
			$Err = 'Unexpected error';
			echo $Err;
			exit();
		}
		if(mysqli_stmt_execute($stmt)){
			$Err = "Payment saved";
			echo $Err;
		}
}

//MPC TEMPORARY FUNCTION
/*
function __temporary($conn){
	$query = 2023;
	$sum = ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	$sum = implode(',', $sum);
	$sql = "SELECT SUM($sum) AS group_loan_id FROM mpc_earnings WHERE year=?";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$err = "error occur";
		//json_encode($err);
		echo $err.mysqli_error($conn);
		//exit();
	}
	mysqli_stmt_bind_param($stmt, 's', $query);
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	$data = mysqli_fetch_array($d);

	$rtn = ['jan' => $data['January'], 'feb' => $data['Febuary'],'mar'=> $data['March'],'Apr'=> $data['April'], 'may' => $data['May'],'jun'=> $data['June'], 'jul'=> $data['July'],'Aug' => $data['August'],'sept'=> $data['September'],'oct'=> $data['October'],'nov'=> $data['November'], 'Dec' => $data['December'], 'yrs' => $data['year']];
	//echo json_encode($rtn);

}
*/

//function get members wiith group
function __showMpcMembers4Penalty($conn, $GroupName, $queryType){

	if($queryType === 'group'){

	$groupId = __mpc_group_InfoByname($conn, $GroupName)[0];
	$sql = "SELECT * FROM mpc_group_loan_request WHERE member_group_name='$GroupName' && group_id='$groupId' && status='1'";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "MEMBER LOAD FAIL";
		echo $Err;
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	?>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">

	<?php
	while($data = mysqli_fetch_array($d)){
		$name = __mpcReturnByPhoneMember($conn, $data['member_phone'])[4]; //member by name
		$Profile = __mpcReturnByPhoneMember($conn, $data['member_phone'])[18]; //profile

		$tbl = 'mpc_group_loan_repayment';
		$tbleCol1 = 'member_id';
		$tbleCol2 = 'member_phone';
		$tblid = 'repayment_id';
		$memberId = $data['member_id'];
		$memberPhone = $data['member_phone'];
		$monthPaid = _countMemberPaymentInterval($conn, $memberId, $memberPhone, $tbleCol1, $tbleCol2, $tblid, $tbl);
		?>
			<tr>
				<td><?php echo $data['group_loan_id']?></td>
				<td><?php echo $name?></td>
				<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $Profile?>" alt="pics" class="dboard-img" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $Profile?>"></td>
				<td title="MONTH PAID"><?php echo $monthPaid?></td>
				<td>
					<select class="adm-select penaltyType" title="SELECT PENALTY TYPE">
						<option value="">-----</option>
						<option value="weekly">WEEKLY</option>
						<option value="monthly">MONTHLY</option>
					</select>
				</td>
				<td title="<?php echo $name?> penalty is &#8358;<?php echo $data['penalty']?>">&#8358; <?php echo $data['penalty']?></td>
				<td>
					<button class="mpc-btn mpc-penalty-setter" mpc-penalty-type="group-loan" mpc-penalty-id="<?php echo $memberId?>" mpc-penalty-phone="<?php echo $memberPhone?>">set penalty</button>
				</td>
			</tr>
		<?php
	}
}else if($queryType === 'regular'){

	//$groupId = __mpc_group_InfoByname($conn, $GroupName)[0];
	$sql = "SELECT * FROM mpc_loan_member WHERE loan_status='1'";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = "MEMBER LOAD FAIL";
		echo $Err.mysqli_error($conn);
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);
	?>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">

	<?php
	while($data = mysqli_fetch_array($d)){
		$name = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[4]; //member by name
		$Profile = __mpcReturnByPhoneMember($conn, $data['mem_phone'])[18]; //profile

		$tbl = 'mpc_loan_member_repayment';
		$tbleCol1 = 'member_id';
		$tbleCol2 = 'member_phone';
		$tblid = 'repayment_id';
		$memberId = $data['mem_id'];
		$memberPhone = $data['mem_phone'];
		$monthPaid = _countMemberPaymentInterval($conn, $memberId, $memberPhone, $tbleCol1, $tbleCol2, $tblid, $tbl);
		?>
			<tr>
				<td><?php echo $data['loan_id']?></td>
				<td><?php echo $name?></td>
				<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $Profile?>" alt="pics" class="dboard-img" srcset="<?php echo __mpc_root__()?>asset/img/<?php echo $Profile?>"></td>
				<td title="MONTH/WEEK PAID"><?php echo $monthPaid?></td>
				<td>
					<select class="adm-select penaltyType" title="SELECT PENALTY TYPE">
						<option value="">-----</option>
						<option value="weekly">WEEKLY</option>
						<option value="monthly">MONTHLY</option>
					</select>
				</td>
				<td title="<?php echo $name?> penalty is &#8358;<?php echo $data['penalty']?>">&#8358; <?php echo $data['penalty']?></td>
				<td>
					<button class="mpc-btn mpc-penalty-setter" mpc-penalty-type="regular-loan" mpc-penalty-id="<?php echo $memberId?>" mpc-penalty-phone="<?php echo $memberPhone?>">set penalty</button>
				</td>
			</tr>
		<?php
	}
}

	echo "</table></div>";

?>
<script>
	//mpc loan penalty
//function penaltySetter(){
    var itemButton = document.querySelectorAll('.mpc-penalty-setter');

        for (let i = 0; i < itemButton.length; i++) {
            itemButton[i].addEventListener('click', function(){
                var itemPhone = this.getAttribute('mpc-penalty-phone');
                var itemId = this.getAttribute('mpc-penalty-id');
				var select = document.querySelectorAll('.penaltyType')[i];
				var penaltyForType = this.getAttribute('mpc-penalty-type');

				var xhr = new XMLHttpRequest();
				var rtn = document.querySelector('.mpc-admin-ds-notify');

				if(select.value === ''){
					rtn.innerHTML = 'PLEASE SELECT PENALTY TYPE';
					rtn.classList.add('to-red-color');
					rtn.classList.add('fa-fade');

					select.style.border = '1.5px solid red';
				}else{


					xhr.open('GET', __mpc_uri__() + 'functions/mpc-ajax-action.php?xpenalty=CODE4ATMANFUL&penaltyid='+ itemId + '&penaltyPhone=' + itemPhone + '&penaltyType=' + select.value+'&penaltyFor='+penaltyForType, true);
					xhr.onreadystatechange = function(){
						if(this.readyState == 4 && this.status == 200){
							if(this.response == 'penalty added'){
								rtn.innerHTML = 'Penalty added successfully, reload window to see result!';
								rtn.classList.add('fa-fade');
							}else{
								console.log(this.response)

							}
						}
					}
					xhr.send();
				}
            })

        }


</script>
<?php

}

function _countMemberPaymentInterval($conn, $memberId, $memberPhone, $tbleCol1, $tbleCol2, $tblid, $tbl){

	$sql = "SELECT COUNT(*) AS $tblid FROM $tbl WHERE $tbleCol1='$memberId' && $tbleCol2='$memberPhone'";
	$dd = mysqli_query($conn, $sql);

	$fetch = mysqli_fetch_assoc($dd);

	return $fetch[$tblid];
}

//each member total repayment all
function __get_member_total_amountFor_repayment__($conn, $memberid, $memberphone, $tbl, $col1, $col2){

	if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM $tbl"))>0){

	$sql = "SELECT * FROM $tbl WHERE $col1='$memberid' && $col2='$memberphone'";
		if($qq = mysqli_query($conn, $sql)){
			$ft = mysqli_fetch_array($qq);

			$TotalRepayment = $ft['total_amount_to_repay'];



			$Allpenalties = $ft['penalty'];

			return $TotalRepayment + $Allpenalties;

		}
	}
}

//function getmpc member total amount paid
function __mpc_member_totalPaid__($conn, $memberId, $memberPhone, $col1, $col2, $tbl, $sumColumn){
	$status = 1;
	$sql = "SELECT SUM($sumColumn) as $sumColumn FROM $tbl WHERE $col1='$memberId' && $col2='$memberPhone' && status='$status'";

	$qq = mysqli_query($conn, $sql);
	$ft = mysqli_fetch_array($qq);

	return $ft[$sumColumn]; ///TOTAL AMOUNT OF MONEY PAID BY MEMBER


}

//trying to load all regular members that their loan is still running
function __mpc_regular($conn){
	$status = 1;
	$sql = "SELECT * FROM mpc_loan_member WHERE loan_status='$status' LIMIT 60";
	$qq = mysqli_query($conn, $sql);

	?>
	<table class="table table-hover table-striped table-bordered ">


	<?php
	$url = __mpc_root__() ."user/dashboard.php/?action=inputData&qparam=penality&group=regular&k=regular";
	//run whil loop to get all member at once
	while ($data = mysqli_fetch_array($qq)) {
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
				<select  class="qinfo adm-select repayType mpc-disabled">
					<option value="">-----</option>
					<option value="weekly">WEEKLY</option>
					<option value="monthly">MONTHLY</option>
				</select>
			</td>
			<td title="Total amount paid by <?php echo $name?> &#8358; <?php echo $amountPaidAlreadyByMember?>">
				&#8358;<?php echo $amountPaidAlreadyByMember?>
			</td>
			<td>
				<input type="text" placeholder="Enter amount" class="setStyle mpc-qinfo regular-loanAmountReturn mpc-disabled">
			</td>

			<td>
				<button class="mpc-btn mpc-regular-loan-saved mpc-disabled" memberid="<?php echo $memberId?>" memberphone="<?php echo $memberPhone?>" mpc-tbl-id="<?php echo $data['loan_id']?>">Save payment</button>
			</td>

	</tr>
		<?php
	}
	echo "<caption><a href=\"$url\">Set penalty</a></caption>";

	echo "</table>";
}

//sum company earning monthly
function __companyEarning($conn, $month, $year, $howToReturn){
	//This function will try to sum up company monthly earnings

	/**
	 * THIS FUNCTION WILL TRY SUM UP COMPANY MONTLY EARINGS
	 *
	 */
	if($howToReturn == 'monthly'){
		$sql = "SELECT SUM($month) AS $month FROM mpc_earnings WHERE year=?";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = 500;
			return $Err;
			exit();
		}
		mysqli_stmt_bind_param($stmt, 's', $year);
		mysqli_stmt_execute($stmt);

		$d = mysqli_stmt_get_result($stmt);

		$data = mysqli_fetch_array($d);

		return $data[$month];
	}else if($howToReturn == 'all'){

		$sql = "SELECT SUM($month) AS $month FROM mpc_earnings";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = 500;
			return $Err;
			exit();
		}
		//mysqli_stmt_bind_param($stmt, 's', $year);
		mysqli_stmt_execute($stmt);

		$d = mysqli_stmt_get_result($stmt);

		$data = mysqli_fetch_array($d);

		return $data[$month];
	}

}

//function calculate loan transaction pending
function __total_processed_inMonth($conn, $month){
	$sql = "SELECT COUNT(*) AS $month FROM mpc_group_loan_request WHERE month_by_name='$month'";
	if(!$q = mysqli_query($conn, $sql)){
		$Err = 'Unexpected error';
		echo $Err;
		exit();
	}
	$qfetch = mysqli_fetch_array($q);


	$sql2 = "SELECT COUNT(*) AS $month FROM mpc_loan_member WHERE loan_month='$month'";
	if(!$q2 = mysqli_query($conn, $sql2)){
		$Err = 'Unexpected error';
		echo $Err;
		exit();
	}
	$qfetch2 = mysqli_fetch_array($q2);



	return $qfetch[$month] + $qfetch2[$month];

}

//function that load loan transaction
function __mpc_LoadLoan_transaction__($conn, $month){
	$sql = "SELECT * FROM mpc_loan_approval_info WHERE approval_month='$month' ORDER BY approval_id DESC LIMIT 100";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'LOAD FAILED';
		print $Err;
		exit();
	}
	//mysqli_stmt_bind_param($stmt,)
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

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
			<!-- <td><?php //echo $data['loan_identifier']?></td> -->
			<td class="rep">&#8358; <?php echo $amountPaid?></td>
		</tr>
		<?php
	}
	?>
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

//function to sum amount paid for each loan collected by member
function __sum_member_eachLOAN($conn, $memberId, $memberphone, $tblCol, $sumColumnName, $tbl){

	 $sql = "SELECT SUM($sumColumnName) AS $sumColumnName FROM $tbl WHERE repayment_for_track='$tblCol' && member_id='$memberId' && member_phone='$memberphone' ";

	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		$Err = 'Sum error';
		echo $Err.mysqli_error($conn);
		exit();
	}
	mysqli_stmt_execute($stmt);
	$d = mysqli_stmt_get_result($stmt);

	$data = mysqli_fetch_array($d);

	return $data[$sumColumnName];
}

//get company total earning
function __mpc_goodLife__($conn){
	$JAN = __companyEarning($conn, 'January', '', 'all'); //JANUARY EARNING
	$FEB = __companyEarning($conn, 'Febuary', '', 'all'); //FEBUARY EARNING
	$MAR = __companyEarning($conn, 'March', '', 'all'); //MARCH EARNING
	$APR = __companyEarning($conn, 'April', '', 'all'); //APRIL EARNING
	$MAY = __companyEarning($conn, 'May', '', 'all'); //MAY EARNING
	$JUN = __companyEarning($conn, 'June', '', 'all'); //JUNE EARNING
	$JUL = __companyEarning($conn, 'July', '', 'all'); //JULY EARNING
	$AUG = __companyEarning($conn, 'August', '', 'all'); //AUGUST EARNING
	$SEPT = __companyEarning($conn, 'September', '', 'all'); //SEPTEMBER EARNING
	$OCT = __companyEarning($conn, 'October', '', 'all'); //OCTOBER EARNING
	$NOV = __companyEarning($conn, 'November', '', 'all'); //NOVEMBER EARNING
	$DEC = __companyEarning($conn, 'December', '', 'all'); //DECEMBER EARNING

	$CompanyEarnings = $JAN + $FEB + $MAR  + $APR + $MAY + $JUN + $JUL + $AUG + $SEPT + $OCT + $NOV + $DEC;

	return $CompanyEarnings;
}

//function deposit transaction
function __mpc_deposit__($conn){
	if(!mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mpc_deposit_transaction")) >0){
		$Err = "<h1 class=\"text-center\">No single Deposit Transaction found!</h1>";
		echo $Err;

	}else {
		$sql = "SELECT * FROM mpc_deposit_transaction ORDER BY deposit_id DESC LIMIT 100";
		$q = mysqli_query($conn, $sql);

		while($data = mysqli_fetch_array($q)){
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

	}


}

function __totalMoneyPaidOut__($conn) {

	$whereToCount = 'group';
	$groupName = date('F');
	$ColumntoDoCount = 'amount_requested';
	$TblId = 'group_loan_id';
	$tblColumn = 'month_by_name';
	$tbl = 'mpc_group_loan_request';


	$totalIngroupLoan = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $TblId, $tblColumn, $tbl);

//reggular loan start here below
	$whereToCount1 = 'regular';
	$groupName1 = date('F');
	$ColumntoDoCount1 = 'loan_amount';
	$TblId1 = 'loan_id';
	$tblColumn1 = 'loan_month';
	$tbl1 = 'mpc_loan_member';


	$totalInRegularLoan = __mpc_total_calculate__($conn, $whereToCount1, $groupName1, $ColumntoDoCount1, $TblId1, $tblColumn1, $tbl1);


	if($totalInRegularLoan == '' || $totalInRegularLoan == 0){
		$totalInRegularLoan = 0;
	}

	if($totalIngroupLoan == '' || $totalIngroupLoan == 0){
		$totalIngroupLoan = 0;
	}

	return $totalIngroupLoan + $totalInRegularLoan;
}

//function get loan loan out in amonth
function __mpc_loanDisbursementMonthly__($conn, $type, $month) {

	if($type === 'regular'){
		$sql = "SELECT * FROM mpc_loan_member WHERE loan_month='$month' ORDER BY loan_id DESC";
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


		$totalInRegularLoan = __mpc_total_calculate__($conn, $whereToCount1, $groupName1, $ColumntoDoCount1, $TblId1, $tblColumn1, $tbl1);

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



	}else if($type === 'group'){
		$sql = "SELECT * FROM mpc_group_loan_request WHERE month_by_name='$month' ORDER BY group_loan_id DESC";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$Err = "Error loading Group";
			echo $Err;
			exit();
		}
		mysqli_stmt_execute($stmt);
		$d = mysqli_stmt_get_result($stmt);

		$whereToCount = 'group';
		$groupName = date('F');
		$ColumntoDoCount = 'amount_requested';
		$TblId = 'group_loan_id';
		$tblColumn = 'month_by_name';
		$tbl = 'mpc_group_loan_request';


		$totalIngroupLoan = __mpc_total_calculate__($conn, $whereToCount, $groupName, $ColumntoDoCount, $TblId, $tblColumn, $tbl);


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
			<caption class="text-right">TOTAL: &#8358; <span class="amountEach"><?php echo $totalIngroupLoan?></span></caption>
		<?php

	}
}

//function that allowed admin to collect sheet
function __mpc_collectSheet__($conn, $type, $month){

	if($type === 'group'){

		$sql = "SELECT * FROM mpc_group_loan_request WHERE month_by_name='$month' ORDER BY group_loan_id DESC";
		$Q = mysqli_query($conn, $sql);

		while($data = mysqli_fetch_array($Q)){
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
				<td title="<?php echo $name?> Outstanding loan amount &#8358; <?php echo $TotalRepayment - $amountPaidAlreadyByMember?>">&#8358; <span class="amountEach"><?php echo $TotalRepayment - $amountPaidAlreadyByMember?></span></td>
			</tr>
			<?php
		}

	}else if($type === 'regular'){
		$sql = "SELECT * FROM mpc_loan_member WHERE loan_month='$month' ORDER BY loan_id DESC";
		$Q = mysqli_query($conn, $sql);

		while($data = mysqli_fetch_array($Q)){
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


				<td title="<?php echo $name?> Outstanding amount <?php echo $TotalRepayment - $amountPaidAlreadyByMember?>">&#8358; <span class="amountEach"><?php echo $TotalRepayment - $amountPaidAlreadyByMember?></span></td>
			</tr>
			<?php
		}
	}
}


//SCHECK IF THERE IS ANY NOTIFICATION THAT HAS BEEN APPROVED
function __mpc_self_check__($conn){
	$sql = "SELECT * FROM mpc_testimony WHERE status='1'";

	if(mysqli_num_rows(mysqli_query($conn, $sql)) >0){
		return 1;
	}
}

//GET ALL TESTIMONY OUT
function __getTestimony__($conn){
	$sql = "SELECT * FROM mpc_testimony WHERE status='1'";

	$q = mysqli_query($conn, $sql);

	while($data = mysqli_fetch_array($q)){
		?>
		<div class="mpc-testi item">
			<i class="fa-quote-left fas fa-3x"></i>

			<p><?php echo $data['message']?></p>

			<span class="mpc-testifierName"><?php echo $data['name']?></span>
		</div>
		<?php
	}
}


//function to get last login/members and staff
function __mpc_last_login__($conn){
	//if($_GET['ajaxAction'] == 'lastLogin'){

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
       //  }
}

//FUNCTION CLASS GET COMPANY LONG AND SHORTNAME
function getSystemName($conn){
	$sql = "SELECT * FROM mpc_system_info";
	if(!$qry = mysqli_query($conn, $sql)){
		$err = "UNEXPECTED ERROR";
		echo $err;
	}

	$data = mysqli_fetch_array($qry);

	return [$data['SYSTEM_NAME'], $data['SYSTEM_NAME_SHORT'], $data['SYSTEM_TITLE']];

}

//FUNCTION DECLARATRION OF NOMINEE
function __NomineeInfo($conn, $phone, $guarantorName, $gforPhone, $gforAddre){
	//gforphone gurantor/witness phone
	$tzne = date_default_timezone_set('Africa/lagos');
    $dayOfTheMonth = date('l d'); 
    $monthOfTheYear = date('F'); 
	$dotted = '.................................................................................................................................................';
    $dottedShort = '............................................';
    $systemNameLong = getSystemName($conn)[0];
    $systemNameShort = getSystemName($conn)[1];
    $systemNameMotto = getSystemName($conn)[2];

	$name = __mpcReturnByPhoneMember($conn, $phone)[4];
    $contactAddress = __mpcReturnByPhoneMember($conn, $phone)[6];

    $declaration = "<div class=\"mpc-justic-nominee\"><p>$dotted) Names of </p><p> $dottedShort $systemNameLong $dotted </p><p>DECLARATION made this 
                    $dayOfTheMonth day of $monthOfTheYear </p><p>I $name, of $contactAddress being a member of the above society, 
                    hereby declare that the person/persons name below shall be my nominee/nominees under the terms of bye-law.</p>
                    <p>$dottedShort of the said society namely, the person/persons to whom in the event of my death all sums due to me by the
                    $dotted (Here)</p><p>$dotted Insert<p><p>$dotted Nominees<p><p>This declaration cancels any previous declaration made by me in this behalf</p>";

    $declaration.= "<p>$guarantorName (NAME) $dottedShort<p><p>In our presence, Both of us being present at the same time<p>";
    $declaration.= "<div class=\"declare-mpc mpc-divide\">
                        <div class=\"mpc-divider1\">
                            <p>$dottedShort</p>
                            <p>$gforPhone</p>
                            <span class=\"spanDiv-mpc\">Signature/Phone of Witness</span>
                        </div>

                        <div class=\"mpc-divider1 mpc-justice-div\">
                            <p>$dottedShort</p>
                            <p>$gforAddre</p>
                            <span class=\"spanDiv-mpc\">Address of Witnesses</span>

                        </div>
                        
                    </div>
                    <h5>Note: Witnesses sign as witness to the Declarer's signature only and not to the terms of the Declaration.
                    The terms may be cancealed from witness byy folding the pater or otherwise.</h5>
                    </div>";

	return $declaration;
}

//GET MY NEXT OF KIN HERE
function nextOfKin($conn, $phone, $id){

	if(!mysqli_num_rows($data = mysqli_query($conn,  "SELECT * FROM mpc_next_of_kin WHERE next_of_kin_for_phone='$phone' && next_of_kin_for_id='$id' ")) >0){

		return ['PENDING', 'PENDING', 'PENDING', 'PENDING', 'PENDING', 'PENDING'];

		exit();
	}

	$row = mysqli_fetch_assoc($data);

	return [$row['next_of_kin_for_phone'], $row['next_of_kin_for_id'], $row['next_kin_name'], $row['next_kin_relationship'], $row['next_kin_addre'], $row['next_kin_phone']];

}

//GET SYSTEM MANDATORY FORM
function mpcWitness($conn, $ph, $id){
	$sql = "SELECT * FROM mpc_guarantors WHERE gurantor_for='$ph' && gurantor_for_id='$id' ";
	$d = mysqli_query($conn, $sql);
	if(! mysqli_num_rows($d) >0){
		return ['pending', 'pending', 'pending', 'DECLARATION OF NOMINEE IS NOT AVAILABLE FOR THIS MEMBER', 'PENDING'];

	}
	$data = mysqli_fetch_array($d);

	return [$data['gurantors_name'], $data['guarantor_phone'], $data['guarantors_address'], $data['nominee_txt'], $data['gurantor_inputer']];
}

//function __getUpdate mandate
function __getmemberMandate($conn, $id, $phone){
	$sql = "SELECT * FROM mpc_member_mandate WHERE mandate_user_id='$id' && mandate_for_phone='$phone' ORDER BY ID DESC";

	$qry = $conn->query($sql);
	if($qry->num_rows >0){
		$data = $qry->fetch_assoc();

		return [$data['shares'], $data['thrift_saving'], $data['special_saving'], $data['date_time']];
	}else{
		return ['N/A', 'N/A', 'PENDING', 'PENDING'];

	}
}


//get members without passort
function __getmemberWithoutPassort($conn){

	 $sql = "SELECT * FROM mpc_members WHERE user_profile='avartar1.png'";
	$qry = $conn->query($sql);

	if(! $qry->num_rows >0){
		echo '<caption>NO MEMBER WITHOUT PASSPORT FOUND</caption>';
	}

	

	while ($data = $qry->fetch_assoc()) {
?>
	<tr>
		<td><?php echo $data['members_id']?></td>
		<td><?php echo $data['name']?></td>
		<td><img style="width: 60px;height: 60px;" src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" class="__system_notice__"></td>
		<td>
			<input uidkey="<?php echo $data['members_id']?>" uidphone="<?php echo $data['phone']?>" type="file" class="mpc-passportUpload" accept="image/jpeg, image/png, image/jpg" style="display: none;" id="showUploads">

			<label for="showUploads" class="psport"><i class="fas fa-camera fa-3x"></i></label>
		</td>
		<!-- <td class="mpc-passportPreview">
			<span class="showpreviewHere"><i class="fas fa-user-circle fa-3x"></i></span>
		</td> -->
		<!-- <td><button uid="<?php //echo $data['members_id']?>" phone="<?php //echo $data['phone']?>" title="UPLOAD PASSPORT FOR <?php //echo $data['name']?>" class="mpc-btn mpc-passport-uploader">upload <i class="fas fa-upload fa-2x"></i></button></td> -->
	</tr>
<?php
	}

}

//function to get all members out
function __getSystemMembers($conn){
	$sql = "SELECT * FROM mpc_members ORDER BY members_id DESC LIMIT 100";
	$stmt = $conn->query($sql);

	if( ! $stmt){
		echo "<caption>Unexpected error occured</caption>";
		die();
	}

	if(! $stmt->num_rows > 0){
		echo "<caption>No data</caption>";
		die();
	}
	
	while($data = $stmt->fetch_assoc()){
	$ph = $data['phone'];
	$id = $data['members_id'];
	$tx = "sal34rl34lcl3l4ljcsdlklfasldflllsdfjasdlfljsdljfaldlfasdlfljsdr9345304034owsljesadlflasdjflsldfjasldfjoewurowelaslkdslkajldflasdjfsdo43904uaslksldsdfois97asdokasdfolsadkf";
	$tx .= "salldfll34l3lsldasdmanful_computer&kdklasdlflluiu34o992302lkkdk9430weqwopwerqwerqqqd3344uyo";
	$a = bin2hex($tx);
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
}



//get all member out
function __mpc_memberOut($conn){
	$sql = "SELECT * FROM mpc_members ORDER BY members_id DESC LIMIT 50";
	$stmt = $conn->query($sql);

	if( ! $stmt->num_rows > 1){
		echo "<caption>NO RECORD FOUND</caption>";
		die;
	}

	while($data = $stmt->fetch_assoc()){

	$imgPath  = __mpc_root__() ."asset/img/" . $data['user_profile'];
?>
	<tr>
		<td><?php print $data['members_id']?></td>
		<td><?php print $data['name']?></td>
		<td><?php print $data['registration_number']?></td>
		<td><img src="<?php print $imgPath?>" class="dboard-img" title="<?php echo $data['user_profile']?>" srcset="<?php print $imgPath?>"></td>
		<td>
        <button class="mpc-btn add-memberTodebit" name="<?php echo $data['name']?>" acc="<?php echo $data['registration_number']?>" uid="<?php echo $data['members_id']?>" ph="<?php echo $data['phone']?>">Add</button>
    	</td>
	</tr>
<?php
	}
}



//load all widthdrawal request
function __wREQUESTAll($conn, $type){
	if($type == 'pending')
	{
		$sql = "SELECT * FROM mpc_loan_request_online WHERE status=0";
	}else if($type == 'rejected')
	{
		$sql = "SELECT * FROM mpc_loan_request_online WHERE status=2";
	}else if($type == 'approved')
	{
		$sql = "SELECT * FROM mpc_loan_request_online WHERE status=1";
	}

	$stmt = $conn->query($sql);
	if( ! $stmt->num_rows > 0){
		echo "<caption class=\"text-center\">NO data found!</caption>";
	}else{
		while ($data = $stmt->fetch_assoc()) {
		 $name = __mpcReturnByPhoneMember($conn, $data['uid_ph'])[4];
		 $img = __mpcReturnByPhoneMember($conn, $data['uid_ph'])[18];

		 // __bankingInfo($conn, $uid, $phone)
		if($data['status'] == 0){
			$txt = 'Pending';
		}else if($data['status'] == 1){
			$txt = 'Approved';
		}else if($data['status'] == 2){
			$txt = 'Not Approved';
		}else if($data['status'] == 3){
			$txt = 'Completed';
		}
?>
	<tr>
		<td><?php echo $name?></td>
		<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $img?>" alt="<?php echo $name?>" title="<?php echo $name?>" class="dboard-img"></td>
		<td>&#8358; <span class="skketd"><?php echo $data['amount']?></span></td>
		<td><?php echo $data['request_date'];?></td>
		<td><span class="skketd"><?php echo $txt//echo __bankingInfo($conn, $data['member_id'], $data['member_phone'])['r']?></span></td>
		<td><span class="skketd"><a aria-msg="<?php echo $data['reason']?>" aria-name="<?php echo $name?>" href="javascript:void(0)" class="readApplicationLetter">Check letter</a> <?php //echo __bankingInfo($conn, $data['member_id'], $data['member_phone'])['s']?></span></td>
		<td style="position: relative;">
			<textarea maxlength="180" class="setStyle resize-none msgTxT p-1" cols="10" rows="20" placeholder="Enter message for member here"></textarea>
		</td>

		<td> <button class="btn-success btn _UYO_eyenakwaibom" ibaad="<?php echo $data['amount']?>" tid="<?php echo $data['ID']?>" uid="<?php echo $data['uid']?>" phone="<?php echo $data['uid_ph']?>">Approve</button></td>
		<td> <button class="btn-danger btn _UYO90awoimahamien" ibaad="<?php echo $data['amount']?>" tid="<?php echo $data['ID']?>" uid="<?php echo $data['uid']?>" phone="<?php echo $data['uid_ph']?>">Reject</button></td>
	</tr>
<?php
		}
	}
}

//SEND MAIL
function __goodLifeMail__($to, $subject, $msg, $status){

	$sendTo = $to;
	$sendSubject = $subject;
	$sendMsg = $msg;

	$header = "From: sender@example.com\r\n";
	$header = "Reply-To: sender@example.com\r\n";
	$header = "From: MIME-Version: 1.0\r\n";
	$header = "Content-Type: text/html; charset=ISO-8859-1\r\n";

	if(mail($sendTo, $sendSubject, $sendMsg, $header)){
		if($status === 1){
			return "Message successfully sent to addmin";
		}
	}else{
		return "Fail to send email";
	}
}

function __getWithdrawalTbl($conn, $id){
	$sql = "SELECT from_account FROM mpc_member_widthdrawal_request WHERE ID='$id'";
	$stmt = $conn->query($sql);

	$data = $stmt->fetch_assoc();

	return $data['from_account'];
}

//check members due for retirment
function __checkAllForRetirement($conn){
	$sql = "SELECT * FROM mpc_members";
	$stmt = $conn->query($sql);
	if(!$stmt->num_rows >0){
		echo "<tr><td>No data found</td><caption>Member due for Retirment</caption></tr>";
	}else{
		while ($data = $stmt->fetch_assoc()) {
			$yrsToServed = 30;
			$dte = date_create_from_format('d/m/Y', $data['religion']);
			
// 			calculateYears($data['religion']);

	if($dte !== false){
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
	}
?>
	<tr>
		<td><?php echo $data['members_id']?></td>
		<td><?php echo $data['name']?></td>
		<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $data['user_profile']?>" class="dboard-img" title="<?php echo $data['name']?>'s profile picture" role="image"></td>
		<td><?php echo $data['religion']?></td>
		<td><?php  print 'Worked for ' .$yrs .' years, '. $mnt .' Month '. $hrs .' hours, ' . $mins . ' minutes ' . $sec . ' Seconds'?></td>
		<td><?php echo $yrsToServed - $yrs . ' Years'?></td>
		<td><span class="<?php echo $cls?> h-100 d-block p-1"><?php echo $tk?></span></td>


	</tr>
<?php
		}
	}
}

function calculateYears($startDates){
// 	date_default_timezone_set('Africa/Lagos');
// 	$dte = date('d/m/Y h:i:s');

// 	$d1 = date_create_from_format("d/m/Y h:i:s", $dte);
// 	$d2 = date_create_from_format("d/m/Y","$startDates");
	date_default_timezone_set('Africa/Lagos');
	$dte = date('d/m/Y h:i:s');
    $dateString = "$startDates";

//  	$dayy;  
    $dArr = explode('/', $dateString);
    // $list = list($dayy, $months, $yearr) = $dateString;
    
	$day = $dArr[0];
	$mnt = $dArr[1];
	$year = $dArr[2];
	
	
// 	$retireArr = explode('/', $dateRetire);
//     // $list = list($dayy, $months, $yearr) = $dateString;
    
// 	$Rday = $retireArr[0];
// 	$Rmnt = $retireArr[1];
// 	$Ryear = $retireArr[2];
	
	$dteString = $day . '/'. $mnt . '/' . $year;
	
	
// 	$Rday = $retireArr[0];
// 	$Rmnt = $retireArr[1];
// 	$Ryear = $retireArr[2];

// 	$RdteString = $Rday . '/'. $Rmnt . '/' . $Ryear;
	
	$d1 = date_create_from_format("d/m/Y h:i:s", $dte);
	$d2 = date_create_from_format("d/m/Y", "$dteString");

// die($startDates);
	//calculate the different between two date
	// $interval = $startDate->diff($endDate);
	$interval = date_diff( $d1, $d2);
//list($day, $month, $year) = $dateParts;

// 	//extract year month, day, hours from the differnce
	$yrs = $interval->y;
	$mnt = $interval->m;
	$dys = $interval->d;
	$hrs = $interval->h;
	$mins = $interval->i;
	$sec = $interval->s;

	$rtn = [
		'yrs' => $yrs,
		'mnt' => $mnt,
		'dys' => $dys,
		'hrs' => $hrs,
		'mins' => $mins,
		'sec' => $sec,
	];
	
	return $rtn;
}

//get all members out for fund moving
function checkToMoveFund($conn){
	$sql = "SELECT * FROM mpc_members ORDER BY members_id DESC LIMIT 100";
	$stmt = $conn->query($sql);
	if(!$stmt->num_rows >0){
		echo "<caption>No Data found.</caption>";
	}else{
		while ($data = $stmt->fetch_assoc()) {
			$uid = $data['members_id'];
			$phone = $data['phone'];
		$members =__mpcReturnByPhoneMember($conn, $phone);
?>
	<tbody>
		<tr>
			<td><?php echo $members[0]?></td>
			<td><?php echo $members[4]?></td>
			<td><img src="<?php echo __mpc_root__()?>asset/img/<?php echo $members[18]?>" class="dboard-img"></td>
			<td><?php echo $members[10]?></td>
			<td><?php echo $members[7]?></td>
			<td><?php echo $members[19]?></td>
			<td><button name="<?php echo $members[4]?>" class="fundsChk mpc-btn mpc-btn-fullWidth" uid="<?php echo $members[0]?>" ph="<?php echo $members[5]?>">Check</button></td>

		</tr>
	</tbody>
<?php
		}
	}
}

/**
 * provision to take money from thrift, shares to special saving
 * make provision for application for special saving
 * repay loan should be corrected to loan repaid
 * LOAN AVAILABLE SHOULD BE CORRECTED TO LOAN BALANCE
 * 
 * */


//function to get member account balance
// function __mpcMemberAccountBal__($conn, $tbl, $memId, $memPh, $tblCol1,  $tblCol2, $tbl_incre){
// 	$sql = "SELECT * FROM $tbl WHERE $tblCol1=? && $tblCol2=? ORDER BY $tbl_incre DESC";
// 	//echo $tblCol1;
// 	$stmt = mysqli_stmt_init($conn);
// 	if(!mysqli_stmt_prepare($stmt, $sql)) {
// 		$Err = "Unexpected Err";
// 		echo $Err.mysqli_error($conn);
// 		exit();
// 	}
// 		mysqli_stmt_bind_param($stmt, 'ss', $memId, $memPh);
// 		mysqli_stmt_execute($stmt);
// 		$d = mysqli_stmt_get_result($stmt);
// 		$data = mysqli_fetch_array($d);

// 		$arr = [$data['debit'], $data['credit'], $data['balance']];

// 		return $arr;
// }

function memberWithErr($conn){
	$sql = "SELECT *
			FROM mpc_members
			WHERE phone NOT IN (
			  SELECT shares_member_phone FROM mpc_account_shares
			  UNION
			  SELECT thrift_mem_phone FROM mpc_thrift_saving
			  UNION
			  SELECT mem_phone FROM mpc_special_saving
			) LIMIT 7";

	$q = $conn->query($sql);

	while ($data = mysqli_fetch_array($q)) {
?>
		<!-- echo $data['name'] ."<br>"; -->
		<div class="load-23232 d-flex">
            <div class="load-fff32 flx">
                <h6><?php echo$data['name'] ?></h6>
            </div>

            <div class="load-fstats flx">
                <img src="<?php echo __mpc_root__()?>asset/img/<?php echo$data['user_profile'] ?>" class="upfiled">
            </div>

            <div class="load-fxbtn flx">
                <button action-id="<?php echo $data['members_id']?>" action-phone="<?php echo $data['phone']?>" class="btn btn-primary w-100 __AS__">Fix</button>
            </div>
        </div>
<?php
	}
}