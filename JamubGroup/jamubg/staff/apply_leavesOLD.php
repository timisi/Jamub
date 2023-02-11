<html>
   <head>
      <!-- Basic Page Info -->
      <meta charset="utf-8">
      <title>Jamub Appraisal System</title>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
      <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <!-- Site favicon -->
      <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/jamublogofav.png">
      <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/jamublogofav.png">
      <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/jamublogofav.png">
      <!-- Mobile Specific Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <!-- Google Font -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
      <!-- CSS -->
      <!-- jQuery UI Signature core CSS -->
      <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
      <link href="../assets/css/jquery.signature.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
      <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
      <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
      <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
      <link rel="stylesheet" type="text/css" href="../vendors/styles/tabledata.css">
      
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    
      
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
      
      <!-- For dynamic form (Adding more formfield) -->

      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
      <!-- <script src="../vendors/dynamicform/js/dynamic-form.js"></script> -->
      <!-- <script src="../vendors/dynamicform/js/jquery.min.js"></script> -->
      
      
      <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

      
      

      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'UA-119386393-1');
      </script>
      <link href="../src/css/jquery.signature.css" rel="stylesheet">
      <script src="../src/js/jquery.signature.js"></script>
      <!-- <script src="../vendors/scripts/addanotherformfields.js"></script> -->

      <style>
         .kbw-signature { width: 100%; height: 100px;}
         #sig canvas{
         width: 100% !important;
         height: auto;
         }
      </style>
   </head>
   <?php include('../includes/config.php'); ?>
   <?php include('../includes/session.php');?>
   <?php 
      if(isset($_POST['upload']))
      {
          $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
          $row = mysqli_fetch_assoc($query);
      
          $firstname = $row['FirstName'];
      
          $cut = substr($firstname, 1, 2);
      
           $folderPath = "../signature/";
      
          $image_parts = explode(";base64,", $_POST['signed']);
              
          $image_type_aux = explode("image/", $image_parts[0]);
            
          $image_type = $image_type_aux[1];
            
          $image_base64 = base64_decode($image_parts[1]);
            
          $file = $folderPath ."sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
            
          file_put_contents($file, $image_base64);
      
          $signature ="sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
      
          $result = mysqli_query($conn,"update tblemployees set signature='$signature' where emp_id='$session_id'         
          ")or die(mysqli_error());
          if ($result) {
          echo "<script>alert('Signature Inserted successfully');</script>";
          } else{
            die(mysqli_error());
         }
      
      }
      ?>
      
      <!-- TO SEND EMAIL NOTIFICATION AFTER SUBMISSION -->
   <?php
      include('../sendmail.php');
      
      if(isset($_POST['apply']))
      {
      $empid=$session_id;
      $evaluation_type=$_POST['evaluation_kind'];
      $review_period=$_POST['review_period'];
      $last_review=$_POST['last_review'];
      $taskchallenges=$_POST['taskchallenges'];
            
      $hod_status=0;
      $reg_status=0;
      $isread=0;
      $datePosting = date("Y-m-d");
      
      // $itemCount = count($_POST["taskname"]);
      // $leave_type=$_POST['leave_type'];
      // $fromdate=date('d-m-Y', strtotime($_POST['date_from']));
      // $todate=date('d-m-Y', strtotime($_POST['date_to']));
      // $requested_days=$_POST['requested_days'];  
      // $leave_days=$_POST['leave_days'];
      // $work_cover=$_POST['work_cover'];
      // $DF = date_create($_POST['date_from']);
      // $DT = date_create($_POST['date_to']);
      
      // $diff =  date_diff($DF , $DT );
      // $num_days = (1 + $diff->format("%a"));
      
      $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
          $row = mysqli_fetch_assoc($query);
      
          $firstname = $row['FirstName'];
      
          $cut = substr($firstname, 1, 2);
      
           $folderPath = "../signature/";
      
          $image_parts = explode(";base64,", $_POST['signed']);
              
          $image_type_aux = explode("image/", $image_parts[0]);
            
          $image_type = $image_type_aux[1];
            
          $image_base64 = base64_decode($image_parts[1]);
            
          $file = $folderPath ."sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
            
          file_put_contents($file, $image_base64);
      
          $signature ="sig_" .$cut. "_".$row['Phonenumber']. "_" .$session_id . '.'.$image_type;
      
      if(empty($taskchallenges))
      {
       echo "<script>alert('The challenges field can not be empty');</script>";
      }
      // elseif($leave_days <= 0)
      // {
      //  echo "<script>alert('YOU HAVE EXCEEDED YOUR LEAVE LIMIT. LEAVE APPLICATION FAILED');</script>";
      // }
      // elseif($requested_days > $leave_days)
      // {
      //  echo "<script>alert('YOU HAVE EXCEEDED YOUR LEAVE LIMIT. LEAVE APPLICATION FAILED');</script>";
      // }
      
      else {
              $staffQuery= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
              //getEmailStaff
              $staffRow = mysqli_fetch_assoc($staffQuery);
              $staffEmailId = $staffRow['EmailId'];
              $firstname = $staffRow['FirstName'];
              $lastname = $staffRow['LastName'];
              $fullname = "".$firstname."  ".$lastname."";
      
              $hodQuery= mysqli_query($conn,"select * from tblemployees where tblemployees.role = 'HOD' and tblemployees.Department = '$session_depart'")or die(mysqli_error());
              //getEmail
              $row = mysqli_fetch_assoc($hodQuery);
              $hEmailId = $row['EmailId'];
              $firstName = $row['FirstName'];
              $lastName = $row['LastName'];
              $hodFullname = "".$firstName."  ".$lastName."";
      
              if (filter_var($staffEmailId, FILTER_VALIDATE_EMAIL)) {
                  
                  if (filter_var($hEmailId, FILTER_VALIDATE_EMAIL)) {
                      $sql="INSERT INTO tblleave (EvaluationType,ReviewPeriod,DateofLastReview,Sign,Challenges,HodRemarks,RegRemarks,IsRead,empid,PostingDate)	VALUES ('$evaluation_type','$review_period','$last_review', '$signature','$taskchallenges','$hod_status','$reg_status','$isread','$empid', '$datePosting')";
                      $lastInsertId = mysqli_query($conn, $sql) or die(mysqli_error());
                      if($lastInsertId)
                      {
                          echo "<script>alert('You just submitted an appraisal for: ".$review_period."');</script>";
                          echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
                          send_mail($fullname,$fromdate,$hEmailId, $evaluation_type, $hodFullname);
                      }
                      else 
                      {
                          echo "<script>alert('Something went wrong. Please try again');</script>";
                      }
                  }
                  else {
                      echo "<script>alert('HOD EMAIL IS INVALID. LEAVE APPLICATION FAILED');</script>";
                   }
              }
              else {
                  echo "<script>alert('YOUR EMAIL IS INVALID. LEAVE APPLICATION FAILED');</script>";
              }
      }
      
      }
      
      ?>
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
         <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
               <div class="page-header">
                  <div class="row">
                     <div class="col-md-6 col-sm-12">
                        <div class="title">
                           <h4>Monthly Appraisal Application</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Appraisal Application Module</li>
                              <li class="breadcrumb-item active" aria-current="page"></li>
                           </ol>
                           <!-- Success Alert Goes Here! -->
                           <div id="show_alert"></div>
                        </nav>
                     </div>
                  </div>
               </div>
               <div style="margin-left: 30px; margin-right: 30px;" class="pd-20 card-box mb-30">
                  <div class="clearfix">
                     <div class="pull-left">
                        <h4 class="text-blue h4">Partner's Appraisal Form</h4>
                        <p class="mb-20"></p>
                     </div>
                  </div>
                  <div class="wizard-content">

                    <!-- THE FORM START FROM HERE -->
                     <form method="post" action="" id="add_form">
                        <section>
                           <?php if ($role_id = 'Staff'): ?>
                           <?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
                              $row = mysqli_fetch_array($query);
                              ?>

                              <!-- EMPLOYEES CONSTANT DETAILS START HERE-->
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >First Name </label>
                                    <input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >Last Name </label>
                                    <input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
                                 </div>
                              </div>
                              
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label>Designation</label>
                                    <input name="postion" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Position_Staff']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label>Partner's ID Number </label>
                                    <input name="staff_id" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Staff_ID']; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >Grade </label>
                                    <input name="grade" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['Grade']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >Subsidiary </label>
                                    <input name="subsidiary" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['Subsidiary']; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >Department </label>
                                    <input name="department" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['Department']; ?>">
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >Line Manager's Name </label>
                                    <input name="linemanager" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['Line_Manager']; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                    <label >Supervisor's Name </label>
                                    <input name="supervisor" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['Supervisor']; ?>">
                                 </div>
                              </div>
                              <!-- <div class="col-md-6 col-sm-12">
                                 <div class="form-group">
                                     <label >Line manager </label>
                                     <input name="linemanager" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['Line_Manager']; ?>">
                                 </div>
                                 </div> -->
                              <?php endif ?>
                           </div>
                           <!-- EMPLOYEES CONSTANT DETAILS -->

                           <!-- EMPLOYEE APPRAISAL FORM START FROM HERE -->
                           <hr>
                           <div class="clearfix">
                              <div class="pull-left">
                                 <h4 class="text-blue h4">PART A (This is to be completed by appraisee)</h4>
                                 <p class="mb-20"></p>
                              </div>
                           </div>
                           
                           <div class="row">
                              <div class="col-md-4 col-sm-12">
                                 <div class="form-group">
                                    <label>Evaluation Type :</label>
                                    <select name="evaluation_kind" id="evaluation_kind" class="custom-select form-control" required="true" autocomplete="off">
                                       <option value="">Select evaluation type...</option>
                                       <?php $sql = "SELECT Evaluation_Type from evaluation_type";
                                          $query = $dbh -> prepare($sql);
                                          $query->execute();
                                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                                          $cnt=1;
                                          if($query->rowCount() > 0)
                                          {
                                          foreach($results as $result)
                                          {   ?>                                            
                                       <option value="<?php echo htmlentities($result->Evaluation_Type);?>"><?php echo htmlentities($result->Evaluation_Type);?></option>
                                       <?php }} ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                 <div class="form-group">
                                    <label>Review Period </label>
                                    <input id="review_period" name="review_period" placeholder="Enter Month&hellip;" type="text" class="form-control" required="true" autocomplete="off" value="">
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                 <div class="form-group">
                                    <label>Date of Last Review </label>
                                    <input id="last_review" name="last_review" type="date" class="form-control" required="true" autocomplete="off" value="">
                                 </div>
                              </div>
                           </div>
                           <!-- Major Archievements -->
                           <hr>
                           <div class="card-box mb-30">
                              <!-- TABLE DATA -->
                              <div class="container-xl">
                                 <div class="table-responsive">
                                    <div class="table-wrapper">
                                       <div class="table-title">
                                          <div class="row">
                                             <div class="col-sm-8">
                                                <h6 class="text-blue h6"><b>MAJOR ACHIEVEMENTS DURING PERIOD UNDER REVIEW</b></h6>
                                             </div>
                                             <div class="col-sm-4">
                                                <div class="search-box">
                                                   <input type="text" class="form-control" placeholder="Search&hellip;">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- THE FORM TABLE START FROM HERE -->
                                       <table class="table table-striped table-hover table-bordered" id="">
                                          <thead>
                                             <tr>
                                                <!-- <th>#</th> -->
                                                <th>TASKs DONE <i class="fa fa-sort"></i></th>
                                                <th>EXPECTED NUMBER OF TASK</th>
                                                <th>TOTAL ACHIEVED <i class="fa fa-sort"></i></th>
                                                <th>ACTION</th>
                                                <!-- <th>Country <i class="fa fa-sort"></i></th>
                                                <th>Actions</th> -->
                                             </tr>
                                          </thead>
                                          <tbody class="" id="show_item">
                                             <tr class="">
                                                <!-- <td>1</td> -->
                                                <td>
                                                    <!-- <textarea class="form-control" name="taskname" id="taskname" class="form-control" placeholder="Enter task here&hellip;"></textarea> -->
                                                    <input type="text" name="taskname[]" id="taskname" class="form-control" required="true" placeholder="Enter task here&hellip;">
                                                </td>
                                                <td>
                                                    <input type="text" name="taskexpected[]" id="taskqty" class="form-control" required="true" placeholder="Enter number&hellip;" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')";>
                                                </td>
                                                <td>
                                                    <input type="text" name="taskachieved[]" id="taskachieved" class="form-control" required="true" placeholder="Enter number&hellip;" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')";>
                                                </td>
                                                <td class="form-group col-md-2 ">
                                                   <button type="button" name="add" class="btn btn-success add_item_btn">
                                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                                   </button>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

                                       <hr>
                                       <!-- MAJOR CHALLENGES -->
                                        <div class="row">
                                            <div class="col-sm-8">
                                            <h6 class="text-blue h6"><b>CHALLENGES ENCOUNTERED DURING THE PERIOD UNDER REVIEW</b></h6>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>(Please highlight the issues that hampared the discharge of your responsibilities)</label>
                                            <textarea id="taskchallenges" name="taskchallenges" type="text" class="form-control" required="true" autocomplete="off" placeholder="Enter challenges here&hellip;"></textarea>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>                         
                           <div class="row">
                              <div class="col-md-4 col-sm-12">
                                 <div class="form-group">
                                    <label>Signature </label>
                                    <div id="sig" ></div>
                                    <br/>
                                    <p style="clear: both;" class="btn btn-group">
                                    </p>
                                    <div class="dropdown">
                                       <button class="btn btn-outline-danger" id="clear">Clear Signature</button>
                                    </div>
                                    <br/>
                                    <textarea id="signature64" name="signed" style="display: none" required="true"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                 <div class="form-group">
                                    <label style="font-size:16px;"><b></b></label>
                                    <div class="modal-footer justify-content-center">
                                       <button class="btn btn-primary" name="apply" id="" data-toggle="modal">Submit&nbsp;Appraisal</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <script type="text/javascript">
         var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
         $('#clear').click(function(e) {
             e.preventDefault();
             sig.signature('clear');
             $("#signature64").val('');
         });
      </script>
      <script>
         const picker = document.getElementById('date_form');
         picker.addEventListener('input', function(e){
         var day = new Date(this.value).getUTCDay();
         if([6,0].includes(day)){
           e.preventDefault();
           this.value = '';
           alert('Weekends not allowed');
         } else {
             calc();
         }
         });
         
         const pickers = document.getElementById('date_to');
         pickers.addEventListener('input', function(e){
         var day = new Date(this.value).getUTCDay();
         if([6,0].includes(day)){
           e.preventDefault();
           this.value = '';
           alert('Weekends not allowed');
         }else {
             calc();
         }
         });
         
         // function calc_days(){
         //     const date_to = document.getElementById('date_to');
         //     const date_from = document.getElementById('date_form');
         // 	var days = 0;
         // 	if(date_to.value != ''){
         // 		var start = new Date(date_from.value);
         // 		var end = new Date(date_to.value);
         // 		var diffDate = (end - start) / (1000 * 60 * 60 * 24);
         // 		days = Math.round(diffDate);
         //        var work = document.getElementById("requested_days");
         //        work.value = days + 1;
         // 	}
         
         // }
         
         function calc() {
           const date_to = document.getElementById('date_to');
           const date_from = document.getElementById('date_form');
           result = getBusinessDateCount(new Date(date_from.value), new Date(date_to.value));
           var work = document.getElementById("requested_days");
           work.value = result;
         }
         
         function getBusinessDateCount(startDate, endDate) {
             var elapsed, daysBeforeFirstSaturday, daysAfterLastSunday;
             var ifThen = function(a, b, c) {
                 return a == b ? c : a;
             };
         
             elapsed = endDate - startDate;
             elapsed /= 86400000;
         
             daysBeforeFirstSunday = (7 - startDate.getDay()) % 7;
             daysAfterLastSunday = endDate.getDay();
         
             elapsed -= (daysBeforeFirstSunday + daysAfterLastSunday);
             elapsed = (elapsed / 7) * 5;
             elapsed += ifThen(daysBeforeFirstSunday - 1, -1, 0) + ifThen(daysAfterLastSunday, 6, 5);
         
             return Math.ceil(elapsed);
          }
         
         // function func(){
         //     var dropdown = document.getElementById("leave_type");
         //     var selection = dropdown.value;
         //     console.log(selection);
         //     var emailTextBox = document.getElementById("work_cover");
         //     // assign the email address here based on your need.
         //     emailTextBox.value = selection;
         //   }
      </script>
      
      <script src="../vendors/scripts/core.js"></script>
      <script src="../vendors/scripts/script.min.js"></script>
      <script src="../vendors/scripts/process.js"></script>
      <script src="../vendors/scripts/layout-settings.js"></script>
      
      
      
      
      
      <!-- HERE IS THE SCRIPT FOR THE DYNAMIC FORM - START FROM HERE -->
      
      
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript">
   $(document).ready(function(){
        $(".add_item_btn").click(function(e) {
          e.preventDefault();
          $("#show_item").prepend(`<tr class="append_item">
                                <!-- <td>1</td> -->
                                <td>
                                      <!-- <textarea class="form-control" name="taskname" id="taskname" class="form-control" placeholder="Enter task here&hellip;"></textarea> -->
                                      <input type="text" name="taskname[]" id="taskname" class="form-control" required="true" placeholder="Enter task here&hellip;">
                                </td>
                                <td>
                                      <input type="text" name="taskexpected[]" id="taskqty" class="form-control" required="true" placeholder="Enter number&hellip;" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')";>
                                </td>
                                <td>
                                      <input type="text" name="taskachieved[]" id="taskachieved" class="form-control" required="true" placeholder="Enter number&hellip;" onkeyup = "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')";>
                                </td>
                                <td class="form-group col-md-2 ">
                                   <button type="button" name="add" class="btn btn-danger remove_item_btn">
                                      <i class="fa fa-minus" aria-hidden="true"></i>
                                   </button>
                                </td>
                             </tr>`)
        });
  
        $(document).on('click', '.remove_item_btn', function(e){
          e.preventDefault();
          let row_item = $(this).parent().parent();
          $(row_item).remove();
        });
  
  
        // Ajax request to insert all form data
  
        $("#add_form").submit(function(e){
          e.preventDefault();
          $("#apply").val('Submitting...');
          $.ajax({
            url: 'dynamicformaction.php',
            method: 'post',
            data: $(this).serialize(),
            success: function(response) {
              $("#apply").val('Submit Appraisal');
              $("#add_form")[0].reset();
              $(".append_item").remove();
              $("#show_alert").html(`<div class="alert alert-success" role="alert">${response}</div>`);
              }
            });
          });
      });
  </script>
  <!-- <script src="../vendors/dynamicform/js/formjs.js"></script> -->
  <!-- HERE IS THE SCRIPT FOR THE DYNAMIC FORM - STOPS HERE -->

      
   </body>
</html>
