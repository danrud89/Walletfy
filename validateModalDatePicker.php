<?php
session_start();

if (!isset($_SESSION['logged_id'])) {
    header('Location: balance.php');
}
if ($_SERVER["REQUEST_METHOD"] === "post") {
    $start_date = $end_date = "";
    $_SESSION['logged_id'] = $userID;

    if (trim($_POST['startDate']) === "" || trim($_POST['endDate']) === "") {
        $_SESSION['date_err'] = 'Fields cannot be empty !';
    } 
    else {
        $date = new DateTime();

        if ($_POST['startDate'] > $_POST['endDate']) {
            $_SESSION['date_err'] = 'Cannot set end date as earlier !';
        }
        else {
            $_SESSION['startDate'] = $_POST['startDate'];
            $_SESSION['endDate'] = $_POST['endDate'];
            $start_date = filter_input(INPUT_POST, trim($_POST['startDate']));
            $start_date->format('Y-m-d');
            $end_date = filter_input(INPUT_POST, trim($_POST['endDate']));
            $end_date->format('Y-m-d');
            require_once 'database.php';

            if (($_POST['periodOfTime'] == NULL) || ($_POST['periodOfTime'] == "")) {
                $_SESSION['date_err'] = "Select from available periods of time !";
                header('Location: balance.php');
                exit();
            }
            if ($_POST['periodOfTime'] == "customPeriod") {
                try {
                    $incomes_query = $db->prepare("SELECT incomes_category_assigned_to_users.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS incomes
                    WHERE incomes.income_category_assigned_to_user_id = incomes.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income BETWEEN '$startDate' AND '$endDate'
                    GROUP BY income_category_assigned_to_user_id");
                    $incomes_query->execute();
                    $incomes = $incomes_query->fetchAll(PDO::FETCH_ASSOC);
                } 
                catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } 
                catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }
                try {
                    $expenses_query = $db->prepare("SELECT expenses_category_assigned_to_users.name, 
                    expenses.amount, payment_methods_assigned_to_users.name, expenses.date_of_expense, 
                    expenses.expense_comment
                    FROM expenses, expenses_category_assigned_to_users, payment_methods_assigned_to_users AS expenses
                    WHERE expenses.expense_category_assigned_to_user_id = expenses.id
                    AND expenses.payment_methods_assigned_to_user_id = payment_methods_assigned_to_users.id
                    AND expenses.user_id = '$userID'
                    AND expenses.date_of_expense BETWEEN '$startDate' AND '$endDate'
                    GROUP BY expense_category_assigned_to_user_id");
                    $expenses_query->execute();
                    $expenses = $expenses_query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }
                unset($_SESSION['date_err']);
            }
            else {
                
                if ($_POST['periodOfTime'] == "currentMonth") {
                    $time = $date->format('Y-m-01');
                }
                if ($_POST['periodOfTime'] == "previousMonth") {
                    $currentYear = $date->format('Y');
                    $previousMonth = $date->format('m') - 1;
                    if ($previousMonth < 1) {
                        $month = 12;
                        $year = $year - 1;
                    }
                    if ($month < 10) {
                        $time = $year . "-0" . $month;
                    } 
                    else {
                        $time = $year . "-" . $month;
                    }
                }
                if ($_POST['periodOfTime'] == "currentYear") {
                    $time = $date->format('Y-01-01');
                }
                try {
                    $incomes_query = $db->prepare("SELECT incomes_category_assigned_to_users.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS incomes
                    WHERE incomes.income_category_assigned_to_user_id = incomes.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income LIKE '$time%'");
                    $incomes_query->execute();
                    $incomes = $incomes_query->fetchAll(PDO::FETCH_ASSOC);
                } 
                catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } 
                catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }

                try {
                    $expenses_query = $db->prepare("SELECT expenses_category_assigned_to_users.name, 
                    expenses.amount, payment_methods_assigned_to_users.name, expenses.date_of_expense, 
                    expenses.expense_comment
                    FROM expenses, expenses_category_assigned_to_users, payment_methods_assigned_to_users AS expenses
                    WHERE expenses.expense_category_assigned_to_user_id = expenses.id
                    AND expenses.payment_methods_assigned_to_user_id = payment_methods_assigned_to_users.id
                    AND expenses.user_id = '$userID'
                    AND expenses.date_of_expense LIKE '$time%'");
                    $expenses_query->execute();
                    $expenses = $expenses_query->fetchAll(PDO::FETCH_ASSOC);
                    unset($_SESSION['date_err']);
                } 
                catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } 
                catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }
            
                $_SESSION['incomesTable'] = $incomes;
                $_SESSION['expensesTable'] = $expenses;
                header('Location: balance.php');
        }
    }
}
}
?>