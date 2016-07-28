<?php

	session_start();
	error_reporting(0);
	if(!isset($_SESSION['errormsg']) || empty($_SESSION['errormsg']) || $_SESSION['errormsg'] == "")
	{
		$_SESSION['errormsg'] = "";
	}

?>

	<?php

		require "includes/connectdb.php";
		mysql_select_db("leaveapp");

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if(isset($_POST['submit']))
			{
				$name = trim(stripslashes(htmlspecialchars($_POST['name'])));
				$regno = strtolower(trim(stripslashes(htmlspecialchars($_POST['regno']))));
				$prog = trim(stripslashes(htmlspecialchars($_POST['prog'])));
				$semester = trim(stripslashes(htmlspecialchars($_POST['semester'])));
				$nature = trim(stripslashes(htmlspecialchars($_POST['nature'])));
				//$document = trim(stripslashes(htmlspecialchars($_POST['document'])));
				//$documentname = trim(stripslashes(htmlspecialchars($_POST['documentname'])));
				$email = trim(stripslashes(htmlspecialchars($_POST['email'])));
				$fromdate = trim(stripslashes(htmlspecialchars((string)date('y-m-d', strtotime($_POST['fromdate'])))));
				$todate = trim(stripslashes(htmlspecialchars((string)date('y-m-d', strtotime($_POST['todate'])))));
				$reason = trim(stripslashes(htmlspecialchars($_POST['reason'])));

				$error = 0;
				$message = "";

				if(empty($name))
				{
					$error = 1;
					$message = $message . " Enter the name correctly.";
				}

				if(empty($regno))
				{
					$error = 1;
					$message = $message . " Enter the registration number correctly.";
				}

				if(empty($prog))
				{
					$error = 1;
					$message = $message . " Enter the programme correctly.";
				}

				if(empty($semester))
				{
					$error = 1;
					$message = $message . " Enter the semester correctly.";
				}

				if(empty($nature))
				{
					$error = 1;
					$message = $message . " Enter the nature of leave correctly.";
				}

				if(empty($email))
				{
					$error = 1;
					$message = $message . " Enter the email id correctly.";
				}

				if(empty($fromdate))
				{
					$error = 1;
					$message = $message . " Enter the from date correctly.";
				}

				if(empty($todate))
				{
					$error = 1;
					$message = $message . " Enter the to date correctly.";
				}

				if(empty($reason))
				{
					$error = 1;
					$message = $message . " Enter the reason of absence correctly.";
				}

				// Count
				$sql = "SELECT MAX(app_no) as count FROM student";
				$query = mysql_query($sql, $mysql_conn);
				$row = mysql_fetch_assoc($query);
				$count = $row['count'] + 1;

				$_SESSION['appno'] = $count;
				$_SESSION['regno'] = $regno;
				$_SESSION['name'] = $name;

				// File Upload
				$documentname = "File" . $count;
				$target_dir = $_SERVER["DOCUMENT_ROOT"] . "/leaveapp/uploads/";
				$target_file = $target_dir . basename($_FILES["document"]["name"]);
				$FileType = pathinfo($target_file, PATHINFO_EXTENSION);
				$newfilename = $target_dir . $documentname . "." . $FileType;
				$documentname = $documentname . "." . $FileType;

				if (!move_uploaded_file($_FILES["document"]["tmp_name"], $newfilename))
				{
					if($nature == 2 || $nature == 3)
					{
						$error = 1;
						$message = $message . " Upload appropriate supporting document.";
					}
					else
					{
						if($nature == 1)
						{
							$sql = "INSERT INTO student (name, reg_no, programme, semester, email, from_date, to_date, no_of_days, nature_of_leave, document_path, reason_of_leave) VALUES ( '$name', '$regno' , $prog , $semester , '$email' , '$fromdate' , '$todate' , $noofdays , $nature , 'Null' , '$reason');";
							$query = mysql_query($sql, $mysql_conn);

							if(!$query)
							{
								echo "Error in getting details...Try again later...". mysql_error();
							}
							else
							{
								header('Location: assets/success.php');
							}
						}
					}
				}

				//No of days
			    	$days = date_diff(date_create($fromdate),date_create($todate));
				$days2 = $days -> format("%R%a days");
				$days3 = substr($days2, 1);
				$noofdays = (int)str_replace(" days","", $days3);
				// echo gettype($noofdays);

				if($error != 0)
				{
					$_SESSION['errormsg'] = $message;
				}

				if($error == 0)
				{
					if($nature == 2 || $nature == 3)
					{
						$sql = "INSERT INTO student (name, reg_no, programme, semester, email, from_date, to_date, no_of_days, nature_of_leave, document_path, reason_of_leave) VALUES ( '$name', '$regno' , $prog , $semester , '$email' , '$fromdate' , '$todate' , $noofdays , $nature , '$documentname' , '$reason');";
						$query = mysql_query($sql, $mysql_conn);

						if(!$query)
						{
							echo "Error in getting details...Try again later...". mysql_error();
						}
						else
						{
							header('Location: assets/success.php');
						}
					}
					else
					{
						if($nature == 1)
						{
							$sql = "INSERT INTO student (name, reg_no, programme, semester, email, from_date, to_date, no_of_days, nature_of_leave, document_path, reason_of_leave) VALUES ( '$name', '$regno' , $prog , $semester , '$email' , '$fromdate' , '$todate' , $noofdays , $nature , 'Null' , '$reason');";
							$query = mysql_query($sql, $mysql_conn);

							if(!$query)
							{
								echo "Error in getting details...Try again later...". mysql_error();
							}
							else
							{
								header('Location: assets/success.php');
							}
						}
					}
				}
			}

		}

	?>

