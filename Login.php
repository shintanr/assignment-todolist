<?php
//start session
session_start();
 
include_once('UserLogin.php');
 
$user = new User();
 
if(isset($_POST['login'])){
	$username = $user->escape_string($_POST['username']);
	$password = $user->escape_string($_POST['password']);
 
	$auth = $user->check_login($username, $password);
 
	if(!$auth){
		$_SESSION['message'] = 'Invalid username or password';
    	header('location:indexLogin.php');
	}
	else{
		$_SESSION['user'] = $auth;
		header('location:AssignmentTodo.php');
	}
}
else{
	$_SESSION['message'] = 'You need to login first';
	header('location:indexLogin.php');
}
?>