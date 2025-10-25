<?php

// mpc class test
class NewSettings{
	
	private $table;
	private $short;
	private $long;
	private $title;
	private $connection;
	private $result;

	public function SystemSettins($tbl, $short, $long, $title, $dbConn){

		$tb = $this->table = $tbl;
		$sh = $this->short = $short;
		$lng = $this->long = $long;
		$ttl = $this->title = $title;
		$id = 1;
		$db = $this->connection = $dbConn;

		$sql = "UPDATE $this->table SET SYSTEM_NAME='$lng', SYSTEM_TITLE='$ttl', SYSTEM_NAME_SHORT='$sh' WHERE ID='$id'";
		$stmt = $db->query($sql);
		//$result;
		if($stmt){
			$this->result = true;
		}else {
			$this->result = false;
		}


		return $this->result;

	}

	public function getSystemLogo($db){
	//	print_r($db);
		$conn = $db;
		$sql = "SELECT COMPANY_LOGO, COMPANY_FAVICON FROM mpc_general_settings WHERE settings_id=1";
		$q = $conn->query($sql);
		$row = $q->fetch_assoc();

		return [$row['COMPANY_LOGO'], $row['COMPANY_FAVICON']];
		
	}

	public function updateSystemLogo($db, $type, $upd){
		if($type == 'logo'){
			$type = 'COMPANY_LOGO';
		}else{
			$type = 'COMPANY_FAVICON';
		}
		
		$sql = "UPDATE mpc_general_settings SET $type='$upd'";
		$stmt = $this->connection = $db;
		$stmt->query($sql);
	//	$result;
		if($stmt){
			$this->result = true;
		}else {
			$this->result = false;
		}

		return $this->result;
	}
}

//social media url
class SocialLink{
	private $db;
	private $facebook;
	private $whatsapp;
	private $instagram;
	private $twitter;
	private $youtube;
	private $linkedin;

	//create social methods here
	public function getSocialLinks($db){
		$conn = $this->db =$db;
		$sql = "SELECT facebook_url, whatsapp_url, instagram_url, twitter_url, youtube_url, linkedin_url FROM mpc_general_settings";
		$stmt = $conn->query($sql);
		$data = $stmt->fetch_assoc();


		return [$data['facebook_url'], $data['whatsapp_url'], $data['instagram_url'], $data['twitter_url'], $data['youtube_url'], $data['linkedin_url']];
	}

	
}

class socialUpdate {
	/**UPDATE ALL SOCIAL MEDIA LINK */
	private $db;
	private $facebook;
	private $whatsapp;
	private $instagram;
	private $twitter;
	private $youtube;
	private $linkedin;

	public function __construct($db, $fb, $whtp, $inst, $twtr, $ytube, $lkedin)
	{
		//UPDATE ALL SOCIAL MEDIA LINK 
		$this->db = $db;
		$this->facebook = $fb;
		$this->whatsapp = $whtp;
		$this->instagram = $inst;
		$this->twitter = $twtr;
		$this->youtube = $ytube;
		$this->linkedin = $lkedin;
	}


	public function updateSocialLink(){
		$sql = "UPDATE mpc_general_settings SET facebook_url='$this->facebook', whatsapp_url='$this->whatsapp', instagram_url='$this->instagram', twitter_url='$this->twitter', youtube_url='$this->youtube', linkedin_url='$this->linkedin'";
		$db = $this->db->prepare($sql);
		$result = '';

		if($db->execute()){
			$result = true;
		}else {
			$result = false;
		}

		return $result;
	}
}