<?php

include('includes/Functions.php');

include ('includes/notification.php');

if(isset($_POST['change'])){
		if($_POST['email'] == '' || $_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['password'] == '' || $_POST['rpassword'] == '') {
				$msgBox = alertBox($SignUpEmpty);
			} else if($_POST['password'] != $_POST['rpassword']) {
				$msgBox = alertBox($PwdNotSame);
				
			} else {
				
				$Email 		= $mysqli->real_escape_string($_POST['email']);
				$Password 	= encryptIt($_POST['password']);
				$FirstName	= $mysqli->real_escape_string($_POST['firstname']);
				$LastName	= $mysqli->real_escape_string($_POST['lastname']);
				
				$sql="UPDATE user SET FirstName = ?, LastName = ?, Email = ?, Password = ? WHERE UserId = $UserId";
				if($statement = $mysqli->prepare($sql)){
					
					$statement->bind_param('sssss', $FirstName, $LastName, $Email, $Password);	
					$statement->execute();
				}
				$msgBox = alertBox($SuccessAccountUpdate);
			}
	}

$GetUsers	 	 = "SELECT FirstName, LastName, Email, Password from user WHERE UserId = $UserId";
$GetUserq		 = mysqli_query($mysqli, $GetUsers);
$UserInfos 		 = mysqli_fetch_assoc($GetUserq);

	include ('includes/global.php');
	
	
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $ManageAccount; ?>	</h1>
			</div>
		</div>
		
					
		<div class="row">
			<?php if ($msgBox) { echo $msgBox; } ?>
			<div class="col-lg-12">
				<div class="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-bar-chart-o fa-fw"></i>
							
						</div>

					<div class="panel-body">
						<form method="post" action="" role="form">
							<fieldset>
								<div class="form-group col-lg-6">
									<label for="email"><?php echo $Emails; ?></label>
									<input class="form-control"  required placeholder="<?php echo $Emails; ?>" name="email" type="email"  value="<?php echo $UserInfos['Email'];?>" autofocus>
								</div>
								<div class="form-group col-lg-6">
									<label for="email"><?php echo $FirstNames; ?></label>
									<input class="form-control"  required placeholder="<?php echo $FirstNames; ?>" value="<?php echo $UserInfos['FirstName'];?>" name="firstname" type="text" >
								</div>
								<div class="form-group col-lg-6">
									<label for="email"><?php echo $LastNames; ?></label>
									<input class="form-control"  required placeholder="<?php echo $LastNames; ?>" name="lastname"  value="<?php echo $UserInfos['LastName'];?>" type="text" >
								</div>
								
								<div class="form-group col-lg-6">
									 <label for="password"><?php echo $Passwords; ?></label>
									<input class="form-control"  placeholder="<?php echo $Passwords; ?>" name="password" type="password" value="">
							   </div>
								<div class="form-group col-lg-6">
									 <label for="password"><?php echo $RepeatPassword; ?></label>
									<input class="form-control"  placeholder="<?php echo $RepeatPassword; ?>" name="rpassword" type="password" value="">
							   </div>
							   <hr>

							   <div class="form-group col-lg-12 text-center">
                                <button type="submit" name="change" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span>  <?php echo $Save; ?></button>
                               </div>
							</fieldset>
						</form>
					</div>
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
