<?php error_reporting(0);?>
<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php
	// code for update the read notification status
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
		// $av_leave=$_POST['av_leave'];
		// $num_days=$_POST['num_days'];

		// Getting the signature
		$query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'") or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($query);

        $signature = $row['signature'];
		$firstName = $row['FirstName'];
        $lastName = $row['LastName'];

		$hrmapprovalcomment = $_POST['hrmapprovalcomment'];
		// global $overallscore_g;
		$grandtotal = $_POST['grandtotal'];

		// $REMLEAVE = $av_leave - $num_days;

		date_default_timezone_set('Asia/Kolkata');
		$admremarkdate=date('Y-m-d ', strtotime("now"));

		if ($status === '2') {
			$result = mysqli_query($conn,"update tblleave, tblemployees set tblleave.RegRemarks='$status',tblleave.RegSign='$signature',tblleave.RegDate='$admremarkdate',tblleave.total_overall_score='$grandtotal',tblleave.hrmapprovalcomment='$hrmapprovalcomment' where tblleave.empid = tblemployees.emp_id AND tblleave.id='$did'");

			if ($result) {
				 echo "<script>alert('Appraisal Request Rejected Successfully');</script>";
				 echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
				} else{
				  die(mysqli_error($conn));
			   }
	}
		elseif ($status === '1') {
				$result = mysqli_query($conn,"update tblleave, tblemployees set tblleave.RegRemarks='$status',tblleave.RegSign='$signature',tblleave.RegDate='$admremarkdate',tblleave.total_overall_score='$grandtotal',tblleave.hrmapprovalcomment='$hrmapprovalcomment' where tblleave.empid = tblemployees.emp_id AND tblleave.id='$did'");

				if ($result) {
			     	echo "<script>alert('Appraisal Approved Successfully');</script>";
					 echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
					} else{
					  die(mysqli_error($conn));
				   }
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
									<li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Appraisal</li>
								</ol>
							</nav>
						</div>
						<!-- <div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown show">
								<a class="btn btn-primary" href="report_pdf.php?leave_id=<?php //echo $_GET['leaveid'] ?>">
									Generate Report
								</a>
							</div>
						</div> -->
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
						$sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.Gender,tblemployees.emp_id,tblemployees.Grade,tblemployees.Phonenumber,tblemployees.Subsidiary,tblemployees.Department,tblemployees.Line_Manager,tblemployees.Supervisor,tblemployees.EmailId,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.EvaluationType,tblleave.ReviewPeriod,tblleave.Challenges,tblleave.DateofLastReview,tblleave.PostingDate,tblleave.Sign,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate,tblleave.acceptconstructive,tblleave.demonstratesapleasant,tblleave.meetsestablished,tblleave.carefullyfollows,tblleave.expressselfclearly,tblleave.providesfeedbacks,tblleave.regularlypresent,tblleave.schedulesandusesleave,tblleave.performsassignedduties,tblleave.identifiesandproffers,tblleave.comesupwithnewideas,tblleave.demonstratestheknowledge,tblleave.hasproperunderdtanding,tblleave.workswellwith,tblleave.willinglyacceptswork,tblleave.maintainsconfidentiality,tblleave.interestedinaswellasparticipates,tblleave.motivatesandbrings,tblleave.stablishesclear,tblleave.delegatesclearly,tblleave.adheresto,tblleave.cummunicateshigh,tblleave.justifications,tblleave.hrmapprovalcomment,tblleave.personalactions,tblleave.personalityscore,tblleave.qowscore,tblleave.communicationsore,tblleave.attendancescore,tblleave.creativityscore,tblleave.jobknowledgescore,tblleave.teamworkscore,tblleave.professionalismscore,tblleave.leadershipscore,tblleave.integrityscore,tblleave.part_b_totalscore_percentage from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where tblleave.id=:lid";
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
							<?php $cnt++;} } }?>
							<hr>


					<!-- TASK ACHIEVED START HERE -->
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
											<!-- <div class="search-box">
												<input type="text" class="form-control" placeholder="Search&hellip;">
												</div> -->
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
																		// $totalachievementpercentage = $percentage;
																		
																?>


																<td class="form-group col-md-2"><br>
																<label style="font-size:16px;"><b>Average Score: </b></label>
																<h7 style="font-size:11px;">
																	<i>Of all task done</i>
																</h7>
																	<input type="text" name="totalachievementpercentage" id="taskqty" class="form-control" required="true" readonly autocomplete="off" value="<?php echo $percentage . "%"; ?>">
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
																} }
														?>
														<input type="hidden" name="num" class="num" value="1">
													</tbody>	
											</table>
									<!-- THE FORM TABLE  FOR TASK DONE END HERE -->
									<hr>
								</div>
							</div>
						</div>
					</div>
					</div>
				<!-- TASK ACHIEVED STOP HERE -->
					
					<?php 
						if(!isset($_GET['leaveid']) && empty($_GET['leaveid'])){
							header('Location: admin_dashboard.php');
						}
						else {
						
						$lid=intval($_GET['leaveid']);
						$sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.Gender,tblemployees.emp_id,tblemployees.Grade,tblemployees.Phonenumber,tblemployees.Subsidiary,tblemployees.Department,tblemployees.Line_Manager,tblemployees.Supervisor,tblemployees.EmailId,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.EvaluationType,tblleave.ReviewPeriod,tblleave.Challenges,tblleave.DateofLastReview,tblleave.PostingDate,tblleave.Sign,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate,tblleave.acceptconstructive,tblleave.demonstratesapleasant,tblleave.meetsestablished,tblleave.carefullyfollows,tblleave.expressselfclearly,tblleave.providesfeedbacks,tblleave.regularlypresent,tblleave.schedulesandusesleave,tblleave.performsassignedduties,tblleave.identifiesandproffers,tblleave.comesupwithnewideas,tblleave.demonstratestheknowledge,tblleave.hasproperunderdtanding,tblleave.workswellwith,tblleave.willinglyacceptswork,tblleave.maintainsconfidentiality,tblleave.interestedinaswellasparticipates,tblleave.motivatesandbrings,tblleave.stablishesclear,tblleave.delegatesclearly,tblleave.adheresto,tblleave.cummunicateshigh,tblleave.justifications,tblleave.hrmapprovalcomment,tblleave.personalactions,tblleave.personalityscore,tblleave.qowscore,tblleave.communicationsore,tblleave.attendancescore,tblleave.creativityscore,tblleave.jobknowledgescore,tblleave.teamworkscore,tblleave.professionalismscore,tblleave.leadershipscore,tblleave.integrityscore,tblleave.part_b_totalscore_percentage,tblleave.total_arch_perc_average from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where tblleave.id=:lid";
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
							<!-- PART B OF THE APPRAISAL STARTs FROM HERE -->
							<div class="card-box mb-30">
									<!-- TABLE DATA -->
									<div class="container-xl">
										<div class="list-group">
											<br>
											<a href="" class="list-group-item list-group-item-action active" style="background-color:DodgerBlue;">
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
											<table class="data-table table strip hover nowrap table-bordered">

									<!-- PERSONALITY -->
									<thead>
										<tr>
											<!-- <th></th> -->
										</tr>
										<tr>
											<th class=""><b>PERFORMACE REVIEW AREA</b></th>
											<th><b>RATING</b></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>1. PERSONALITY</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Accepts Contructive criticism without arguments.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;"  name="acceptcontruc" id="acceptcontruc" class="selectpicker form-control" data-style="btn-outline-primary" autocomplete="off" readonly value="<?php echo htmlentities($result->acceptconstructive);?>" />
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											
										</tr>

										<tr>
											<td>Demonstrates a pleasant and calm personality when <br> dealing with fellow partners and clients.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="demostratesple" id="demostratesple" require class="selectpicker form-control"  data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->demonstratesapleasant);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumpersonality" id="sumpersonality" class="form-control" readonly value="<?php echo htmlentities($result->personalityscore);?>" /></td>
											<td><b></b></td>
										</tr>
									</tbody>
									<hr>
									
									<!-- QUALITY OF WORK -->
									<thead>
										<tr>
											<th></th>
										</tr>
										<tr>
											<th class=""><b>2. QUALITY OF WORK</b></th>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>	
										</tr>
									</thead>

									<tbody>
										<tr>
											<td>Meets established standards and consistently produces high <br> quality error-free work.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="meetestablished" id="meetestablished"  class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->meetsestablished);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Carefully follows established procedures in getting <br> the job done.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="carefullyfollows" id="carefullyfollows" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->carefullyfollows);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b>
												<input type="number" name="sumqow" id="sumqow" class="form-control" readonly value="<?php echo htmlentities($result->qowscore);?>" /></td>
											</td>
											<td><b></b></td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- COMMUNICATION -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>3. COMMUNICATION SKILLS</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Express self clearly both orally and in writting and shows <br> effectiveness in listening to others</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="expressself" id="expressself" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->expressselfclearly);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Provides feedbacks and relevant Information in a timely manner.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="providesfeedback" id="providesfeedback" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->providesfeedbacks);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b>
												<input type="number" name="sumcommunication" id="sumcommunication" class="form-control" readonly value="<?php echo htmlentities($result->communicationsore);?>" /></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- QUALITY OF WORK -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>4. ATTENDANCE</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>
																			
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Regularly present and puntual.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="regularlypresent" id="regularlypresent" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->regularlypresent);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Schedules and uses leave in a manner that is sensitive to department and workload.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="usesleave" id="usesleave" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->schedulesandusesleave);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumattendance" id="sumattendance" class="form-control" readonly value="<?php echo htmlentities($result->attendancescore);?>" /></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- INITIATIVE/CREATIVITY -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>5. INITIATIVE/CREATIVITY</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Performs assigned duties with little or no supervision.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="performduties" id="performduties" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->performsassignedduties);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Identifies and proffers solutions to operational problems and constraints.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="profersolutions" id="profersolutions" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->identifiesandproffers);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>Comes up with new ideas and persistently looks for ways of doing things better.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="comesup" id="comesup" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->comesupwithnewideas);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="suminitiative" id="suminitiative" class="form-control" readonly readonly value="<?php echo htmlentities($result->creativityscore);?>" /></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- JOB KNOWLEDGE -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>6. JOB KNOWLEDGE</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Demonstrates the knowledge, skill and competence to performeffectivelyon the job. </td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="skilsandknowledge" id="skilsandknowledge" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->demonstratestheknowledge);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Has proper underdtanding of his/her role and its relevance to the Groups's mission and objectives.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="properunderstanding" id="properunderstanding" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->hasproperunderdtanding);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumjobknowledge" id="sumjobknowledge" class="form-control" readonly  readonly value="<?php echo htmlentities($result->jobknowledgescore);?>"/></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- COOPERATION/TEAMWORK -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>7. COOPERATION/TEAMWORK</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>

									<tbody>
										<tr>
											<td>Works well with and coordinates own work with others to achieve common goal</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="workwell" id="workwell" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->workswellwith);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Willingly accepts work including chnages in assignments not related to jobs.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="willinglyaccept" id="willinglyaccept" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->willinglyacceptswork);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumteamwork" id="sumteamwork" class="form-control" readonly  readonly value="<?php echo htmlentities($result->teamworkscore);?>" /></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- PROFESSIONALISM -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>8. PROFESSIONALISM</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Maintains confidentiality of Information.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="confidentiality" id="confidentiality" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->maintainsconfidentiality);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Interested in as well as participates in personal development programmes to <br> improve personal capacity to carry out job functions.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="personaldevelopment" id="personaldevelopment" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->interestedinaswellasparticipates);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumproffessional" id="sumproffessional" class="form-control" readonly value="<?php echo htmlentities($result->professionalismscore);?>" /></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- LEADERSHIP -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>9. LEADERSHIP</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Motivates and brings out the best in team members..</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="motivatemembers" id="motivatemembers" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->motivatesandbrings);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Establishes clear Expectations and direction for the team.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="clearexpectations" id="clearexpectations" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->stablishesclear);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>Delegates clearly and provides support, including necessary resources to get the job done.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="delegateduties" id="delegateduties" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->delegatesclearly);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumleadership" id="sumleadership" class="form-control" readonly value="<?php echo htmlentities($result->	leadershipscore);?>"/></td>
											</td>
											<td><b></b></td>
										</tr>
									</tbody>

									<!-- INTEGRITY/ACCOUNTABILITY -->
									<thead>
										<tr>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><b>10. INTEGRITY/ACCOUNTABILITY</b></td>
											<td colspan="4"><b>Enter value between (1 - 5)</b></td>								
										</tr>
									</tbody>
									<tbody>
										<tr>
											<td>Adheres to the Group's values, guidelines of conduct and policies.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="adheresto" id="adheresto" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->adheresto);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td>Personal actions are consistent with words.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="personalactions" id="personalactions" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->personalactions);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>Cummunicates high personal standards.</td>
											<td colspan="4">
												<div class="row breakafter">
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
															<input type="number" min="1" max="5" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" name="communicatehigh" id="communicatehigh" require class="selectpicker form-control" placeholder="Enter Rating value" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($result->cummunicateshigh);?>">
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
									<tr>
											<td><b></b></td>
											<td colspan="4">
												<b>Total: (%):</b> 
												<input type="number" name="sumintegrity" id="sumintegrity" class="form-control" readonly  readonly value="<?php echo htmlentities($result->integrityscore);?>"/></td>
											</td>
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
											<label style="font-size:16px;"><b>Average Score Part A: </b></label>
												<h7 style="font-size:11px;">
													<i>Technical KPI <b><?php echo $result->total_arch_perc_average."%";  ?></b></i>
													<?php $overallscore_a = $result->total_arch_perc_average * 0.7;  ?>
												</h7>
												<div class="avatar mr-2 flex-shrink-0">
													<input type="text" name="averagescore" id="averagescore" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($overallscore_a.'%');?>">
												</div>
											</div>
										</div>

										<div class="form-group col-md-4">
											<div class="form-group">
											<label style="font-size:16px;"><b>Average Score Part B: </b></label>
												<h7 style="font-size:11px;">
													<i>Soft Skills <b><?php echo $result->part_b_totalscore_percentage."%";  ?></b></i>
													<?php $overallscore_b = $result->part_b_totalscore_percentage * 0.3;  ?>
												</h7>
												<div class="avatar mr-2 flex-shrink-0">
													<input type="text" name="overallscore_b" id="overallscore_b" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($overallscore_b.'%');?>">
												</div>
											</div>
										</div>

										<div class="form-group col-md-4">
											<div class="form-group">
											<label style="font-size:16px;"><b>Grand Total Score: </b></label>
												<h7 style="font-size:11px;">
													<i>Overall Grade Score</i>
													<?php $overallscore_g = $overallscore_a + $overallscore_b;  ?>
												</h7>
												<div class="avatar mr-2 flex-shrink-0">
													<input type="text" name="grandtotal" id="grandtotal" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo htmlentities($overallscore_g.'%');?>">
												</div>
											</div>
										</div>
									</div>

									</div>
									</div> 



									<div class="row">
										<div class="col-sm-8">
										<h6 class="text-blue h6"><b>HOD's APPROVAL COMMENT</b></h6>
										</div>
									</div>
									<div class="form-group">
										<textarea id="taskchallenges" name="approvaljustification" type="text" class="form-control" autocomplete="off" readonly><?php echo htmlentities($result->justifications);?></textarea>
									</div>
									<hr><br>

									<div class="row">
										<div class="col-sm-8">
										<h6 class="text-blue h6"><b>HRM's APPROVAL COMMENT</b></h6>
										</div>
									</div>
									<div class="form-group">
									<textarea id="hrmapprovalcomment" name="hrmapprovalcomment" type="text" class="form-control" required="true" autocomplete="off" placeholder="Enter Approval Comment here&hellip;"></textarea>
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
									<label style="font-size:16px;"><b>Rector's/Registra's Approval</b></label>
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
									<label style="font-size:16px;"><b>Date For Rector's/Registra's Action</b></label>
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
									<label style="font-size:16px;"><b>Leave Status From HOD</b></label>
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
									<label style="font-size:16px;"><b>Leave Status From Rector/Registra</b></label>
									<?php $ad_stats=$result->RegRemarks;?>
									<?php
									if ($ad_stats==1): ?>
									  <input type="text" style="color: green;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Approved"; ?>">
									<?php
									 elseif ($ad_stats==2): ?>
									  <input type="text" style="color: red; font-size: 16px;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Rejected"; ?>">
									  <?php
									else: ?>
									  <input type="text" style="color: blue;" class="selectpicker form-control" data-style="btn-outline-primary" readonly value="<?php echo "Pending"; ?>">
									<?php endif ?>
								</div>
							</div>

							<?php 
							if(($stats==0 AND $ad_stats==0) OR ($stats==1 AND $ad_stats==0) OR ($stats==1 AND $ad_stats==2))
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