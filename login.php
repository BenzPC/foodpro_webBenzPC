<?php 
	session_start();
	header('Content-Type: application/json');
	
		isset($_GET['uid']) ? $uid = $_GET['uid'] : $uid = '';
		
		if($uid == "ADMIN"){
			$_SESSION['name'] = "ADMIN";		
			echo json_encode(array('status' => '0','message'=> '1' ));

		}else{
			$_SESSION['name'] = "Super Admin";
			echo json_encode(array('status' => '1','message'=> '1' ));

		}
?>