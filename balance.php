<?php
session_start();
require_once 'database.php';
if (!isset($_SESSION['logged_id'])) {
    header('Location: index.php');
    exit();
}
$firstDayOfThisMonth = date('d-m-Y', strtotime('first day of this month'));
$lastDayOfThisMonth  = date('d-m-Y', strtotime('last day of this month'));

if (isset($_SESSION['periodOfTimeSelected'])) {
    $incomes = $_SESSION['incomesTable'];
    $incomesDetails = $_SESSION['incomesTableInDetail'];
    $expenses = $_SESSION['expensesTable'];
    $expensesDetails = $_SESSION['expensesTableInDetail'];
} else {
    $firstDayOfCurrentMonth = date('Y-m-d', strtotime('first day of this month'));
    $lastDayOfCurrentMonth  = date('Y-m-d', strtotime('last day of this month'));
    $userID = $_SESSION['logged_id'];
    $incomes_query_grouped = $db->prepare("SELECT SUM(incomes.amount) AS totalSumOfIncomesGrouped, inc.name 
    FROM incomes, incomes_category_assigned_to_users AS inc 
    WHERE incomes.income_category_assigned_to_user_id = inc.id 
    AND incomes.user_id = '$userID' 
    AND incomes.date_of_income BETWEEN '$firstDayOfCurrentMonth' AND '$lastDayOfCurrentMonth'
    GROUP BY inc.name");
    $incomes_query_grouped->execute();
    $incomes = $incomes_query_grouped->fetchAll(PDO::FETCH_ASSOC);

    $incomes_query_in_details = $db->prepare("SELECT inc.name, incomes.amount, incomes.date_of_income,
    incomes.income_comment
    FROM incomes, incomes_category_assigned_to_users AS inc
    WHERE incomes.income_category_assigned_to_user_id = inc.id
    AND incomes.user_id = '$userID'
    AND incomes.date_of_income BETWEEN '$firstDayOfCurrentMonth' AND '$lastDayOfCurrentMonth'
    ORDER BY incomes.date_of_income");
    $incomes_query_in_details->execute();
    $incomesDetails = $incomes_query_in_details->fetchAll(PDO::FETCH_ASSOC);

    $expenses_query_grouped = $db->prepare("SELECT SUM(expenses.amount) AS totalSumOfExpensesGrouped, enc.purpose 
                FROM expenses, expenses_category_assigned_to_users AS enc
                WHERE expenses.expense_category_assigned_to_user_id = enc.id 
                AND expenses.user_id = '$userID' 
                AND expenses.date_of_expense BETWEEN '$firstDayOfCurrentMonth' AND '$lastDayOfCurrentMonth'
                GROUP BY enc.purpose");
    $expenses_query_grouped->execute();
    $expenses = $expenses_query_grouped->fetchAll(PDO::FETCH_ASSOC);

    $expenses_query_in_details = $db->prepare("SELECT enc.purpose, expenses.amount, pnc.name, expenses.date_of_expense, expenses.expense_comment 
                    FROM expenses, expenses_category_assigned_to_users AS enc, payment_methods_assigned_to_users AS pnc 
                    WHERE expenses.expense_category_assigned_to_user_id = enc.id 
                    AND expenses.payment_method_assigned_to_user_id = pnc.id 
                    AND expenses.user_id = '$userID' 
                    AND expenses.date_of_expense BETWEEN '$firstDayOfCurrentMonth' AND '$lastDayOfCurrentMonth'
                    ORDER BY expenses.date_of_expense");
    $expenses_query_in_details->execute();
    $expensesDetails = $expenses_query_in_details->fetchAll(PDO::FETCH_ASSOC);

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />

    <link href="https://fonts.googleapis.com/css?family=Inconsolata|Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script type="text/javascript" src="script.js"></script>
    <link rel="icon" href="img/favicon.png">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/data.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <header id="top">
        <h3>Wall€tfy!</h3>
        <h4 class="loggedAs mr-5 text-left mt-3 align-middle">USER: <?php echo $_SESSION['logged_user'] ?>
        </h4>
        <nav>
            <ul>
                <li><a href="menu.php" title="Home"><span class="material-icons mx-2 align-middle">home</span>Home</a></li>
                <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">savings</span><a class="text-muted" href="#" data-toggle="modal" data-target="#addIncome">Income</a></li>
                <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">shopping_cart</span><a class="text-muted" href="#" class="openModal" data-toggle="modal" data-target="#addExpense" title="Expense">Expense</a></li>
                <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">insert_chart_outlined</span><a class="text-muted" href="balance.php" title="Balance">Balance</a></li>
                <li><a href="settings.php" title="Settings"><span class="material-icons mx-2 align-middle">manage_accounts</span>Settings</a></li>
                <li><a href="logout.php" title="Log Out"><span class="material-icons mx-2 align-middle">logout</span>Exit</a></li>
            </ul>
        </nav>
    </header>


    <section id="balance" style="background-image: url(img/pap1.jpg);">
        <div class="wrapper mt-5">
            <div class="row mt-5">
                <div class="mx-auto my-auto">
                    <h2 class="text-center py-1" id="intro">BALANCE SHEET</h2>
                </div>
            </div>

            <div class="mb-3 mx-2 py-2 px-4">
                <form id="date-range-form" method="post" action="validateModalDatePicker.php">
                    <div class="row d-inline-flex justify-content-center w-100 mx-auto">
                        <button id="default" type="submit" name='periodOfTime' value="currentMonth" class="btn mr-5">
                            <div class="buttonBalance">
                                <div class="icon mt-4">
                                    <span class="material-icons">event</span>
                                </div>
                            </div>
                            <p class="option">Current Month</p>
                        </button>
                        <button type="submit" name='periodOfTime' value="previousMonth" class="btn mr-5">
                            <div class="buttonBalance">
                                <div class="icon mt-4">
                                    <span class="material-icons">today</span>
                                </div>
                            </div>
                            <p class="option">Previous month</p>
                        </button>
                        <button type="submit" name='periodOfTime' value="currentYear" class="btn mr-5">
                            <div class="buttonBalance">
                                <div class="icon mt-4">
                                    <span class="material-icons">calendar_month</span>
                                </div>
                            </div>
                            <p class="option">Current Year</p>
                        </button>
                        <button type="submit" class="btn"><a href="#" class="open-modal" data-target="#dateModal" data-toggle="modal">
                                <div class="buttonBalance">
                                    <div class="icon mt-4">
                                        <span class="material-icons">date_range</span>
                                    </div>
                                </div>
                                <p class="option">Custom</p>
                            </a>
                        </button>
                    </div>
                </form>
            </div>

            <div class='row mb-3'>
                <div class='col-12 text-center mt-3'>
                    <h3 class='balanceDates'>FINANCIAL BALANCE FROM: <?php echo ((isset($_SESSION['startDate']) && $_SESSION['startDate'] != '') ? $_SESSION['startDate'] : $firstDayOfThisMonth);
                                                                        unset($_SESSION['startDate']); ?> TO <?php echo ((isset($_SESSION['endDate']) && $_SESSION['endDate'] != '') ? $_SESSION['endDate'] : $lastDayOfThisMonth);
                                                                                                                unset($_SESSION['endDate']); ?> </h3>
                </div>
            </div>
            <p class="mt-5 mb-5 mx-auto" style="width:95%; border-bottom: 1px solid aliceblue;"></p>
            <div class="table mt-5">
                <div class="col">
                    <h3 class="text-center" style="color:aliceblue;">INCOMES</h3>
                    <table id="tableOfIncomes" class="table table-striped table-bordered table-hover table-active text-inherit table-sm table-responsive-sm">
                        <thead class="bg-dark border-secondary">
                            <tr>
                                <th onclick="sortTableAlphabetically('tableOfIncomes')" scope="col" class="text-center">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfIncomes')" scope="col" class="text-center">Value <span class="material-icons align-middle">import_export</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-secondary" id="balanceData">
                            <?php

                            foreach ($incomes as $singleIncome) {
                                echo '<tr>';
                                echo '<td>' . $singleIncome['name'] . '</td>';
                                echo '<td>' . $singleIncome['totalSumOfIncomesGrouped'] . '</td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col" id="incomesChart" class="mt-4 d-inline-flex" style="height:450px; margin: 0 auto"></div>
            </div>


            <div class="table-responsive-text mb-5 p-2">
                <h3 class="text-center" style="color:aliceblue">Details of Incomes</h3>
                <table id="tableOfIncomesInDetail" class="table table-striped table-bordered table-hover table-active text-inherit table-sm " style="table-layout: fixed; width: 100%">
                    <thead class="bg-dark border-secondary">
                        <tr>
                            <th onclick="sortTableAlphabetically('tableOfIncomesInDetail')" scope="col" class="text-center">Category <span class="material-icons align-middle">import_export</span></th>
                            <th onclick="sortTableNumerically('tableOfIncomesInDetail')" scope="col" class="text-center">Value <span class="material-icons align-middle">import_export</span></th>
                            <th scope="col" class="align-middle text-center" style="pointer-events: none;">Date</th>
                            <th scope="col" class="align-middle text-center" style="pointer-events: none;">Commentary</th>
                            <th style="display:none;" class="align-middle"> id</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-secondary" id="balanceDataDetails">
                        <?php

                        foreach ($incomesDetails as $singleIncomeInDetails) {
                            echo '<tr>';
                            echo '<td>' . $singleIncomeInDetails['name'] . '</td>';
                            echo '<td>' . $singleIncomeInDetails['amount'] . '</td>';
                            echo '<td>' . $singleIncomeInDetails['date_of_income'] . '</td>';
                            echo '<td>' . $singleIncomeInDetails['income_comment'] . '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <p class="mt-5 mb-5 mx-auto" style="width:95%; border-bottom: 1px solid aliceblue;"></p>
            <div class="table mt-5">
                <div class="col">
                    <h3 class="text-center" style="color:aliceblue">EXPENSES</h3>
                    <table id="tableOfExpenses" class="table table-striped table-bordered table-hover table-active text-inherit table-sm table-responsive-sm">
                        <thead class="bg-dark border-secondary">
                            <tr class="table-active">
                                <th onclick="sortTableAlphabetically('tableOfExpenses')" scope="col" class="text-center">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfExpenses')" scope="col" class="text-center">Value <span class="material-icons align-middle">import_export</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-secondary">
                            <?php

                            foreach ($expenses as $singleExpense) {
                                echo '<tr>';
                                echo '<td>' . $singleExpense['purpose'] . '</td>';
                                echo '<td>' . $singleExpense['totalSumOfExpensesGrouped'] . '</td>';
                                echo '</tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col" id="expensesChart" class="mt-4 d-inline-flex" style="height:450px; margin: 0 auto"></div>
            </div>


            <div class="table-responsive-text mb-5 p-2">
                <h3 class="text-center" style="color:aliceblue">Details of Expenses</h3>
                <table id="tableOfExpensesInDetail" class="table table-bordered table-hover table-active table-sm" style="table-layout: fixed; width: 100%">
                    <thead class="bg-dark border-secondary">
                        <tr>
                            <th onclick="sortTableAlphabetically('tableOfExpensesInDetail')" scope="col" class="text-center">Category <span class="material-icons align-middle">import_export</span></th>
                            <th onclick="sortTableNumerically('tableOfExpensesInDetail')" scope="col" class="text-center">Value <span class="material-icons align-middle">import_export</span></th>
                            <th scope="col" class="align-middle text-center" style="pointer-events: none;">Payment option</th>
                            <th scope="col" class="align-middle text-center" style="pointer-events: none;">Date</th>
                            <th scope="col" class="align-middle text-center" style="pointer-events: none;">Commentary</th>
                            <th style="display:none;" class="align-middle text-center"> id</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-secondary table-striped">
                        <?php
                        foreach ($expensesDetails as $singleExpenseInDetails) {
                            echo '<tr>';
                            echo '<td>' . $singleExpenseInDetails['purpose'] . '</td>';
                            echo '<td>' . $singleExpenseInDetails['amount'] . '</td>';
                            echo '<td>' . $singleExpenseInDetails['name'] . '</td>';
                            echo '<td>' . $singleExpenseInDetails['date_of_expense'] . '</td>';
                            echo '<td>' . $singleExpenseInDetails['expense_comment'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <p class="mt-5 mb-5 mx-auto" style="width:95%; border-bottom: 1px solid aliceblue;"></p>
            <div class="table mt-5 w-50 mx-auto my-auto">
                <div class="balanceSummary mx-auto my-auto">
                    <h3 class="text-center" style="color:aliceblue">BALANCE SUMMARY</h3>
                    <table id="tableOfBalance" class="table table-hover table-bordered table-active table-responsive-sm">
                        <thead class="bg-dark border-secondary text-center" style="pointer-events: none;">
                            <tr>
                                <th scope="col">TOTAL INCOMES</th>
                                <th scope="col">TOTAL EXPENSES</th>
                                <th scope="col">BALANCE</th>
                            </tr>
                        </thead>
                        <tbody class="bg-secondary text-center">
                            <tr style="pointer-events: none;">
                                <?php
                                echo '<tr>';
                                echo '<td>' . $_SESSION['totalSumOfIncomes'] . '</td>';
                                echo '<td>' . $_SESSION['totalSumOfExpenses'] . '</td>';
                                echo '<td>' . $_SESSION['balance'] . '</td>';
                                echo '</tr>';
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-4 mb-4">
                <div class="col-12 text-center">
                    <?php
                    $positiveBalanceMessage = "Well done! With carefully money menagement You save {$_SESSION['balance']} zł";
                    $negativeBalanceMessage = "Watch out ! You spent a little too much money !";
                    if ($_SESSION['balance'] > 0) {
                        echo "<p id='successInfo'>{$positiveBalanceMessage}</p>";
                    } else {
                        echo "<p id='alertInfo'>{$negativeBalanceMessage}</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="mx-auto mt-4 mb-4">
                    <a href="menu.php"><button type="button" class="btn btn-rounded btn-lg p-2" id="btnBack"><span class="material-icons mr-1 mt-2">reply</span>BACK TO MAIN MENU</button></a>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Modal datePicker -->
    <div id="dateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dateModal" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 id="customPeriod" class="text-center mx-auto my-auto">Select date range</h4>
                </div>
                <div class="modal-body bg-light">
                    <form action="validateModalDatePicker.php" method="post" autocomplete="off">
                        <label class="text-muted" for="startDate">Start date:</label>
                        <div class="input-group mb-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <span class="material-icons">
                                        date_range
                                    </span> </span>
                            </div>
                            <input id="startDate" type="date" class="form-control" aria-label="data" name="startDate" value="<?php echo date('Y-m-d'); ?>" min="2000-01-01" required>
                        </div>

                        <label class="text-muted" for="endDate">End date:</label>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <span class="material-icons">
                                        date_range
                                    </span> </span>
                            </div>
                            <input id="endDate" type="date" class="form-control" aria-label="data" name="endDate" value="<?php echo date('Y-m-d'); ?>" min="2000-01-01" required>
                        </div>
                </div>
                <div class="modal-footer justify-content-center flex-column flex-md-row btn-group" role="group">
                    <button id="saveDates" type="submit" class="btn btn-outline-success btn-floating waves-effect" name='periodOfTime' value="customPeriod">SAVE</button>
                    <button type="reset" class="btn btn-danger btn-floating waves-effect" data-dismiss="modal" value="Close">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        window.onload = function() {
            drawPieChartOfExpenses();
            drawPieChartOfIncomes();
        }

        function drawPieChartOfExpenses() {
            var table = document.getElementById("tableOfExpenses");
            var category = [];
            var amount = [];
            var dataPoint = [];
            var totalExpense = '<?php echo $_SESSION['totalSumOfExpenses']; ?>';
            for (var i = 1; i < table.rows.length; ++i) {
                var row = "";
                var dataPoints = ""
                for (var j = 0; j < table.rows[i].cells.length; ++j) {
                    row = table.rows[i].cells[j].innerHTML;
                    if (j % 2 == 0) {
                        category[i - 1] = row;
                    } else if (j % 2 == 1) {
                        amount[i - 1] = row;
                    }
                }
                dataPoint.push({
                    y: (amount[i - 1] / totalExpense),
                    label: category[i - 1]
                });
            }

            var chart = new CanvasJS.Chart("expensesChart", {
                theme: "dark1",
                animationEnabled: true,
                backgroundColor: "transparent",
                title: {
                    text: "Your Expenses",
                    fontColor: "aliceblue",
                    fontFamily: "Inconsolata",
                },
                subtitles: [{
                    text: "",
                    fontSize: 10,
                    fontColor: "white",
                }],
                data: [{
                    type: "pie",
                    indexLabelFontSize: 15,
                    indexLabelFontColor: "white",
                    radius: 120,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "####.00%",
                    click: explodePie,
                    dataPoints: dataPoint
                }]
            });
            chart.render();
        }

        function drawPieChartOfIncomes() {
            var table = document.getElementById("tableOfIncomes");
            var category = [];
            var amount = [];
            var dataPoint = [];
            var totalIncomes = '<?php echo $_SESSION['totalSumOfIncomes']; ?>';
            for (var i = 1; i < table.rows.length; ++i) {
                var row = "";
                var dataPoints = ""
                for (var j = 0; j < table.rows[i].cells.length; ++j) {
                    row = table.rows[i].cells[j].innerHTML;
                    if (j % 2 == 0) {
                        category[i - 1] = row;
                    } else if (j % 2 == 1) {
                        amount[i - 1] = row;
                    }
                }
                dataPoint.push({
                    y: (amount[i - 1] / totalIncomes),
                    label: category[i - 1]
                });
            }

            var chart = new CanvasJS.Chart("incomesChart", {
                theme: "dark2",
                animationEnabled: true,
                backgroundColor: "transparent",
                title: {
                    text: "Your Incomes",
                    fontColor: "aliceblue",
                    fontFamily: "Inconsolata",
                },
                subtitles: [{
                    text: "",
                    fontSize: 10,
                    fontColor: "white",
                }],
                data: [{
                    type: "pie",
                    indexLabelFontSize: 15,
                    indexLabelFontColor: "white",
                    radius: 120,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "####.00%",
                    click: explodePie,
                    dataPoints: dataPoint
                }]
            });
            chart.render();
        }

        function explodePie(e) {
            for (var i = 0; i < e.dataSeries.dataPoints.length; i++) {
                if (i !== e.dataPointIndex)
                    e.dataSeries.dataPoints[i].exploded = false;
            }
        };
    </script>
    <?php
    if (isset($_SESSION['dateStatus']) && $_SESSION['dateStatus'] != '') {
    ?>
        <script>
            Swal.fire({
                title: 'Watch Out!',
                text: '<?php echo $_SESSION['dateStatus']; ?>',
                icon: '<?php echo $_SESSION['dateStatusCode']; ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#6495ED',
                position: 'center',
            }).then(function() {
                window.location = 'balance.php';
            });
        </script>
    <?php
        unset($_SESSION['dateStatus']);
        unset($_SESSION['dateStatusCode']);
    }
    ?>
    <?php
    if (isset($_SESSION['serwerStatus']) && $_SESSION['serwerStatus'] != '') {
    ?>
        <script>
            Swal.fire({
                title: 'Internal serwer error!',
                text: '<?php echo $_SESSION['serwerStatus']; ?>',
                icon: '<?php echo $_SESSION['serwerStatusCode']; ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#6495ED',
                position: 'center',
            });
        </script>
    <?php
        unset($_SESSION['serwerStatus']);
        unset($_SESSION['serwerStatusCode']);
    }
    ?>
    <?php
    unset($_SESSION['periodOfTime']);
    unset($_SESSION['incomesTable']);
    unset($_SESSION['expensesTable']);
    unset($_SESSION['incomesTableInDetail']);
    unset($_SESSION['expensesTableInDetail']);
    unset($_SESSION['balance']);
    unset($_SESSION['totalSumOfIncomes']);
    unset($_SESSION['totalSumOfExpenses']);
    unset($_SESSION['periodOfTimeSelected']);
    ?>
</body>

</html>