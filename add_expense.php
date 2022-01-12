<?php
session_start();
$expenseAmount = $expenseDate = $expensePurpose = $expenseOptions = "";

function filterInputs($inputData){
    $outputData = filter_input(INPUT_POST, '$inputData');
    return $outputData;
}
 
function validateDate($testDate)
{   $dateValid = false;
    $dateArray = explode('.', $testDate);
    if (count($dateArray) == 3) {
        if (checkdate($dateArray[0], $dateArray[1], $dateArray[2])) {
            $dateValid = true;
            return $dateValid;
        }
        return $dateValid;
    }
    return $dateValid;
}

function checkDataSet($inputData){
    $dataIsSet = false;
    if(isset($inputData)) {
        $dataIsSet = true;
        return $dataIsSet;
    }
    return $dataIsSet;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addExpense'])) {

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

     $user_id = $_SESSION['logged_id'];
    
    if(!is_numeric($_POST['amount'])){
        $_SESSION['amount_err'] = 'Invalid amount format !';
    }
    if(is_float($_POST['amount'])){ 
    $expenseAmount = filterInputs($_POST['amount']);   
    $expenseAmount = str_replace(',', '.', $_POST['amount']);
    }
    else {
        $_SESSION['amount_err'] = 'Invalid amount format !';  
    }
    if ($expenseAmount <= 0) {
        $_SESSION['amount_err'] = 'Amount must be greater than 0 !';    
    }

    if(validateDate($_POST['date'])){
    $expenseDate = filterInputs($_POST['date']);
    }
    else {
        $_SESSION['date_err'] = 'Invalid date format !';
    }
    $expensePurpose = filterInputs($_POST['purpose']);
    $expenseOptions = filterInputs($_POST['options']);
    if(is_string($_POST['comment'])){
    $expenseComment = filterInputs($_POST['comment']);
    }
    else{
        $_SESSION['comment_err'] = 'Invalid commentary format !';
    }
    if(strlen($comment) > 50){
        $_SESSION['comment_err'] = 'Comment cannot contain more than 50 characters !';
    }       
      require_once 'database.php'; 
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
      
      $_SESSION['expenseStatus'] = "Expense has been saved !";
      $_SESSION['expenseStatusCode'] = "success!";
}
else{
    $_SESSION['expenseStatus'] = "Something went wrong ! Expense has not been saved !";
    $_SESSION['expenseStatusCode'] = "error!";
}
?>