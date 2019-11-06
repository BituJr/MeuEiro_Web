<?php

$msgBoxExpense='';

include('includes/Functions.php');

include ('includes/notification.php');

if(isset($_POST['income'])){
		$iuser			= $_SESSION['UserId'];
		$iname 			= $mysqli->real_escape_string($_POST["iname"]);
		$icategory		= $mysqli->real_escape_string($_POST["icategory"]);
		$iaccount		= $mysqli->real_escape_string($_POST["iaccount"]);
		$idescription	= $mysqli->real_escape_string($_POST["idescription"]);
		$idate			= $mysqli->real_escape_string($_POST["idate"]);
		$iamount		= $mysqli->real_escape_string(clean($_POST["iamount"]));

        if($iuser == '' OR $iamount == '' ) {
                $msgBox = alertBox($MessageEmpty);
            } else{

        if($iamount < 0){
            $msgBox = alertBox($NegativeAmount);
        }else{
	
		$sql="INSERT INTO assets (UserId, Title, Date, CategoryId, AccountId, Amount, Description) VALUES (?,?,?,?,?,?,?)";
		if($statement = $mysqli->prepare($sql)){
			
			$statement->bind_param('issiiss',$iuser, $iname, $idate, $icategory, $iaccount, $iamount, $idescription);	
			$statement->execute();
		}
		$msgBox = alertBox($SaveMsgIncome);
        }
     }
	}

//save Expense form
if(isset($_POST['expense'])){
		$euser			= $_SESSION['UserId'];
		$ename 			= $mysqli->real_escape_string($_POST["ename"]);
		$ecategory		= $mysqli->real_escape_string($_POST["ecategory"]);
		$eaccount		= $mysqli->real_escape_string($_POST["eaccount"]);
		$edescription	= $mysqli->real_escape_string($_POST["edescription"]);
		$edate			= $mysqli->real_escape_string($_POST["edate"]);
		$eamount		= $mysqli->real_escape_string(clean($_POST["eamount"]));

        if($ename == '' OR $eamount == '' ) {
                $msgBox = alertBox($MessageEmpty);
            } else{

		if($eamount < 0){
            $msgBoxExpense = alertBox($NegativeAmount);
        }else{
		
		
		$sql="INSERT INTO bills (UserId, Title, Dates, CategoryId, AccountId, Amount, Description) VALUES (?,?,?,?,?,?,?)";
		if($statement = $mysqli->prepare($sql)){
			
			$statement->bind_param('issiiss',$euser, $ename, $edate, $ecategory, $eaccount, $eamount, $edescription);	
			$statement->execute();
		}
		$msgBoxExpense = alertBox($SaveMsgExpense);
        }
	}

}

?>        
        
	
	<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><?php echo $Expenses ;?></h1>
				</div>
			</div>
			
		<div class="row">
			<div class="col-lg-12 ">
				   <?php if ($msgBoxExpense) { echo $msgBoxExpense; } ?>
				<div class="panel panel-danger">
						<div class="panel-heading">
							<i class="fa fa-minus"></i> <?php echo $Expenses ;?>
						</div>
					<div class="panel-body">
					<form action="" method="post" role="form">
						<fieldset>
							<div class="form-group col-lg-6">
								<label for="ename"><?php echo $Name ;?></label>
								<input class="form-control" required placeholder="<?php echo $Name ;?>" name="ename" type="text" autofocus>
							</div>
							 <div class="form-group col-lg-5">
								 <label for="eamount" class="control-label"><?php echo $Amount ;?></label> 
									 <div class="input-group">
										 <span class="input-group-addon"><?php echo $ColUser['Currency'];?></span>                                      
										 <input class="form-control" required placeholder="<?php echo $Amount ;?>"  id="iamount" name="eamount" type="text" value="">
									 </div>
						   </div>
						   <div class="form-group  col-lg-6">
								<label for="ecategory"><?php echo $Category ;?></label>
								<select name="ecategory" class="form-control">
									<?php while($col = mysqli_fetch_assoc($expense)){ ?>
									<option value="<?php echo $col['CategoryId'];?>"><?php echo $col['CategoryName'];?></option>
									<?php } ?>
								</select>
							</div>                                 
						   
						   <div class="form-group  col-lg-5">
								 <label for="eaccount"><?php echo $Account ;?></label>
								<select name="eaccount" class="form-control">
									 <?php while($col = mysqli_fetch_assoc($AccountExpense)){ ?>
									<option value="<?php echo $col['AccountId'];?>"><?php echo $col['AccountName'];?></option>
									<?php } ?>
								</select>
						   </div>

						   <div class="form-group col-lg-6" id="expense">
								 <label for="edate"><?php echo $Date ;?></label>
								<div class="input-group date">
									<input name="edate" class="form-control" type="text"  value="<?php echo date("Y-m-d");?>">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
						   </div>

							 <div class="form-group col-lg-6 ">
								 <label for="edescription"><?php echo $Description ;?></label>
								<textarea name="edescription" class="form-control"></textarea>
						   </div>     
						                           
						</fieldset>
									   
					</div>
							<div class="panel-footer">
									<button type="submit" name="expense" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span>  <?php echo $SaveExpense ;?></button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>


