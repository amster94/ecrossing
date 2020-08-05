<?php

require_once dirname(__DIR__).'/class.ecrossingFileUpload.php';

if (isset($_POST['handle_upload_bgv_request_employee_file'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingFileUpload();
    $return = $UserDetails->handle_upload_bgv_request_employee_file($_POST,$_FILES);
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

if (isset($_POST['handle_get_employee_uploaded_file_list'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingFileUpload();
    $return = $UserDetails->handle_get_employee_uploaded_file_list($_POST);
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

if (isset($_POST['handle_upload_bgv_request_employee_report'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingFileUpload();
    $return = $UserDetails->handle_upload_bgv_request_employee_report($_POST,$_FILES);
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

if (isset($_POST['handle_get_employee_uploaded_report_list'])) {
  try {
  //--------------------- INTIALIZE DETAIL FUNCTION --------------------------//
  $UserDetails = new EcrossingFileUpload();
    $return = $UserDetails->handle_get_employee_uploaded_report_list($_POST);
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