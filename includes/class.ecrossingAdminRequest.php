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
ini_set('display_errors',1);
error_reporting(E_ALL); 
date_default_timezone_set('Asia/Kolkata');

class EcrossingAdminRequest {

	public function handle_check_client_data($user_data) {
		// GET CLIENT EMAIL 
		$email = $user_data['email'];
		$return = array();
		$request_div = "";
		// GET ALL BGV REQUEST OF CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT t1.inprogress_request,t1.complete_request,t2.pending_employee,t2.grey_employee,t2.green_employee,t2.red_employee,t2.orange_employee FROM (SELECT SUM(request_status = 'In Progress') as inprogress_request,SUM(request_status = 'Complete') as complete_request FROM ecrossing_client_request WHERE client_email=:client_email ) t1 , (SELECT SUM(employee_status = 'White') as pending_employee,SUM(employee_status = 'Grey') as grey_employee,SUM(employee_status = 'Green') as green_employee,SUM(employee_status = 'Red') as red_employee,SUM(employee_status = 'Orange') as orange_employee FROM ecrossing_client_employee WHERE client_email=:client_email ) t2  ";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			$inprogress_request = $request_result[0]['inprogress_request'];
			$complete_request = $request_result[0]['complete_request'];
			$pending_employee = $request_result[0]['pending_employee'];
			$grey_employee = $request_result[0]['grey_employee'];
			$red_employee = $request_result[0]['red_employee'];
			$green_employee = $request_result[0]['green_employee'];
			$orange_employee = $request_result[0]['orange_employee'];
			$complete_employee = $grey_employee + $red_employee + $green_employee + $orange_employee;

			$return['pending_request'] = $inprogress_request + 0;
			$return['complete_request'] = $complete_request + 0;
			$return['pending_employee'] = $pending_employee + 0;
			$return['complete_employee'] = $complete_employee + 0;
			return $return;
		} else {
			$return['error'] = "Failed to Process Request";
			return $return;
		}


	}

	public function handle_get_all_client_bgv_request($user_data) {

		// GET CLIENT EMAIL 
		$email = $user_data['email'];
		$return = array();
		$request_div = "";
		// GET ALL BGV REQUEST OF CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_request_date,'%D %b %Y') as request_date,request_unique_id,request_status FROM ecrossing_client_request WHERE client_email=:client_email AND request_status !='Pending' AND request_status !='Complete' ORDER BY client_request_date DESC";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			$request_div .= '';
			foreach($request_result as $row) {
				// GENERATE HTML
				$link = SITE_BASE_URL.'admin-panel/view-bgv-request.php?request_id='.$row['request_unique_id'];
				$request_div .= '<tr>';
				$request_div .= '<td>'.$row['request_date'].'</td>';
				$request_div .= '<td>'.$row['request_unique_id'].'</td>';
				$request_div .= '<td><button onclick="downloadRequest(\''.$row['request_unique_id'].'\',\''.$email.'\');" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12"><i class="fa fa-download"></i> Download Request</button></td>';
				$request_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">View Request</a></td>';
				$request_div .= '</tr>';
				$request_div .= '';
			}
			$return['success'] = $request_div;
			return $return;
		} else {
			$return['error'] = "Failed to Process Request";
			return $return;
		}
	}

	public function handle_get_all_client_completed_bgv_request($user_data) {
		// GET CLIENT EMAIL 
		$email = $user_data['email'];
		$return = array();
		$request_div = "";
		// GET ALL BGV REQUEST OF CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_request_date,'%D %b %Y') as request_date,request_unique_id,request_status FROM ecrossing_client_request WHERE client_email=:client_email AND request_status ='Complete' ORDER BY client_request_date DESC";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			$request_div .= '';
			foreach($request_result as $row) {
				// GENERATE HTML
				$link = SITE_BASE_URL.'admin-panel/view-bgv-request.php?request_id='.$row['request_unique_id'];
				$request_div .= '<tr>';
				$request_div .= '<td>'.$row['request_date'].'</td>';
				$request_div .= '<td>'.$row['request_unique_id'].'</td>';
				$request_div .= '<td><button onclick="downloadRequest(\''.$row['request_unique_id'].'\',\''.$email.'\');" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12"><i class="fa fa-download"></i> Download Request</button></td>';
				$request_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">View Request</a></td>';
				$request_div .= '</tr>';
				$request_div .= '';
			}
			$return['success'] = $request_div;
			return $return;
		} else {
			$return['error'] = "Failed to Process Request";
			return $return;
		}
	}

	public function handle_get_all_employee_reviewed($user_data) {
		$email = $user_data['email'];
		$return = array();
		$employee_div = "";
		// FETCH THE DETAILS OF THE EMPLOYEES
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT request_unique_id,employee_name,employee_unique_id,employee_status FROM ecrossing_client_employee WHERE client_email=:client_email AND employee_status='White'";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) >= 0) {
			// HTML
			$employee_div = "";
			foreach ($employee_result as $row) {
				$link = SITE_BASE_URL.'admin-panel/update-employee-status.php?employee_id='.$row['employee_unique_id']."&client_id=".$email;
				$employee_div .= '<tr>';
				$employee_div .= '<td>'.$row['employee_name'].'</td>';
				$employee_div .= '<td>'.$row['request_unique_id'].'</td>';
				// $employee_div .= '<td>'.$row['request_unique_id'].'</td>';
				if($row['employee_status'] == "Red") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">Red</button></td>';
				} elseif($row['employee_status'] == "Green") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12">Green</button></td>';
				} elseif($row['employee_status'] == "Orange") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12">Orange</button></td>';
				} elseif($row['employee_status'] == "Gray") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Gray</button></td>';
				} else {
					$employee_div .= '<td><button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Under Review</button></td>';
				}
				$employee_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">Update Employee Report</a></td>';
				$employee_div .= '</tr>';
				$employee_div .= '';
			}
			$return['success'] = $employee_div;
			return $return;
		} else {
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
			$return['success'] = "Success";
			return $return;
		} else {
			$error_html = "System Error. Failed to add Employee.";
			$return['error'] = $error_html;
			return $return;
		}
	}



	public function handle_download_request($request_data) {
		// GET THE DATA
		$email = $request_data['email'];
		$request_id = $request_data['request_id'];
		$return =array();
		// GENERATE THE FOLDER LINK
		// $filePath = dirname(__DIR__)."/uploads/".$email."/".$request_id;
		// $rootPath = dirname(__DIR__)."/downloads/".$email;
		// $filePath = $request_id;
		$rootPath = "../../downloads/".$email;
		if(!is_dir($rootPath)) {
			mkdir($rootPath);
		}
		if(!is_dir($rootPath."/".$request_id)) {
			mkdir($rootPath."/".$request_id);
		}
		$createPath = "../../downloads/".$email."/".$request_id."/".$request_id.'.zip';
		$filename = "../downloads/".$email."/".$request_id."/".$request_id.'.zip';
		// Initialize archive object
		$zip = new ZipArchive();
		if ($zip->open($createPath, ZipArchive::CREATE)!==TRUE) {
          $return['error'] = "Error";
		  return $return;
        } else {
        	$old = getcwd();
			chdir("../../uploads/".$email."/");
			$this->create_zip_folder($zip,$request_id."/");
			chdir($old); // Restore the old working directory
			$zip->close();
			$return['success'] = $filename;
			return $return;
        }
		// $res = $zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
	}

	public function create_zip_folder($zip,$link) {
        if (is_dir($link)){
          if ($dh = opendir($link)){
           while (($file = readdir($dh)) !== false){
         
            // CHECK IF FILE 
            if (is_file($link.$file)) {
             if($file != '' && $file != '.' && $file != '..'){
         
              $zip->addFile($link.$file);
             }
            } else{
             // CHECK IF DIRECTORY
             if(is_dir($link.$file) ){

              if($file != '' && $file != '.' && $file != '..'){

               // ADD EMPTY DIRECTORY
               $zip->addEmptyDir($link.$file);

               $folder = $link.$file.'/';
         
               // READ DATA OF THE FOLDER
               $this->create_zip_folder($zip,$folder);
              }
             }
            }
           }
           closedir($dh);
          }
         }
    }

    public function handle_update_request_status($request_data) {
    	// GET REQUEST
    	$request_id = $request_data['request_id'];
    	$status = $request_data['status'];

    	// UPDATE REQUEST STATUS
    	$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":status",":unique_id");
		$condition_arr2 = array($status,$request_id);
		$CheckActiveUser = new EcrossingPDO();
		$new_request_sql = "UPDATE ecrossing_client_request SET request_status=:status WHERE request_unique_id=:unique_id";
		$request_employee_result=$CheckActiveUser->updateQuery($new_request_sql,$condition_arr1,$condition_arr2);
		if($request_employee_result == 1) {
			$return['success'] = "Success";
			return $return;
		} else {
			$error_html = "System Error. Failed to Update Request.";
			$return['error'] = $error_html;
			return $return;
		}
    }

    public function handle_get_all_request_employee($request_data) {
    	// GET REQUEST DATA
    	$request_id = $request_data['request_id'];
    	$return = array();
		$employee_div = "";
    	// GET THE EMPLOYEE LIST
    	// FETCH THE DETAILS OF THE EMPLOYEES
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":unique_id");
		$condition_arr2 = array($request_id);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_employee_date,'%D %b %Y') as employee_date,client_email,request_unique_id,employee_name,employee_unique_id,employee_status FROM ecrossing_client_employee WHERE request_unique_id=:unique_id";
		$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($employee_result) && sizeof($employee_result) >= 0) {
			// HTML
			$employee_div = "";
			foreach ($employee_result as $row) {
				$link = SITE_BASE_URL.'admin-panel/update-employee-status.php?employee_id='.$row['employee_unique_id'].'&client_id='.$row['client_email'];
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
				} elseif($row['employee_status'] == "Gray") {
					$employee_div .= '<td><button type="button" class="btn btn-fill btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Gray</button></td>';
				} else {
					$employee_div .= '<td><button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Under Review</button></td>';
				}
				$employee_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">Update Employee Report</a></td>';
				$employee_div .= '</tr>';
				$employee_div .= '';
			}
			$return['success'] = $employee_div;
			return $return;
		} else {
			$error_html = "<h4>No BGV Request to display.</h4>";
			$return['error'] = $error_html;
			return $return;
		}
    }

    public function handle_update_employee_status($request_data) {
    	// GET REQUEST
    	$employee_id = $request_data['employee_id'];
    	$email = $request_data['email'];
    	$status = $request_data['status'];

    	// UPDATE REQUEST STATUS
    	$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":status",":unique_id",":email");
		$condition_arr2 = array($status,$employee_id,$email);
		$CheckActiveUser = new EcrossingPDO();
		$new_status_sql = "UPDATE ecrossing_client_employee SET employee_status=:status WHERE employee_unique_id=:unique_id AND client_email=:email";
		$status_employee_result=$CheckActiveUser->updateQuery($new_status_sql,$condition_arr1,$condition_arr2);
		if($status_employee_result == 1) {
			$return['success'] = "Success";
			return $return;
		} else {
			$error_html = "System Error. Failed to Update Request.";
			$return['error'] = $error_html;
			return $return;
		}
    }

    public function handle_get_latest_news_feed() {
    	$return = array();
    	$current_date = date("Y-m-d h:i:s");
    	$notify_div = "";
    	// GET THE LASTEST NEWSFEED
  //   	$condition_arr1="";
		// $condition_arr2="";
		$CheckActiveUser = new EcrossingPDO();
		$notify_sql = "SELECT notification_date,client_email,request_employees FROM ecrossing_admin_notification ORDER BY ecrossing_notification_id DESC LIMIT 0,10 ";
		$notify_result=$CheckActiveUser->selectQuery($notify_sql);
		if(is_array($notify_result) && sizeof($notify_result) > 0) {
			foreach($notify_result as $row) {
				$time = $this->ago($row['notification_date']);
				$notify_div .= '';
				$notify_div .= '<div class="alert success">';
				$notify_div .= '<span class="closebtn" >'.$time.'</span> ';
				$notify_div .= '<strong>New Request!</strong><br> With '.$row['request_employees'].' Employees by <b>'.$row['client_email'].'</b>';
				$notify_div .= '</div>';
				$notify_div .= '';
			}
			$return['success'] = $notify_div;
			return $return;
		} else {
			$error_div = "";
			$error_div .= '<div class="alert success">';
			$error_div .= '<strong style="text-align:center;">No Notification</strong>';
			$error_div .= '</div>';
			$error_div .= '';
			$error_div .= '';

			$return['error'] = "No Notification.";
			return $return;
		}
    }

    public function pluralize($count,$text)
	{
	    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
	}

	public function ago($datetime)
	{
		$date1=new DateTime($datetime);
		$now = new DateTime();
		$interval = date_diff($now,$date1);
	    //$interval = date_create('now')->diff( $datetime );
	    $suffix = ( $interval->invert ? ' ago' : '' );
	    if ( $v = $interval->y >= 1 ) return $this->pluralize( $interval->y, 'year' ) . $suffix;
	    if ( $v = $interval->m >= 1 ) return $this->pluralize( $interval->m, 'month' ) . $suffix;
	    if ( $v = $interval->d >= 1 ) return $this->pluralize( $interval->d, 'day' ) . $suffix;
	    if ( $v = $interval->h >= 1 ) return $this->pluralize( $interval->h, 'hour' ) . $suffix;
	    if ( $v = $interval->i >= 1 ) return $this->pluralize( $interval->i, 'minute' ) . $suffix;
	    return $this->pluralize( $interval->s, 'second' ) . $suffix;
	}

	public function handle_finish_bgv_request($request_data) {
		// GET THE SESSION
		if(!isset($_SESSION)) {
			session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$request_id = $request_data['request_id'];
		$current_date = date("Y-m-d h:i:s");
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
			$return['success'] = "Success";
			return $return;
		} else {
			$error_html = "System Error. Failed to Finish Request.";
			$return['error'] = $error_html;
			return $return;
		}
	}

	public function handle_add_new_client_data($client_data) {
		// GET CLIENT DATA
		$current_date = date("Y-m-d h:i:s");
		$client_email = $client_data['email'];
		$client_name = $client_data['name'];
		$client_password = $client_data['password1'];

		// ADD THE CLIENT DATA TO CLIENT TABLE
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_date",":name",":email",":pass");
		$condition_arr2 = array($current_date,$client_name,$client_email,$client_password);
		$CheckActiveUser = new EcrossingPDO();
		$new_request_sql = "INSERT INTO ecrossing_client(client_date,client_name,client_email,client_password) VALUES(:client_date,:name,:email,:pass)";
		$request_employee_result=$CheckActiveUser->insertQuery($new_request_sql,$condition_arr1,$condition_arr2);
		if($request_employee_result == 1) {
			// CREATE THE FOLDER INSIDE
			$root_directory = dirname(__DIR__)."/uploads/".$client_email;
			if(!is_dir($root_directory)) {
				mkdir($root_directory);
			}
			// SET SESSION VARIABLE
			$return['success'] = "Success";
			return $return;
		} else {
			$error_html = "System Error. Failed to add Client.";
			$return['error'] = $error_html;
			return $return;
		}

	}

	public function handle_get_all_client_added() {
		// GET THE CLIENT DATA
		$current_date = date("Y-m-d h:i:s");
		$return = array();
		$client_div = "";
    	// FETCH THE DETAILS OF THE CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$CheckActiveUser = new EcrossingPDO();
		$client_sql = "SELECT DATE_FORMAT(client_date,'%D %b %Y') as client_date,client_email,client_name FROM ecrossing_client ORDER BY client_date DESC";
		$client_result=$CheckActiveUser->selectQuery($client_sql);
		if(is_array($client_result) && sizeof($client_result) >= 0) {
			// HTML
			$client_div = "";
			foreach ($client_result as $row) {
				$client_div .= '<tr>';
				$client_div .= '<td>'.$row['client_date'].'</td>';
				$client_div .= '<td>'.$row['client_name'].'</td>';
				$client_div .= '<td>'.$row['client_email'].'</td>';
				$client_div .= '<td>Yes</td>';
				$client_div .= '</tr>';
				$client_div .= '';
			}
			$return['success'] = $client_div;
			return $return;
		} else {
			$error_html = "<h4>No Client to display.</h4>";
			$return['error'] = $error_html;
			return $return;
		}

	}



}

?>