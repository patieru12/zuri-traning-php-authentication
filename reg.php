<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
require_once "db_functions.php";

$registered = register($_POST['name'], $_POST['username'], $_POST['password']);

if(true === $registered){
	$user = login($_POST['username'], $_POST['password']);
	if(is_array($user)){
		$_SESSION['user'] = $user;
		echo json_encode(["success" => true, "message" => "New User registration accepted!", "url" => "welcome.php"]);
		return;
	}
}
echo json_encode(["success" => false, "message" => $registered]);