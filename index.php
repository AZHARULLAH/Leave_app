<html>

	<head>

		<title>EEE Department | NITC</title>

		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	      	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>
	      	<link type="text/css" rel="stylesheet" href="css/home.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	</head>

	<body class="container">

		<h3 class="center">National Institute Of Technology, Calicut</h3>

		<h4 class="center">EEE Department - Leave Application From</h4>

		<div id="form_body" class="row">

			<form class="col s12" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

				<div class="row">

					<div class="input-field col s6 m4 l4">
				          		<input id="name" name="name" type="text" class="validate" required>
					          	<label for="name">Name</label>
				        	</div>

				        	<div class="input-field col s6 m4 l4">
				          		<input id="reg_no" name="regno" type="text" class="validate" required>
					          	<label for="reg_no">Registration number</label>
				        	</div>

				        	<div class="input-field col s6 m4 l4">
					    	<select name="prog">
					      		<option value="" disabled selected>Choose your programme</option>
				      			<option value="1">B.Tech</option>
					      		<option value="2">M.Tech</option>
					      		<option value="3">Ph.D</option>
					    	</select>
					    	<label>Programme of study</label>
				  	</div>

				</div>

				<div class="row">

				  	<div class="input-field col s6 m3 l3">
				          		<input id="semester" name="semester" type="number" class="validate" required>
					          	<label for="semester">Semester</label>
				        	</div>

				        	<div class="row">
					        	<div class="input-field col s6 m6 l6">
				          			<input id="email" name="email" type="email" class="validate">
					          		<label for="email" data-error="wrong" data-success="right">Email</label>
					        	</div>
				      	</div>

				</div>

				<div class="row">

				  	<div class="input-field col s6 m4 l4">
					    	<select name="nature">
					      		<option value="" disabled selected>Nature of leave</option>
				      			<option value="1">Casual Leave</option>
					      		<option value="2">Medical Leave</option>
					      		<option value="3">Permission To Attend Conference</option>
					    	</select>
					    	<label>Nature Of Leave</label>
				  	</div>

				  	<div class="file-field input-field col s8 m7 l7 right">
					      	<div class="btn">
					        		<span>File</span>
					        		<input type="file" name="document" id="document">
					      	</div>
					      	<div class="file-path-wrapper">
					        		<input id="files" class="file-path validate" type="text" name="documentname">
					      	</div>
				    	</div>

				</div>

				<div class="row col s12 m12 l12">

					<h4 class="center">Period of Absence</h4>
					<div class="row col s12 m4 l3 offset-m1 offset-l1 left">
						<label>From Date</label>
						<input type="date" name="fromdate" class="datepicker">
					</div>
					<div class="row col s12 m4 l3 offset-m1 offset-l1">
						<label>To Date</label>
						<input type="date" name="todate" class="datepicker">
					</div>
					<div class="row">
						<p class="col offset-m1 offset-l1">No of days : <span class="days">0</span></p>
					</div>

				</div>

				<div class="row col s12 m12 l12">

					<div class="row">
					          	<div class="input-field col s12">
					            	<input name="reason" id="input_text" type="text" length="500">
					            	<label for="input_text">Reason for absence</label>
					          	</div>
				        	</div>

				</div>

				<button class="btn waves-effect waves-light right" type="submit" name="submit">Submit
				        	<i class="material-icons right">send</i>
			    	</button>

			</form>
		</div>

		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/home.js"></script>
      		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>

	</body>

	<?php

		require "includes/connectdb.php";
		mysql_select_db("leaveapp");

		// $root = realpath($_SERVER["DOCUMENT_ROOT"]);
		// echo $root."aweaw";
		// include_once $_SERVER['DOCUMENT_ROOT'] . "leaveapp/uploads/index.php";

		if(isset($_POST['submit']))
		{
			// if(!empty($_POST['name']) && isset($_POST['name']) && !empty($_POST['regno']) && isset($_POST['regno']) &&
			// 	!empty($_POST['prog']) && isset($_POST['prog'])  && !empty($_POST['semester']) && isset($_POST['semester']) &&
			// 	!empty($_POST['email']) && isset($_POST['email'])  && !empty($_POST['nature']) && isset($_POST['nature']) &&
			// 	!empty($_POST['document']) && isset($_POST['document'])  && !empty($_POST['fromdate']) && isset($_POST['fromdate']) &&
			// 	!empty($_POST['todate']) && isset($_POST['todate'])  && !empty($_POST['reason']) && isset($_POST['reason']))
			// {
				echo "<br>" . $name = $_POST['name'];
				echo "<br>" . $regno = $_POST['regno'];
				echo "<br>" . $prog = $_POST['prog'];
				echo "<br>" . $semester = $_POST['semester'];
				echo "<br>" . $email = $_POST['nature'];
				// echo "<br>" . $document = $_POST['document'];
				// echo "<br>" . $documentname = $_POST['documentname'];
				echo "<br>" . $email = $_POST['email'];
				echo "<br>" . $fromdate = date('y-m-d', strtotime($_POST['fromdate']));
				echo "<br>" . $todate = date('y-m-d', strtotime($_POST['todate']));
				echo "<br>" . $reason = $_POST['reason'];

				// Count
				$sql = "SELECT COUNT(*) as count FROM student";
				$query = mysql_query($sql, $mysql_conn);
				$row = mysql_fetch_assoc($query);
				$count = $row['count'] + 1;

				// File Upload
				$documentname = "File" + $count;
				$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/leaveapp/uploads/";
				$target_file = $target_dir . basename($_FILES["document"]["name"]);
				$FileType = pathinfo($target_file, PATHINFO_EXTENSION);
				$newfilename = $target_dir . $documentname . "." . $FileType;

				if (move_uploaded_file($_FILES["document"]["tmp_name"], $newfilename))
				{
				        	echo "The file ". $documentname . " has been uploaded.";
			    	}
			    	else
			    	{
				        	echo "Sorry, there was an error uploading your file.";
			    	}

				// $sql = "INSERT INTO leaveapp "

			// }
		}

	?>

</html>