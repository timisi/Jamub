<?php error_reporting(0);?>
<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php

	$did=intval($_GET['leaveid']);
	$sql="update tblleave set IsRead=:isread where id=:did";
	$query = $dbh->prepare($sql);
	$query->bindParam(':isread',$isread,PDO::PARAM_STR);
	$query->bindParam(':did',$did,PDO::PARAM_STR);
	$query->execute();

?>

<style>
	input[type="text"]
	{
	    font-size:16px;
	    color: #0f0d1b;
	    font-family: Verdana, Helvetica;
	}

	.btn-outline:hover {
	  color: #fff;
	  background-color: #524d7d;
	  border-color: #524d7d; 
	}

	textarea { 
		font-size:16px;
	    color: #0f0d1b;
	    font-family: Verdana, Helvetica;
	}

	textarea.text_area{
        height: 8em;
        font-size:16px;
	    color: #0f0d1b;
	    font-family: Verdana, Helvetica;
      }

	</style>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/jamublogo.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>APPRAISAL REQUEST</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Appraisal</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<!-- <div class="dropdown show">
								<a class="btn btn-primary" href="report_pdf.php?leave_id=<?php //echo $_GET['leaveid'] ?>">
									Generate Report
								</a>
							</div> -->
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Appraisee Details</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					<form method="post" action="">

						<?php 
						if(!isset($_GET['leaveid']) && empty($_GET['leaveid'])){
							header('Location: admin_dashboard.php');
						}
						else {
						
						$lid=intval($_GET['leaveid']);
						$sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.Gender,tblemployees.emp_id,tblemployees.Grade,tblemployees.Phonenumber,tblemployees.Subsidiary,tblemployees.Department,tblemployees.Line_Manager,tblemployees.Supervisor,tblemployees.EmailId,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.EvaluationType,tblleave.ReviewPeriod,tblleave.Challenges,tblleave.DateofLastReview,tblleave.PostingDate,tblleave.Sign,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where tblleave.id=:lid";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':lid',$lid,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{         
						?>  
							<div class="row">
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Full Name</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->FirstName." ".$result->LastName);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Partner's Designation</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Position_Staff);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Partner's ID</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-success" readonly value="<?php echo htmlentities($result->Staff_ID);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Phone Number</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->Phonenumber);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Appraisal Type</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->EvaluationType);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Applied Date</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-success" readonly value="<?php echo htmlentities($result->PostingDate);?>">
									</div>
								</div>

								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Period Under Review</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->ReviewPeriod);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Date of Last Review</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->DateofLastReview);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Partner's Grade</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Grade);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Subsidiary</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Subsidiary);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Department</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Department);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Line Manager's Name</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Line_Manager);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Supervisor's Name</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->Supervisor);?>">
									</div>
								</div>
							

							
								<div class="form-group row">
									<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Email Address</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-info" readonly value="<?php echo htmlentities($result->EmailId);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Gender</b></label>
										<input type="text" class="selectpicker form-control" data-style="btn-outline-success" readonly value="<?php echo htmlentities($result->Gender);?>">
									</div>
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="form-group">
										<label style="font-size:16px;"><b>Staff Signature</b></label>
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo '../signature/'.($result->Sign);?>" width="60" height="40" alt="">
										</div>
									</div>
								</div>
								</div>
							</div>

							<hr>
							<div class="row">
									<div class="col-sm-8">
										<h6 class="text-blue h6"><b>CHALLENGES ENCOUNTERED DURING THE PERIOD UNDER REVIEW</b></h6>
									</div>
									</div>
									<div class="form-group">
										<label>(Listed here are some of the issues that hampared the discharge of my responsibilities)</label>
										<textarea id="taskchallenges" name="taskchallenges" type="text" class="form-control" readonly autocomplete="off" placeholder=""><?php echo htmlentities($result->Challenges);?></textarea>
									</div>
							</div>

							<hr>

							<div class="card-box mb-30">
									<!-- TABLE DATA -->
									<div class="container-xl">
										<div class="table-responsive">
											<div class="table-wrapper">
												<div class="table-title">
												<div class="row">
													<div class="col-sm-8"><br>
														<h6 class="text-blue h6"><b>MAJOR ACHIEVEMENTS DURING PERIOD UNDER REVIEW</b></h6>
													</div>
													<div class="col-sm-4">
													</div>
												</div>
												</div>
												<!-- THE FORM TABLE  FOR TASK DONE START FROM HERE -->
												<table class="table table-striped table-hover table-bordered" id="">
													<thead>
														<tr>
															<th>TASKs DONE <i class="fa fa-sort"></i></th>
															<th>EXPECTED NUMBER OF TASK</th>
															<th>TOTAL ACHIEVED <i class="fa fa-sort"></i></th>
															<!-- <th>SCORES</th> -->
															<th>PERCENTAGE</th>
															<!-- <th>TOTAL PERCENTAGE</th> -->
														</tr>
													</thead>
													<tbody class="">
															<?php 
																$result = $dbh->prepare( "SELECT * from tblleave where id = '$lid' ORDER BY id Desc");
																$result->execute();
																while($row = $result->fetch()){
																
																	$is = explode('|', $row['TaskDone']);
																	$ip = explode('|', $row['ExpectedNumberofTask']);
																	$iv = explode('|', $row['TotalTaskAchieved']);
																	$it = explode('|', $row['taskpercentage']);

																	if(count($is)>1) {	
																		$all_scores = 0;												
																		for($r=0;$r<count($is);$r++) {
															?>
															<tr class="">
																<td class="form-group col-md-2" >
																	<?php echo $is[$r]; ?>
																</td>
																<td class="form-group col-md-2">
																	<input type="text" name="taskexpected1" id="taskqty" class="form-control" required="true" readonly autocomplete="off" value="<?php echo $ip[$r]; ?>">
																</td>
																<td class="form-group col-md-2">
																	<input type="text" name="taskexpected2" id="taskqty" class="form-control" required="true" readonly autocomplete="off" value="<?php echo $iv[$r]; ?>">
																</td>
																<td class="form-group col-md-2">
																	<input type="text" name="taskexpected3" id="taskqty" class="form-control" required="true" readonly autocomplete="off" value="<?php echo $it[$r]. "%"; ?>">
																</td>													
															</tr>
																<?php
																		$all_scores += ($it[$r]/100);
																	} 
																		$per_temp = ($all_scores / count($is)) * 100;
																		$percentage = number_format($per_temp, 2);															
																?>
																<td class="form-group col-md-2"><br>
																<label style="font-size:16px;"><b>Total Score In Percentage:</b></label>
																	<input type="text" name="trypercentage" id="taskqty" class="form-control" required="true" readonly autocomplete="off" value="<?php echo $percentage . "%"; ?>">
																</td>
																		<?php
																			} else
																				{
																	?>
															<tr class="">
																<td class="form-group col-md-2">
																	<?php echo $row['TaskDone']; ?>
																</td>
																<td class="form-group col-md-2">
																	<?php echo $row['ExpectedNumberofTask']; ?>
																</td>
																<td class="form-group col-md-2">
																	<?php echo $row['TotalTaskAchieved']; ?>
																</td>
																<td class="form-group col-md-2">
																	<?php echo $row['taskpercentage']; ?>
																</td>
															</tr> 
														<?php 
																				// if (!empty($percentage)) {
																				// 	$result = mysqli_query($conn,"update tblleave set total_arch_perc_average='$percentage' where tblleave.empid = tblemployees.emp_id AND tblleave.id='$did'") or die(mysqli_error($conn));
																				// 	echo "<script>alert('PERCENTAGE UPDATED');</script>";
																				// 	} 
																} 
																
															}
														?>
														<input type="hidden" name="num" class="num" value="1">
														
													</tbody>	
												</table>
												<!-- TOTAL SCORES HERE -->
												<div class="row">
												<div class="form-group col-md-2">
													<div class="form-group">
													
														<!-- <label style="font-size:16px;"><b>Total Score In Percentage:</b></label>
														<div class="avatar mr-2 flex-shrink-0">
															<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php //echo $arraysum . "%"; ?>">
														</div> -->
													</div>
												</div>
												<!-- THE FORM TABLE  FOR TASK DONE END HERE -->
												<hr>
											</div>
										</div>
										
							</div><br>
							<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<!-- <h4>APPRAISAL DETAILS</h4> -->
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<!-- <li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Appraisal</li> -->
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown show">
								<button type="submit" name="trysummit">
								<a class="btn btn-primary" name="trysummit" href="leave_details.php?leaveid=<?php echo $lid;?>">
									Kindly Appraise
								</a>
								</button>
							</div><br>
						</div>
					</div>
									</div>
							</div>

							<hr>
						</form>
						</div>

								</div>
							</div>
								</div>
							</div>

						<?php $cnt++;} } }?>
					</form>
				</div>

			</div>
			
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>