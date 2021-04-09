<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
require_once "db_functions.php";

$resetted = reset_mypwd($_POST['username'], $_POST['password']);
// var_dump($resetted);
if(true === $resetted){
	echo json_encode(["success" => true, "message" => "Password Successfuly resetted", "url" => ""]);
	return;
}

echo json_encode(["success" => false, "message" => "Password not resetted: ".$resetted]);