<?php error_reporting(0);?>
<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php
	// code for update the read notification status
	include('../reviewmail.php');
	
	$isread=1;
	$did=intval($_GET['leaveid']);  
	date_default_timezone_set('Asia/Kolkata');
	$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
	$sql="update tblleave set IsRead=:isread where id=:did";
	$query = $dbh->prepare($sql);
	$query->bindParam(':isread',$isread,PDO::PARAM_STR);
	$query->bindParam(':did',$did,PDO::PARAM_STR);
	$query->execute();

	// code for action taken on leave
	if(isset($_POST['update']))
	{ 
		$did=intval($_GET['leaveid']);
		$status=$_POST['status'];   

		// Getting the signature
		$query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
        $row = mysqli_fetch_assoc($query);

        $signature = $row['signature'];
		$hodEmail = $row['EmailId'];
		$firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $hodFullname = "".$firstName."  ".$lastName."";

		// Getting the Staff of current leave

		// Getting data for the approval details 
		$acceptcrit = $row['exampleRadios1'];
		$demonstrates = $row ['exampleRadios2'];
		$meets = $row ['exampleRadios3'];
		$carefully = $row ['exampleRadios4'];
		$expressself = $row ['exampleRadios5'];
		$providesfeedbacks = $row ['exampleRadios6'];
		$regularlypresent = $row ['exampleRadios7'];
		$schedules = $row ['exampleRadios8'];
		$performs = $row ['exampleRadios9'];
		$identifiesand = $row ['exampleRadios10'];
		$comesup = $row ['exampleRadios11'];
		$knowledge = $row ['exampleRadios12'];
		$hasproper = $row ['exampleRadios13'];
		$workswell = $row ['exampleRadios14'];
		$willinglyaccepts = $row ['exampleRadios15'];
		$maintains = $row ['exampleRadios16'];
		$interestedin = $row ['exampleRadios17'];
		$motivatesand = $row ['exampleRadios18'];
		$establishesclear = $row ['exampleRadios19'];
		$delegatesclearly = $row ['exampleRadios20'];
		$adheresto = $row ['exampleRadios21'];
		$personalactions = $row ['exampleRadios22'];
		$cummunicateshigh = $row ['exampleRadios23'];
		$actionjustify = $row ['actionjustify'];
		$approvaljustification = $row ['approvaljustification'];

		$staffEmail = $_POST['emailID'];

		// $REMLEAVE = $av_leave - $num_days;
		$reg_status = 2;
		date_default_timezone_set('Asia/Kolkata');
		$admremarkdate=date('Y-m-d ', strtotime("now"));

		if ($status === '2') {
			$result = mysqli_query($conn,"update tblleave, tblemployees set tblleave.HodRemarks='$status',tblleave.HodSign='$signature',tblleave.HodDate='$admremarkdate',tblleave.acceptconstructive='$acceptcrit',tblleave.demonstratesapleasant='$demonstrates',tblleave.meetsestablished='$meets',tblleave.carefullyfollows='$carefully',tblleave.expressselfclearly='$expressself',tblleave.providesfeedbacks='$providesfeedbacks',tblleave.regularlypresent='$regularlypresent',tblleave.schedulesandusesleave='$schedules',tblleave.performsassignedduties='$performs',tblleave.identifiesandproffers='$identifiesand',tblleave.comesupwithnewideas='$comesup',tblleave.demonstratestheknowledge='$knowledge',tblleave.hasproperunderdtanding='$hasproper',tblleave.workswellwith='$workswell',tblleave.willinglyacceptswork='$willinglyaccepts',tblleave.maintainsconfidentiality='$maintains',tblleave.interestedinaswellasparticipates='$interestedin',tblleave.motivatesandbrings='$motivatesand',tblleave.stablishesclear='$establishesclear',tblleave.delegatesclearly='$delegatesclearly',tblleave.adheresto='$adheresto',tblleave.cummunicateshigh='$cummunicateshigh',tblleave.justifications='$justificationcomment',tblleave.actionjustification='$approvaljustification' where tblleave.empid = tblemployees.emp_id AND tblleave.id='$did'");

			if ($result) {
				if (filter_var($hodEmail, FILTER_VALIDATE_EMAIL)){
					if (filter_var($staffEmail, FILTER_VALIDATE_EMAIL)){
					approve_leave_mail($hodFullname,$staffEmail, "REJECTED");
				} else {
				echo "<script>alert('STAFF EMAIL IS INVALID. LEAVE APPLICATION REJECTED BUT NO EMAIL SENT');</script>";
				}
				
			} else {
				echo "<script>alert('YOUR EMAIL IS INVALID. LEAVE APPLICATION REJECTED BUT NO EMAIL SENT');</script>";
			}
			} else{
				die(mysqli_error());
			} 
		}
		elseif ($status === '1') {
			$result = mysqli_query($conn,"update tblleave, tblemployees set tblleave.HodRemarks='$status',tblleave.HodSign='$signature',tblleave.HodDate='$admremarkdate' where tblleave.empid = tblemployees.emp_id AND tblleave.id='$did'");

				if ($result) {
					if (filter_var($hodEmail, FILTER_VALIDATE_EMAIL)){
						 if (filter_var($staffEmail, FILTER_VALIDATE_EMAIL)){
							approve_leave_mail($hodFullname,$staffEmail, "APPROVED");
						 } else {
							echo "<script>alert('STAFF EMAIL IS INVALID. LEAVE APPLICATION APPROVED, BUT NO EMAIL SENT');</script>";
						 }
					
					} else {
						echo "<script>alert('YOUR EMAIL IS INVALID. LEAVE APPLICATION APPROVED, BUT NO EMAIL SENT');</script>";
					}
					
					} else{
					  die(mysqli_error());
				   }
		}
		else{
			echo "<script>alert('Error occured');</script>";
		}
	}

		// date_default_timezone_set('Asia/Kolkata');
		// $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));

		// $sql="update tblleaves set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";

		// $query = $dbh->prepare($sql);
		// $query->bindParam(':description',$description,PDO::PARAM_STR);
		// $query->bindParam(':status',$status,PDO::PARAM_STR);
		// $query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
		// $query->bindParam(':did',$did,PDO::PARAM_STR);
		// $query->execute();
		// echo "<script>alert('Leave updated Successfully');</script>";

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
								<h4>APPRAISAL DETAILS</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Appraisal</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown show">
								<a class="btn btn-primary" href="report_pdf.php?leave_id=<?php echo $_GET['leaveid'] ?>">
									Generate Report
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Appraisal Details</h4>
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
																		
																		} 
																		
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
																} }
														?>
														<input type="hidden" name="num" class="num" value="1">
														
													</tbody>	
												</table>
												<!-- TOTAL SCORES HERE -->
												<div class="row">
												<div class="form-group col-md-2">
													<div class="form-group">
													<?php //$xi++; }
																			$percentagescore1 = 20;
																			$percentagescore2 = 30;
																			$percentagescore3 = 40;
																			$percentagescore4 = 50;
																			// $totalsumofpercentage = 
																			$totalpercentagescore = ($percentagescore1 / $percentagescore2)* 100;
																		?>
														<label style="font-size:16px;"><b>Total Score In Percentage:</b></label>
														<div class="avatar mr-2 flex-shrink-0">
															<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo $it[$r]. "%"; ?>">
														</div>
													</div>
												</div>
												</div>
												<!-- THE FORM TABLE  FOR TASK DONE END HERE -->
												<hr>
											</div>
										</div>
									</div>
							</div>

							<hr>

							<!-- PART B OF THE APPRAISAL STARTs FROM HERE -->
							

							<div class="card-box mb-30">
									<!-- TABLE DATA -->
									<div class="container-xl">
										<div class="list-group">
											<br>
											<a href="#" class="list-group-item list-group-item-action active" style="background-color:DodgerBlue;">
												<div class="d-flex w-100 justify-content-between">
													<h5 class="mb-1">PART B (Kindly appraise this partner according to his/her Achievements)</h5>
													<small>For HOD</small>
												</div>
												<p class="mb-1">INSTRUCTIONS</p>
												<small>
													<ol>
														<li>Complete this form while evaluating the performance of the partner.</li>
														<li>Use the following rating codes to indicate the partners performance in each review area by selection the accurate rating for the partner</li>
													</ol>
													<span>5 = Exceptional (Excellent) | 4 = Exceeds Expectation (Very good) | 3 = Meets Expectations (Good) | 2 = Below Expectations (Fair) | 1 = Unsatisfactory (Poor) | N/A (Not Applicable)</span>
												</small>
										</a>
									</div>
									<br><br>
									<div class="card-box mb-30">
									<!-- TABLE DATA -->
									<div class="container-xl">
									<div class="table-responsive">
										<div class="table-wrapper">
											<div class="table-title">
											<div class="row">
												<div class="col-sm-8"><br>
													<h6 class="text-blue h6"><b></b></h6>
												</div>
												<div class="col-sm-4">
												</div>
											</div>
											</div>
											<!-- THE FORM TABLE  FOR TASK DONE START FROM HERE -->
											<table class="data-table table stripe hover nowrap table-bordered">
									<!-- PERSONALITY -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>1. PERSONALITY</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Accepts Contructive criticism without arguments.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios1" id="accept5" value="5">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios1" id="accept4" value="4">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios1" id="accept3" value="3">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios1" id="accept2" value="2">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios1" id="accept1" value="1">
												</div>
											</td>
										</tr>
										<tr>
											
										</tr>

										<tr>
											<td>Demonstrates a pleasant and calm personality when <br> dealing with fellow partners and clients.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios2" id="demonstrate5" value="5">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios2" id="demonstrate4" value="4">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios2" id="demonstrate3" value="3">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios2" id="demonstrate2" value="2">
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios2" id="demonstrate1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- QUALITY OF WORK -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>2. QUALITY OF WORK</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Meets established standards and consistently produces high <br> quality error-free work.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios3" id="meet5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios3" id="meet4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios3" id="meet3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios3" id="meet2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios3" id="meet1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Carefully follows established procedures in getting <br> the job done.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios4" id="carefully5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios4" id="carefully4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios4" id="carefully3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios4" id="carefully2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios4" id="carefully1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- COMMUNICATION -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>3. COMMUNICATION SKILLS</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Express self clearly both orally and in writting and shows <br> effectiveness in listening to others</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios5" id="express5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios5" id="express4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios5" id="express3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios5" id="express2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios5" id="express1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Provides feedbacks and relevant Information in a timely manner.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios6" id="demonstrate5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios6" id="demonstrate4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios6" id="demonstrate3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios6" id="demonstrate2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios6" id="demonstrate1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- QUALITY OF WORK -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>4. ATTENDANCE</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Regularly present and puntual.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios7" id="regularly5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios7" id="regularly4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios7" id="regularly3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios7" id="regularly2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios7" id="regularly1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Schedules and uses leave in a manner that is sensitive to department and workload.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios8" id="schedules5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios8" id="schedules4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios8" id="schedules3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios8" id="schedules2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios8" id="schedules1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- INITIATIVE/CREATIVITY -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>5. INITIATIVE/CREATIVITY</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Performs assigned duties with little or no supervision.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios9" id="perform5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios9" id="perform4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios9" id="perform3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios9" id="perform2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios9" id="perform1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Identifies and proffers solutions to operational problems and constraints.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios10" id="identifies5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios10" id="identifies4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios10" id="identifies3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios10" id="identifies2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios10" id="identifies1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td>Comes up with new ideas and persistently looks for ways of doing things better.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios11" id="comesup5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios11" id="comesup4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios11" id="comesup3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios11" id="comesup2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios11" id="comesup1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- JOB KNOWLEDGE -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>6. JOB KNOWLEDGE</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Demonstrates the knowledge, skill and competence to performeffectivelyon the job. </td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios12" id="demonstrates5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios12" id="demonstrates4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios12" id="demonstrates3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios12" id="demonstrates2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios12" id="demonstrates1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Has proper underdtanding of his/her role and its relevance to the Groups's mission and objectives.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios13" id="hasproper5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios13" id="hasproper4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios13" id="hasproper3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios13" id="hasproper2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios13" id="hasproper" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- COOPERATION/TEAMWORK -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>7. COOPERATION/TEAMWORK</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Works well with and coordinates own work with others to achieve common goal</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios14" id="workwell5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios14" id="workwell4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios14" id="workwell3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios14" id="workwell2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios14" id="workwell1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Willingly accepts work including chnages in assignments not related to jobs.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios15" id="willingly5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios15" id="willingly4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios15" id="willingly3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios15" id="willingly2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios15" id="willingly1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- PROFESSIONALISM -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>8. PROFESSIONALISM</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Maintains confidentiality of Information.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios16" id="maintains5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios16" id="maintains4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios16" id="maintains3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios16" id="maintains2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios16" id="maintains1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Interested in as well as participates in personal development programmes to <br> improve personal capacity to carry out job functions.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios17" id="interestedin5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios17" id="interestedin4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios17" id="interestedin3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios17" id="interestedin2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios17" id="interestedin1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- LEADERSHIP -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>9. LEADERSHIP</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Motivates and brings out the best in team members..</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios18" id="motivates5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios18" id="motivates4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios18" id="motivates3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios18" id="motivates2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios18" id="motivates1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Establishes clear Expectations and direction for the team.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios19" id="establishes5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios19" id="establishes4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios19" id="establishes3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios19" id="establishes2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios19" id="establishes1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td>Delegates clearly and provides support, including necessary resources to get the job done.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios20" id="delegates5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios20" id="delegates4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios20" id="delegates3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios20" id="delegates2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios20" id="delegates1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- INTEGRITY/ACCOUNTABILITY -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>10. INTEGRITY/ACCOUNTABILITY</b></td>
											<td><b>5</b></td>
											<td><b>4</b></td>
											<td><b>3</b></td>
											<td><b>2</b></td>
											<td><b>1</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Adheres to the Group's values, guidelines of conduct and policies.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios21" id="adheres5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios21" id="adheres4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios21" id="adheres3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios21" id="adheres2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios21" id="adheres1" value="1" >
												</div>
											</td>
										</tr>

										<tr>
											<td>Personal actions are consistent with words.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios22" id="personalactions5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios22" id="personalactions4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios22" id="personalactions3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios22" id="personalactions2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios22" id="personalactions1" value="1" >
												</div>
											</td>
										</tr>
										<tr>
											<td>Cummunicates high personal standards.</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios23" id="dcummunicateshigh5" value="5" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios23" id="cummunicateshigh4" value="4" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios23" id="cummunicateshigh3" value="3" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios23" id="cummunicateshigh2" value="2" >
												</div>
											</td>
											<td>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="exampleRadios23" id="cummunicateshigh1" value="1" >
												</div>
											</td>
										</tr>
									</tbody>
									<tr>
											<td><b></b></td>
											<td><b>Total Score (%):</b></td>
											<td><b></b></td>
										</tr>
								</table>
											<!-- THE FORM TABLE  FOR TASK DONE END HERE -->
											<hr>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="form-group col-md-4">
											<div class="form-group">
												<label style="font-size:16px;"><b>Grand Total Score In Percentage:</b></label>
												<?php
													if ($result->HodSign==""): ?>
												<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "NA"; ?>">
												<?php else: ?>
												<div class="avatar mr-2 flex-shrink-0">
													<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->HodDate); ?>">
												</div>
													<?php endif ?>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-8">
										<h6 class="text-blue h6"><b>KINDLY JUSTIFY THE INFORMATION SUPPLIED</b></h6>
										</div>
									</div>
									<div class="form-group">
										<textarea id="taskchallenges" name="approvaljustification" type="text" class="form-control" autocomplete="off" placeholder="Justifications&hellip;"></textarea>
									</div>
									<hr><br>
									<div class="form-group row">
							
									<div class="col-md-6 col-sm-12">
							    <div class="form-group">
									<label style="font-size:16px;"><b>HOD's Approval</b></label>
									<?php
									if ($result->HodSign==""): ?>
									  <input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "NA"; ?>">
									<?php else: ?>
									  <div class="avatar mr-2 flex-shrink-0">
										<img src="<?php echo '../signature/'.($result->HodSign);?>" width="100" height="40" alt="">
									  </div>
									<?php endif ?>
							    </div>
							</div>
							
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label style="font-size:16px;"><b>HRM's Approval</b></label>
									<?php
									if ($result->RegSign==""): ?>
									  <input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "NA"; ?>">
									<?php else: ?>
									  <div class="avatar mr-2 flex-shrink-0">
										<img src="<?php echo '../signature/'.($result->RegSign);?>" width="100" height="40" alt="">
									  </div>
									<?php endif ?>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-6 col-sm-12">
							    <div class="form-group">
									<label style="font-size:16px;"><b>Date For HOD's Action</b></label>
									<?php
									if ($result->HodDate==""): ?>
									  <input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "NA"; ?>">
									<?php else: ?>
									  <div class="avatar mr-2 flex-shrink-0">
										<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->HodDate); ?>">
									  </div>
									<?php endif ?>
							    </div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label style="font-size:16px;"><b>Date For HRM's Action</b></label>
									<?php
									if ($result->RegDate==""): ?>
									  <input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "NA"; ?>">
									<?php else: ?>
									  <div class="avatar mr-2 flex-shrink-0">
										<input type="text" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->RegDate); ?>">
									  </div>
									<?php endif ?>
								</div>
							</div>
						</div>


						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label style="font-size:16px;"><b>Appraisal Status From HOD</b></label>
									<?php $stats=$result->HodRemarks;?>
									<?php
									if ($stats==1): ?>
									  <input type="text" style="color: green;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Approved"; ?>">
									<?php
									 elseif ($stats==2): ?>
									  <input type="text" style="color: red; font-size: 16px;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Rejected"; ?>">
									  <?php
									else: ?>
									  <input type="text" style="color: blue;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Pending"; ?>">
									<?php endif ?>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label style="font-size:16px;"><b>Appraisal Status From HRM</b></label>
									<?php $stats=$result->RegRemarks;?>
									<?php
									if ($stats==1): ?>
									  <input type="text" style="color: green;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Approved"; ?>">
									<?php
									 elseif ($stats==2): ?>
									  <input type="text" style="color: red; font-size: 16px;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Rejected"; ?>">
									  <?php
									else: ?>
									  <input type="text" style="color: blue;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Pending"; ?>">
									<?php endif ?>
								</div>
							</div>

							<?php 
							if(($stats==0 AND $ad_stats==0) OR ($stats==2 AND $ad_stats==0) OR ($stats==2 AND $ad_stats==2))
							  {

							 ?>
							<div class="col-md-4">
								<div class="form-group">
									<label style="font-size:16px;"><b></b></label>
									<div class="modal-footer justify-content-center">
										<button class="btn btn-primary" id="action_take" data-toggle="modal" data-target="#success-modal">Take&nbsp;Action</button>
									</div>
								</div>
							</div>

							<form name="adminaction" method="post">
  								<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body text-center font-18">
												<h4 class="mb-20">Leave take action</h4>
												<select name="status" required class="custom-select form-control">
													<option value="">Choose your option</option>
				                                          <option value="1">Approved</option>
				                                          <option value="2">Rejected</option>
												</select>
											</div>
											<div class="modal-footer justify-content-center">
												<input type="submit" class="btn btn-primary" name="update" value="Submit">
											</div>
										</div>
									</div>
								</div>
  							</form>

							 <?php }?> 
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