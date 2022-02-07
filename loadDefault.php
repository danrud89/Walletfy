<?php
session_start();
$_SESSION['periodOfTimeSelected'] = false;
require_once 'database.php';
$firstDayOfThisMonth = date('Y-m-d', strtotime('first day of this month'));
$lastDayOfThisMonth  = date('Y-m-d', strtotime('last day of this month'));

$incomes_query_grouped = $db->prepare("SELECT SUM(incomes.amount) AS totalSumOfIncomesGrouped, inc.name 
FROM incomes, incomes_category_assigned_to_users AS inc 
WHERE incomes.income_category_assigned_to_user_id = inc.id 
AND incomes.user_id = '$userID' 
AND incomes.date_of_income BETWEEN '$firstDayOfThisMonth' AND '$lastDayOfThisMonth'
GROUP BY inc.name");
$incomes_query_grouped->execute();
$incomes = $incomes_query_grouped->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($incomes);

/* foreach ($incomes as $singleIncome) {
    echo '<tr>';
    echo '<td>' . $singleIncome['name'] . '</td>';
    echo '<td>' . $singleIncome['totalSumOfIncomesGrouped'] . '</td>';
    echo '</tr>';
} */

/* foreach ($incomes as $singleIncome) {
    echo '<tr class="table active">
     <td>' . $singleIncome['name'] . '</td>;
    <td>' . $singleIncome['totalSumOfIncomesGrouped'] . '</td>;
    </tr>';
} */

/* try {
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
*/
