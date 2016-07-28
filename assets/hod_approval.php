<?php

	session_start();
	$app_no = $_GET['appno'];

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
			mysql_select_db("leaveapp");

			$sql = "SELECT * FROM student WHERE app_no = $app_no";
			$query = mysql_query($sql, $mysql_conn);
			$row = mysql_fetch_assoc($query);

			$_SESSION['name'] = $row['name'];
			$_SESSION['reg_no'] = $row['reg_no'];

		?>

			<table class="bordered striped centered responsive-table">
				<tbody>
		          			<tr>
		            				<td>Name</td>
		            				<td> <?php echo $row['name'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Registration number</td>
		            				<td> <?php echo $row['reg_no'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Programme</td>
		            				<td> <?php
							if($row['programme'] == 1)
							{
								echo "B.Tech";
							}
							elseif($row['programme'] == 2)
							{
								echo "M.Tech";
							}
							elseif($row['programme'] == 3)
							{
								echo "Ph.D";
							}
		            				?> </td>
		          			</tr>
		          			<tr>
		            				<td>Semester</td>
		            				<td> <?php echo $row['semester'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Email</td>
		            				<td> <?php echo $row['email'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Leaved to be availed from</td>
		            				<td> <?php echo $row['from_date'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Leaved to be availed till</td>
		            				<td> <?php echo $row['to_date'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Leaved to be availed for</td>
		            				<td> <?php echo $row['no_of_days'] . " ";  ?>  days</td>
		          			</tr>
		          			<tr>
		            				<td>Nature of leave</td>
		            				<td>
		            					<?php
		            						if($row['nature_of_leave'] == 1)
								{
									echo "Casual leave";
								}
								elseif($row['nature_of_leave'] == 2)
								{
									echo "Medical leave";
								}
								elseif($row['nature_of_leave'] == 3)
								{
									echo "Permission to attend conference";
								}
		            				 	?>
		            				 </td>
		          			</tr>
		          			<?php
		          				if($row['nature_of_leave'] != 1)
		          				{
		          					echo '<tr>
				            				<td>Supporting document</td>
				            				<td><a href="' .  $uploadslink . $row["document_path"] . '">' .  $row["document_path"] . '</a></td>
				          			</tr>';
		          				}
		          			?>
		          			<tr>
		            				<td>Reason for leave</td>
		            				<td> <?php echo $row['reason_of_leave'];  ?> </td>
		          			</tr>
		          			<tr>
		            				<td>Approval Status</td>
		            				<td> Recommended by the FA. Needs HOD's  approval.</td>
		          			</tr>
		        		</tbody>
		      	</table>

		      	<div id="actions" style="margin-top:30px;">
			      	<a href="hod_accept.php?appno=<?php echo $app_no; ?>" class="waves-effect waves-light btn-large right green"><i class="material-icons right">thumb_up</i>Approve</a>
				<a href="hod_reject.php?appno=<?php echo $app_no; ?>" class="waves-effect waves-light btn-large left red"><i class="material-icons right">thumb_down</i>Don't Approve</a>
			</div>

	</body>

</html>