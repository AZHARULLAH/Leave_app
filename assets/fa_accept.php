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

	</head>

	<body class="container">

		<h3 class="center">National Institute Of Technology, Calicut</h3>

		<h4 class="center">EEE Department - Leave Application From</h4>

		<?php

			require "../includes/connectdb.php";
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
			$msg = "This an electronic generated mail from the Electrical engineering department, NIT Calicut. You have received this mail because a student, " . $_SESSION['name'] . " , roll no - " . $studentrollno . " has applied for a leave. The application has been recommended by his FA, Mr. " . $fac_name . " His application needs your approval and the leave will be granted. Click the below link to take action. " . $app_link;

			$mail=mail($hod_email, "Approval of leave application", $msg);
			if($mail)
			{
			  	echo '<p>The application has been forwarded to the HOD, Mr.  ' . $hod_name  . '. Thank you. </p>';
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