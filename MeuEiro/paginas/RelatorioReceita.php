<?php

include('includes/Functions.php');


include ('includes/notification.php');


$SearchTerm = '';

if (isset($_POST['submitin'])) {
	
		$IncomeIds = $_POST['incomeid'];	
		
		$GetAccountId = "SELECT AccountId FROM assets WHERE UserId = $UserId and AssetsId = $IncomeIds";
		$AccountId = mysqli_query($mysqli,$GetAccountId);
		$ColId = mysqli_fetch_array($AccountId);
		$AccId = $ColId['AccountId'];
		
		$Delete = "DELETE FROM assets WHERE AssetsId = $IncomeIds";
		$DeleteI = mysqli_query($mysqli,$Delete); 
		
		$TotalIncome = "UPDATE totals SET totals.Totals = (SELECT SUM(Amount) FROM assets where assets.UserId = $UserId AND assets.AccountId = totals.AccountId) \n"
    . "	WHERE totals.UserId = $UserId AND totals.AccountId = $AccId";
		$UpdateTotalIncome = mysqli_query($mysqli,$TotalIncome);
		if(!$UpdateTotalIncome){
			$Gagal="QUERY ERROR";
				 $msgBox = alertBox($Gagal);
			}
		
		$msgBox = alertBox($DeleteIncome);
	}
	

$GetIncomeHistory = "SELECT * from assets left join category on assets.CategoryId = category.CategoryId left join account on assets.AccountId = account.AccountId where assets.UserId = $UserId ORDER BY assets.Date DESC";
$IncomeHistory = mysqli_query($mysqli,$GetIncomeHistory); 



$GetAllIncomeDate 	 = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND MONTH(Date) = MONTH (CURRENT_DATE())";
$GetAIncomeDate		 = mysqli_query($mysqli, $GetAllIncomeDate);
$IncomeColDate 		 = mysqli_fetch_assoc($GetAIncomeDate);


$GetAllIncomeDateToday 		 = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND Date = CURRENT_DATE()";
$GetAIncomeDateToday		 = mysqli_query($mysqli, $GetAllIncomeDateToday);
$IncomeColDateToday 		 = mysqli_fetch_assoc($GetAIncomeDateToday);




if (isset($_POST['searchbtn'])) {
	$SearchTerm = $_POST['search'];
	$GetIncomeHistory = "SELECT * from assets left join category on assets.CategoryId = category.CategoryId left join account on assets.AccountId = account.AccountId where 
					(assets.Title like '%$SearchTerm%' 
					OR account.AccountName like '%$SearchTerm%'
					OR assets.Description like '%$SearchTerm%' 
					OR category.CategoryName like '%$SearchTerm%')
					AND assets.UserId = $UserId ORDER BY assets.Date DESC";
$IncomeHistory = mysqli_query($mysqli,$GetIncomeHistory); 
	
}
	include ('includes/global.php');

?>

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $AssetReports ;?></h1>
                </div>
            </div>
            <?php if ($msgBox) { echo $msgBox; } ?>
           <a href="index.php?paginas=Receitas" class="btn white btn-success "><i class="fa fa-plus"></i> <?php echo $NewIncome; ?></a>
          
		<div class="row">
			
			<div class="col-lg-12">
				<div class="panel panel-green">
				
					<div class="panel-heading">
					   <i class="glyphicon glyphicon-stats"></i> <?php echo $HistoryofAssets ;?>
					</div>
					
					<div class="panel-body">
						<div class="pull-right">
							<form action="" method="post">
								<div class="form-group input-group col-lg-5	pull-right">
									<input type="text" name="search" placeholder="<?php echo $Search ;?>" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-delete1" name="searchbtn" type="input"><i class="fa fa-search"></i>
										</button>
									</span> 
								</div>
							</form> 
							 
						</div>     
						<div class="">
							<table class="table table-bordered table-hover table-striped" id="assetsdata">
								<thead>
									<tr>
										<th class="text-left"><?php echo $Title ;?></th>
										<th class="text-left"><?php echo $Date ;?></th>
										<th class="text-left"><?php echo $Category ;?></th>
										<th class="text-left"><?php echo $Account ;?></th>
										<th class="text-left"><?php echo $Description ;?></th>
										<th class="text-left"><?php echo $Amount ;?></th>
										<th class="text-left"><?php echo $Action ;?></th>
									   
									</tr>
								</thead>

								<tbody>
									 <?php while($col = mysqli_fetch_assoc($IncomeHistory)){ ?>
									<tr>
									<td><?php echo $col['Title'];?></td>
									<td><?php echo date("M d Y",strtotime($col['Date']));?></td>
									<td><?php echo $col['CategoryName'];?></td>
									<td><?php echo $col['AccountName'];?></td>
									<td><?php echo $col['Description'];?></td>
									<td><?php echo $ColUser['Currency'].' '.number_format($col['Amount']);?></td>
									<td colspan="2" class="notification">
										<a href="index.php?paginas=GerenciarReceitas&id=<?php echo $col['AssetsId'];?>" class="" data-toggle="modal"><span class="btn btn-delete1 btn-xs glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditIncome ;?>"></span></a>
								<a href="#DeleteIncome<?php echo $col['AssetsId'];?>"  data-toggle="modal"><span class=" glyphicon glyphicon-trash btn btn-delete btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $DeleteIncomes ;?>"></span></button>			
									</td>
									</tr>
								</tbody>
								
								<div class="modal fade" id="DeleteIncome<?php echo $col['AssetsId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
									<div class="modal-dialog">
										<div class="modal-content">
											<form action="" method="post">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><?php echo $AreYouSure ;?></h4>
												</div>
												<div class="modal-body">
													<?php echo $ThisItem ;?>
												</div>
												<div class="modal-footer">
													<input type="hidden" id="incomeid" name="incomeid" value="<?php echo $col['AssetsId']; ?>" />
													<button type="input" id="submit" name="submitin" class="btn btn-primary"><?php echo $Yes ;?></button>
													<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $Cancel ;?></button>
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
   