<html>

	<head>

		<title>EEE Department | NITC</title>

		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	      	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="screen,projection"/>
	      	<link type="text/css" rel="stylesheet" href="css/home.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	</head>

	<body class="container">

		<img class="left" height="130px" src="img/nitc.png">
		<h3 class="center">National Institute Of Technology, Calicut</h3>

		<h4 class="center">EEE Department - Leave Application Form</h4>

		<br><hr class="style6 z-depth-1"><br>

		<div id="form_body" class="row">

			<div id="errorsdiv">

				<p>
					<?php  echo $_SESSION["errormsg"]; ?>
				</p>

			</div>

			<form id="mainform" class="col s12" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

				<div class="row">

					<div class="input-field col s6 m4 l4">
				          		<input id="name" name="name" type="text" class="validate" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
					          	<label for="name">Name</label>
				        	</div>

				        	<div class="input-field col s6 m4 l4">
				          		<input id="reg_no" name="regno" type="text" class="validate" value="<?php echo isset($_POST['regno']) ? $_POST['regno'] : '' ?>" required>
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
				          		<input id="semester" name="semester" type="number" class="validate" value="<?php echo isset($_POST['semester']) ? $_POST['semester'] : '' ?>" required>
					          	<label for="semester">Semester</label>
				        	</div>

				        	<div class="row">
					        	<div class="input-field col s6 m6 l6">
				          			<input id="email" name="email" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" class="validate">
					          		<label for="email" data-error="wrong" data-success="right">Email</label>
					        	</div>
				      	</div>

				</div>

				<!-- <br><hr class="style6 z-depth-1"><br> -->

				<div class="row">

				  	<div class="input-field col s6 m4 l4">
					    	<select name="nature" id="nature">
					      		<option value="" disabled selected>Nature of leave</option>
				      			<option value="1">Casual Leave</option>
					      		<option value="2">Medical Leave</option>
					      		<option value="3">Permission To Attend Conference</option>
					    	</select>
					    	<label>Nature Of Leave</label>
				  	</div>

				  	<div class="file-field input-field col s8 m7 l7 right">
					      	<div class="btn" id="nulldocument">
					        		<span>File</span>
					        		<input type="file" name="document" id="document">
					      	</div>
					      	<div class="file-path-wrapper">
					        		<input id="files" class="file-path validate" type="text" name="documentname">
					      	</div>
				    	</div>

				</div>

				<br><hr class="style6 z-depth-1"><br>

				<div class="row col s12 m12 l12">

					<h4 class="center">Period of Absence</h4>
					<p class="center" style="font-size:20px;"><a href="assets/checkleaves.php" target="_blank">Click here to check the number of leaves you can still avail.</a></p><br>
					<div class="row col s12 m4 l3 offset-m1 offset-l1 left">
						<label>From Date</label>
						<input type="date" id="fromdate" name="fromdate" class="datepicker" value="<?php echo isset($_POST['fromdate']) ? $_POST['fromdate'] : '' ?>">
					</div>
					<div class="row col s12 m4 l3 offset-m1 offset-l1">
						<label>To Date</label>
						<input type="date" id="todate" name="todate" class="datepicker" value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : '' ?>">
					</div>
					<div class="row">
						<p class="col offset-m1 offset-l1">No of days : <span class="days">0</span></p>
					</div>

				</div>

				<br><hr class="style6 z-depth-1"><br>

				<div class="row col s12 m12 l12">

					<div class="row">
					          	<div class="input-field col s12">
					            	<input name="reason" id="input_text" type="text" length="500" value="<?php echo isset($_POST['reason']) ? $_POST['reason'] : '' ?>">
					            	<label for="input_text">Reason for absence</label>
					          	</div>
				        	</div>

				</div>

				<button class="btn waves-effect waves-light right" type="submit" name="submit" id="submit">Submit
				        	<i class="material-icons right">send</i>
			    	</button>

			</form>
		</div>

		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/home.js"></script>
      		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>

	</body>

</html>