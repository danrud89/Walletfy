<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="balance.css" type="text/css" />
    <link href="vivify.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="icons/css/fontello.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="icon" href="img/favicon.png">


</head>

<body>
    <div class="container">
        <div class="row">
            <div id="toggle">
                <i class="indicator"></i>
            </div>
        </div>
        <div class="row">
            <div class="intro col-sm-12 col-md-6  mx-auto my-auto">
                <h3 class="text-center">BALANCE SHEET</h3>
            </div>
        </div>
        <div class="welcome-message mt-0 mb-1 mx-2 py-2 px-4 w-100">
            <form id="date-range-form" method="POST" action="validateModalDatePicker.php">
                <div class="input-group col-sm-12 col-md-6 mx-auto px-3 py-3 t-3">
                    <div class="calendar-icon my-1">
                        <span class="material-icons pb-1 pr-1">
                            date_range
                        </span>
                    </div>
                    <select id="periodOfTime" class="custom-select" data-live-search="true" name="periodOfTime">
                        <option value="">--- Please select period ---</option>
                        <option value="currentMonth">Current month</option>
                        <option value="previousMonth">Previous month</option>
                        <option value="currentYear">Current year</option>
                        <option value="customPeriod">
                            <a href="#" data-toggle="modal" data-target="#dateModal" data-toggle="modal">Custom</a>
                        </option>
                    </select>
                </div>

                <div class='row'>
                    <div class='col-12 text-center mt-3'>
                        <h4 class='balanceDates'>FINANCIAL BALANCE FROM : <?php echo ((isset($_SESSION['first']) && $_SESSION['login_err'] != '') ? $_SESSION['login_err'] : ''); unset($_SESSION['login_err']); ?> TO : <?php if (isset($_SESSION['end_date'])) {echo $_SESSION['end_date']; unset ($_SESSION['end_date']);}?> </h4>
                    </div>
                </div>

                <!-- Modal datePicker -->
                <div id="dateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dateModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="customPeriod" class="text-secondary">Select date range</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="validateModalDatePicker.php" id="datePicker">
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <span class="material-icons">
                                                    date_range
                                                </span> </span>
                                        </div>
                                        <input id="startDate" type="date" class="form-control" aria-label="data" name="startDate" value="<?php echo date('Y-m-d'); ?>" min="2000-01-01" required>
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <span class="material-icons">
                                                    date_range
                                                </span> </span>
                                        </div>
                                        <input id="endDate" type="date" class="form-control" aria-label="data" name="endDate" value="<?php echo date('Y-m-d'); ?>" min="2000-01-01" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer btn-group" role="group">
                                <button type="button" class="btn btn-dark" value="SAVE" name="saveDates"></button>
                                <button id="modalCloseBtn" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <div class="error">
                                    <?php
                                    if (isset($_SESSION['date_err'])) {
                                        echo $_SESSION['date_err'];
                                        unset($_SESSION['date_err']);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table mt-5 mb-5">
                <div class="col">
                    <h3 class="text-center">INCOMES</h3>
                    <table id="tableOfIncomes" class="table table-striped table-bordered table-hover table-active text-inherit table-sm">
                        <thead>
                            <tr>
                                <th onclick="sortTableAlphabetically('tableOfIncomes')" scope="col">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfIncomes')" scope="col">Value <span class="material-icons align-middle">import_export</span></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col">
                    <h3 class="text-center">EXPENSES</h3>
                    <table id="tableOfExpenses" class="table table-striped table-bordered table-hover table-active text-inherit table-sm">
                        <thead>
                            <tr>
                                <th onclick="sortTableAlphabetically('tableOfExpenses')" scope="col">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfExpenses')" scope="col">Value <span class="material-icons align-middle">import_export</span></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive-text mb-2">
                    <h2 class="text-center">List of Incomes</h2>
                    <table id="tableOfIncomesInDetail" class="table table-striped table-bordered table-hover table-active text-inherit table-sm" style="table-layout: fixed; width: 100%">
                        <thead>
                            <tr>
                                <th onclick="sortTableAlphabetically('tableOfIncomesInDetail')" scope="col">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfIncomesInDetail')" scope="col">Value <span class="material-icons align-middle">import_export</span></th>
                                <th scope="col">Date</th>
                                <th scope="col">Commentary</th>
                                <th style="display:none;"> id</th>
                                <th width="5%"></th>

                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="table-responsive-text mt-3 mb-3">
                    <h2 class="text-center">List of Expenses</h2>
                    <table id="tableOfExpensesInDetail" class="table table-striped table-bordered table-hover table-active text-inherit table-sm" style="table-layout: fixed; width: 100%">
                        <thead>
                            <tr>
                                <th onclick="sortTableAlphabetically('tableOfExpensesInDetail')" scope="col">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfExpensesInDetail')" scope="col">Value <span class="material-icons align-middle">import_export</span></th>
                                <th scope="col">Payment option</th>
                                <th scope="col">Date</th>
                                <th scope="col">Commentary</th>
                                <th style="display:none;"> id</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row ">
                <div class="balanceSummary col-sm-12 col-md-6 mt-2 mb-2  mx-auto my-auto">
                    <h3 class="text-center">BALANCE:{{sumOfIncomes-sumOfExpenses}}</h3>
                </div>
            </div>
            <div class="row ">
                <div class="chartDisplay col-sm-12 col-md-6  mx-auto mt-2 mb-2">
                    <h3 class="text-center"> *Display Interactive Chart* </h3>
                </div>
            </div>

            <div class="row">
                <div class="back mx-auto mt-2 mb-2">
                    <a href="menu.php"><button type="button" class="p-2">BACK TO MAIN MENU</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="row">
            <footer class="page-footer col-sm-12 col-md-12">
                <div class="footer-container text-center mt-2 mb-1 mx-auto">
                    <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved </p>
                </div>
            </footer>
        </div>
    </div>

    <script>
        const body = document.querySelector('body');
        const toggle = document.getElementById('toggle');
        toggle.onclick = function() {
            toggle.classList.toggle('active');
            body.classList.toggle('active');
        }
    </script>
    <script>
        $('#periodOfTime').change(function() {
            if (this.value == "customPeriod") {
                document.getElementById("periodOfTime").setAttribute("onclick", "");
                $('#dateModal').modal({
                    show: true

                });
            } else {
                document.getElementById("periodOfTime").setAttribute("onclick", "this.form.submit()");
            }
        });
    </script>
</body>

</html>