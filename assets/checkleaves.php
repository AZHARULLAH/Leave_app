<?php

	session_start();
	error_reporting(0);
	if(!isset($_SESSION['errormsg']) || empty($_SESSION['errormsg']) || $_SESSION['errormsg'] == "")
	{
		$_SESSION['errormsg'] = "";
	}

?>

<?php

	require "../includes/connectdb.php";
	mysql_select_db("leaveapp");

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['submit']))
		{
			$regno = strtolower(trim(stripslashes(htmlspecialchars($_POST['rollno']))));
		}
	}

	$message = "";

	$sql = "SELECT * FROM leaves_availed WHERE reg_no = '$regno'";
	$query = mysql_query($sql, $mysql_conn);
	if(!$query)
	{
		$message = $message . " Invalid Roll number. Please enter a valid one.";
		$_SESSION['errormsg'] = $message;
	}
	else
	{
		$row = mysql_fetch_assoc($query);
		$leaves_availed = $row['no_of_leaves'];
	}

	$char = substr($regno, 0, 1);
	if($char == "b")
	{
		$sql = "SELECT no_of_leaves FROM max_leaves_allowed WHERE programme = 1";
	}
	elseif($char == "m")
	{
		$sql = "SELECT no_of_leaves FROM max_leaves_allowed WHERE programme = 2";
	}
	elseif($char == "p")
	{
		$sql = "SELECT no_of_leaves FROM max_leaves_allowed WHERE programme = 3";
	}

	$query = mysql_query($sql, $mysql_conn);
	$row = mysql_fetch_assoc($query);
	$max_leaves = $row['no_of_leaves'];

?>

<html>

	<head>

		<title>EEE Department | NITC</title>

		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	      	<link type="text/css" rel="stylesheet" href="../materialize/css/materialize.css"  media="screen,projection"/>
	      	<link type="text/css" rel="stylesheet" href="../css/home.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	</head>

	<body class="container">

		<h3 class="center">National Institute Of Technology, Calicut</h3>

		<h4 class="center">EEE Department - Leave Application From</h4>

		<br><hr class="style6"><br>

		<div id="errorsdiv">

			<p>
				<?php  echo $_SESSION["errormsg"]; ?>
			</p>

		</div>

		<div id="form_body" class="row">

			<form  class="col s12" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

				<div class="row">

					<div class="input-field col s6 m4 l3 push-l4">
				          		<input id="rollno" name="rollno" type="text" class="validate" value="<?php echo isset($_POST['rollno']) ? $_POST['rollno'] : '' ?>" required>
					          	<label for="rollno">Registration number</label>
				        	</div>

				        	<button style="margin-top:25px;" class="btn waves-effect waves-light col push-l5" type="submit" name="submit" id="submit">Check
					        	<i class="material-icons right">send</i>
				    	</button>

				</div>

			</form>

		</div>

		<?php  

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				if(isset($_POST['submit']))
				{

		?>

			<div id="info">

				<h5><?php echo $regno;  ?></h5>
				<p>Maximum number of leaves allowed : <span class="numbers"><?php echo $max_leaves;  ?></span></p>
				<p>Number of leaves already availed : <span class="numbers"><?php echo $leaves_availed;  ?></span></p>
				<p>Maximum number of leaves allowed : <span class="numbers"><?php echo $max_leaves - $leaves_availed;  ?></span></p>

			</div>

		<?php }} ?>

		<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
      		<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>

	</body>

</html>