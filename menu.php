<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

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
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="menu.css" type="text/css" />
    <link rel="stylesheet" href="icons/css/fontello.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="icon" href="img/favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <div class="container col-md-12">
        <div class="row">
            <div id="toggle" class="col-sm-12 mx-1 my-3 px-1 py-1">
                <i class="indicator"></i>
            </div>
        </div>
        <div class="row">
            <div class="motto1 col-md-12 text-center mx-0 my-1">
                <p><img class="wallet-dark" src="img/wallet_dark.jpg" alt="" style="transform: scale(0.8);">
                    <img class="wallet-light" src="img/wallet-light.png" alt="" style="transform: scale(0.8);">Wall€tfy!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="motto2 col-md-12 text-center">
                <p>Application that makes money management easier !</p>
            </div>
        </div>

        <div class="row">
            <div class="hexmenu col-sm-10 col-lg-12 mx-auto mb-5">
                <div class="hexagon text-center">
                    <ul class="honeycomb justify-content-center m-3">
                        <a href="#" class="openModal position-relative p-2" data-toggle="modal" data-target="#addIncome">
                            <li class="honeycomb-cell">
                                <span class="material-icons">savings</span>
                                <div class="honeycomb-cell_title">INCOMES</div>
                            </li>
                        </a>


                        <a href="add_expense.html" class="position-relative p-2" data-toggle="modal" data-target="#addExpense">
                            <li class="honeycomb-cell">
                                <span class="material-icons">
                                    shopping_cart
                                </span>
                                <div class="honeycomb-cell_title">EXPENSES</div>
                            </li>
                        </a>


                        <a href="balance.html" class="position-relative p-2">
                            <li class="honeycomb-cell">
                                <span class="material-icons">insert_chart_outlined</span>
                                <div class="honeycomb-cell_title">BALANCE</div>
                            </li>
                        </a>


                        <a href="settings.html" class="position-relative p-2">
                            <li class="honeycomb-cell">
                                <span class="material-icons">
                                    manage_accounts
                                </span>
                                <div class="honeycomb-cell_title">SETTINGS</div>
                            </li>
                        </a>


                        <a href="index.html" class="position-relative p-2">
                            <li class="honeycomb-cell">
                                <span class="material-icons">
                                    dvr
                                </span>
                                <div class="honeycomb-cell_title">Log out</div>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 mt-5">
        <div class="row">
            <footer class="page-footer col-sm-12 col-md-12">
                <div class="footer-container text-center mx-auto">
                    <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved </p>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="bootstrap5/js/bootstrap.min.js"></script>
    <script>
        const body = document.querySelector('body');
        const toggle = document.getElementById('toggle');
        toggle.onclick = function() {
            toggle.classList.toggle('active');
            body.classList.toggle('active');
        }

    </script>
</body>

<!-- ModalIncomes-->
<div class="modal fade" id="addIncome" tabindex="-1" role="dialog" aria-labelledby="addIncome" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-5">
            <div class="modal-header d-flex justify-content-center">
                <h4 id="addIncome" class="modal-title mx-auto">ADD NEW INCOME</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0 bg-light">
                <form action="add_income.php" method="post">
                    <div class="row">
                        <div class="income-input mx-auto mt-4">
                            <div class="income-icon">
                                <span class="material-icons px-2 py-2">
                                    attach_money
                                </span>
                            </div>
                            <input class="amount-data px-3" type="number" class="form-control" placeholder="Value" min="0" max="99999.99" step="0.01" aria-label="value" name="amount" style="width: 85%" required>
                        </div>
                    </div>
                    <div class="error">
                        <?php
                            if(isset($_SESSION['amount_err']))
                            {
                            echo $_SESSION['amount_err'];
                            unset($_SESSION['amount_err']);
                            }
                        ?>
                        </div>
                    <div class="income-input mx-auto mt-3">
                        <div class="income-icon">
                            <span class="material-icons px-2 py-2 text-muted">
                                date_range
                            </span>
                        </div>
                        <input type="date" class="data-control px-3" aria-label="date" style="width: 85%" required>
                    </div>
                    <div class="error">
                        <?php
                            if(isset($_SESSION['date_err']))
                            {
                            echo $_SESSION['date_err'];
                            unset($_SESSION['date_err']);
                            }
                        ?>
                        </div>
                    <div class="income-input mx-auto mt-3">
                        <div class="income-icon">
                            <span class="material-icons px-2 py-2">
                                list
                            </span>
                        </div>
                        <select name="category" class="user-options px-4 text-muted" style="width: 85%">
                            <option value="">--- Please select option ---</option>
                            <option value="salary">Salary</option>
                            <option value="sell">Internet sale</option>
                            <option value="interest">Interest</option>
                            <option value="donation">Donation</option>
                            <option value="gift">Gift</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="error">
                        <?php
                            if(isset($_SESSION['category_err']))
                            {
                            echo $_SESSION['category_err'];
                            unset($_SESSION['category_err']);
                            }
                        ?>
                        </div>
                    <div class="income-input mx-auto mt-3 mb-4">
                        <div class="income-icon">
                            <span class="material-icons px-2 py-3">
                                description
                            </span>
                        </div>
                        <textarea class="form-data px-3 py-2" minlength="0" maxlength="50" placeholder="Commentary (not required)" name="comment" style="width: 85%"></textarea>
                    </div>
                    <div class="error">
                        <?php
                            if(isset($_SESSION['comment_err']))
                            {
                            echo $_SESSION['comment_err'];
                            unset($_SESSION['comment_err']);
                            }
                        ?>
                        </div>
                </form>
            </div>

            <div class="modal-footer justify-content-center flex-column flex-md-row btn-group">
                <input type="submit" name="addIncome" value="ADD" class="btn btn-floating btn-outline-success mr-2">
                <input type="button" class="btn btn-floating btn-danger waves-effect" value="CLOSE" data-dismiss="modal">
            </div>
            <div class="incomeAdded">
            <?php
            if (isset($_SESSION['incomeAddedCorrectly']))
            echo '<h5> class="text-center mx-auto text-success">Income has been added correctly!</h5>';
            unset($_SESSION['incomeAddedCorrectly']);
            ?>
            </div>
        </div>
    </div>
