<?php
/*
* EcrossingLogin - PHP Login query creation .
* PHP Version 7
* @package Includes

/**
* EcrossingLogin - PHP Login query creation .
* @package Includes
* @author Amey Sarode (Amster) <ameysarode00@gmail.com>
*/
require_once dirname(__DIR__).'/includes/service/appvars.php';
require_once dirname(__DIR__).'/includes/service/class.ecrossingPDO.php';



class EcrossingLogin {

	public function handle_client_login($login_data) {
		// FETCH DATA
		$email = $login_data['email'];
		$password = $login_data['password'];
		$return = array();
		// CHECK THE LOGIN AND PROCEED
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":client_email",":password",":active");
		$condition_arr2 = array($email,$password,'1');
		$CheckActiveUser = new EcrossingPDO();
		$login_sql = "SELECT client_name,client_email,client_password FROM ecrossing_client WHERE client_email=:client_email AND client_password=:password AND client_activated=:active";
		$login_result=$CheckActiveUser->selectQuery($login_sql,$condition_arr1,$condition_arr2);
		if(is_array($login_result) && sizeof($login_result) == 1) {
			if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['ecrossing_client_email']) || isset($_SESSION['ecrossing_client_name'])) {
				$return['error'] = "Already Logged In.";
				return $return;
			} else {
				$_SESSION['ecrossing_client_name'] = $login_result[0]['client_name'];
		    $_SESSION['ecrossing_client_email'] = $login_result[0]['client_email'];
		    setcookie('ecrossing_client_email', $login_result[0]['client_email'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			setcookie('ecrossing_client_name', $login_result[0]['client_name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			}

			$return['success'] = "Success";
			//$return['error'] = $encrypted_password;
			return $return;
			unset($CheckActiveUser);

		} else {
			$return['error'] = "Email or Password is Incorrect.";
			//$return['error'] = $encrypted_password;
			return $return;
			unset($CheckActiveUser);
		}
	}

	public function handle_admin_login($login_data) {
		// FETCH DATA
		$email = $login_data['email'];
		$password = $login_data['password'];
		$return = array();
		// CHECK THE LOGIN AND PROCEED
		$condition_arr1="";
		$condition_arr2="";
		$condition_arr1 = array(":admin_email",":password",":active");
		$condition_arr2 = array($email,$password,'1');
		$CheckActiveUser = new EcrossingPDO();
		$login_sql = "SELECT admin_name,admin_email,admin_password FROM ecrossing_admin WHERE admin_email=:admin_email AND admin_password=:password AND admin_activated=:active";
		$login_result=$CheckActiveUser->selectQuery($login_sql,$condition_arr1,$condition_arr2);
		if(is_array($login_result) && sizeof($login_result) == 1) {
			if(!isset($_SESSION)) {
				session_start();
			}
			if(isset($_SESSION['ecrossing_admin_email']) || isset($_SESSION['ecrossing_admin_name'])) {
				$return['error'] = "Already Logged In.";
				return $return;
			} else {
				$_SESSION['ecrossing_admin_name'] = $login_result[0]['admin_name'];
		    $_SESSION['ecrossing_admin_email'] = $login_result[0]['admin_email'];
		    setcookie('ecrossing_admin_email', $login_result[0]['admin_email'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			setcookie('ecrossing_admin_name', $login_result[0]['admin_name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			}

			$return['success'] = "Success";
			//$return['error'] = $encrypted_password;
			return $return;
			unset($CheckActiveUser);

		} else {
			$return['error'] = "Email or Password is Incorrect.";
			//$return['error'] = $encrypted_password;
			return $return;
			unset($CheckActiveUser);
		}
	}



}

?>