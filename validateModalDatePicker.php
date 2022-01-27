<?php
session_start();

if ((isset($_POST['periodOfTime'])) && $_SERVER["REQUEST_METHOD"] === "POST") {
    $start_date = $end_date = "";
    $userID = $_SESSION['logged_id'];
    $_SESSION['periodOfTimeSelected'] = true;

    $periodOfTime = isset($_POST['periodOfTime']) ? $_POST['periodOfTime'] : 'null';
    $_SESSION['periodOfTime'] = $periodOfTime;

    $date = new DateTime();
    require_once 'database.php';

    // user select -> current month from select 
    if ($periodOfTime === "currentMonth") {
        $time = $date->format('Y-m');
        $_SESSION['time'] = $time;
        try {
            $incomes_query = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS inc
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income LIKE '$time%' ");
            $incomes_query->execute();
            $incomes = $incomes_query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
            echo "Application Error: Register failed.<br>" . $error->getMessage();
        }

        try {
            $expenses_query = $db->prepare("SELECT enc.purpose, expenses.amount, pnc.name, expenses.date_of_expense, expenses.expense_comment 
            FROM expenses, expenses_category_assigned_to_users AS enc, payment_methods_assigned_to_users AS pnc 
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.payment_method_assigned_to_user_id = pnc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense LIKE '$time%'");
            $expenses_query->execute();
            $expenses = $expenses_query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
            echo "Application Error: Register failed.<br>" . $error->getMessage();
        }
        $_SESSION['incomesTable'] = $incomes;
        $_SESSION['expensesTable'] = $expenses;
    }

    // user select -> previus month from select 
    else if ($periodOfTime === "previousMonth") {
        $currentYear = $date->format('Y');
        $previousMonth = $date->format('m') - 1;
        if ($previousMonth < 1) {
            $previousMonth = 12;
            $year -=  1;
        }
        if ($month < 10) {
            $time = $year . "-0" . $month;
        } else {
            $time = $year . "-" . $month;
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
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
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
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
            echo "Application Error: Register failed.<br>" . $error->getMessage();
        }
    }

    // user select -> current year from select 
    else if ($periodOfTime ===  "currentYear") {
        $time = $date->format('Y-01-01');
        try {
            $incomes_query = $db->prepare("SELECT incomes_category_assigned_to_users.name, incomes.amount, incomes.date_of_income,
                            incomes.income_comment
                            FROM incomes, incomes_category_assigned_to_users AS incomes
                            WHERE incomes.income_category_assigned_to_user_id = incomes.id
                            AND incomes.user_id = '$userID'
                            AND incomes.date_of_income LIKE '$time%'");
            $incomes_query->execute();
            $incomes = $incomes_query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
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
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
            echo "Application Error: Register failed.<br>" . $error->getMessage();
        }
    }

    // user select -> custom period from select 
    else {
        if (trim($_POST['startDate']) === "" || trim($_POST['endDate']) === "") {
            $_SESSION['dateStatus'] = 'Fields cannot be empty !';
            $_SESSION['dateStatusCode'] = 'error';
            header('Location: balance.php');
        }
        if ($_POST['startDate'] > $_POST['endDate']) {
            $_SESSION['dateStatus'] = 'Cannot set end date as earlier !';
            $_SESSION['dateStatusCode'] = 'error';
            header('Location: balance.php');
        }
        $start_date = filter_input(INPUT_POST, trim($_POST['startDate']));
        $start_date = date('Y-m-d', strtotime($_POST['startDate']));
        $end_date = filter_input(INPUT_POST, trim($_POST['endDate']));
        $end_date = date('Y-m-d', strtotime($_POST['endDate']));

        $_SESSION['startDate'] = $start_date;
        $_SESSION['endDate'] = $end_date;

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
        } catch (PDOException $e) {
            echo "DataBase Error: Register failed.<br>" . $e->getMessage();
        } catch (Exception $error) {
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
    }

    
    
    header('Location: balance.php');
} else {
    $_SESSION['serwerStatus'] = "WRONG SERVER METHOD";
    $_SESSION['serwerStatusCode'] = "error";
    header('Location: balance.php');
    exit();
}
