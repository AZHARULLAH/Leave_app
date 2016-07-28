<?php

	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_db = "leaveapp";
	$conn_error = "<h3>No connection</h3> <br> Please check your internet connection...";
	$mysql_conn = mysql_connect($mysql_host, $mysql_username, $mysql_password, $mysql_db);
	if(mysql_error())
	{
		die($conn_error);
	}

	$link = "localhost/leaveapp/assets/";
	$uploadslink = "/leaveapp/uploads/";

?>