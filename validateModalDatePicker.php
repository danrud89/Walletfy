<?php
session_start();

if(!isset($_SESSION['logged_id']))
{
    header('Location: balance.php');
}

($_POST['start_date'] == '' || $_POST['end_date'] == '') ? 

   $_SESSION['e_balance_date'] = 'Nale¿y wybraæ obie daty!';
   header('Location: balance.php');
   exit();

else
{
    if($_POST['first_date'] > $_POST['second_date'])
    {
        $_SESSION['e_balance_date'] = 'Pierwsza data nie mo¿e byæ wiêksza ni¿ druga!';
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
?>