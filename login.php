<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
require_once "db_functions.php";

//try to login the user
$user = login($_POST['username'], $_POST['password']);

if(is_array($user)){
	$_SESSION['user'] = $user;
	echo json_encode(["success" => true, "message" => "Authentication success", "url" => "welcome.php"]);
	return;
}

echo json_encode(["success" => false, "message" => $user]);