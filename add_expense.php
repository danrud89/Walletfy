<?php
session_start();
$expenseAmount = $expenseDate = $expensePurpose = $expenseOptions = "";
$amount_err = $date_err = $purpose_err = $options_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addExpense'])) {

    if(!isset($_POST['amount'])){
    $_SESSION['amount_err'] = 'Amount field cannot be empty !';
    }
    if(!isset($_POST['date'])){
    $_SESSION['date_err'] = 'Date field cannot be empty !';
    }
    if(!isset($_POST['purpose'])){
    $_SESSION['purpose_err'] = 'Select matching category !';
    }
    if(!isset($_POST['options'])){
    $_SESSION['options_err'] = 'Select matching category !';
    }

    if(empty($amount_err) && empty($date_err) && empty($category_err)){
    $user_id = $_SESSION['logged_id'];
    $expenseAmount = str_replace(',', '.', $_POST['amount']);
    $expenseDate = $_POST['date'];
    $expensePurpose = $_POST['purpose'];
    $expenseOptions = $_POST['options'];
    $expenseComment = $_POST['comment'];

    if ($amount <= 0) {
        $_SESSION['amount_err'] = 'Amount must be greater than 0 !';    
    }
    if(strlen($comment) > 50){
        $_SESSION['comment_err'] = 'Comment cannot contain more than 50 characters !';
    }       
      
            $sql_select_category = "SELECT id FROM expenses_category_assigned_to_users 
            WHERE user_id = :user_id 
            AND name = :category";
        try{
            $query_select = $db->prepare($sql_select_category);
            $query_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_select->bindValue(':expense_category', $expenseOptions, PDO::PARAM_STR);
            $query_select->execute();

            $result = $query_select->fetch();
        }
        catch(Exception $e){
            echo $error->getMessage();
        }
        try{
            $sql_insert_expense = "INSERT INTO expenses VALUES(NULL, :id_user, :expense_category, :expense_amount, :expense_date, :expense_comment)"; 
            $query_expense = $db->prepare($sql_insert_expense);
            $query_expense->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_category', $expenseOptions, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_amount', $expenseAmount, PDO::PARAM_STR);
            $query_expense->bindValue(':expense_date', $expenseDate, PDO::PARAM_STR);
            $query_expense->bindValue(':expense_comment', $expenseComment, PDO::PARAM_STR);
            $query_expense->execute();
        }
       catch(Exception $error)
      {
        echo $error->getMessage();
      }
            $_SESSION['expenseAddedCorrectly'] = true;
            $db->close();     
}
}
?>