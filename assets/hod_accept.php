<?php

	session_start();
	$app_no = $_GET['appno'];
	$studentname = $_SESSION['name'];
	$studentrollno = $_SESSION['reg_no'];

?>

<html>

	<head>

		<title>EEE Department | NITC</title>

		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	      	<link type="text/css" rel="stylesheet" href="../materialize/css/materialize.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="../css/approval.css">

	</head>

	<body class="container">

		<img class="left" height="130px" src="../img/nitc.png">
		<h3 class="center">National Institute Of Technology, Calicut</h3>

		<h4 class="center">EEE Department - Leave Application Form</h4>

		<br><hr class="style6 z-depth-1"><br>

		<?php

			require "../includes/connectdb.php";
			require "../PHPMailer/test/testemail.php";
			mysql_select_db("leaveapp");

			$sql = "SELECT * FROM hod_details";
			$query = mysql_query($sql, $mysql_conn);
			$row = mysql_fetch_assoc($query);
			$hod_name = $row['name'];

			$sql = "SELECT * FROM student WHERE app_no =  $app_no";
			$query = mysql_query($sql, $mysql_conn);
			$row = mysql_fetch_assoc($query);
			$student_email = $row['email'];
			$leave_fromdate = $row['from_date'];
			$leave_todate = $row['to_date'];

			$app_link = "<a href='" . $link . "final_approved.php?appno=" . $app_no . "'>" . $link . "final_approved.php?appno=" . $app_no . "</a>";
			$msg = "This an electronic generated mail from the Electrical engineering department, NIT Calicut. You have received this mail because you have applied for a leave from <b>" . $leave_fromdate . "</b> to <b>" . $leave_todate . "</b>. And your leave has been approved by the HOD, Mr. <b>" . $hod_name . "</b>. Please take a print out of the application form in the link below and submit it in the department office." . $app_link;

			if(smtpmailer($student_email, 'leaves.eee@gmail.com' , 'EEE Dept., NITC', 'Approval for leave request', $msg))
			{
			  	echo '<h4 class="center green-text">The approval of the leave application has been sent to the student. Thank you. </h4>';
			  	$sql = "UPDATE app_status SET status = 1 WHERE app_no = $app_no";
			  	$query = mysql_query($sql, $mysql_conn);
			}
			else
			{
			  	echo '<p>There is an unexpected error in forwarding the leave application. Please try again. </p>';
			}

			session_unset();
			session_destroy();

		?>

	</body>

</html>