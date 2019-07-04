<?php include "includes/admin_header.php" ?>
<?php
if(admin_logged_in()){
} else {
redirect("admin_login.php");
}
?>
<?php include "includes/admin_navigation.php" ?>

<div id="wrapper">
	<div class="container-fluid">
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 col-md-offset-2" style="padding-bottom: 100px;">
						<div class="text-center">
							<h1 class="page-header">
							Add Subject
							</h1>
							
<?php display_message();  ?>
<?php validate_addSubject(); ?>

						</div>
						<div class="well well-sm" style="background-color:white;">
							<form method="post" action="">
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<br>
										<div class="form-group">
											<label for="name">Subject Code</label>
											<input type="text" class="form-control" id="subject_code" name="subject_code" placeholder="Enter subject code" required>
										</div>
										
										<div class="form-group">
											<label for="name">Subject name</label>
											<input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Enter subject name" required>
											<br>
											<button type="submit" class="btn btn-success pull-right" id="btnContactUs" value="Go!">
											Submit</button>
										</div>
									</div>
								</div>
								<br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "includes/admin_footer.php" ?>