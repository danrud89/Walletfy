<?php
session_start();

if (!isset($_SESSION['logged_id'])) {
    header('Location: balance.php');
}
if ($_SERVER["REQUEST_METHOD"] === "post") {
    $start_date = $end_date = "";
    $_SESSION['logged_id'] = $user['id'];

    if (trim($_POST['startDate']) === "" || trim($_POST['endDate']) === "") {
        $_SESSION['date_err'] = 'Fields cannot be empty !';
    } 
    else {
        $date = new DateTime();

        if ($_POST['startDate'] < $_POST['endDate']) {
            $_SESSION['date_err'] = 'Cannot set end date as earlier !';
        }
        if ($_POST['startDate'] == $_POST['endDate']) {
            $_SESSION['date_err'] = 'Cannot select the same day !';    
        }
        else {
            $_SESSION['startDate'] = $_POST['startDate'];
            $_SESSION['endDate'] = $_POST['endDate'];
            $start_date = filter_input(INPUT_POST, trim($_POST['startDate']));
            $start_date->format('Y-m-d');
            $end_date = filter_input(INPUT_POST, trim($_POST['endDate']));
            $end_date->format('Y-m-d');
            require_once 'database.php';

            if ($_POST['periodOfTime'] == "none") {
                $_SESSION['date_err'] = "Select from available periods of time !";
                header('Location: balance.php');
                exit();
            }
            if ($_POST['periodOfTime'] == "customPeriod") {
                try {
                    $incomes_query = $db->prepare("SELECT incomes.name, incomes.amount, incomes.date_of_income
                    FROM incomes_category_assigned_to_users AS inc, incomes
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income BETWEEN '$startDate' AND '$endDate'
                    GROUP BY income_category_assigned_to_user_id");
                    $incomes_query->execute();
                    $incomes = $incomes_query->fetchAll();
                } 
                catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } 
                catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }
                try {
                    $expenses_query = $db->prepare("SELECT expenses.name, expenses.amount, expenses.date_of_expense
                    FROM expenses_category_assigned_to_users AS exp, expenses
                    WHERE expenses.expense_category_assigned_to_user_id = exp.id
                    AND expenses.user_id = '$userID'
                    AND expenses.date_of_expense BETWEEN '$startDate' AND '$endDate'
                    GROUP BY expense_category_assigned_to_user_id");
                    $expenses_query->execute();
                    $expenses = $expenses_query->fetchAll();
                } catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }
                unset($_SESSION['date_err']);
            }
            else {
                
                if ($_POST['periodOfTime'] == "currentMonth") {
                    $time = $date->format('Y-m');
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
                    $time = $date->format('Y');
                }
                try {
                    $incomes_query = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income
                    FROM incomes_category_assigned_to_users AS inc, incomes
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income LIKE '$time%'");
                    $incomes_query->execute();
                    $incomes = $incomes_query->fetchAll();
                } 
                catch (PDOException $e) {
                    echo "DataBase Error: Register failed.<br>" . $e->getMessage();
                } 
                catch (Exception $error) {
                    echo "Application Error: Register failed.<br>" . $error->getMessage();
                }

                try {
                    $expenses_query = $db->prepare("SELECT exp.name, expenses.amount, expenses.date_of_expense
                    FROM expenses_category_assigned_to_users AS exp, expenses
                    WHERE expenses.expense_category_assigned_to_user_id = exp.id
                    AND expenses.user_id = '$userID'
                    AND expenses.date_of_expense LIKE '$time%'");
                    $expenses_query->execute();
                    $expenses = $expenses_query->fetchAll();
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