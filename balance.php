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
?>

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
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<!-- partial:index.partial.html -->

  <header id="top">
    <h3>Wall€tfy!</h3>
    <nav>
      <ul>
        <li><span class="material-icons mx-2 align-middle">home</span><a href="menu.html" title="Home">Home</a></li>
        <li><span class="material-icons mx-2 align-middle">savings</span><a href="#" data-toggle="modal" data-target="#addIncome">Income</a></li>
        <li><span class="material-icons mx-2 align-middle">shopping_cart</span><a href="#" class="openModal" data-toggle="modal" data-target="#addExpense" title="Expense">Expense</a></li>
        <li><span class="material-icons mx-2 align-middle">insert_chart_outlined</span><a href="balance.html" title="Balance">Balance</a></li>
        <li><span class="material-icons mx-2 align-middle">manage_accounts</span><a href="settings.html" title="Settings">Settings</a></li>
		<li><span class="material-icons mx-2 align-middle">logout</span><a href="index.html" title="Log Out">Log Out</a></li>
      </ul>
    </nav>
  </header>
  
  <main>
    
	  <section id="balance" style="background-image: url(ewallet2.png);">
        <div class="row mt-1>
            <div class="mx-auto my-auto">
                <h2 class="text-center py-1" id="intro">BALANCE SHEET</h2>
            </div>
        </div>
		
        <div class="mb-1 mx-2 py-2 px-4">
            <form id="date-range-form" method="POST" action="validateModalDatePicker.php">
                <div class="input-group mx-auto px-3 py-3 t-3 w-25">
                    <div class="calendar-icon my-1">
                        <span class="material-icons pb-1 pr-1">
                            date_range
                        </span>
                    </div>
                    <select id="periodOfTime" class="custom-select form-control" data-live-search="true" name="periodOfTime">
                        <option value="default">- Please select period -</option>
                        <option value="currentMonth">Current month</option>
                        <option value="previousMonth">Previous month</option>
                        <option value="currentYear">Current year</option>
                        <option value="customPeriod"><a href="#" data-toggle="modal" data-target="#dateModal" data-toggle="modal">Custom</a></option>
                    </select>
                </div>
				
				<!-- Modal datePicker -->
                <div id="dateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dateModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" action="validateModalDatePicker.php" id="datePicker">
                                <div class="modal-header">
                                    <h4 id="customPeriod" class="text-secondary">Select date range</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
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
                                    <button type="button" class="btn btn-dark" name="saveDates">Save</button>
                                    <button id="modalCloseBtn" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <span class="text-alert">
                                        <?php echo ((isset($_SESSION['date_err']) && $_SESSION['date_err'] != '') ? $_SESSION['date_err'] : '');
                                        unset($_SESSION['date_err']); ?>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-12 text-center mt-3'>
                        <h4 class='balanceDates'>FINANCIAL BALANCE FROM : <?php echo ((isset($firstDate) && $firstDate != '') ? $firstDate : '');
                                                                            unset($firstDate); ?> TO : <?php echo ((isset($secondDate) && $secondDate != '') ? $secondDate : '');
                                                                                                        unset($secondDate); ?> </h4>
                    </div>
                </div>
            </form>

            <div class="table mt-5 mb-5">
                <div class="col">
                    <h3 class="text-center" style="color:aliceblue;">INCOMES</h3>
                    <table id="tableOfIncomes" class="table table-striped table-bordered table-hover table-active text-inherit table-sm">
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
                    <table id="tableOfExpenses" class="table table-striped table-bordered table-hover table-active text-inherit table-sm">
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
                    <table id="tableOfIncomesInDetail" class="table table-striped table-bordered table-hover table-active text-inherit table-sm" style="table-layout: fixed; width: 100%">
                        <thead class="bg-dark border-secondary">
                            <tr>
                                <th onclick="sortTableAlphabetically('tableOfIncomesInDetail')" scope="col" class="text-center">Category <span class="material-icons align-middle">import_export</span></th>
                                <th onclick="sortTableNumerically('tableOfIncomesInDetail')" scope="col" class="text-center">Value <span class="material-icons align-middle">import_export</span></th>
                                <th scope="col" class="align-middle text-center">Date</th>
                                <th scope="col" class="align-middle text-center">Commentary</th>
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
                                <th scope="col" class="align-middle text-center">Payment option</th>
                                <th scope="col" class="align-middle text-center">Date</th>
                                <th scope="col" class="align-middle text-center">Commentary</th>
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
                    <table class="table table-hover table-bordered">
									<thead class="bg-dark border-secondary text-center">
										<tr>
											<th scope="col">TOTAL INCOMES</th>
											<th scope="col">TOTAL EXPENSES</th>
											<th scope="col">BALANCE</th>
										</tr>
									</thead>
									<tbody class="bg-secondary">
										<tr>
											<?php
													$totalSumOfIncomes = 0;
													$totalSumOfExpenses = 0;
                                                    $balance = 0;
													foreach($incomes as $singleIncome) {
														$totalSumOfIncomes += $singleIncome[1];
													}
													foreach($expenses as $singleExpense) {
														$totalSumOfExpenses += $singleExpense[1];
													}
													$balance = round($totalSumOfIncomes - $totalSumOfExpenses,2);
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
            <div class="row ">
                <div class="chartDisplay col-sm-12 col-md-6  mx-auto mt-2 mb-2">
                    <h3 class="text-center"> *Display Interactive Chart* </h3>
                </div>
            </div>

            <div class="row">
                <div class="mx-auto mt-2 mb-2" id="back">
                    <a href="menu.html"><button type="button" class="btn btn-dark-moon btn-rounded btn-lg p-1" style="font-size:24px; letter-spacing:2px;"><span class="material-icons align-top mr-1">undo</span>BACK TO MAIN MENU</button></a>
                </div>
            </div>
			
        </div>
</section>

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
<script>
$('#periodOfTime').change(function() {
    var opval = $(this).val();
    if(opval=="customPeriod"){
        $('#dateModal').modal("show");
    }
});</script>

    <script>
        function sortTableAlphabetically(idOfTable) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById(idOfTable);
            switching = true;
            //Set the sorting direction to ascending:
            dir = "asc";
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[0];
                    y = rows[i + 1].getElementsByTagName("TD")[0];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        };
    </script>
    <script>
        function sortTableNumerically(idOfTable) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById(idOfTable);
            switching = true;
            //Set the sorting direction to ascending:
            dir = "asc";
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                    //start by saying there should be no switching:
                    shouldSwitch = false;
                    /*Get the two elements you want to compare,
                    one from current row and one from the next:*/
                    x = rows[i].getElementsByTagName("TD")[1];
                    y = rows[i + 1].getElementsByTagName("TD")[1];
                    /*check if the two rows should switch place,
                    based on the direction, asc or desc:*/
                    if (dir == "asc") {
                        if (Number(x.innerHTML) > Number(y.innerHTML)) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (Number(x.innerHTML) < Number(y.innerHTML)) {
                            //if so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /*If a switch has been marked, make the switch
                    and mark that a switch has been done:*/
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    //Each time a switch is done, increase this count by 1:
                    switchcount++;
                } else {
                    /*If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again.*/
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        };
    </script>
	
   
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'></script><script  src="./script.js"></script>

</body>
</html>
