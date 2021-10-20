<?php
session_start();
$amount = $date = $category = "";
$amount_err = $date_err = $category_err = $comment_err = "";

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
      
            $sql_select_category = "SELECT id FROM incomes_category_assigned_to_users WHERE user_id = :user_id AND name = :category";
            $query_select = $db->prepare($sql_select_category);
            $query_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_select->bindValue(':income_category', $category, PDO::PARAM_STR);
            $query_select->execute();

            $result = $query_select->fetch();

            $income_category_number = $result[0];

            $sql_insert_income = "INSERT INTO incomes VALUES(NULL, :id_user, :income_category, :income_amount, :income_date, :income_comment)"; 
            $query_income = $db->prepare($sql_insert_income);
            $query_income->bindValue(':id_user', $user_id, PDO::PARAM_INT);
            $query_income->bindValue(':income_category', $category, PDO::PARAM_INT);
            $query_income->bindValue(':income_amount', $amount, PDO::PARAM_STR);
            $query_income->bindValue(':income_date', $date, PDO::PARAM_STR);
            $query_income->bindValue(':income_comment', $comment, PDO::PARAM_STR);
            $query_income->execute();

            $_SESSION['incomeAddedCorrectly'] = true;
            $db->close();     
}
}
?>