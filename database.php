<?php

$config = require_once 'config.php';
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);

try {
	
	$db = new PDO("mysql:host={$config['host']};dbname={$config['database']};charset=utf8",$config['user'], 
	$config['password'], $pdoOptions);

} catch (PDOException $error) {
	echo $error->getMessage();
	exit('Internal server error ! Please try again later.');
}

?>