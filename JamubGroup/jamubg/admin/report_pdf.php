<?php
	include('../includes/session.php');
	include('../includes/config.php');
	require_once('../TCPDF-main/tcpdf.php');

	$did=intval($_GET['leave_id']);
	// $sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.emp_id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblemployees.Av_leave,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.LeaveType,tblleave.ToDate,tblleave.FromDate,tblleave.PostingDate,tblleave.RequestedDays,tblleave.DaysOutstand,tblleave.Sign,tblleave.WorkCovered,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate,tblleave.num_days from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where tblleave.id='$did'";
	$sql = "SELECT tblleave.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.Gender,tblemployees.emp_id,tblemployees.Grade,tblemployees.Phonenumber,tblemployees.Subsidiary,tblemployees.Department,tblemployees.Line_Manager,tblemployees.Supervisor,tblemployees.EmailId,tblemployees.Position_Staff,tblemployees.Staff_ID,tblleave.EvaluationType,tblleave.ReviewPeriod,tblleave.Challenges,tblleave.DateofLastReview,tblleave.PostingDate,tblleave.Sign,tblleave.HodRemarks,tblleave.RegRemarks,tblleave.HodSign,tblleave.RegSign,tblleave.HodDate,tblleave.RegDate,tblleave.acceptconstructive,tblleave.demonstratesapleasant,tblleave.meetsestablished,tblleave.carefullyfollows,tblleave.expressselfclearly,tblleave.providesfeedbacks,tblleave.regularlypresent,tblleave.schedulesandusesleave,tblleave.performsassignedduties,tblleave.identifiesandproffers,tblleave.comesupwithnewideas,tblleave.demonstratestheknowledge,tblleave.hasproperunderdtanding,tblleave.workswellwith,tblleave.willinglyacceptswork,tblleave.maintainsconfidentiality,tblleave.interestedinaswellasparticipates,tblleave.motivatesandbrings,tblleave.stablishesclear,tblleave.delegatesclearly,tblleave.adheresto,tblleave.cummunicateshigh,tblleave.justifications,tblleave.hrmapprovalcomment,tblleave.personalactions,tblleave.personalityscore,tblleave.qowscore,tblleave.communicationsore,tblleave.attendancescore,tblleave.creativityscore,tblleave.jobknowledgescore,tblleave.teamworkscore,tblleave.professionalismscore,tblleave.leadershipscore,tblleave.integrityscore,tblleave.part_b_totalscore_percentage from tblleave join tblemployees on tblleave.empid=tblemployees.emp_id where tblleave.id='$did'";
						
	$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	while ($row = mysqli_fetch_array($query)) {
		$firstname = $row['FirstName'];
		$lastname = $row['LastName'];
		$position = $row['Position_Staff']; 
	    $staff_id = $row['Staff_ID'];
				
		$staff_signature = $row['Sign'];
		$posted = $row['PostingDate'];
		$hod_sign = $row['HodSign'];
		$hod_date = $row['HodDate'];
		$reg_sign = $row['RegSign'];
		$reg_date = $row['RegDate'];
		$hodFullname = "".$firstName."  ".$lastName."";

		$acceptcrit = $_POST['acceptcontruc'];
		$demonstrates = $_POST ['demostratesple'];
		$meets = $_POST ['meetestablished'];
		$carefully = $_POST ['carefullyfollows'];
		$expressself = $_POST ['expressself'];
		$providesfeedbacks = $_POST ['providesfeedback'];
		$regularlypresent = $_POST ['regularlypresent'];
		$schedules = $_POST ['usesleave'];
		$performs = $_POST ['performduties'];
		$identifiesand = $_POST ['profersolutions'];
		$comesup = $_POST ['comesup'];
		$knowledge = $_POST ['skilsandknowledge'];
		$hasproper = $_POST ['properunderstanding'];
		$workswell = $_POST ['workwell'];
		$willinglyaccepts =$_POST ['willinglyaccept'];
		$maintains = $_POST ['confidentiality'];
		$interestedin = $_POST ['personaldevelopment'];
		$motivatesand = $_POST ['motivatemembers'];
		$establishesclear = $_POST ['clearexpectations'];
		$delegatesclearly = $_POST ['delegateduties'];
		$adheresto = $_POST ['adheresto'];
		$personalactions = $_POST ['personalactions'];
		$cummunicateshigh = $_POST ['communicatehigh'];



		$personality = $_POST['sumpersonality'];
		$qow = $_POST['sumqow'];
		$communicationskills = $_POST['sumcommunication'];
		$attendance = $_POST['sumattendance'];
		$creativity = $_POST['suminitiative'];
		$jobknowledge = $_POST['sumjobknowledge'];
		$coorperation = $_POST['sumteamwork'];
		$professionalism = $_POST['sumproffessional'];
		$leadership = $_POST['sumleadership'];
		$integrity = $_POST['sumintegrity'];
		$approvaljustification = $_POST ['approvaljustification'];
		$partbpercentage= $_POST ['grandtotal'];
	}

	/**
	 * summary
	 */
	class PDF extends TCPDF
	{
	    public function Header()
	    {
	    	$this->Ln(5);
	    	$this->SetFont('helvetica','B', 14);
	    	$this->Cell(189, 5, 'Codelytical Institute of Programming', 0, 1, 'C');
	    	$this->SetFont('helvetica','B', 14);
	    	$this->Ln(2);
	    	$this->Cell(189, 3, 'P.O. Box 1, Youtube', 0, 1, 'C');
	    	$this->SetFont('helvetica','B', 14);
	    	$this->Ln(2);
	    	$this->Cell(189, 3, 'PERIODIC APPRAISAL APPLICATION DETAILS', 0, 1, 'C');
	    }

	    public function Body()
	    {

	    }
	}

	// create new PDF document
	$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('JAMUB APPRAISAL SYSTEM');
	$pdf->SetTitle('JAMUB APPRAISAL SYSTEM');
	$pdf->SetSubject('');
	$pdf->SetKeywords('');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	$pdf->setFooterData(array(0,64,0), array(0,64,128));

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}

	// set default font subsetting mode
	$pdf->setFontSubsetting(true);

	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size.
	$pdf->SetFont('dejavusans', '', 14, '', true);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();

	$pdf->Ln(20);
	$pdf->SetFont('times','B', 12);
	$pdf->Cell(189, 6, '1.          Full Name:    '.$firstname.' '.$lastname.'', 0, 1);

	$pdf->Ln(8);
	$pdf->SetFont('times','B', 12);
	$pdf->Cell(130, 6, '2.          Position:    '.$position.' ', 0, 0);
	$pdf->Cell(59, 6, '   Staff ID Number:    '.$staff_id.' ', 0, 1);

	$pdf->Ln(8);

	// // $pdf->SetFont('times','B', 12);
	// // $pdf->Cell(189, 6, '3.          Approved outstanding from previous year(state days):    '.$previous.' ', 0, 1);
	// // $pdf->Cell(189, 6, '             (Provide evidence of approval)', 0, 1);

	// // $pdf->Ln(8);

	// // $pdf->SetFont('times','B', 12);
	// // $pdf->Cell(189, 6, '4.          Leave Entitlement for 2021:    '.$leave_entitled.' ', 0, 1);

	// // $pdf->Ln(8);
	
	// // $pdf->SetFont('times','B', 12);
	// // $pdf->Cell(189, 6, '5.          Comulative Leave Entitlement:    '.$cumulative_leave.' ', 0, 1);

	// $pdf->Ln(10);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(189, 6, '6.          Number of days requested:    '.$num_days.' ', 0, 1);

	// $pdf->Ln(10);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(189, 6, '7.          Number of days still outstanding:    '.$outstanding.' ', 0, 1);

	// $pdf->Ln(10);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(130, 6, '8.          Start date:    '.$start_date.' ', 0, 0);
	// $pdf->Cell(59, 6, 'End Date:   '.$end_date.'');

	// $pdf->Ln(12);
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(34, 15, '9.          Signature : .............................', 0, 0);
	// $pdf->writeHTMLCell(96,1,'','', '', 0, 0);
	// $pdf->Cell(59, 15, 'Date:   '.$posted.'', 0, 1);

	// $pdf->Ln(3);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(95, 18, '10.        Recommendation By (Head of Department): ......................', 0, 0);
	// $pdf->writeHTMLCell(35,30,'','', '', 0, 0);
	// $pdf->Cell(59, 18, 'Date:   '.$hod_date.'', 0, 1);

	// $pdf->Ln(8);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(189, 6, '11.       Work to be covered by:    '.$work_cover.' ', 0, 1);

	// $pdf->Ln(8);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(75, 18, '12.        Approved By (Rector/Registra): ......................', 0, 0);
	// $pdf->writeHTMLCell(55,1,'','', '', 0, 0);
	// $pdf->Cell(59, 18, 'Date:   '.$reg_date.'', 0, 1);

	// $pdf->Ln(8);
	
	// $pdf->SetFont('times','B', 12);
	// $pdf->Cell(189, 6, '13.       Date Resumed (for official work):    '.$end_date.' ', 0, 1);

	// Close and output PDF document
	$pdf->Output('aci_1.pdf', 'I');

