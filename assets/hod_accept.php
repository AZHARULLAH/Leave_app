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

	</head>

	<body class="container">

		<h3 class="center">National Institute Of Technology, Calicut</h3>

		<h4 class="center">EEE Department - Leave Application From</h4>

		<?php

			require "../includes/connectdb.php";
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
			$msg = "This an electronic generated mail from the Electrical engineering department, NIT Calicut. You have received this mail because you have applied for a leave from " . $leave_fromdate . " to " . $leave_todate . ". And your leave has been approved by the HOD, Mr. " . $hod_name . ". Please take a print out of the application form in the link below and submit it in the department office." . $app_link;

			$mail=mail($student_email, "Approval of leave application", $msg);
			if($mail)
			{
			  	echo '<p>The approved application form has been sent to the student, Thank you. </p>';
			}
			else
			{
			  	echo '<p>There is an unexpected error in forwarding the leave application to the student. Please try again. </p>';
			}

			session_unset();
			session_destroy();

		?>

	</body>

</html>