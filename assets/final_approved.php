<?php

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
		            				<td> Leave granted by the HOD</td>
		          			</tr>
		        		</tbody>
		      	</table>

		      	<a id="print" style="margin-top:30px; margin-left:40%;" href="javascript:window.print()" class="waves-effect waves-light btn-large center"><i class="material-icons right">print</i>Print this page</a>

		      	<script type="text/javascript">

		      		$("#print").click(function(){
		      			$(this).remove();
		      		})

		      	</script>

		      	<style type="text/css">

		      		@media print and (color) {
			   	* {
			      		-webkit-print-color-adjust: exact;
				      	print-color-adjust: exact;
			   	}

			   	#print
				{
					display: none;
				}

				}

				img
				{
					float: left;
				}

				header nav, footer {
					display: none;
				}

				@page {
					margin: 1cm;
				}

				@page :left {
					margin: 1cm;
				}

				@page :right {
					margin: 1cm;
				}

				table.striped > tbody > tr:nth-child(odd) {
				  	background-color: #f2f2f2;
				}

				table.striped > tbody > tr > td {
				  	border-radius: 0px;
				}

				table {
				  	width: 100%;
				  	display: table;
				  	margin-top: 50px;
				}

				table.bordered > thead > tr,
				table.bordered > tbody > tr {
				  	border-bottom: 1px solid #d0d0d0;
				}

				table.centered thead tr th, table.centered tbody tr td {
				  	text-align: center;
				}

				thead {
				  	border-bottom: 1px solid #d0d0d0;
				}

				td, th {
				  	padding: 15px 5px;
				  	display: table-cell;
				  	text-align: left;
				  	vertical-align: middle;
				  	border-radius: 2px;
				}

				h1, h2, h3, h4, h5, h6 {
				  	font-weight: 400;
				  	line-height: 1.1;
				}

				h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
				  	font-weight: inherit;
				}

				h3 {
				  	font-size: 2.28rem;
				  	line-height: 110%;
				  	margin: 1.46rem 0 1.168rem 0;
				}

				h4 {
				  	font-size: 2.00rem;
				  	line-height: 110%;
				  	margin: 1.14rem 0 0.912rem 0;
				}

				.center, .center-align {
				  	text-align: center;
				}

		      	</style>

	</body>

</html>