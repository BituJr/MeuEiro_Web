<?php


include('includes/Functions.php');


include ('includes/notification.php');

$SearchTerm = '';
if (isset($_POST['submitin'])) {
	
		$BillsId = $_POST['BillsId'];	
		
		$Delete = "DELETE FROM bills WHERE BillsId = $BillsId";
		$DeleteI = mysqli_query($mysqli,$Delete); 
		
		$msgBox = alertBox($DeleteExpense);
	}

$GetExpenseHistory = "SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = $UserId ORDER BY bills.Dates DESC";
$ExpenseHistory = mysqli_query($mysqli,$GetExpenseHistory); 

$GetAllBillsDate    = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND MONTH(Dates) = MONTH (CURRENT_DATE())";
$GetABillsDate      = mysqli_query($mysqli, $GetAllBillsDate);
$BillsColDate       = mysqli_fetch_assoc($GetABillsDate);

$GetAllBillsToday       = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND Dates = CURRENT_DATE()";
$GetABillsDateToday         = mysqli_query($mysqli, $GetAllBillsToday);
$BillsColDateToday          = mysqli_fetch_assoc($GetABillsDateToday);

if (isset($_POST['searchbtn'])) {
	$SearchTerm = $_POST['search'];
	$GetExpenseHistory = "SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where 
                    (bills.Title like '%$SearchTerm%' 
                    OR account.AccountName like '%$SearchTerm%'
                    OR bills.Description like '%$SearchTerm%' 
                    OR category.CategoryName like '%$SearchTerm%')
                    AND bills.UserId = $UserId ORDER BY bills.Dates DESC";
$ExpenseHistory = mysqli_query($mysqli,$GetExpenseHistory); 
	
}

	include ('includes/global.php');
	
	
?>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $ExpenseReports; ?></h1>
			</div>
		</div>
		<a href="index.php?paginas=Despesas" class="btn white btn-success "><i class="fa fa-plus"></i> <?php echo $NewExpenses; ?></a>
	   
		<div class="row">
			<?php if ($msgBox) { echo $msgBox; } ?>
			<div class="col-lg-12">
				<div class="panel panel-red">
					<div class="panel-heading">
					   <i class="glyphicon glyphicon-list-alt"></i> <?php echo $HistoryofExpense; ?>  
					</div>
					
					<div class="panel-body">
						<div class="pull-right">
							<form action="" method="post">
								<div class="form-group input-group col-lg-5	pull-right">
										<input type="text" name="search" placeholder="<?php echo $Search; ?>" class="form-control">
										<span class="input-group-btn">
											<button class="btn btn-delete" name="searchbtn" type="input"><i class="fa fa-search"></i>
											</button>
										</span> 
								</div>
							 </form> 
							 
						</div>     
						<div class="">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th class="text-left"><?php echo $Title; ?></th>
										<th class="text-left"><?php echo $Date; ?></th>
										<th class="text-left"><?php echo $Category; ?></th>
										<th class="text-left"><?php echo $Account; ?></th>
										<th class="text-left"><?php echo $Description; ?></th>
										<th class="text-left"><?php echo $Amount; ?></th>
										<th class="text-left"><?php echo $Action; ?></th>
									</tr>
								</thead>

								<tbody>
									 <?php while($col = mysqli_fetch_assoc($ExpenseHistory)){ ?>
									<tr>
									<td><?php echo $col['Title'];?></td>
									<td><?php echo date("M d Y",strtotime($col['Dates']));?></td>
									<td><?php echo $col['CategoryName'];?></td>
									<td><?php echo $col['AccountName'];?></td>
									<td><?php echo $col['Description'];?></td>
									<td><?php echo $ColUser['Currency'].' '.number_format($col['Amount']);?></td>
									<td colspan="2" class="notification">
										<a href="index.php?paginas=GerenciarDespesas&id=<?php echo $col['BillsId'];?>" class="" data-toggle="modal"><span class="btn btn-delete1 btn-xs glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditExpense; ?>"></span></a>
										<a href="#DeleteEx<?php echo $col['BillsId'];?>"  data-toggle="modal"><span class=" glyphicon glyphicon-trash btn btn-delete btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $DeleteExpenses; ?>"></span></button>					
									</td>
									</tr>
								</tbody>
								<div class="modal fade" id="DeleteEx<?php echo $col['BillsId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="" method="post">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><?php echo $AreYouSure; ?></h4>
												</div>
												<div class="modal-body">
													<?php echo $ThisItem; ?>
												</div>
												<div class="modal-footer">
													 
													<input type="hidden" id="BillsId" name="BillsId" value="<?php echo $col['BillsId']; ?>" />
													<button type="input" id="submit" name="submitin" class="btn btn-primary"><?php echo $Yes; ?></button>
													<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $Cancel; ?></button>
												</div> 
											</form>	
										</div>
									</div>
								</div>
								 <?php } ?> 
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	   
		<div class="row">
			<div class="col-lg-12">
			   
			</div>
		</div>
    </div>