</div>


<!-- ModalExpenses-->
<div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpense" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-5">
            <div class="modal-header d-flex justify-content-center">
                <h4 id="addExpense" class="modal-title mx-auto">ADD NEW EXPENSE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0 bg-light">
                <form action="expense.php" method="post">
                    <div class="expense-box mx-auto pl-4 pr-3 py-3">
                        <div class="title text-center mx-auto">ADD NEW EXPENSE</div>
                        <div class="expense-input mx-auto mt-4">
                            <div class="expense-icon">
                                <span class="material-icons px-2 py-2">
                                    attach_money
                                </span>
                            </div>
                            <input class="form-data px-3" type="number" class="form-control" placeholder="Value" min="0" max="99999.99" step="0.01" aria-label="value" name="amount" style="width: 85%" required>
                        </div>
                        <div class="expense-input mx-auto mt-4">
                            <div class="expense-icon">
                                <span class="material-icons px-2 py-2">
                                    date_range
                                </span>
                            </div>
                            <input type="date" class="data-control px-3" aria-label="date" style="width: 85%" required>
                        </div>
                        <div class="expense-input mx-auto mt-4">
                            <div class="expense-icon">
                                <span class="material-icons px-2 py-2">
                                    credit_score
                                </span>
                            </div>
                            <select name="options" class="user-options px-3 text-muted" style="width: 85%">
                                <option value="">--- Please select option ---</option>
                                <option value="credit-card">Credit card</option>
                                <option value="cash">Cash</option>
                                <option value="debet-card">Debet card</option>
                                <option value="blik">Blik</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        <div class="expense-input mx-auto mt-4">
                            <div class="expense-icon">
                                <span class="material-icons">
                                    <span class="material-icons px-2 py-2">
                                        shopping_bag
                                    </span>
                                </span>
                            </div>
                            <select name="options" class="user-options px-3 text-muted" style="width: 85%">
                                <option value="">--- Please select option ---</option>
                                <option value="food">Food</option>
                                <option value="home">Housekeeping</option>
                                <option value="clothes">Clothes</option>
                                <option value="transport">Transport</option>
                                <option value="health">Health</option>
                                <option value="hygiene">Hygiene</option>
                                <option value="kids">Kids</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="trip">Travelling</option>
                                <option value="school">School/Learning</option>
                                <option value="books">Books</option>
                                <option value="debt">Debt</option>
                                <option value="pension">Pension</option>
                                <option value="donation">Donation</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="expense-input mx-auto mt-4 mb-4">
                            <div class="expense-icon">
                                <span class="material-icons px-2 py-3">
                                    description
                                </span>
                            </div>
                            <textarea class="form-data px-3 py-2" maxlength="50" placeholder="Commentary (not required)" name="comment" style="width: 85%"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-center flex-column flex-md-row btn-group">
            <input type="submit" name="addExpense" value="ADD" class="btn btn-floating btn-outline-success mr-2">
                <input type="button" class="btn btn-floating btn-danger waves-effect" value="CLOSE" data-dismiss="modal">
            </div>
        </div>
    </div>
</div>

</html>
