<?php

require_once dirname(__DIR__).'/class.ecrossingClientRequest.php';


if (isset($_POST['handle_generate_client_bgv_request'])) {
	try {
	//--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
	$UserDetails = new EcrossingClientRequest();
  	$return = $UserDetails->handle_generate_client_bgv_request();
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

if (isset($_POST['handle_get_request_employee_list'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientRequest();
    $return = $UserDetails->handle_get_request_employee_list($_POST);
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

if (isset($_POST['handle_get_request_download_employee_list'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientRequest();
    $return = $UserDetails->handle_get_request_download_employee_list($_POST);
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

if (isset($_POST['handle_add_request_employee'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientRequest();
    $return = $UserDetails->handle_add_request_employee($_POST);
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

if (isset($_POST['handle_finish_bgv_request'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientRequest();
    $return = $UserDetails->handle_finish_bgv_request($_POST);
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

if (isset($_POST['handle_download_excel_report'])) {
  try {
  ob_clean ();
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingClientRequest();
    $return = $UserDetails->handle_download_excel_report($_POST);
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