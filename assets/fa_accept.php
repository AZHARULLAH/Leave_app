<?php

	session_start();
	$app_no = $_GET['appno'];
	$fa_id = $_SESSION['fa_id'];
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

			$sql = "SELECT * FROM faculty_details WHERE faculty_id =  $fa_id";
			$query = mysql_query($sql, $mysql_conn);
			$row = mysql_fetch_assoc($query);
			$fac_name = $row['faculty_name'];

			$sql = "SELECT * FROM hod_details";
			$query = mysql_query($sql, $mysql_conn);
			$row = mysql_fetch_assoc($query);
			$hod_name = $row['name'];
			$hod_email = $row['email'];

			$app_link = "<a href='" . $link . "hod_approval.php?appno=" . $app_no . "'>" . $link . "hod_approval.php?appno=" . $app_no . "</a>";
			$msg = "<p>This an electronic generated mail from the Electrical engineering department, NIT Calicut. You have received this mail because a student, <b>" . $_SESSION['name'] . "</b> , roll no - <b>" . $studentrollno . "</b> has applied for a leave. The application has been recommended by his FA, Mr. <b>" . $fac_name . "</b>. His application needs your approval and the leave will be granted. Click the link to take action. " . $app_link . "</p>";

			// $mail= smtpmailer('leaves.eee@gmail.com', $hod_email , 'EEE Dept., NITC', 'Approval for leave request', $msg);
			if(smtpmailer($hod_email, 'leaves.eee@gmail.com' , 'EEE Dept., NITC', 'Approval for leave request', $msg))
			{
			  	echo '<h4 class="center green-text">The application has been forwarded to the HOD, Mr.  ' . $hod_name  . '. Thank you. </h4>';
			  	$sql = "UPDATE app_status SET set_to_hod = 1 WHERE app_no = $app_no";
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