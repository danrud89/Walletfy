<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['erase_income'])) {
$_SESSION['amount'] = "";
$current_date = new DateTime();
$_SESSION['date'] = $current_date->format('Y-m-d');
$_SESSION['category'] = "";
$_SESSION['comment'] = "";
header('Location: menu.php');
}