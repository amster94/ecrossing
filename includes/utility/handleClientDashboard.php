<?php

require_once dirname(__DIR__).'/class.ecrossingClientDashboard.php';


if (isset($_POST['handle_get_all_bgv_request'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingClientDashboard();
  	$return = $UserDetails->handle_get_all_bgv_request();
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

if (isset($_POST['handle_get_all_completed_bgv_request'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientDashboard();
    $return = $UserDetails->handle_get_all_completed_bgv_request();
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

if (isset($_POST['handle_get_all_employee_reviewed'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingClientDashboard();
  	$return = $UserDetails->handle_get_all_employee_reviewed();
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

if (isset($_POST['handle_get_all_bgv_request_status'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingClientDashboard();
  	$return = $UserDetails->handle_get_all_bgv_request_status();
  	unset($UserDetails);
  	if(!empty($return['error'])) {
  		echo json_encode(array('error' => $return['error']));
  	} else {
  		echo json_encode(array('pending' => $return['pending'],'complete' => $return['complete']));
	}
	}
  	catch(Exception $e) {
  		$return = "Exception Message ->".$e->getMessage().":Exception Code ->".$e->getCode();
  		$return.=":Exception File ->".$e->getFile().":Exception Line ->".$e->getLine();
  		echo json_encode(array('error' => $return));
  	}
}

if (isset($_POST['handle_get_employee_report_by_request'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientDashboard();
    $return = $UserDetails->handle_get_employee_report_by_request();
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

if (isset($_POST['handle_get_completed_employee_report'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientDashboard();
    $return = $UserDetails->handle_get_completed_employee_report();
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

if (isset($_POST['handle_send_query_status'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientDashboard();
    $return = $UserDetails->handle_send_query_status($_POST);
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


?>