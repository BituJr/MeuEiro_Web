<?php

include('includes/Functions.php');

include ('includes/notification.php');

if(isset($_POST['submitin'])){
		$CategoryIds = $_POST['categoryid'];
		$Delete = "DELETE FROM account WHERE AccountId = $CategoryIds";
		$DeleteI = mysqli_query($mysqli,$Delete); 
		
		$msgBox = alertBox($DeleteAccount);
	}

if(isset($_POST['edit'])){
		$CategoryIds = $_POST['categoryid'];
		$CategoryName = $_POST['categoryedit'];
		
		$sql="UPDATE account SET AccountName = ? WHERE AccountId = $CategoryIds";
		if($statement = $mysqli->prepare($sql)){
		
			$statement->bind_param('s', $CategoryName);	
			$statement->execute();
			
		}
		$msgBox = alertBox($UpdateMsgAccount);
	}


if (isset($_POST['submit'])) {
		
		$category	= $mysqli->real_escape_string($_POST["account"]);	
		
		$sql="INSERT INTO account (UserId, AccountName) VALUES (?,?)";
		if($statement = $mysqli->prepare($sql)){
			
			$statement->bind_param('is',$UserId, $category);	
			$statement->execute();
		}
		$msgBox = alertBox($SaveMsgAccount);	
		
	}
	
$GetList = "SELECT AccountId, AccountName FROM account WHERE UserId = $UserId ORDER BY AccountName ASC";
$GetListCategory = mysqli_query($mysqli,$GetList); 

if (isset($_POST['searchbtn'])) {
	$SearchTerm = $_POST['search'];
	$GetList = "SELECT AccountId, AccountNama FROM account WHERE UserId = $UserId  AND AccountName
				like '%$SearchTerm%' ORDER BY AccountName ASC";
$GetListCategory = mysqli_query($mysqli,$GetList); 
	
}

	include ('includes/global.php');
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $ManageAccount; ?>	</h1>
                </div>
            </div>
			
            <?php if ($msgBox) { echo $msgBox; } ?>
                <a href="#new" class="btn white btn-success " data-toggle="modal"><i class="fa fa-plus"></i> <?php echo $NewAccount; ?></a>
            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-info">
					
                        <div class="panel-heading">
                            <i class="fa fa-tags"></i> <?php echo $ListAccount; ?> 
                        </div>
						
                        <div class="panel-body">
							<div class="pull-right">
								<form action="" method="post">
								<div class="form-group input-group col-lg-5	pull-right">
                                            <input type="text" name="search" placeholder="<?php echo $Search; ?>" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn btn-conta" name="searchbtn" type="input"><i class="fa fa-search"></i>
                                                </button>
                                            </span> 
                                 </div>
                                 </form> 
                                 
                            </div>     
                            <div class="">
                                <table class="table table-bordered table-hover table-striped" id="assetsdata">
                            <thead>
								<tr>
			                    <th class="text-left"><?php echo $Account; ?></th>
			                    <th class="text-left"><?php echo $Action; ?></th>
								</tr>
							</thead>

							<tbody>
								 <?php while($col = mysqli_fetch_assoc($GetListCategory)){ ?>
								<tr>
								<td><?php echo $col['AccountName'];?></td>
								
								<td colspan="2" class="notification">
									<a href="#EditCat<?php echo $col['AccountId'];?>" class="" data-toggle="modal"><span class="btn btn-delete1 btn-xs glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo $EditAccount; ?>"></span></a>
									<a href="#DeleteCat<?php echo $col['AccountId'];?>"  data-toggle="modal"><span class=" glyphicon glyphicon-trash btn btn-delete btn-xs" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo $DeleteAccounts; ?>"></span></a>			
								</td>
								</tr>
							</tbody>
							<div class="modal fade" id="DeleteCat<?php echo $col['AccountId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
                                <div class="modal-dialog">
                                    <div class="modal-content">
									<form action="" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo $AreYouSure; ?></h4>
                                        </div>
                                        <div class="modal-body">
                                           <?php echo $AccountMessage; ?>
                                        </div>
                                        <div class="modal-footer">
											 
											<input type="hidden" id="categoryid" name="categoryid" value="<?php echo $col['AccountId']; ?>" />
											<button type="input" id="submit" name="submitin" class="btn btn-primary"><?php echo $Yes; ?></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $Cancel; ?></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="modal fade" id="EditCat<?php echo $col['AccountId'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
                                <div class="modal-dialog">
                                    <div class="modal-content">
									<form action="" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo $EditAccount; ?></h4>
                                        </div>
                                        <div class="modal-body">
												<div class="form-group">
													<label for="category"><?php echo $Account; ?></label>
													<input class="form-control" required  name="categoryedit" value="<?php echo $col['AccountName']; ?>" type="text" autofocus>
												</div>
                                        </div>
                                        <div class="modal-footer">
											 
											<input type="hidden" id="categoryid" name="categoryid" value="<?php echo $col['AccountId']; ?>" />
											<button type="input" id="submit" name="edit" class="btn btn-primary"><?php echo $Save; ?></button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $Cancel; ?></button>
                                            </form>
                                        </div>
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
        </div>
  
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel"><?php echo $AddAccount; ?></h4>
						</div>
						
						<div class="modal-body">
							<div class="form-group">
								<label for="category"><?php echo $Account; ?></label>
								<input class="form-control" required placeholder="<?php echo $Account; ?>" name="account" type="text" autofocus>
							</div>
						</div>
						
						<div class="modal-footer">
							 
							<button type="submit" name="submit" class="btn btn-success"><span class=""></span>  <?php echo $Save; ?></button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $Cancel; ?></button>
					</form>
					</div>
				</div>
			</div>
		</div>



	<script>


    $(function() {
		
     $('.notification').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    });
    </script>
