<?php
/*
* EcrossingCLientRequest - PHP CLientRequest query creation .
* PHP Version 7
* @package Includes

/**
* EcrossingCLientRequest - PHP CLientRequest query creation .
* @package Includes
* @author Amey Sarode (Amster) <ameysarode00@gmail.com>
*/
require_once dirname(__DIR__).'/includes/service/appvars.php';
require_once dirname(__DIR__).'/includes/service/class.ecrossingPDO.php';
include dirname(__DIR__).'/includes/Classes/PHPExcel/IOFactory.php';
require_once dirname(__DIR__).'/includes/Classes/PHPExcel.php';
ini_set('display_errors',1);
date_default_timezone_set('Asia/Kolkata');

class EcrossingClientRequest {

	public function handle_generate_client_bgv_request() {
		// GET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$current_date = date("Y-m-d h:i:s");
		$email = $_SESSION['ecrossing_client_email'];
		$unique_id = "BGV".date("ymdhis");
		$return = array();
		// CREATE NEW REQUEST
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":request_date",":unique_id",":email");
		$condition_arr2 = array($current_date,$unique_id,$email);
		$CheckActiveUser = new EcrossingPDO();
		$new_request_sql = "INSERT INTO ecrossing_client_request(client_request_date,request_unique_id,client_email) VALUES(:request_date,:unique_id,:email)";
		$request_result=$CheckActiveUser->insertQuery($new_request_sql,$condition_arr1,$condition_arr2);
		if($request_result == 1) {
			// CREATE FOLDER
			// CHECK CLIENT FOLDER EXIST
			$root_directory = dirname(__DIR__)."/uploads/".$email;
			if(!is_dir($root_directory)) {
				mkdir($root_directory);
			}
			$request_folder_path = dirname(__DIR__)."/uploads/".$email."/".$unique_id;
            mkdir($request_folder_path);
			// SET SESSION VARIABLE
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			// $link = SITE_BASE_URL."client-panel/view-request.php?request_id=".$unique_id;
			$link = SITE_BASE_URL."client-panel/request/".$unique_id;
			$return['success'] = $link;
			return $return;
		} else {
			// THROW ERROR
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$return['error'] = "Cannot Process Request. Check Internet Connection.";
			return $return;
		}


	}

	public function handle_get_request_employee_list($request_data) {
		// GET THE ID
		$request_id = $request_data['request_id'];

		// GET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$current_date = date("Y-m-d h:i:s");
		$return = array();
		// FETCH THE DETAILS OF THE EMPLOYEES
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($email,$request_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_employee_date,'%D %b %Y') as employee_date,client_email,request_unique_id,employee_name,employee_unique_id,employee_status FROM ecrossing_client_employee WHERE client_email=:client_email AND request_unique_id=:unique_id ORDER BY client_employee_date DESC";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) >= 0) {
			// HTML
			$employee_div = "";
			foreach ($employee_result as $row) {
				$link = SITE_BASE_URL.'client-panel/upload-employee-data.php?employee_id='.$row['employee_unique_id'];
				$link = SITE_BASE_URL.'client-panel/employee/'.$row['employee_unique_id'];
				$employee_div .= '<tr>';
				$employee_div .= '<td>'.$row['employee_date'].'</td>';
				$employee_div .= '<td>'.$row['employee_name'].'</td>';
				// $employee_div .= '<td>'.$row['request_unique_id'].'</td>';
				if($row['employee_status'] == "Red") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">Red</button></td>';
				} elseif($row['employee_status'] == "Green") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12">Green</button></td>';
				} elseif($row['employee_status'] == "Orange") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12">Orange</button></td>';
				} elseif($row['employee_status'] == "Grey") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Grey</button></td>';
				} else {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">In Progress</button></td>';
				}
				$employee_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">Upload Employee Data</a></td>';
				$employee_div .= '</tr>';
				$employee_div .= '';
			}
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$return['success'] = $employee_div;
			return $return;
		} else {
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$error_html = "<h4>No BGV Request to display.</h4>";
			$return['error'] = $error_html;
			return $return;
		}
	}

	public function handle_get_request_download_employee_list($request_data) {
		// GET THE ID
		$request_id = $request_data['request_id'];

		// GET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$current_date = date("Y-m-d h:i:s");
		$return = array();
		// FETCH THE DETAILS OF THE EMPLOYEES
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($email,$request_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_employee_date,'%D %b %Y') as employee_date,client_email,request_unique_id,employee_name,employee_unique_id,employee_status,download_employee_report FROM ecrossing_client_employee WHERE client_email=:client_email AND request_unique_id=:unique_id AND download_employee_report IS NOT NULL AND employee_status !='White' ORDER BY client_employee_date DESC";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) >= 0) {
			// HTML
			$employee_div = "";
			foreach ($employee_result as $row) {
				// $link = SITE_BASE_URL.'client-panel/upload-employee-data.php?employee_id='.$row['employee_unique_id'];
				$link = SITE_BASE_URL.'client-panel/employee/'.$row['employee_unique_id'];
				$employee_div .= '<tr>';
				$employee_div .= '<td>'.$row['employee_date'].'</td>';
				$employee_div .= '<td>'.$row['employee_name'].'</td>';
				// $employee_div .= '<td>'.$row['request_unique_id'].'</td>';
				if($row['employee_status'] == "Red") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">Red</button></td>';
				} elseif($row['employee_status'] == "Green") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12">Green</button></td>';
				} elseif($row['employee_status'] == "Orange") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12">Orange</button></td>';
				} elseif($row['employee_status'] == "Grey") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Grey</button></td>';
				} else {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12">In Progress</button></td>';
				}
				$employee_div .= '<td><a href="'.SITE_BASE_URL.$row['download_employee_report'].'" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12" download><i class="fa fa-download"></i> Download Report</a></td>';
				$employee_div .= '</tr>';
				$employee_div .= '';
			}
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$return['success'] = $employee_div;
			return $return;
		} else {
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$error_html = "<h4>No BGV Request to display.</h4>";
			$return['error'] = $error_html;
			return $return;
		}

	}

	public function handle_add_request_employee($request_data) {
		// GET THE ID
		// GET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$request_id = $request_data['request_id'];
		$employee_name = $request_data['employee_name'];
		$folder_employee_name = str_replace(' ', '_', $employee_name);
		$current_date = date("Y-m-d h:i:s");
		$employee_id = $folder_employee_name."_".date("dmy_his");
		$return = array();
		// ADD THE EMPLOYEE DATA TO EMPLOYEE TABLE
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":request_date",":name",":unique_id",":employee_id",":email");
		$condition_arr2 = array($current_date,$employee_name,$request_id,$employee_id,$email);
		$CheckActiveUser = new EcrossingPDO();
		$new_request_sql = "INSERT INTO ecrossing_client_employee( 	client_employee_date,employee_name,request_unique_id,employee_unique_id,client_email) VALUES(:request_date,:name,:unique_id,:employee_id,:email)";
		$request_employee_result=$CheckActiveUser->insertQuery($new_request_sql,$condition_arr1,$condition_arr2);
		if($request_employee_result == 1) {
			// CREATE THE FOLDER INSIDE
			$root_directory = dirname(__DIR__)."/uploads/".$email."/".$request_id."/";
			if(!is_dir($root_directory)) {
				mkdir($root_directory);
			}
			$request_folder_path = dirname(__DIR__)."/uploads/".$email."/".$request_id."/".$employee_id;
            mkdir($request_folder_path);
			// SET SESSION VARIABLE
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$return['success'] = "Success";
			return $return;
		} else {
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$error_html = "System Error. Failed to add Employee.";
			$return['error'] = $error_html;
			return $return;
		}
	}

	public function handle_finish_bgv_request($request_data) {
		// GET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$request_id = $request_data['request_id'];
		$current_date = date("Y-m-d h:i:s");
		$employee_count = 0;
		$return = array();
		// UPDATE THE REQUEST STATUS
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($email,$request_id);
		$CheckActiveUser = new EcrossingPDO();
		$new_request_sql = "UPDATE ecrossing_client_request SET request_status='In Progress' WHERE client_email=:client_email AND request_unique_id=:unique_id";
		$request_employee_result=$CheckActiveUser->updateQuery($new_request_sql,$condition_arr1,$condition_arr2);
		if($request_employee_result == 1) {
			// GET EMPLOYEE COUNT
			$condition_arr1="";
			$condition_arr2="";
			$condition_arr1 = array(":client_email",":unique_id");
			$condition_arr2 = array($email,$request_id);
			$CheckActiveUser = new EcrossingPDO();
			$request_sql = "SELECT SUM(request_unique_id = :unique_id) as employee_count FROM ecrossing_client_employee WHERE client_email=:client_email AND request_unique_id=:unique_id ";
			$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
			if(is_array($employee_result) && sizeof($employee_result) > 0) {
				$employee_count = $employee_result[0]['employee_count'];
			} else {
				$employee_count = 0;
			}
			// NOTIFY ADMIN
			$condition_arr1="";
			$condition_arr2="";
			$condition_arr1 = array(":request_date",":unique_id",":email",":employee_count");
			$condition_arr2 = array($current_date,$request_id,$email,$employee_count);
			$CheckActiveUser = new EcrossingPDO();
			$new_request_sql = "INSERT INTO ecrossing_admin_notification(notification_date,client_email,request_unique_id,request_employees) VALUES(:request_date,:email,:unique_id,:employee_count)";
			$request_employee_result=$CheckActiveUser->insertQuery($new_request_sql,$condition_arr1,$condition_arr2);
			if($request_employee_result == 1) {
				$CheckActiveUser = NULL;
				unset($CheckActiveUser);
				$return['success'] = "Success";
				return $return;
			} else {
				$CheckActiveUser = NULL;
				unset($CheckActiveUser);
				$error_html = "System Error. Failed to Finish Request. .";
				$return['error'] = $error_html;
				return $return;
			}

		} else {
			$CheckActiveUser = NULL;
			unset($CheckActiveUser);
			$error_html = "System Error. Failed to Finish Request.";
			$return['error'] = $error_html;
			return $return;
		}
	}

	public function handle_download_excel_report($request_data) {
		$request_id = $request_data['request_id'];
		$objPHPExcel = NULL;
		$objWriter= NULL;
		// SET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$return = array();
		// GET THE REQUEST DATA
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":unique_id");
		$condition_arr2 = array($email,$request_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT request_unique_id,DATE_FORMAT(client_employee_date,'%D %b %Y') as employee_date,employee_name,employee_status FROM ecrossing_client_employee WHERE client_email=:client_email AND request_unique_id=:unique_id ORDER BY client_employee_date DESC";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) > 0) {
			// CREATE NEW EXCEL
			$objPHPExcel = new PHPExcel(); // Create new PHPExcel object
			$objPHPExcel->getProperties()->setCreator("Ecrossing Corporation")
			 ->setLastModifiedBy("Ecrossing Corporation")
			 ->setTitle("Employee Request Status Report ".$request_id)
			 ->setSubject("Employee Request Status Report")
			 ->setDescription("Employee Status Report Details for Request ".$request_id)
			 ->setKeywords("Ecrossing")
			 ->setCategory("Ecrossing Request");
			// create style
			$default_border = array(
			    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
			    'color' => array('rgb'=>'333')
			);
			$style_header = array(
			    'borders' => array(
			        'bottom' => $default_border,
			        'left' => $default_border,
			        'top' => $default_border,
			        'right' => $default_border,
			    ),
			    'fill' => array(
			        'type' => PHPExcel_Style_Fill::FILL_SOLID,
			        'color' => array('rgb'=>'00FF00'),
			    ),
			    'font' => array(
			        'bold' => true,
			 		'size' => 10,
			 		'color' => array('rgb'=>'333333'),
			    )
			);
			$style_content = array(
			    'borders' => array(
			        'bottom' => $default_border,
			        'left' => $default_border,
			        'top' => $default_border,
			        'right' => $default_border,
			    ),
			    'fill' => array(
			        'type' => PHPExcel_Style_Fill::FILL_SOLID,
			        'color' => array('rgb'=>'eeeeee'),
			    ),
			    'font' => array(
			 	'size' => 10,
			    )
			);
			// Create Header
			$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', 'SR NO')
			            ->setCellValue('B1', 'REQUEST NO')
			            ->setCellValue('C1', 'EMPLOYEE DATE')
			            ->setCellValue('D1', 'EMPLOYEE NAME')
			            ->setCellValue('E1', 'EMPLOYEE STATUS');
			$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray( $style_header ); // give style to header
			 
			// Create Data
			$firststyle='A2';
			$i=0;
			foreach($employee_result as $row)
			{
			 $urut=$i+2;
			 $sr_no='A'.$urut;
			 $request_no='B'.$urut;
			 $emp_date='C'.$urut;
			 $emp_name='D'.$urut;
			 $emp_status='E'.$urut;
			 $objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue($sr_no, $i+1)
			         ->setCellValue($request_no, $row['request_unique_id'])
			         ->setCellValue($emp_date, $row['employee_date'])
			         ->setCellValue($emp_name, $row['employee_name'])
			         ->setCellValue($emp_status, $row['employee_status']);
			 $laststyle=$emp_status;
			 $i++;
			}
			$objPHPExcel->getActiveSheet()->getStyle($firststyle.':'.$laststyle)->applyFromArray( $style_content ); // give style to header
			// RESIZE COLUMN
			for ($col = 'A'; $col != 'F'; $col++) {
       			// $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setWidth(-1);
       			$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }
            // RESIZE ROW
			// for($x=0;$i<=sizeof($employee_result);$x++) {
			// 	$objPHPExcel->getActiveSheet()->getRowDimension($x)->setRowHeight(-1);
			// }
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle($request_id.'_Report');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// SAVE THE EXCEL
			$root_path = dirname(__DIR__)."/downloads/".$email."/";
			$folder_path = dirname(__DIR__)."/downloads/".$email."/".$request_id."/";

			$filename = $folder_path.$request_id.".xls";
			if(!is_dir($root_path)) {
				mkdir($root_path);
			}
			if(!is_dir($folder_path)) {
				mkdir($folder_path);
			}
			if(file_exists($filename)) {
				unlink($filename);
			}
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save($filename);
			$CheckActiveUser = NULL;
			$objPHPExcel = NULL;
			$objWriter= NULL;
			unset($CheckActiveUser);
			unset($objPHPExcel);
			unset($objWriter);
			$url_path = SITE_BASE_URL."/downloads/".$email."/".$request_id."/".$request_id.".xls";
			$return['success'] = $url_path;
			return $return;

		} else {
			unset($CheckActiveUser);
			$CheckActiveUser = NULL;
			$return['error'] = "Failed to Download";
			return $return;
		}

	}

}

?>