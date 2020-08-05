<?php

require_once dirname(__DIR__).'/class.ecrossingAdminRequest.php';


if (isset($_POST['handle_check_client_data'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingAdminRequest();
  	$return = $UserDetails->handle_check_client_data($_POST);
  	unset($UserDetails);
  	if(!empty($return['error'])) {
  		echo json_encode(array('error' => $return['error']));
  	} else {
  		echo json_encode(array('pending_request' => $return['pending_request'],'complete_request' => $return['complete_request'],'pending_employee' => $return['pending_employee'],'complete_employee' => $return['complete_employee']));
	}
	}
  	catch(Exception $e) {
  		$return = "Exception Message ->".$e->getMessage().":Exception Code ->".$e->getCode();
  		$return.=":Exception File ->".$e->getFile().":Exception Line ->".$e->getLine();
  		echo json_encode(array('error' => $return));
  	}
}

if (isset($_POST['handle_get_all_client_bgv_request'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_get_all_client_bgv_request($_POST);
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

if (isset($_POST['handle_get_all_client_completed_bgv_request'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_get_all_client_completed_bgv_request($_POST);
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
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_get_all_employee_reviewed($_POST);
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

if (isset($_POST['handle_download_request'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_download_request($_POST);
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

if (isset($_POST['handle_update_request_status'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_update_request_status($_POST);
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

if (isset($_POST['handle_get_all_request_employee'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_get_all_request_employee($_POST);
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

if (isset($_POST['handle_update_employee_status'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_update_employee_status($_POST);
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

if (isset($_POST['handle_get_latest_news_feed'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_get_latest_news_feed();
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

if (isset($_POST['handle_add_new_client_data'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_add_new_client_data($_POST);
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

if (isset($_POST['handle_get_all_client_added'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingAdminRequest();
    $return = $UserDetails->handle_get_all_client_added();
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