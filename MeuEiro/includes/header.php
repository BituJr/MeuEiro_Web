<?php
include ('includes/notification.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MeuEiro - Gerenciador financeiro</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="js/plugins/fullcalender/fullcalendar.css" rel="stylesheet">

     <link href="css/datepicker.css" rel="stylesheet">

    <link href="css/plugins/morris.css" rel="stylesheet">

    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

     <script src="js/jquery-1.11.0.js"></script>
     <script src="js/plugins/metisMenu/metisMenu.js"></script>
</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="headmain">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">MeuEiro - Gerenciador financeiro</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li>
                     <?php 
                    echo $Welcome;?>, 
                    <?php 
                    echo $ColUser["FirstName"]." ".$ColUser['LastName'];?>
                </li>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="index.php?action=logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $Logout;?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav font-sidebar" id="side-menu">
						
						<li>
                            <a <?php ActiveClass("index");?> href="index.php"><i class="glyphicon glyphicon-home"></i>  <?php echo $Dashboard;?><span class="fa arrow"></a>
                        </li>
                        
                        <li>
                            <a <?php ActiveClass("index.php?paginas=RelatorioReceita");?> href="index.php?paginas=RelatorioReceita"><i class="glyphicon glyphicon-stats"></i>  <?php echo $Incomes;?><span class="fa arrow"></span></a>
                        </li>
						
                        <li>
							<li> 
								<a <?php ActiveClass("index.php?paginas=RelatorioDespesa");?> href="index.php?paginas=RelatorioDespesa" ><i class="glyphicon glyphicon-list-alt"></i> <?php echo $Expenses;?><span class="fa arrow"></span></a> 
							</li>      
                        </li>
						<li>
							<a <?php ActiveClass("index.php?paginas=Contas");?> href="index.php?paginas=Contas"> <i class="fa fa-tags"></i> <?php echo $Account;?><span class="fa arrow"></a>
                        </li>
                        
						<li>
							<a class="parent" href="javascript:void(0)"><i class="fa fa-gears"> </i> <?php echo $CategorySettings;?><span class="fa arrow"></a>
							<ul class="nav nav-second-level" id="subitem">
                                <li>
                                    <a <?php ActiveClass("index.php?paginas=CategoriaReceita");?> href="index.php?paginas=CategoriaReceita"><i class="fa fa-caret-right"></i> <?php echo $CategoryIncome;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?paginas=CategoriaDespesa");?> href="index.php?paginas=CategoriaDespesa"><i class="fa fa-caret-right"></i> <?php echo $CategoryExpense;?></a>
                                </li> 
							</ul>
                        </li>
                        
                        </li>
                            <li><a <?php ActiveClass("index.php?paginas=Orcamento");?> href="index.php?paginas=Orcamento"><i class="fa fa-archive"></i> <?php echo $BudgetsM;?><span class="fa arrow"></a>
                        </li>

                        <li>
                            <a class="parent" href="javascript:void(0)"><i class="fa fa-print"> </i> <?php echo $ReportsGraphs;?><span class="fa arrow"></a>
                            <ul class="nav nav-second-level" >

                                 <li>
                                    <a <?php ActiveClass("index.php?paginas=ReceitaVsDespesa");?> id="subitem" href="index.php?paginas=ReceitaVsDespesa"><i class="fa fa-caret-right"> </i> <?php echo $IncomeVsExpense;?></a>
                                </li>
                                
                                <li>
                                    <a <?php ActiveClass("index.php?paginas=CalendarioReceitas");?> id="subitem" href="index.php?paginas=CalendarioReceitas"><i class="fa fa-caret-right"> </i> <?php echo $IncomeCalender;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?paginas=CalendarioDespeseas");?> id="subitem" href="index.php?paginas=CalendarioDespeseas"><i class="fa fa-caret-right"> </i> <?php echo $ExpenseCalender;?></a>
                                </li>                             
                            </ul>
                        </li> 
                    </ul>
                </div>
            </div> 
        </nav>
    </div>
</body>

<script>

$(document).ready(function () {
    $(this).parent().addClass("collapse");
    $(".parent").on('click', function () {
        $(this).parent().find("#subitem").slideToggle();
    });
});

</script>

      
