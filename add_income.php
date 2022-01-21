<?php
session_start();
$incomeAmount = $incomeDate = $incomeCategory = "";
$incomeComment = "";

function validateDate($testDate)
{
    $dateValid = false;
    $dateArray = explode('.', $testDate);
    if (count($dateArray) == 3) {
        if (checkdate($dateArray[2], $dateArray[1], $dateArray[0])) {
            $dateValid = true;
            return $dateValid;
        }
        return $dateValid;
    }
    return $dateValid;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addIncome'])) {

    
    if (!isset($_POST['amount'])) {
        $_SESSION['amount_err'] = 'Amount field cannot be empty !';
    }
    if (!isset($_POST['date'])) {
        $_SESSION['date_err'] = 'Date field cannot be empty !';
    }
    if (!isset($_POST['category'])) {
        $_SESSION['category_err'] = 'Select matching category !';
    }

    $user_id = $_SESSION['logged_id'];
    $incomeAmount = filter_input(INPUT_POST, 'amount');
    $incomeDate = filter_input(INPUT_POST, 'date');
    $incomeCategory = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    if (!is_string($_POST['comment'])) {
        $_SESSION['comment_err'] = 'Invalid comment format !';
    } else {
        $incomeComment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        if (strlen($incomeComment) > 50) {
            $_SESSION['comment_err'] = 'Comment cannot contain more than 50 characters !';
        }
    }

    require_once 'database.php';
    try {
        $sql_select_income_category_id = "SELECT id FROM incomes_category_assigned_to_users WHERE user_id = :user_id AND name = :income_category";
        $query_select = $db->prepare($sql_select_income_category_id);
        $query_select->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $query_select->bindValue(':income_category', $incomeCategory, PDO::PARAM_STR);
        $query_select->execute();

        $result = $query_select->fetch();
        $incomeId = $result['id'];
    } catch (PDOException $e) {
        echo "DataBase Error: Request failed.<br>" . $e->getMessage();
    } catch (Exception $e) {
        echo "Application Error: Request failed.<br>" . $error->getMessage();
    }

    try {
        $sql_insert_income = "INSERT INTO incomes VALUES(NULL, :id_user, :income_category, :income_amount, :income_date, :income_comment)";
        $query_income = $db->prepare($sql_insert_income);
        $query_income->bindValue(':id_user', $user_id, PDO::PARAM_INT);
        $query_income->bindValue(':income_category', $incomeId, PDO::PARAM_INT);
        $query_income->bindValue(':income_amount', $incomeAmount, PDO::PARAM_STR);
        $query_income->bindValue(':income_date', $incomeDate, PDO::PARAM_STR);
        $query_income->bindValue(':income_comment', $incomeComment, PDO::PARAM_STR);
        $query_income->execute();
    } catch (PDOException $e) {
        echo "DataBase Error: Request failed.<br>" . $e->getMessage();
    } catch (Exception $e) {
        echo "Application Error: Request failed.<br>" . $error->getMessage();
    }

    $_SESSION['incomeStatus'] = "Income has been saved !";
    $_SESSION['incomeStatusCode'] = "success!";
    header('location: menu.php');
} else {
    $_SESSION['incomeStatus'] = "Something went wrong ! Income has not been saved !";
    $_SESSION['incomeStatusCode'] = "error!";
    header('location: menu.php');
}
