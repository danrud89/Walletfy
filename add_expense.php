<?php
session_start();
$expenseAmount = $expenseDate = $expensePurpose = $expensePaymentMethod = "";
$expenseComment = "";

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
    if(!isset($_POST['paymentMethod'])){
    $_SESSION['payment_err'] = 'Select matching category !';
    }

    $user_id = $_SESSION['logged_id'];
    $expenseAmount = filter_input(INPUT_POST, 'amount'); 
    $expenseDate = filter_input(INPUT_POST, 'date');
    $expensePurpose = filter_input(INPUT_POST, 'purpose');
    $expensePaymentMethod = filter_input(INPUT_POST, 'paymentMethod');
    
    if (!is_string($_POST['comment'])) {
        $_SESSION['comment_err'] = 'Invalid comment format !';
    } else {
        $expenseComment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        if (strlen($expenseComment) > 50) {
            $_SESSION['comment_err'] = 'Comment cannot contain more than 50 characters !';
        }
    }       
      require_once 'database.php'; 
      try{
            $sql_select_category = "SELECT id FROM expenses_category_assigned_to_users 
            WHERE user_id = :user_id  AND purpose = :expense_purpose";
        
            $query_select_category = $db->prepare($sql_select_category);
            $query_select_category->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_select_category->bindValue(':expense_purpose', $expensePurpose, PDO::PARAM_STR);
            $query_select_category->execute();

            $result = $query_select_category->fetch();
            $expensePurposeId = $result['id'];
        }
        catch (PDOException $e) {
            echo "DataBase Error: Request failed.<br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "Application Error: Request failed.<br>" . $error->getMessage();
        }

        try{
            $sql_select_payment = "SELECT id FROM payment_methods_assigned_to_users 
            WHERE user_id = :user_id AND name = :payment_method";
        
            $query_select_payment = $db->prepare($sql_select_payment);
            $query_select_payment->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_select_payment->bindValue(':payment_method', $expensePaymentMethod, PDO::PARAM_STR);
            $query_select_payment->execute();

            $query_result = $query_select_payment->fetch();
            $expensePaymentId = $query_result['id'];
        }
        catch (PDOException $e) {
            echo "DataBase Error: Request failed.<br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "Application Error: Request failed.<br>" . $error->getMessage();
        }
        
        try{
            $sql_insert_expense = "INSERT INTO expenses VALUES(NULL, :user_id, :expense_purpose, :expense_payment_method, :expense_amount, :expense_date, :expense_comment)"; 
            $query_expense = $db->prepare($sql_insert_expense);
            $query_expense->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_purpose', $expensePurposeId, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_payment_method',$expensePaymentId, PDO::PARAM_INT);
            $query_expense->bindValue(':expense_amount', $expenseAmount, PDO::PARAM_STR);
            $query_expense->bindValue(':expense_date', $expenseDate, PDO::PARAM_STR);
            $query_expense->bindValue(':expense_comment', $expenseComment, PDO::PARAM_STR);
            $query_expense->execute();
        }
        catch (PDOException $e) {
            echo "DataBase Error: Request failed.<br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "Application Error: Request failed.<br>" . $error->getMessage();
        }
      if($query_result){
      $_SESSION['expenseStatus'] = "Expense has been saved !";
      $_SESSION['expenseStatusCode'] = "success!";
      header('location: menu.php');
      }
      else{
        $_SESSION['expenseStatus'] = "Something went wrong ! Expense has not been saved !";
        $_SESSION['expenseStatusCode'] = "error!";
        header('location: menu.php');
      }
}
else{
    $_SESSION['expenseStatus'] = "Something went wrong ! Expense has not been saved !";
    $_SESSION['expenseStatusCode'] = "error!";
    header('location: menu.php');
}
?>