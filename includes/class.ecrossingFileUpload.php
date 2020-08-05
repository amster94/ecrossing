<?php
/*
* EcrossingFileUpload - PHP FileUpload query creation .
* PHP Version 7
* @package Includes

/**
* EcrossingFileUpload - PHP FileUpload query creation .
* @package Includes
* @author Amey Sarode (Amster) <ameysarode00@gmail.com>
*/

require_once dirname(__DIR__).'/includes/service/appvars.php';
require_once dirname(__DIR__).'/includes/service/class.ecrossingPDO.php';
ini_set('display_errors',1);
date_default_timezone_set('Asia/Kolkata');

class EcrossingFileUpload {

	public function handle_upload_bgv_request_employee_file($employee_data,$employee_file) {
		// GET EMPLOYEE INFO
		$employee_id = $employee_data['employee_id'];
		$client_email = $employee_data['email'];
		$file_list = "";
		$return = array();
		// GET THE BGV REQUEST FOR EMPLOYEE
		$current_date = date("Y-m-d h:i:s");
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($client_email,$employee_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT request_unique_id FROM ecrossing_client_employee WHERE client_email=:client_email AND employee_unique_id=:unique_id ";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) > 0) {
			// GET THE BGV REQUEST AND UPPLOAD THE FILE
			$request_id = $employee_result[0]['request_unique_id'];

			// GET THE FOLDER PATH
			$file_name = $employee_file['file']['name'];
			$folder_path = dirname(__DIR__)."/uploads/".$client_email."/".$request_id."/".$employee_id."/".$file_name;
			if(file_exists($folder_path)) {
				unlink($folder_path);
			} 
			if (move_uploaded_file($employee_file['file']['tmp_name'], $folder_path)) {
				$file_list .= '<li class="border">
                            <span>'.$file_name.'</span>
                            <span class="success_file btn-success" name="success_file">&#10004;</span>
                            </li>';
				$return['success'] = $file_list;
				return $return;
			} else {
				$return['error'] = "Oops! Failed to upload File.";
				return $return;
			}

		} else {
			$return['error'] = "Oops! Failed to upload File. Data Error";
			return $return;
		}
	}

	public function handle_get_employee_uploaded_file_list($employee_data) {
		// GET THE DATA
		$employee_id = $employee_data['employee_id'];
		$client_email = $employee_data['email'];
		$file_list = "";
		$return = array();
		// GET THE BGV REQUEST FOR EMPLOYEE
		$current_date = date("Y-m-d h:i:s");
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($client_email,$employee_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT request_unique_id FROM ecrossing_client_employee WHERE client_email=:client_email AND employee_unique_id=:unique_id ";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) > 0) {
			// GET THE BGV REQUEST AND UPPLOAD THE FILE
			$request_id = $employee_result[0]['request_unique_id'];

			// GET THE FOLDER PATH
			$folder_path = dirname(__DIR__)."/uploads/".$client_email."/".$request_id."/".$employee_id."/";
			foreach(glob($folder_path.'*.*') as $file_name) {
				$file_name = str_replace($folder_path, '', $file_name);
				$file_list .= '<li class="border"><span>'.$file_name.'</span><span class="success_file btn-success" name="success_file">&#10004;</span></li>';
			}
			$return['success'] = $file_list;
			return $return;
			
		} else {
			$return['error'] = "Oops! Failed to load File list. Data Error";
			return $return;
		}
		
	}

	public function handle_upload_bgv_request_employee_report($employee_data,$employee_file) {
		// GET EMPLOYEE INFO
		$employee_id = $employee_data['employee_id'];
		$client_email = $employee_data['email'];
		$report_list = "";
		$return = array();
		// GET THE BGV REQUEST FOR EMPLOYEE
		$current_date = date("Y-m-d h:i:s");
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($client_email,$employee_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT request_unique_id FROM ecrossing_client_employee WHERE client_email=:client_email AND employee_unique_id=:unique_id ";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) > 0) {
			// GET THE BGV REQUEST AND UPPLOAD THE FILE
			$request_id = $employee_result[0]['request_unique_id'];

			// GET THE FOLDER PATH
			$file_name = $employee_file['file']['name'];
			$email_path = dirname(__DIR__)."/employee-reports/".$client_email;
			$request_path = dirname(__DIR__)."/employee-reports/".$client_email."/".$request_id;
			
			if(!is_dir($email_path)) {
				mkdir($email_path);
			}
			if(!is_dir($request_path)) {
				mkdir($request_path);
			}
			if(!is_dir($request_path."/".$employee_id)) {
				mkdir($request_path."/".$employee_id);
			}
			
			// NEW FILE NAME
			$file_part = explode(".", $file_name);
			$new_file_name = $employee_id.'.'.end($file_part);
			$folder_path = dirname(__DIR__)."/employee-reports/".$client_email."/".$request_id."/".$employee_id."/".$new_file_name;
			if(file_exists($folder_path)) {
				unlink($folder_path);
			}
			if (move_uploaded_file($employee_file['file']['tmp_name'], $folder_path)) {
				// UPDATE THE EMPLOYEE DOWNLOAD REPORT LIST
				$file_path = "employee-reports/".$client_email."/".$request_id."/".$employee_id."/".$new_file_name;
				$condition_arr1="";
				$condition_arr2="";
				$condition_arr1 = array(":client_email",":unique_id",":report");
				$condition_arr2 = array($client_email,$employee_id,$file_path);
				$CheckActiveUser = new EcrossingPDO();
				$new_report_sql = "UPDATE ecrossing_client_employee SET download_employee_report=:report WHERE client_email=:client_email AND employee_unique_id=:unique_id";
				$report_employee_result=$CheckActiveUser->updateQuery($new_report_sql,$condition_arr1,$condition_arr2);
				if($report_employee_result == 1) {
					$report_list .= '<li class="border">
                            <span>'.$file_name.'</span>
                            <span class="success_file btn-success" name="success_file">&#10004;</span>
                            </li>';
					$return['success'] = $report_list;
					return $return;
				} else {
					$error_html = "System Error. Failed to Finish Request.";
					$return['error'] = $error_html;
					return $return;
				}
				
			} else {
				$return['error'] = "Oops! Failed to upload Report.";
				return $return;
			}

		} else {
			$return['error'] = "Oops! Failed to upload File. Data Error";
			return $return;
		}
	}

	public function handle_get_employee_uploaded_report_list($employee_data) {
		// GET THE DATA
		$employee_id = $employee_data['employee_id'];
		$client_email = $employee_data['email'];
		$file_list = "";
		$return = array();
		// GET THE BGV REQUEST FOR EMPLOYEE
		$current_date = date("Y-m-d h:i:s");
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($client_email,$employee_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT request_unique_id FROM ecrossing_client_employee WHERE client_email=:client_email AND employee_unique_id=:unique_id ";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) > 0) {
			// GET THE BGV REQUEST AND UPPLOAD THE FILE
			$request_id = $employee_result[0]['request_unique_id'];

			// GET THE FOLDER PATH
			$folder_path = dirname(__DIR__)."/employee-reports/".$client_email."/".$request_id."/".$employee_id."/";
			foreach(glob($folder_path.'*.*') as $file_name) {
				$file_name = str_replace($folder_path, '', $file_name);
				$file_list .= '<li class="border"><span>'.$file_name.'</span><span class="success_file btn-success" name="success_file">&#10004;</span></li>';
			}
			$return['success'] = $file_list;
			return $return;
			
		} else {
			$return['error'] = "Oops! Failed to load File list. Data Error";
			return $return;
		}
		
	}

}

?>