<?php

	session_start();
	$app_no = $_SESSION['appno'];
	$reg_no = $_SESSION['regno'];

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
		require "../PHPMailer/test/testemail.php";
		mysql_select_db("leaveapp");

		// 1 - sent
		// 0 - not sent
		// 0 - not approved

		$sql = "INSERT INTO app_status (app_no, sent_to_fa, set_to_hod, status) VALUES ('$app_no', 1, 0, 0)";
		$query = mysql_query($sql, $mysql_conn);
		if(!$query)
		{
			echo "Some problem in updating the database..Try again later.." . mysql_error();
		}

		$rollno = (int) substr($reg_no, 3, 4);
		$category = substr($reg_no, 0, 3);

		$sql = "SELECT * FROM fa_details WHERE from_rollno LIKE '$category%'";
		$query = mysql_query($sql, $mysql_conn);
		while($row = mysql_fetch_assoc($query))
		{
			// echo $row['from_rollno'] . " , " . $row['to_rollno'];
			$from_number = (int) substr($row['from_rollno'], 3, 4);
			$to_number = (int) substr($row['to_rollno'], 3, 4);
			if($rollno >= $from_number && $rollno <= $to_number)
			{
				$fa_id = $row['faculty_id'];
			}
		}

		$sql = "SELECT * FROM faculty_details WHERE faculty_id = $fa_id";
		$query = mysql_query($sql, $mysql_conn);
		$row = mysql_fetch_assoc($query);
		$faculty_name = $row['faculty_name'];
		$faculty_email = $row['faculty_email'];

		$app_link = "<a href='" . $link . "fa_approval.php?appno=" . $app_no . "&fa_id=" . $fa_id . "'>" . $link . "fa_approval.php?appno=" . $app_no . "&fa_id=" . $fa_id . "</a>";
		$msg = "This an electronic generated mail from the Electrical engineering department, NIT Calicut. <br><br> You have received this mail because a student, " . $_SESSION['name'] . "</span> , roll no - " . $reg_no . " has applied for a leave. His application needs your recommendation and this application will be forwarded to the HOD for approval. Click the link to take action - .  " . $app_link;

		$mail = smtpmailer('leaves.eee@mail.com', $faculty_email , 'EEE Dept., NITC', 'Recommendation for leave approval', $msg);
		if($mail)
		{
		  	echo '<p>Your application has been sent to ' . $faculty_name  . '. You will receive a mail once it has been approved. Also, Please check your spam as the mail sent might be detected as spam. </p>';
		}
		else
		{
		  	echo '<p>There is an unexpected error in forwarding your leave application. Please report to the department office. </p>';
		}

	?>

	<style type="text/css">

		.bold
		{
			color: orange;
			font-weight: bold;
			font-size: 20px;
		}

	</style>

	</body>

</html>

<?php

	session_unset();
	session_destroy();

?>