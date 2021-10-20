<?php
session_start();
$amount = $date = $purpose = $options = "";
$amount_err = $date_err = $purpose_err = $options_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addIncome'])) {

    if(!isset($_POST['amount'])){
    $_SESSION['amount_err'] = 'Amount field cannot be empty !';
    }
    if(!isset($_POST['date'])){
    $_SESSION['date_err'] = 'Date field cannot be empty !';
    }
    if(!isset($_POST['category'])){
    $_SESSION['category_err'] = 'Select matching category !';
    }

    if(empty($amount_err) && empty($date_err) && empty($category_err)){
    $user_id = $_SESSION['id'];
    $amount = str_replace(',', '.', $_POST['amount']);
    $date = $_POST['date'];
    $category = $_POST['category'];
    $comment = $_POST['comment'];

        if ($amount <= 0) {
            $_SESSION['amount_err'] = 'Amount must be greater than 0 !';
            header('Location: menu.php');
            exit();
        }
        if(strlen($comment) > 50){
            $_SESSION['comment_err'] = 'Comment cannot contain more than 50 characters !';
            header('Location: menu.php');
            exit();
        }       
      
            $sql_select_category = "SELECT id FROM expenses_category_assigned_to_users 
            WHERE user_id = :user_id 
            AND name = :category";

            $query_select = $db->prepare($sql_select_category);
            $query_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_select->bindValue(':expense_category', $category, PDO::PARAM_STR);
            $query_select->execute();

            $result = $query_select->fetch();

            $sql_insert_expense = "INSERT INTO expenses VALUES(NULL, :id_user, :expense_category, :expense_amount, :expense_date, :expense_comment)"; 
            $query_expense = $db->prepare($sql_insert_expense);
            $query_expense->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_category', $category, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_amount', $amount, PDO::PARAM_STR);
            $query_expense->bindValue(':expense_date', $date, PDO::PARAM_STR);
            $query_expense->bindValue(':expense_comment', $comment, PDO::PARAM_STR);
            $query_expense->execute();

            $_SESSION['expenseAddedCorrectly'] = true;
            $db->close();     
}
}
?>