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
    switch ($periodOfTime) {
        case "currentMonth":
            $firstDayOfThisMonth = date('Y-m-d', strtotime('first day of this month'));
            $lastDayOfThisMonth  = date('Y-m-d', strtotime('last day of this month'));
           // $time = $date->format('Y-m');
           // $_SESSION['time'] = $time;
            try {
                $incomes_query_grouped = $db->prepare("SELECT SUM(incomes.amount) AS totalSumOfIncomesGrouped, inc.name 
                FROM incomes, incomes_category_assigned_to_users AS inc 
                WHERE incomes.income_category_assigned_to_user_id = inc.id 
                AND incomes.user_id = '$userID' 
                AND incomes.date_of_income BETWEEN '$firstDayOfThisMonth' AND '$lastDayOfThisMonth'
             GROUP BY inc.name" );
                $incomes_query_grouped->execute();
                $incomes = $incomes_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $incomes_query_in_details = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS inc
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income BETWEEN '$firstDayOfThisMonth' AND '$lastDayOfThisMonth'
                    ORDER BY incomes.date_of_income");
                $incomes_query_in_details->execute();
                $incomesDetails = $incomes_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            try {
                $expenses_query_grouped = $db->prepare("SELECT SUM(expenses.amount) AS totalSumOfExpensesGrouped, enc.purpose 
            FROM expenses, expenses_category_assigned_to_users AS enc
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$firstDayOfThisMonth' AND '$lastDayOfThisMonth'
            GROUP BY enc.purpose");
                $expenses_query_grouped->execute();
                $expenses = $expenses_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $expenses_query_in_details = $db->prepare("SELECT enc.purpose, expenses.amount, pnc.name, expenses.date_of_expense, expenses.expense_comment 
            FROM expenses, expenses_category_assigned_to_users AS enc, payment_methods_assigned_to_users AS pnc 
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.payment_method_assigned_to_user_id = pnc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$firstDayOfThisMonth' AND '$lastDayOfThisMonth'
            ORDER BY expenses.date_of_expense");
                $expenses_query_in_details->execute();
                $expensesDetails = $expenses_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            $_SESSION['incomesTable'] = $incomes;
            $_SESSION['incomesTableInDetail'] = $incomesDetails;
            $_SESSION['expensesTable'] = $expenses;
            $_SESSION['expensesTableInDetail'] = $expensesDetails;
            $_SESSION['startDate'] = date('d-m-Y', strtotime('first day of this month'));
            $_SESSION['endDate'] = date('d-m-Y', strtotime('last day of this month'));
            header('Location: balance.php');
            break;

            // user select -> previus month from select 
        case "previousMonth":
            $firstDayOfLastMonth = date('Y-m-d', strtotime('first day of last month'));
            $lastDayOfLastMonth  = date('Y-m-d', strtotime('last day of last month'));
            try {
                $incomes_query_grouped = $db->prepare("SELECT SUM(incomes.amount) AS totalSumOfIncomesGrouped, inc.name 
                FROM incomes, incomes_category_assigned_to_users AS inc 
                WHERE incomes.income_category_assigned_to_user_id = inc.id 
                AND incomes.user_id = '$userID' 
                AND incomes.date_of_income BETWEEN '$firstDayOfLastMonth' AND '$lastDayOfLastMonth'
             GROUP BY inc.name" );
                $incomes_query_grouped->execute();
                $incomes = $incomes_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $incomes_query_in_details = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS inc
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income BETWEEN '$firstDayOfLastMonth' AND '$lastDayOfLastMonth'
                    ORDER BY incomes.date_of_income");
                $incomes_query_in_details->execute();
                $incomesDetails = $incomes_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            try {
                $expenses_query_grouped = $db->prepare("SELECT SUM(expenses.amount) AS totalSumOfExpensesGrouped, enc.purpose 
            FROM expenses, expenses_category_assigned_to_users AS enc
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$firstDayOfLastMonth' AND '$lastDayOfLastMonth'
            GROUP BY enc.purpose");
                $expenses_query_grouped->execute();
                $expenses = $expenses_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $expenses_query_in_details = $db->prepare("SELECT enc.purpose, expenses.amount, pnc.name, expenses.date_of_expense, expenses.expense_comment 
            FROM expenses, expenses_category_assigned_to_users AS enc, payment_methods_assigned_to_users AS pnc 
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.payment_method_assigned_to_user_id = pnc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$firstDayOfLastMonth' AND '$lastDayOfLastMonth'
            ORDER BY expenses.date_of_expense");
                $expenses_query_in_details->execute();
                $expensesDetails = $expenses_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            $_SESSION['incomesTable'] = $incomes;
            $_SESSION['incomesTableInDetail'] = $incomesDetails;
            $_SESSION['expensesTable'] = $expenses;
            $_SESSION['expensesTableInDetail'] = $expensesDetails;
            $_SESSION['startDate'] = date('d-m-Y', strtotime('first day of last month'));
            $_SESSION['endDate'] = date('d-m-Y', strtotime('last day of last month'));
            header('Location: balance.php');
            break;

            // user select -> current year from select 
        case "currentYear":
            $firstDayOfCurrentYear = date('Y-01-01');
            $currentDay = date('Y-m-d');
            try {
                $incomes_query_grouped = $db->prepare("SELECT SUM(incomes.amount) AS totalSumOfIncomesGrouped, inc.name 
                FROM incomes, incomes_category_assigned_to_users AS inc 
                WHERE incomes.income_category_assigned_to_user_id = inc.id 
                AND incomes.user_id = '$userID' 
                AND incomes.date_of_income BETWEEN '$firstDayOfCurrentYear' AND '$currentDay'
             GROUP BY inc.name" );
                $incomes_query_grouped->execute();
                $incomes = $incomes_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $incomes_query_in_details = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS inc
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income BETWEEN '$firstDayOfCurrentYear' AND '$currentDay'
                    ORDER BY incomes.date_of_income");
                $incomes_query_in_details->execute();
                $incomesDetails = $incomes_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            try {
                $expenses_query_grouped = $db->prepare("SELECT SUM(expenses.amount) AS totalSumOfExpensesGrouped, enc.purpose 
            FROM expenses, expenses_category_assigned_to_users AS enc
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$firstDayOfCurrentYear' AND '$currentDay'
            GROUP BY enc.purpose");
                $expenses_query_grouped->execute();
                $expenses = $expenses_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $expenses_query_in_details = $db->prepare("SELECT enc.purpose, expenses.amount, pnc.name, expenses.date_of_expense, expenses.expense_comment 
            FROM expenses, expenses_category_assigned_to_users AS enc, payment_methods_assigned_to_users AS pnc 
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.payment_method_assigned_to_user_id = pnc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$firstDayOfCurrentYear' AND '$currentDay'
            ORDER BY expenses.date_of_expense");
                $expenses_query_in_details->execute();
                $expensesDetails = $expenses_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            $_SESSION['incomesTable'] = $incomes;
            $_SESSION['incomesTableInDetail'] = $incomesDetails;
            $_SESSION['expensesTable'] = $expenses;
            $_SESSION['expensesTableInDetail'] = $expensesDetails;
            $_SESSION['startDate'] = date('01-01-Y');
            header('Location: balance.php');
            break;

            // user select -> custom period from select 
        case 'customPeriod':
            if (trim($_POST['startDate']) === "" || trim($_POST['endDate']) === "") {
                $_SESSION['dateStatus'] = 'Fields cannot be empty !';
                $_SESSION['dateStatusCode'] = 'error';
                header('Location: balance.php');
                exit();
            }
            if ($_POST['startDate'] > $_POST['endDate']) {
                $_SESSION['dateStatus'] = 'Cannot set end date as earlier !';
                $_SESSION['dateStatusCode'] = 'error';
                header('Location: balance.php');
                exit();
            }
            $startDate = filter_input(INPUT_POST, trim($_POST['startDate']));
            $startDate = date('Y-m-d', strtotime($_POST['startDate']));
            $endDate = filter_input(INPUT_POST, trim($_POST['endDate']));
            $endDate = date('Y-m-d', strtotime($_POST['endDate']));

            try {
                $incomes_query_grouped = $db->prepare("SELECT SUM(incomes.amount) AS totalSumOfIncomesGrouped, inc.name 
                FROM incomes, incomes_category_assigned_to_users AS inc 
                WHERE incomes.income_category_assigned_to_user_id = inc.id 
                AND incomes.user_id = '$userID' 
                AND incomes.date_of_income BETWEEN '$startDate' AND '$endDate'
             GROUP BY inc.name" );
                $incomes_query_grouped->execute();
                $incomes = $incomes_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $incomes_query_in_details = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income,
                    incomes.income_comment
                    FROM incomes, incomes_category_assigned_to_users AS inc
                    WHERE incomes.income_category_assigned_to_user_id = inc.id
                    AND incomes.user_id = '$userID'
                    AND incomes.date_of_income BETWEEN '$startDate' AND '$endDate'
                    ORDER BY incomes.date_of_income");
                $incomes_query_in_details->execute();
                $incomesDetails = $incomes_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            try {
                $expenses_query_grouped = $db->prepare("SELECT SUM(expenses.amount) AS totalSumOfExpensesGrouped, enc.purpose 
            FROM expenses, expenses_category_assigned_to_users AS enc
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$startDate' AND '$endDate'
            GROUP BY enc.purpose");
                $expenses_query_grouped->execute();
                $expenses = $expenses_query_grouped->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }
            try {
                $expenses_query_in_details = $db->prepare("SELECT enc.purpose, expenses.amount, pnc.name, expenses.date_of_expense, expenses.expense_comment 
            FROM expenses, expenses_category_assigned_to_users AS enc, payment_methods_assigned_to_users AS pnc 
            WHERE expenses.expense_category_assigned_to_user_id = enc.id 
            AND expenses.payment_method_assigned_to_user_id = pnc.id 
            AND expenses.user_id = '$userID' 
            AND expenses.date_of_expense BETWEEN '$startDate' AND '$endDate'
            ORDER BY expenses.date_of_expense");
                $expenses_query_in_details->execute();
                $expensesDetails = $expenses_query_in_details->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "DataBase Error: Register failed.<br>" . $e->getMessage();
            } catch (Exception $error) {
                echo "Application Error: Register failed.<br>" . $error->getMessage();
            }

            $_SESSION['incomesTable'] = $incomes;
            $_SESSION['incomesTableInDetail'] = $incomesDetails;
            $_SESSION['expensesTable'] = $expenses;
            $_SESSION['expensesTableInDetail'] = $expensesDetails;
            $_SESSION['startDate'] =  date('d-m-Y', strtotime($startDate));
            $_SESSION['endDate'] =date('d-m-Y', strtotime($endDate));
            header('Location: balance.php');
            break;
    }

    $_SESSION['totalSumOfIncomes'] = 0;
    $_SESSION['totalSumOfExpenses'] = 0;
    $_SESSION['balance'] = 0;
    foreach ($incomesDetails as $singleIncome) {
        $_SESSION['totalSumOfIncomes'] += $singleIncome['amount'];
    }
    foreach ($expensesDetails as $singleExpense) {
        $_SESSION['totalSumOfExpenses'] += $singleExpense['amount'];
    }
    $_SESSION['balance'] = round($_SESSION['totalSumOfIncomes'] - $_SESSION['totalSumOfExpenses'], 2);
} 
else {
    $_SESSION['serwerStatus'] = "WRONG SERVER METHOD";
    $_SESSION['serwerStatusCode'] = "error";
    header('Location: balance.php');
    exit();
}
