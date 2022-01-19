<?php
session_start();
unset($_SESSION['logged_id']);
unset($_SESSION['logged_user']);
unset($_SESSION['loggedin']);
header('location: index.php');
?>
