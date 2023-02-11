<?php
	include('apply_leaves.php');
	$conn = new PDO('mysql:host=localhost;dbname=aci_leave', 'root', '');
//     include('../includes/config.php');
//    include('../includes/session.php');


	$tot = $_POST['num'];
	
	for($i=1;$i<=$tot;$i++) {
		$sql = 'INSERT INTO tblleave (TaskDone, ExpectedNumberofTask, TotalTaskAchieved) VALUES (:taskdone, :expectednumber, :taskachieved)';
		$stmt = $conn->prepare($sql); 
		// $stmt->execute([
		// 	'taskdone' => $_POST['taskname'.$i],
		// 	'expectednumber' => $_POST['taskexpected'.$i],
		// 	'taskachieved' => $_POST['taskachieved'.$i]
		// ]);
	}

	if($stmt)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: apply_leaves.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: apply_leaves.php");
        exit(0);
    }


?>