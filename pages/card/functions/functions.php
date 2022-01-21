<?php 
	include_once("/../db/dbconnect.php");
	/*
		User log-out definition
	*/
	function url($url){
		return "http://localhost/cardMIS".$url;
	}

	/*
		Check Login User Type & Authentication
		$_SESSION['admin_type']; // Admin Type
		$_SESSION['login_id'];   // Admin Login Id 
		$_SESSION['id'];         // Admin Id
	
		Admin authinticatioon 
	*/

	function userAdminAuth(){

		if($_SESSION['admin_type']=='true'){
			return $_SESSION['admin_type'];
		}else{
			return false;
		}

	}

	/*
		Every user role authintications 
	*/
	function userLogin(){

		if($_SESSION['login_id']){

			return $_SESSION['login_id'];

		}else{
			return false;
		}

		if($_SESSION['id']){

			return $_SESSION['id'];
		}else{
			return false;
		}
	}

	// remove parentheses from mobile number //
	function removeParentheses($data){
		$pattern = ('/\D+/');
		$replace = '';
		if(is_string($data)){
			$value =  preg_replace($pattern, $replace, $data);
		}
		return $value;
	}

	// remove minus sign //
	function removeMinusSign($val){
		if($val<0){
			$result = abs($val)." DR";
		}else{
			$result = $val." CR";
		}
		return $result;
	}


	// Mobile SMS Sending //
	function send_mobile_sms($message,$phone){

        /*$number   = '1867536941';
        $message  = 'Dear A/H your request for issuance of DEBIT CARD has accepted at (branch) - SBAC BANK LTD.';*/
        $message  = urlencode($message);
        $userName = "sbacsms";
        $password = "SbacMizan@321";
        $data     = 'Username='.$userName.'&Password='.$password.'&From=SBAC BANK&To=880'.$phone.'&Message='.$message; 
        //Api url which without any parameter init curl url //
        $curl = curl_init('https://api.mobireach.com.bd/SendTextMessage?'); 
        curl_setopt($curl, CURLOPT_POST, 1); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //Set parameter to url 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($curl);
        $load   = simplexml_load_string($result);
        // variable with outpur example //
        $messageId = $load->ServiceClass->MessageId; // 1547974865488091
        $Status = $load->ServiceClass->Status; //0
        $StatusText = $load->ServiceClass->StatusText; // success
        $ErrorCode = $load->ServiceClass->ErrorCode; // 0
        $SMSCount = $load->ServiceClass->SMSCount;// 1
        $CurrentCredit = $load->ServiceClass->CurrentCredit; // 35046.78
        curl_close ($curl); // close curl //

	}


?>

