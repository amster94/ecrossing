<?php
/*
* EcrossingClientDashbaord - PHP ClientDashbaord query creation .
* PHP Version 7
* @package Includes

/**
* EcrossingClientDashbaord - PHP ClientDashbaord query creation .
* @package Includes
* @author Amey Sarode (Amster) <ameysarode00@gmail.com>
*/

require_once dirname(__DIR__).'/includes/service/appvars.php';
require_once dirname(__DIR__).'/includes/service/class.ecrossingPDO.php';
require_once dirname(__DIR__).'/includes/class.phpmailer.php';
require_once dirname(__DIR__).'/includes/class.smtp.php';
ini_set('display_errors',1);
date_default_timezone_set('Asia/Kolkata');

class EcrossingClientDashboard {

	protected $support_mail = SUPPORT_MAIL;
	protected $support_pass = SUPPORT_PASS;

	public function handle_get_all_bgv_request() {
		$return = array();
		// SET SESSION
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		// GET THE BGV REQUEST FOR THE CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":status");
		$condition_arr2 = array($email,"Complete");
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_request_date,'%D %b %Y') as request_date,client_email,request_unique_id,request_status FROM ecrossing_client_request WHERE client_email=:client_email AND request_status!=:status ORDER BY client_request_date DESC";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			// GENERATE HTML
			$bgv_request_div = "";
			foreach ($request_result as $row) {
				// $link = SITE_BASE_URL.'client-panel/view-request.php?request_id='.$row['request_unique_id'];
				$link = SITE_BASE_URL.'client-panel/request/'.$row['request_unique_id'];
				$bgv_request_div .= '<tr>';
				$bgv_request_div .= '<td>'.$row['request_date'].'</td>';
				$bgv_request_div .= '<td>'.$row['request_unique_id'].'</td>';
				$bgv_request_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-fill  btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">View Request</a></td>';
				if($row['request_status'] == "In Progress") {
					$bgv_request_div .= '<td><input type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" value="In Progress" ></td>';
				} elseif($row['request_status'] == "Complete") {
					$bgv_request_div .= '<td><input type="button" class="btn btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Complete" ></td>';
				} elseif($row['request_status'] == "Reviewing") {
					$bgv_request_div .= '<td><input type="button" class="btn btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Reviewing" ></td>';
				} else {
					$bgv_request_div .= '<td><input type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Pending" ></td>';
				}
				$bgv_request_div .= '</tr>';
				$bgv_request_div .= '';
			}
			unset($CheckActiveUser);
			$return['success'] = $bgv_request_div;
			return $return;
		} else {
			$error_html = "<h4>No BGV Request to display.</h4>";
			unset($CheckActiveUser);
			$return['error'] = $error_html;
			return $return;
		}
	}

	public function handle_get_all_completed_bgv_request() {
		$return = array();
		// SET SESSION
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		// GET THE BGV REQUEST FOR THE CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":status");
		$condition_arr2 = array($email,"Complete");
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_request_date,'%D %b %Y') as request_date,client_email,request_unique_id,request_status FROM ecrossing_client_request WHERE client_email=:client_email AND request_status=:status ORDER BY client_request_date DESC";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			// GENERATE HTML
			$bgv_request_div = "";
			foreach ($request_result as $row) {
				// $link = SITE_BASE_URL.'client-panel/view-request.php?request_id='.$row['request_unique_id'];
				$link = SITE_BASE_URL.'client-panel/request/'.$row['request_unique_id'];
				$bgv_request_div .= '<tr>';
				$bgv_request_div .= '<td>'.$row['request_date'].'</td>';
				$bgv_request_div .= '<td>'.$row['request_unique_id'].'</td>';
				$bgv_request_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-fill  btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">View Request</a></td>';
				$bgv_request_div .= '<td><input type="button" class="btn btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Complete" ></td>';
				$bgv_request_div .= '</tr>';
				$bgv_request_div .= '';
			}
			unset($CheckActiveUser);
			$return['success'] = $bgv_request_div;
			return $return;
		} else {
			$error_html = "<h4>No BGV Request to display.</h4>";
			unset($CheckActiveUser);
			$return['error'] = $error_html;
			return $return;
		}

	}

	public function handle_get_all_employee_reviewed() {
		// GET THE EMAIL
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$return = array();
		$employee_report_div = "";
		// GET THE EMPLOYEE REPORT GENERATED
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DISTINCT request_unique_id FROM ecrossing_client_employee WHERE client_email=:client_email AND download_employee_report IS NOT NULL AND employee_status !='White' ";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			// GENERATE HTML
			$employee_report_div .= '';
			foreach ($request_result as $row) {
			$link = SITE_BASE_URL.'client-panel/download-request/'.$row['request_unique_id'];
			// GET REQUEST DATA
			$condition_arr1="";
			$condition_arr2="";
			$condition_arr1 = array(":client_email",":request_id");
			$condition_arr2 = array($email,$row['request_unique_id']);
			$CheckEmployee = new EcrossingPDO();
			$status_sql = "SELECT t1.request_date,t1.request_status,t2.total_employee FROM (SELECT DATE_FORMAT(client_request_date,'%D %b %Y') as request_date,request_status FROM ecrossing_client_request WHERE client_email=:client_email AND  request_unique_id = :request_id) t1,(SELECT COUNT(employee_unique_id) as total_employee FROM ecrossing_client_employee WHERE client_email=:client_email AND request_unique_id = :request_id AND download_employee_report IS NOT NULL AND employee_status !='White') t2";
			$status_result=$CheckEmployee->selectQuery($status_sql,$condition_arr1,$condition_arr2);
			if(is_array($status_result) && sizeof($status_result) >= 0) {
				$request_date = $status_result[0]['request_date'];
				$request_status = $status_result[0]['request_status'];
				$total_employee = $status_result[0]['total_employee'];
				unset($CheckEmployee);
			} else {
				$request_date = "NaN";
				$request_status = "NaN";
				$total_employee = "NaN";
				unset($CheckEmployee);
			}
			$employee_report_div .= '<tr>';
			$employee_report_div .= '<td>'.$request_date.'</td>';
			$employee_report_div .= '<td>'.$row['request_unique_id'].'</td>';
			$employee_report_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-fill btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">Check Employees</a></td>';
			$employee_report_div .= '<td>'.$total_employee.'</td>';
			if($request_status == "In Progress") {
				$employee_report_div .= '<td><input type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" value="In Progress" ></td>';
			} elseif($request_status == "Complete") {
				$employee_report_div .= '<td><input type="button" class="btn btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Complete" ></td>';
			} elseif($row['request_status'] == "Reviewing") {
				$employee_report_div .= '<td><input type="button" class="btn btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Reviewing" ></td>';
			} else {
				$employee_report_div .= '<td><input type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Pending" ></td>';
			}
			$employee_report_div .= '</tr>';
			$employee_report_div .= '';
			}
			unset($CheckActiveUser);
			$return['success'] = $employee_report_div;
			return $return;

		} else {
			$error_html = "<tr><td>No Employee Report Found.</td></tr>";
			unset($CheckActiveUser);
			$return['error'] = $error_html;
			return $return;
		}

	}

	// public function handle_get_all_employee_reviewed() {
	// 	// SET SESSION
	// 	if(!isset($_SESSION)) {
	// 			session_start();
	// 	}
	// 	$email = $_SESSION['ecrossing_client_email'];
	// 	// GET THE EMPLOYEES REVIEWED FOR THE CLIENT
	// 	// GET THE BGV REQUEST FOR THE CLIENT
	// 	$condition_arr1="";
	// 	$condition_arr2="";
	// 	$condition_arr1 = array(":client_email");
	// 	$condition_arr2 = array($email);
	// 	$CheckActiveUser = new EcrossingPDO();
	// 	$request_sql = "SELECT DATE_FORMAT(client_employee_date,'%D %b %Y') as employee_date,employee_name,client_email,request_unique_id,employee_status FROM ecrossing_client_employee WHERE client_email=:client_email AND employee_status <> 'Grey' ";
	// 	$employee_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
	// 	if(is_array($employee_result) && sizeof($employee_result) >= 0) {
	// 		// GENERATE HTML
	// 		$employee_div = "";
	// 		foreach ($employee_result as $row) {
	// 			$employee_div .= '<tr>';
	// 			$employee_div .= '<td>'.$row['employee_date'].'</td>';
	// 			$employee_div .= '<td>'.$row['employee_name'].'</td>';
	// 			$employee_div .= '<td>'.$row['request_unique_id'].'</td>';
	// 			if($row['employee_status'] == "Red") {
	// 				$employee_div .= '<td><button type="button" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">Red</button></td>';
	// 			} elseif($row['employee_status'] == "Green") {
	// 				$employee_div .= '<td><button type="button" class="btn btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12">Green</button></td>';
	// 			} elseif($row['employee_status'] == "Orange") {
	// 				$employee_div .= '<td><button type="button" class="btn btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12">Orange</button></td>';
	// 			} else {
	// 				$employee_div .= '<td><button type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">White</button></td>';
	// 			}
	// 			$employee_div .= '</tr>';
	// 			$employee_div .= '';
	// 		}
	// 		$return['success'] = $employee_div;
	// 		return $return;
			

	// 	} else {
	// 		$error_html = "<h4>No Employee to display.</h4>";
	// 		$return['error'] = $error_html;
	// 		return $return;
	// 	}
	// }

	public function handle_get_all_bgv_request_status() {
		$return = array();
		// SET SESSION
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		// GET THE BGV REQUEST FOR THE CLIENT
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT SUM(request_status = 'Pending') as pending_request,SUM(request_status = 'In Progress') as inprogress_request,SUM(request_status = 'Complete') as complete_request FROM ecrossing_client_request WHERE client_email=:client_email ORDER BY client_request_date DESC";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			// GENERATE HTML
			$pending_request = $request_result[0]['pending_request'];
			$inprogress_request = $request_result[0]['inprogress_request'];
			$complete_request = $request_result[0]['complete_request'];
			$return['pending'] = $pending_request + $inprogress_request;
			$return['complete'] = $complete_request + 0;
			return $return;

		} else {
			$error_html = "<h4>BGV Request Data Not Found.</h4>";
			$return['error'] = $error_html;
			return $return;
		}
	}

	public function handle_get_employee_report_by_request() {
		// GET THE EMAIL
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$return = array();
		$employee_report_div = "";
		// GET THE EMPLOYEE REPORT GENERATED
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DISTINCT request_unique_id FROM ecrossing_client_employee WHERE client_email=:client_email AND download_employee_report IS NOT NULL AND employee_status !='White' ";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			// GENERATE HTML
			$employee_report_div .= '';
			foreach ($request_result as $row) {
			$link = SITE_BASE_URL.'client-panel/download-request/'.$row['request_unique_id'];
			// GET THE REQUEST DETAILS
			$condition_arr1="";
			$condition_arr2="";
			$condition_arr1 = array(":client_email",":request_id");
			$condition_arr2 = array($email,$row['request_unique_id']);
			$CheckEmployee = new EcrossingPDO();
			$status_sql = "SELECT DATE_FORMAT(client_request_date,'%D %b %Y') as request_date,request_status FROM ecrossing_client_request WHERE client_email=:client_email AND  request_unique_id = :request_id";
			$status_result=$CheckEmployee->selectQuery($status_sql,$condition_arr1,$condition_arr2);
			if(is_array($status_result) && sizeof($status_result) >= 0) {
				$request_date = $status_result[0]['request_date'];
				$request_status = $status_result[0]['request_status'];
				unset($CheckEmployee);
			} else {
				$request_date = "NaN";
				$request_status = "NaN";
				$total_employee = "NaN";
				unset($CheckEmployee);
			}
			$employee_report_div .= '<tr>';
			$employee_report_div .= '<td>'.$request_date.'</td>';
			$employee_report_div .= '<td>'.$row['request_unique_id'].'</td>';
			$employee_report_div .= '<td><a href="'.$link.'" target="_blank" class="btn btn-fill btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12" role="button">View Request</a></td>';
			if($request_status == "In Progress") {
				$employee_report_div .= '<td><input type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12" value="In Progress" ></td>';
			} elseif($request_status == "Complete") {
				$employee_report_div .= '<td><input type="button" class="btn btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Complete" ></td>';
			} elseif($row['request_status'] == "Reviewing") {
				$employee_report_div .= '<td><input type="button" class="btn btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Reviewing" ></td>';
			} else {
				$employee_report_div .= '<td><input type="button" class="btn btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12" value="Pending" ></td>';
			}
			$employee_report_div .= '</tr>';
			$employee_report_div .= '';
			}
			unset($CheckActiveUser);
			$return['success'] = $employee_report_div;
			return $return;
		} else {
			unset($CheckActiveUser);
			$error_html = "<tr><td>No Employee Report Found.</td></tr>";
			$return['error'] = $error_html;
			return $return;
		}
	}


	public function handle_get_completed_employee_report() {
		// GET THE EMAIL
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$return = array();
		$employee_report_div = "";
		// GET THE EMPLOYEE REPORT GENERATED
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT DATE_FORMAT(client_employee_date,'%D %b %Y') as employee_date,employee_name,employee_status,download_employee_report FROM ecrossing_client_employee WHERE client_email=:client_email AND download_employee_report!='' AND employee_status !='White'";
		$request_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($request_result) && sizeof($request_result) >= 0) {
			// GENERATE HTML
			$employee_report_div .= '';
			foreach ($request_result as $row) {
			$employee_report_div .= '<tr>';
			$employee_report_div .= '<td>'.$row['employee_date'].'</td>';
			$employee_report_div .= '<td>'.$row['employee_name'].'</td>';
			if($row['employee_status'] == "Red") {
					$employee_report_div .= '<td><button type="button" class="btn btn-fill btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">Red</button></td>';
				} elseif($row['employee_status'] == "Green") {
					$employee_report_div .= '<td><button type="button" class="btn btn-fill btn-success col-lg-12 col-md-12 col-sm-12 col-xs-12">Green</button></td>';
				} elseif($row['employee_status'] == "Orange") {
					$employee_report_div .= '<td><button type="button" class="btn btn-fill btn-warning col-lg-12 col-md-12 col-sm-12 col-xs-12">Orange</button></td>';
				} else {
					$employee_report_div .= '<td><button type="button" class="btn btn-fill btn-default col-lg-12 col-md-12 col-sm-12 col-xs-12">Grey</button></td>';
				}
			$employee_report_div .= '<td><a href="'.SITE_BASE_URL.$row['download_employee_report'].'" class="btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12" download><i class="fa fa-download"></i> Download Report</a></td>';
			$employee_report_div .= '</tr>';
			$employee_report_div .= '';
			}
			$return['success'] = $employee_report_div;
			return $return;

		} else {
			$error_html = "<tr><td>No Employee Report Found.</td></tr>";
			$return['error'] = $error_html;
			return $return;
		}

	}

	public function handle_send_query_status($user_info) {
		// GET DATA
		$title = $user_info['title'];
		$description = $user_info['description'];
		if(!isset($_SESSION)) {
				session_start();
		}
		$email = $_SESSION['ecrossing_client_email'];
		$return = array();
		$client_mail_div = "";

		// GET THE EMPLOYEE DETAILS
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email");
		$condition_arr2 = array($email);
		$CheckActiveUser = new EcrossingPDO();
		$request_sql = "SELECT client_name FROM ecrossing_client WHERE client_email=:client_email";
		$client_result=$CheckActiveUser->selectQuery($request_sql,$condition_arr1,$condition_arr2);
		if(is_array($client_result) && sizeof($client_result) >= 0) {
			$client_name = $client_result[0]['client_name'];
			unset($CheckActiveUser);
		} else {
			$client_name = "NaN";
			unset($CheckActiveUser);
		}

		// SEND THE MAIL
		$username = $this->support_mail;
    	$password = $this->support_pass;
    	$mode = "Default";
    	$to = "invibrations@gmail.com";
    	$subject = "New Query Raised From Client : ".$client_name;
    	$message = '<div class="mail_box" style="background-color:#f7f7f7;margin-top:0px;margin-bottom:0px;margin-right:0px;margin-left:0px;" >
      <div class="container-fluid" style="padding-top:0.5%;padding-bottom:3%;padding-right:2%;padding-left:2%;background-color:#d36d2b;width:80%;margin-left:8%;" >
        <a href="http://ecrossings.in/" style="text-decoration:none;" >
        <center><img class="img-responsive mail_logo" src="http://ecrossings.in/wp-content/uploads/2017/12/logo-1.png" style="width:40%;background-color:#FFF;"></center></a>
        <div class="container" style="width:100%;background-color:#fff;box-shadow:0px 0px 3px 0px rgba(0,0,0,.12), 0px 0px 3px 0px rgba(0,0,0,.12);" >
          <div class="main_body" style="padding-top:2%;padding-bottom:2%;padding-right:2%;padding-left:2%;" >
            <div class="confirmation_body" style="text-align:left;padding-top:2%;padding-bottom:2%;padding-right:2%;padding-left:2%;font-size:16px;" >
              <h3 style="color:#555;font-weight:normal;" >Hi Admin,</h3>
              <p style="color:#555;font-weight:normal;" > Query details are as follows : </p>
              <p>Title : <span>'.$title.'</span></p>
              <p>Email/Contact : <span>'.$email.'</span></p>
              <p>Query Description : <span>'.$description.'</span></p>
            </div>
            <div>
            </div>
            <div class="send-body" style="color:#555;text-align:left;font-size:16px;">
            <p>Regards,</p>
            <p style="color:#5CB85C;"><b>Team Ecrossing</b></p>
            </div>
          </div>
        </div>
        </div>
      </div>';
	  $return = $this->smtpmailer_gmail($to,$subject,$message,$username,$password,$mode);
	  return $return;
	}

	/*-------------------- SEND MAIL VIA GMAIL -------------------------------------------------*/
	protected function smtpmailer_gmail($to,$subject,$message,$Username,$Password,$mode) {
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = $Username;
	$mail->Password = $Password;
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->From = $Username;
	$mail->FromName = 'Ecrossing';
	$mail->isHTML(true);
	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = ( stripslashes( $message ) );
	$mail->AltBody = 'Please Use a Html email Client To view This Message!!';
	$mail->SMTPOptions = array(
		'ssl' => array(
	    'verify_peer' => false,
	    'verify_peer_name' => false,
	    'allow_self_signed' => true
		)
	);
	$messenger = array();
	if(!$mail->send()) {
		$messenger['error'] = "Failed to send Query";
	} else {
		$messenger['success'] = "Query Send Successfuly";
	}
	return $messenger;
   }

   protected function smtpmailer($to,$subject,$message,$Username,$Password,$mode){
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.ecrossing.com';
	$mail->SMTPAuth = true;
	$mail->Username = $Username;
	$mail->Password = $Password;
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->From = $Username;
	$mail->FromName = 'Ecrossing';
	$mail->isHTML(true);
	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = ( stripslashes( $message ) );
	$mail->AltBody = 'Please Use a Html email Client To view This Message!!';
	$mail->SMTPOptions = array(
		'ssl' => array(
	    'verify_peer' => false,
	    'verify_peer_name' => false,
	    'allow_self_signed' => true
		)
	);
	$messenger = array();
	if(!$mail->send()) {
		$messenger['error'] = "Failed to send Query";
	} else {
		$messenger['success'] = "Query Send Successfuly";
	}

	return $messenger;
	}


}


?>