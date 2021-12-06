<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Wall€tfy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="descritpion" content="Dzięki WALLETFY - aplikacji do zarządzania finansami, Twoje zarządzanie budżetem stanie się prostsze!" />
    <meta name="keywords" content="budżet,finanse,wydatki,przychody,bilans" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge, chrome = 1" />
  <link href="https://fonts.googleapis.com/css?family=Inconsolata|Montserrat:400,500,700&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'>
<link rel="stylesheet" href="./style.css">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
  <header id="top">
    <h3>Wall€tfy!</h3>
	<h5 class="loggedAs ml-0">User name:<?= $_SESSION['login'] ?>
            </h5>
    <nav>
      <ul>
        <li><span class="material-icons mx-2 align-middle">home</span><a href="menu.html" title="Home">Home</a></li>
        <li><a href="#" data-toggle="modal" data-target="#addIncome"><span class="material-icons mx-2 align-middle">savings</span>Income</a></li>
        <li><span class="material-icons mx-2 align-middle">shopping_cart</span><a href="#" class="openModal" data-toggle="modal" data-target="#addExpense" title="Expense">Expense</a></li>
        <li><span class="material-icons mx-2 align-middle">insert_chart_outlined</span><a href="balance.html" title="Balance">Balance</a></li>
        <li><span class="material-icons mx-2 align-middle">manage_accounts</span><a href="settings.html" title="Settings">Settings</a></li>
		<li><span class="material-icons mx-2 align-middle">logout</span><a href="index.html" title="Log Out">Log Out</a></li>
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
		  <p class = "lead">
		  On the top You can select the option You are interested in from the navigation bar. Add a new income, expense, view the balance of the period You are interested in or personalize Your account in the settings. 
		  </p>
        </div>
      </div>
	    <div class="container-fluid col-12 mt-5">
        <div class="row text-center">
            <footer class="page-footer">
                <div class="footer-container text-center mx-auto">
                    <p>Wszelkie prawa zastrzeżone. Copyright © 2021. All Rights Reserved.
					Follow me:<a class="mx-3" href="#!" id="ln"><i class="fab fa-linkedin"></i></a>
                    <a class="mx-3" href="#!" id="fb"><i class="fab fa-facebook-square"></i></a>
                    <a class="mx-3" href="#!" id="gh"><i class="fab fa-github"></i></a></p>		
                </div>
            </footer>
        </div>
    </div>
    </section>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script><script  src="./script.js"></script>

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
                        <input type="date" class="data-control px-3" aria-label="date" name="date" style="width: 85%" required>
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
                   
                    <div class="income-input mx-auto mt-3 mb-4">
                        <div class="income-icon">
                            <span class="material-icons px-2 py-3">
                                description
                            </span>
                        </div>
                        <textarea class="form-data px-3 py-2" minlength="0" maxlength="50" placeholder="Commentary (not required)" name="comment" style="width: 85%"></textarea>
                    </div>
            </div>
            <div class="modal-footer justify-content-center flex-column flex-md-row btn-group">
                <input type="submit" name="addIncome" value="ADD" class="btn btn-floating btn-outline-success mr-2">
                <input type="button" class="btn btn-floating btn-danger waves-effect" name="erase_income" action="erase_expense.php" value="CLOSE" data-dismiss="modal">
                
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
                            <select name="purpose" class="user-options px-3 text-muted" style="width: 85%">
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
                            <textarea class="form-data px-3 py-2" minlength="0" maxlength="50" placeholder="Commentary (not required)" name="comment" style="width: 85%"></textarea>
                        </div>
                    </div>
            </div>

            <div class="modal-footer justify-content-center flex-column flex-md-row btn-group">
                <input type="submit" name="addExpense" value="ADD" class="btn btn-floating btn-outline-success mr-2">
                <input type="button" class="btn btn-floating btn-danger waves-effect" name="erase_expense" value="CLOSE" data-dismiss="modal">
            </div>
            </form>
        </div>
    </div>
</div>
</html>
