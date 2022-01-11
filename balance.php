<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$date = new DateTime();
$date->format('Y-m-d');
$firstDate = $_SESSION['startDate'];
$firstDate->format('d-m-Y');
$secondDate = $_SESSION['endDate'];
$secondDate->format('d-m-Y');
$incomes = $_SESSION['incomesTable'];
$expenses = $_SESSION['expensesTable'];
$positiveBalanceMessage = "Congratulations! Your proper money menagement allowed You to save :{$balance} zł";
$negativeBalanceMessage = "Watch out ! You spent a little too much money";

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

</head>

<body>

    <header id="top">
        <h3>Wall€tfy!</h3>
        <nav>
            <ul>
                <li><span class="material-icons mx-2 align-middle">home</span><a href="menu.php" title="Home">Home</a></li>
                <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">savings</span><a class="text-muted" href="#" data-toggle="modal" data-target="#addIncome">Income</a></li>
                <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">shopping_cart</span><a class="text-muted" href="#" class="openModal" data-toggle="modal" data-target="#addExpense" title="Expense">Expense</a></li>
                <li style="pointer-events: none; cursor: not-allowed;"><span class="material-icons mx-2 align-middle text-muted">insert_chart_outlined</span><a class="text-muted" href="balance.php" title="Balance">Balance</a></li>
                <li><span class="material-icons mx-2 align-middle">manage_accounts</span><a href="settings.html" title="Settings">Settings</a></li>
                <li><span class="material-icons mx-2 align-middle">logout</span><a href="index.php" title="Log Out">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <main>

        <section id="balance" style="background-image: url(pap1.jpg);">
            <div class="wrapper">
                <div class="row mt-1">
                    <div class="mx-auto my-auto">
                        <h2 class="text-center py-1" id="intro">BALANCE SHEET</h2>
                    </div>
                </div>
               
                <div class="mb-1 mx-2 py-2 px-4">
                    <form id="date-range-form" method="POST" action="validateModalDatePicker.php">
                        <div class="input-group mx-auto px-1 py-3 t-3 w-50">
                            <div class="calendar-icon my-1">
                                <span class="material-icons pb-1 pr-1">
                                    date_range
                                </span>
                            </div>

                            <select id="periodOfTime" class="custom-select" data-live-search="true" name="periodOfTime" autocomplete="off" style="cursor:pointer">
                                <option value="" selected disabled>-- Please select period --</option>
                                <option value="currentMonth">Current month</option>
                                <option value="previousMonth">Previous month</option>
                                <option value="currentYear">Current year</option>
                                <option value="customPeriod">
                                    <a href="#" class="open-modal" data-target="#dateModal" data-toggle="modal">Custom</a>
                                </option>
                            </select>
                        </div>
                        <!-- Modal datePicker -->
                        <div id="dateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dateModal" aria-hidden="true" data-backdrop="false">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 id="customPeriod" class="text-center">Select date range</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group mb-5">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <span class="material-icons">
                                                        date_range
                                                    </span> </span>
                                            </div>
                                            <input id="startDate" type="date" class="form-control" aria-label="data" name="startDate" value="<?php echo $date; ?>" min="2000-01-01" required>
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <span class="material-icons">
                                                        date_range
                                                    </span> </span>
                                            </div>
                                            <input id="endDate" type="date" class="form-control" aria-label="data" name="endDate" value="<?php echo $date; ?>" min="2000-01-01" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer btn-group" role="group">
                                        <input type="submit" class="btn btn-outline-success btn-floating waves-effect" name="saveDates" value="Save">
                                        <input type="reset" class="btn btn-danger btn-floating waves-effect" data-dismiss="modal" value="Close">
                                        <span class="text-alert">
                                            <?php echo ((isset($_SESSION['date_err']) && $_SESSION['date_err'] != '') ? $_SESSION['date_err'] : '');
                                            unset($_SESSION['date_err']); ?>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class='row'>
                        <div class='col-12 text-center mt-3'>
                            <h4 class='balanceDates'>FINANCIAL BALANCE FROM : <?php echo ((isset($firstDate) && $firstDate != '') ? $firstDate : '');
                                                                                unset($firstDate); ?> TO : <?php echo ((isset($secondDate) && $secondDate != '') ? $secondDate : '');
                                                                                                            unset($secondDate); ?> </h4>
                        </div>
                    </div>

                    <div class="table mt-5 mb-5">
                        <div class="col">
                            <h3 class="text-center" style="color:aliceblue;">INCOMES</h3>
                            <table id="tableOfIncomes" class="table table-striped table-bordered table-hover table-active text-inherit table-sm table-responsive-sm">
                                <thead class="bg-dark border-secondary">
                                    <tr>
                                        <th onclick="sortTableAlphabetically('tableOfIncomes')" scope="col" class="text-center">Category <span class="material-icons align-middle">import_export</span></th>
                                        <th onclick="sortTableNumerically('tableOfIncomes')" scope="col" class="text-center">Value <span class="material-icons align-middle">import_export</span></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-secondary">
                                    <?php
                                    foreach ($incomes as $singleIncome) {
                                        echo '<tr>';
                                        echo '<td>' . $singleIncome[0] . '</td>';
                                        echo '<td>' . $singleIncome[1] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

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
                                        echo '<td>' . $singleExpense[0] . '</td>';
                                        echo '<td>' . $singleExpense[1] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive-text mb-2">
                            <h2 class="text-center" style="color:aliceblue">List of Incomes</h2>
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
                                <tbody class="bg-secondary">
                                    <?php
                                    foreach ($incomes as $singleIncome) {
                                        echo '<tr>';
                                        echo '<td>' . $singleIncome[0] . '</td>';
                                        echo '<td>' . $singleIncome[1] . '</td>';
                                        echo '<td>' . $singleIncome[2] . '</td>';
                                        echo '<td>' . $singleIncome[3] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive-text mt-3 mb-3">
                            <h2 class="text-center" style="color:aliceblue">List of Expenses</h2>
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
                                    foreach ($expenses as $singleExpense) {
                                        echo '<tr>';
                                        echo '<td>' . $singleExpense[0] . '</td>';
                                        echo '<td>' . $singleExpense[1] . '</td>';
                                        echo '<td>' . $singleExpense[2] . '</td>';
                                        echo '<td>' . $singleExpense[3] . '</td>';
                                        echo '<td>' . $singleExpense[4] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="balanceSummary col-sm-12 col-md-6 mt-2 mb-2  mx-auto my-auto">
                            <h3 class="text-center">BALANCE SUMMARY</h3>
                            <table class="table table-hover table-bordered table-responsive table-active table-responsive-sm">
                                <thead class="bg-dark border-secondary text-center" style="pointer-events: none;">
                                    <tr>
                                        <th scope="col">TOTAL INCOMES</th>
                                        <th scope="col">TOTAL EXPENSES</th>
                                        <th scope="col">BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-secondary">
                                    <tr style="pointer-events: none;">
                                        <?php
                                        $totalSumOfIncomes = 0;
                                        $totalSumOfExpenses = 0;
                                        $balance = 0;
                                        foreach ($incomes as $singleIncome) {
                                            $totalSumOfIncomes += $singleIncome[1];
                                        }
                                        foreach ($expenses as $singleExpense) {
                                            $totalSumOfExpenses += $singleExpense[1];
                                        }
                                        $balance = round($totalSumOfIncomes - $totalSumOfExpenses, 2);
                                        echo '<tr>';
                                        echo '<td>' . $incomeSummary . '</td>';
                                        echo '<td>' . $expenseSummary . '</td>';
                                        echo '<td>' . $balance . '</td>';
                                        echo '</tr>';
                                        ?>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <?php
                            echo $balance > 0 ? "<h3 id='successInfo'>{$positiveBalanceMessage}</h3> !" : "<h3 id='alertInfo'>{$negativeBalanceMessage}</h3>";
                            ?>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="chartDisplay col-sm-12 col-md-6  mx-auto mt-2 mb-2">
                            <h3 class="text-center"> *Display Interactive Chart* </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mx-auto mt-2 mb-2">
                            <a href="menu.php"><button type="button" class="btn btn-rounded btn-lg p-2" id="btnBack"><span class="material-icons mr-1 mt-2">reply</span>BACK TO MAIN MENU</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
</body>

</html>