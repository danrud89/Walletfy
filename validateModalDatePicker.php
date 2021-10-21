<?php
session_start();

if(!isset($_SESSION['logged_id']))
{
    header('Location: balance.php');
}

$start_date = $end_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveDates'])){

   if ($_POST['start_date'] == "" || $_POST['end_date'] == "") { 

   $_SESSION['date_err'] = 'Date fields cannot be empty !';
   header('Location: balance.php');
   exit();
}

else
{
    if($_POST['first_date'] > $_POST['second_date'])
    {
        $_SESSION['date_err'] = 'Cannot set second date as earlier !';
        header('Location: balance.php');
        exit();
    }
    else
    {
        $_SESSION['first_date'] = $_POST['first_date'];
        $_SESSION['second_date'] = $_POST['second_date'];
        header('Location: balance_custom.php');
    }
    
}
}
?>