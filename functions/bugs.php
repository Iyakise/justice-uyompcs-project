<?php

$data = json_decode(file_get_contents('php://input'));
date_default_timezone_set('Africa/Lagos');
$dte = date('Y-m-d H:i:s');
$uid = $data->uid;
$phone = $data->phone;
// $uid = 
// $
if($data->actionPermit !== '__no_allowed__')
{
	throw new Exception("Error Processing Request", 1);
	die;
}
define ('__mpc_connection__', 'GoodLife mpc uyo'); //db connecntin define constant
define ('MPC-AUTORIZE-CALL', ''); //mpc-function define constant

require_once dirname(__DIR__) ."/config/conn.php";

//update shares
$sql = "SELECT * FROM mpc_account_shares WHERE shares_member_id='$uid'";
if(!$q = $conn->query($sql)){
	$sql = "INSERT INTO mpc_account_shares (shares_member_id, shares_member_phone, 
						debit, credit, balance, date_time)
			VALUES('$uid', '$phone', '0', '0', '0', '$dte')";
	$conn->query($sql);
}else{
	$sql = "UPDATE mpc_account_shares SET shares_member_phone='$phone' WHERE shares_member_id='$uid'";
	$conn->query($sql);
}


// update thrift
$sql = "SELECT * FROM mpc_thrift_saving WHERE thrift_mem_id='$uid'";
if(!$q = $conn->query($sql)){
	$sql = "INSERT INTO mpc_thrift_saving (thrift_mem_id, thrift_mem_phone, 
						debit, credit, balance, date_time)
			VALUES('$uid', '$phone', '0', '0', '0', '$dte')";
	$conn->query($sql);
}else{
	$sql = "UPDATE mpc_thrift_saving SET thrift_mem_phone='$phone' WHERE thrift_mem_id='$uid'";
	$conn->query($sql);
}


// update special savings
$sql = "SELECT * FROM mpc_special_saving WHERE mem_id='$uid'";
if(!$q = $conn->query($sql)){
	$sql = "INSERT INTO mpc_special_saving (mem_id, mem_phone, 
						debit, credit, balance, date_time)
			VALUES('$uid', '$phone', '0', '0', '0', '$dte')";
	$conn->query($sql);
}else{
	$sql = "UPDATE mpc_special_saving SET mem_phone='$phone' WHERE mem_id='$uid'";
	$conn->query($sql);
}

$update = "UPDATE mpc_member_verification SET verify_for_phone='$phone' WHERE verify_for='$uid'";
$conn->query($update);


echo json_encode(['status' => true, 'response' => 'Account error fixed successful']);