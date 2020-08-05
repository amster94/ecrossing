<?php

require_once dirname(__DIR__).'/class.ecrossingLogin.php';

if (isset($_POST['handle_client_login'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingLogin();
  	$return = $UserDetails->handle_client_login($_POST);
  	unset($UserDetails);
  	if(!empty($return['error'])) {
  		echo json_encode(array('error' => $return['error']));
  	} else {
  		echo json_encode(array('success' => $return['success']));
	}
	}
  	catch(Exception $e) {
  		$return = "Exception Message ->".$e->getMessage().":Exception Code ->".$e->getCode();
  		$return.=":Exception File ->".$e->getFile().":Exception Line ->".$e->getLine();
  		echo json_encode(array('error' => $return));
  	}
}

if (isset($_POST['handle_admin_login'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingLogin();
  	$return = $UserDetails->handle_admin_login($_POST);
  	unset($UserDetails);
  	if(!empty($return['error'])) {
  		echo json_encode(array('error' => $return['error']));
  	} else {
  		echo json_encode(array('success' => $return['success']));
	}
	}
  	catch(Exception $e) {
  		$return = "Exception Message ->".$e->getMessage().":Exception Code ->".$e->getCode();
  		$return.=":Exception File ->".$e->getFile().":Exception Line ->".$e->getLine();
  		echo json_encode(array('error' => $return));
  	}
}

if (isset($_POST['handle_login'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingLogin();
  	$return = $UserDetails->handle_admin_login($_POST);
  	unset($UserDetails);
  	if(!empty($return['error'])) {
  		echo json_encode(array('error' => $return['error']));
  	} else {
  		echo json_encode(array('firstname' => $return['firstname'],'lastname' => $return['lastname'],'gender' => $return['gender'],'contact' => $return['contact'],'birthday' => $return['birthday'],'address' => $return['address']));
	}
	}
  	catch(Exception $e) {
  		$return = "Exception Message ->".$e->getMessage().":Exception Code ->".$e->getCode();
  		$return.=":Exception File ->".$e->getFile().":Exception Line ->".$e->getLine();
  		echo json_encode(array('error' => $return));
  	}
}


?>