<?php
		// Setup MySQL Connection variables
		
		$dbhost 	= "localhost";			//database host
		$dbuser 	= "root";				//database username
		$dbpassword = "";					//database password
		$database 	= "school";			//database name


		// Connect to the mySQL Server
		
		mysql_connect($dbhost, $dbuser, $dbpassword) or die("Can not connect to database: ".mysql_error());
		$connectDB = mysql_connect($dbhost, $dbuser, $dbpassword); 


		// Open the mySQL Database
		
		mysql_select_db($database) or die("Can not select the database: ".mysql_error()); 

?>

