<?php
// Initialize the session
session_start();

/* Check if the user is logged in, if yes - redirect him to main menu page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("Location: index.php");
    exit;
} else {
?>
    <script>
        $(document).ready(function() {
            let wasShown = false;
            if (!wasShown) {
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: 'General Title',
                    animation: false,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                toastMixin.fire({
                    title: 'Signed in Successfully'
                });
                wasShown = true;
            }

        });
    </script>
<?php
}
*/
//$userName = $_SESSION['logged_user'];
//$userID = $_SESSION['logged_id'];
//$expenseAddedCorrectly = $_SESSION['expenseAddedCorrectly'];
//$incomeAddedCorrectly = $_SESSION['incomeAddedCorrectly'];
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'>
    <link rel="stylesheet" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <script type="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body onload="setTodaysDate()">
    <header id="top">
        <h3>Wall€tfy!</h3>
        <h5 class="loggedAs ml-0">User :<?php echo $userName ?>
        </h5>
        <nav>
            <ul>
                <li><span class="material-icons mx-2 align-middle">home</span><a href="menu.php" title="Home">Home</a></li>
                <li><span class="material-icons mx-2 align-middle">savings</span><a href="#" data-toggle="modal" data-target="#addIncome">Income</a></li>
                <li><span class="material-icons mx-2 align-middle">shopping_cart</span><a href="#" class="openModal" data-toggle="modal" data-target="#addExpense" title="Expense">Expense</a></li>
                <li><span class="material-icons mx-2 align-middle">insert_chart_outlined</span><a href="balance.php" title="Balance">Balance</a></li>
                <li><span class="material-icons mx-2 align-middle">manage_accounts</span><a href="settings.php" title="Settings">Settings</a></li>
                <li><span class="material-icons mx-2 align-middle">logout</span><a href="index.php" title="Log Out">Exit</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home" style="background-image: url(ewallet.png)">
            <div class="content">
                <div class="mb-4">
                    <svg class="title">
                        <text x="0" y="40">Wall€tfy!</text>
                    </svg>
                    <p class="lead">
                        Walcome to Wall€tfy! - a personal finance application that makes money management easy. The app is designed to streamline cash tracking and help you save money.
                    </p>
                    <p class="lead">
                        On the top You can select the option You are interested in from the navigation menu. Add a new income, expense, view the balance of the period You are interested in or personalize Your account in the settings.
                    </p>
                </div>
            </div>
            <div class="container-fluid mt-5">
                <div class="row">
                    <footer class="page-footer">
                        <div class="footer-container text-center mx-auto">
                            <p class="text-center">Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
                                Follow me:<a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                                <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                                <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a>
                            </p>
                        </div>
                    </footer>
                </div>
            </div>
        </section>

        <!-- ModalIncomes-->
        <div class="modal fade" id="addIncome" tabindex="-1" role="dialog" aria-labelledby="addIncome" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-5">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 id="addIncome" class="modal-title mx-auto">ADD NEW INCOME</h4>
                    </div>
                    <div class="modal-body py-0 bg-light">
                        <form action="add_income.php" method="post" autocomplete="off">

                            <div class="income-input mx-auto mt-4">
                                <div class="income-icon">
                                    <span class="material-icons px-2 py-2">
                                        attach_money
                                    </span>
                                </div>
                                <input class="amount-data px-3" type="number" class="form-control" placeholder="Value" min="0" max="99999.99" step="0.01" aria-label="value" name="amount" style="width: 85%" required>
                            </div>

                            <div class="income-input mx-auto mt-3">
                                <div class="income-icon">
                                    <span class="material-icons px-2 py-2 text-muted">
                                        date_range
                                    </span>
                                </div>
                                <input type="date" class="data-control px-3" aria-label="date" name="date" value="<?php echo date('Y-m-d'); ?>" style="width: 85%" required>
                            </div>

                            <div class="income-input mx-auto mt-3">
                                <div class="income-icon">
                                    <span class="material-icons px-2 py-2">
                                        list
                                    </span>
                                </div>
                                <select name="category" class="user-options px-4 text-muted" style="width: 85%" required>
                                    <option value="">--- Please select option ---</option>
                                    <option value="Salary">Salary</option>
                                    <option value="Internet sale">Internet sale</option>
                                    <option value="Interest">Interest</option>
                                    <option value="Donation">Donation</option>
                                    <option value="Gift">Gift</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="income-input mx-auto mt-3 mb-4">
                                <div class="income-icon">
                                    <span class="material-icons px-2 py-4">
                                        description
                                    </span>
                                </div>
                                <textarea class="form-data px-3 py-2" minlength="0" maxlength="50" placeholder="Commentary (not required)" name="comment" style="width: 85%"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-center flex-column flex-md-row btn-group">
                        <button type="submit" id="addIncome" name="addIncome" value="ADD" class="btn btn-floating btn-outline-success mr-2">ADD</button>
                        <button type="reset" class="btn btn-floating btn-danger waves-effect" name="erase_income"  value="CLOSE" data-dismiss="modal" onclick="this.form.reset();">CLOSE</button>
                        <span class="text-success"><?php echo ((isset($incomeAddedCorrectly) && $incomeAddedCorrectly != '') ? 'Income saved !' : '');
                                                    unset($incomeAddedCorrectly); ?> </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- ModalExpenses-->
        <div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpense" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-5">
                    <div class="modal-header d-flex justify-content-center">
                        <h4 id="addExpense" class="modal-title mx-auto">ADD NEW EXPENSE</h4>
                    </div>
                    <div class="modal-body py-0 bg-light">
                        <form action="add_expense.php" method="post" autocomplete="off">
                            <div class="expense-box mx-auto pl-4 pr-3 py-3">
                                <div class="title text-center mx-auto">ADD NEW EXPENSE</div>
                                <div class="expense-input mx-auto mt-0">
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
                                    <input type="date" class="data-control px-3" aria-label="date" name="date" style="width: 85%" min="2000-01-01" max="2030-12-31" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>

                                <div class="expense-input mx-auto mt-4">
                                    <div class="expense-icon">
                                        <span class="material-icons px-2 py-2">
                                            credit_score
                                        </span>
                                    </div>
                                    <select name="options" class="user-options px-3 text-muted" style="width: 85%" required>
                                        <option value="">--- Please select option ---</option>
                                        <option value="Credit-card">Credit card</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Debet card">Debet card</option>
                                        <option value="Blik">Blik</option>
                                        <option value="Transfer">Transfer</option>
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
                                    <select name="purpose" class="user-options px-3 text-muted" style="width: 85%" required>
                                        <option value="">--- Please select option ---</option>
                                        <option value="Food">Food</option>
                                        <option value="Home">Housekeeping</option>
                                        <option value="Clothes">Clothes</option>
                                        <option value="Transport">Transport</option>
                                        <option value="Health">Health</option>
                                        <option value="Hygiene">Hygiene</option>
                                        <option value="Kids">Kids</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Trip">Travelling</option>
                                        <option value="School">School/Learning</option>
                                        <option value="Books">Books</option>
                                        <option value="Debt">Debt</option>
                                        <option value="Pension">Pension</option>
                                        <option value="Donation">Donation</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="expense-input mx-auto mt-4 mb-4">
                                    <div class="expense-icon">
                                        <span class="material-icons px-2 py-4">
                                            description
                                        </span>
                                    </div>
                                    <textarea class="form-data px-3 py-2" minlength="0" maxlength="50" placeholder="Commentary (not required)" name="comment" style="width: 85%"></textarea>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer justify-content-center flex-column flex-md-row btn-group">
                        <button type="submit" id="addExpense" name="addExpense" value="ADD" class="btn btn-floating btn-outline-success mr-2">ADD</button>
                        <button type="reset" class="btn btn-floating btn-danger waves-effect" name="erase_expense" value="CLOSE" action="erase_expense.php" data-dismiss="modal" onclick="this.form.reset();">CLOSE</button>
                        <span class="text-success"><?php echo ((isset($expenseAddedCorrectly) && $expenseAddedCorrectly != '') ? 'Expense saved !' : '');
                                                    unset($expenseAddedCorrectly); ?> </span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['addExpense']) && isset($_SESSION['expenseStatus']) && $_SESSION['expenseStatus'] != "") {
        ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION['expenseStatus']; ?>",
                    icon: "<?php echo $_SESSION['expenseStatusCode']; ?>",
                    button: "OK",
                });
            </script>
        <?php
            unset($expenseStatus);
        }
        if (isset($_POST['addIncome']) && isset($_SESSION['incomeStatus']) && $_SESSION['incomeStatus'] != "") {
        ?>
            <script>
                swal({
                    position: 'top-end',
                    title: "<?php echo $_SESSION['incomeStatus']; ?>",
                    icon: "<?php echo $_SESSION['incomeStatusCode']; ?>",
                    button: "OK",
                });
            </script>
        <?php
            unset($incomeStatus);
            }
        ?>

</body>

</html>