<?php 
session_start();

require_once('dblibs.php');

//Remembering the fields to repopulate them
$_SESSION['fname'] = htmlspecialchars($_POST['fname']);
$_SESSION['lname'] = htmlspecialchars($_POST['lname']);
$_SESSION['email'] = htmlspecialchars($_POST['email']);
$_SESSION['password'] = htmlspecialchars($_POST['password']);
$_SESSION['conpass'] = htmlspecialchars($_POST['conpass']);
$_SESSION['pnumber'] = htmlspecialchars($_POST['pnumber']);
$_SESSION['saddress'] = htmlspecialchars($_POST['saddress']);
$_SESSION['city'] = htmlspecialchars($_POST['city']);

//Start the error message off as false
$error = FALSE;

//Validation for first name	
	if(!empty($_POST['fname'])){
		if (ctype_alpha($_POST['fname']) === false){
			$_SESSION['fname.msg'] = " Error! You must enter only letters.";
			$error = TRUE;
		}else{
			unset($_SESSION['fname.msg']);
		}
	}else{
		$_SESSION['fname.msg'] = " Error! You must enter a first name.";
		$error = TRUE;
	}

//Validation for last name	
	if(!empty($_POST['lname'])){
		if (ctype_alpha($_POST['lname']) === false){
			$_SESSION['lname.msg'] = " Error! You must enter only letters.";
			$error = TRUE;
		}else{
			unset($_SESSION['lname.msg']);
		}
	}else{
		$_SESSION['lname.msg'] = " Error! You must enter a last name.";
		$error = TRUE;
	}
	
//Validation of the password
	if(!empty($_POST['password'])){	
		if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,20}$/', $_SESSION['password'])){
			$_SESSION['password.msg'] =  " Error! Password must be 8-20 characters long, must have one number, must have one letter!";
			$error = TRUE;
		}else{
			unset($_SESSION['password.msg']);
		}
	}else{
		$_SESSION['password.msg'] = " Error! You must enter a password.";
		$error = TRUE;
	}
	
//Validation if the passwords match together	
	if(!empty($_POST['conpass'])){	
		if(($_POST['password']) != $_POST['conpass']){
			$_SESSION['conpass.msg'] =  " Error! Passwords do not match";
			$error = TRUE;
		}else{
			unset($_SESSION['conpass.msg']);
		}
	}else{
		$_SESSION['conpass.msg'] = " Error! Please confirm password.";
		$error = TRUE;
	}
		
		
//Validation for the email address
	if(!empty($_POST['email'])){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			unset($_SESSION['email.msg']);
		}
		else{
			$_SESSION['email.msg'] = " Error! Email address is not valid. Example: john@exmaple.com";
			$error = TRUE;
		}
	}
	else{
		$_SESSION['email.msg'] = " Error! You must enter a email address.";
		$error = TRUE;
	}

//Validation for the phone number	
	if(!empty($_POST['pnumber'])){
		if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST['pnumber'])){
			unset($_SESSION['pnumber.msg']);
		}
		else{
			$_SESSION['pnumber.msg'] = " Error! Not a valid phone number. Example: 000-000-0000";
			$error = TRUE;
		}
	}
	else{
		$_SESSION['pnumber.msg'] = " Error! You must enter a phone number.";
		$error = TRUE;
	}
	
// Validation for the address

	if(!empty($_POST['saddress'])){
		if(preg_match("/^[0-9a-zA-Z [:punct:]]{1,50}$/", $_POST['saddress'])){
			unset($_SESSION['saddress.msg']);
		}else{
			$_SESSION['saddress.msg'] = " Error! Please enter a valid address.";
			$error = TRUE;
		}
	}else{
		$_SESSION['saddress.msg'] = " Error! Please enter an address.";
		$error = TRUE;
	}

//Validation for the city

	if(!empty($_POST['city'])){
	if(preg_match("/^[a-zA-Z -]+$/", $_POST['city'])){
			unset($_SESSION['city.msg']);
		}else{
			$_SESSION['city.msg'] = " Error! Please enter a valid city. Letters only.";
			$error = TRUE;
		}
	}else{
		$_SESSION['city.msg'] = " Error! Please enter a city.";
		$error = TRUE;
	}

	
	//If any of the errros occur the user will be redirected to the contactform page to 
	//fix the errors if there is no error the user will be redirected to the success
	//page which will show all the entire in a table
	if($error === TRUE){
		$_SESSION['error.msg'] = " Error!";
		header("Location: signupform.php");
	}else{
		unset($_SESSION['error.msg']);
		db_connect();
		db_add_new_user($_SESSION['email'], $_SESSION['password'], 
		$_SESSION['fname'], $_SESSION['lname'], $_SESSION['pnumber'], 
		$_SESSION['saddress'], $_SESSION['city'] 
		);
		header("Location: complete.php");
	}
?>