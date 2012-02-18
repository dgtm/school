<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("connectdb.php");
	save_history();
		for ($class=9;$class>=1;$class--)
	{upgrade_passed($class);	}
	for ($class=10;$class>=1;$class--)
	{degrade_failed($class);}
    reset_marks();
	echo "Passed students have been promoted and failed students have been set to the same class. Do not upgrade class again.";
	?><br />
    <a href="index.php"> Return Home</a>
    <?php
	
function save_history(){
	$tables = create_tables();
	$sql_query1 = "INSERT INTO history_main SELECT * FROM main";
	$sql_query2 = "INSERT INTO history_first SELECT * FROM first";
	$sql_query3 = "INSERT INTO history_second SELECT * FROM second";
	$sql_query4 = "INSERT INTO history_third SELECT * FROM third";
			$result = mysql_query($sql_query1) or die(mysql_error());
			$result = mysql_query($sql_query2) or die(mysql_error());
			$result = mysql_query($sql_query3) or die(mysql_error());
			$result = mysql_query($sql_query4) or die(mysql_error());
	}
//historyID int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,

function create_tables()
{
	$sql_main = "CREATE TABLE IF NOT EXISTS history_main 
(
ID 	int(3), 			
name varchar(30),		
class int(11), 			
roll int(11), 			
total decimal(8,2), 			
percent decimal(5,2), 			
flag varchar(1), 		
`1` decimal(8,2), 			
`2` decimal(8,2), 			
`3` decimal(8,2), 			
`4` decimal(8,2), 			
`5` decimal(8,2), 			
`6` decimal(8,2), 			
`7` decimal(8,2), 			
`8` decimal(8,2), 			
`9` decimal(8,2), 			
`10` decimal(8,2), 			
`11` decimal(5,2), 			
`12` decimal(5,2),
`13` decimal(8,2), 			
`14` decimal(8,2), 			
`15` decimal(8,2), 			
`16` decimal(8,2), 			
`17` decimal(8,2), 			
`18` decimal(8,2), 			
`19` decimal(8,2), 			
`20` decimal(8,2), 			
attend 	varchar(11), 		
rank int(11), 			
batch int(11) 	
)";
	$sql_second = "CREATE TABLE IF NOT EXISTS history_second 
(
ID 	int(3), 			
name varchar(30),		
class int(11), 			
roll int(11), 			
total decimal(8,2), 			
percent decimal(5,2), 			
flag varchar(1), 		
`1` decimal(8,2), 			
`2` decimal(8,2), 			
`3` decimal(8,2), 			
`4` decimal(8,2), 			
`5` decimal(8,2), 			
`6` decimal(8,2), 			
`7` decimal(8,2), 			
`8` decimal(8,2), 			
`9` decimal(8,2), 			
`10` decimal(8,2), 			
`11` decimal(5,2), 			
`12` decimal(5,2),
`13` decimal(8,2), 			
`14` decimal(8,2), 			
`15` decimal(8,2), 			
`16` decimal(8,2), 			
`17` decimal(8,2), 			
`18` decimal(8,2), 			
`19` decimal(8,2), 			
`20` decimal(8,2), 			
attend 	varchar(11), 		
rank int(11), 			
batch int(11) 	
)";
	$sql_third ="CREATE TABLE IF NOT EXISTS history_third 
(
ID 	int(3), 			
name varchar(30),		
class int(11), 			
roll int(11), 			
total decimal(8,2), 			
percent decimal(5,2), 			
flag varchar(1), 		
`1` decimal(8,2), 			
`2` decimal(8,2), 			
`3` decimal(8,2), 			
`4` decimal(8,2), 			
`5` decimal(8,2), 			
`6` decimal(8,2), 			
`7` decimal(8,2), 			
`8` decimal(8,2), 			
`9` decimal(8,2), 			
`10` decimal(8,2), 			
`11` decimal(5,2), 			
`12` decimal(5,2),
`13` decimal(8,2), 			
`14` decimal(8,2), 			
`15` decimal(8,2), 			
`16` decimal(8,2), 			
`17` decimal(8,2), 			
`18` decimal(8,2), 			
`19` decimal(8,2), 			
`20` decimal(8,2), 			
attend 	varchar(11), 		
rank int(11), 			
batch int(11) 	
)";
	$sql_first = "CREATE TABLE IF NOT EXISTS history_first
(
ID 	int(3), 			
name varchar(30),		
class int(11), 			
roll int(11), 			
total decimal(8,2), 			
percent decimal(5,2), 			
`flag` varchar(1), 		
`1` decimal(8,2), 			
`2` decimal(8,2), 			
`3` decimal(8,2), 			
`4` decimal(8,2), 			
`5` decimal(8,2), 			
`6` decimal(8,2), 			
`7` decimal(8,2), 			
`8` decimal(8,2), 			
`9` decimal(8,2), 			
`10` decimal(8,2), 			
`11` decimal(5,2), 			
`12` decimal(5,2),
`13` decimal(8,2), 			
`14` decimal(8,2), 			
`15` decimal(8,2), 			
`16` decimal(8,2), 			
`17` decimal(8,2), 			
`18` decimal(8,2), 			
`19` decimal(8,2), 			
`20` decimal(8,2), 					
attend 	varchar(11), 		
rank int(11), 			
batch int(11) 	
)";
$result = mysql_query($sql_main) or die(mysql_error());
$result = mysql_query($sql_first) or die(mysql_error());
$result = mysql_query($sql_second) or die(mysql_error());
$result = mysql_query($sql_third) or die(mysql_error());
if ($result){
	echo "";
	}
}

function reset_marks()
{
		$sql_query = "SELECT * FROM main";
		$result = mysql_query($sql_query) or die(mysql_error());
			if ($result){
					$num = mysql_numrows($result);
					for($k=0; $k<$num; $k++)
						{	
							$row=mysql_fetch_array($result);
							$id[$k] = $row['ID'];
							$update_roll= "UPDATE main SET 
							`total`=0, 			
`percent`=0, 			
`flag`='F', 		
`1`=0, 			
`2`=0, 			
`3`=0, 			
`4`=0, 			
`5`=0, 			
`6`=0, 			
`7`=0, 			
`8`=0, 			
`9`=0, 			
`10`=0, 			
`11`=0, 			
`12`=0,
`13`=0, 			
`14`=0, 			
`15`=0, 			
`16`=0, 			
`17`=0, 			
`18`=0, 			
`19`=0, 			
`20`=0, 					
`attend`=0, 		
`rank`=0 AND 			
`batch`=0 WHERE ID=$id[$k]";
							$qry = mysql_query($update_roll) or die(mysql_error());
														$update_roll= "UPDATE first SET 
							`total`=0, 			
`percent`=0, 			
`flag`='F', 		
`1`=0, 			
`2`=0, 			
`3`=0, 			
`4`=0, 			
`5`=0, 			
`6`=0, 			
`7`=0, 			
`8`=0, 			
`9`=0, 			
`10`=0, 			
`11`=0, 			
`12`=0,
`13`=0, 			
`14`=0, 			
`15`=0, 			
`16`=0, 			
`17`=0, 			
`18`=0, 			
`19`=0, 			
`20`=0, 					
`attend`=0, 		
`rank`=0 AND 			
`batch`=0 WHERE ID=$id[$k]";
							$qry = mysql_query($update_roll) or die(mysql_error());
														$update_roll= "UPDATE second SET 
							`total`=0, 			
`percent`=0, 			
`flag`='F', 		
`1`=0, 			
`2`=0, 			
`3`=0, 			
`4`=0, 			
`5`=0, 			
`6`=0, 			
`7`=0, 			
`8`=0, 			
`9`=0, 			
`10`=0, 			
`11`=0, 			
`12`=0,
`13`=0, 			
`14`=0, 			
`15`=0, 			
`16`=0, 			
`17`=0, 			
`18`=0, 			
`19`=0, 			
`20`=0, 					
`attend`=0, 		
`rank`=0 AND 			
`batch`=0 WHERE ID=$id[$k]";
							$qry = mysql_query($update_roll) or die(mysql_error());
							$update_roll= "UPDATE third SET 
							`total`=0, 			
`percent`=0, 			
`flag`='F', 		
`1`=0, 			
`2`=0, 			
`3`=0, 			
`4`=0, 			
`5`=0, 			
`6`=0, 			
`7`=0, 			
`8`=0, 			
`9`=0, 			
`10`=0, 			
`11`=0, 			
`12`=0,
`13`=0, 			
`14`=0, 			
`15`=0, 			
`16`=0, 			
`17`=0, 			
`18`=0, 			
`19`=0, 			
`20`=0, 					
`attend`=0, 		
`rank`=0 AND 			
`batch`=0 WHERE ID=$id[$k]";
							$qry = mysql_query($update_roll) or die(mysql_error());
		
					}	
				}
}

function upgrade_passed($class)
{
		$sql_query = "SELECT * FROM main WHERE `class`= $class AND `flag`='P' ORDER BY rank DESC";
		$result = mysql_query($sql_query) or die(mysql_error());
			if ($result){
					$num = mysql_numrows($result);
	
					for($k=0; $k<$num; $k++)
						{	
							$row=mysql_fetch_array($result);
							$id[$k]=$row['ID'];
							$current_class[$k] = $row['class'];
							$newclass = $current_class[$k] + 1;
							$rank[$k]=$row['rank'];
							$update_roll= "UPDATE main SET `roll` = $rank[$k] WHERE ID=$id[$k]";
							$qry = mysql_query($update_roll) or die(mysql_error());
							$update_class= "UPDATE main SET `class` = $newclass WHERE ID=$id[$k]";
							$qry = mysql_query($update_class) or die(mysql_error());
														$update_class= "UPDATE first SET `class` = $newclass WHERE ID=$id[$k]";
							$qry = mysql_query($update_class) or die(mysql_error());
														$update_class= "UPDATE second SET `class` = $newclass WHERE ID=$id[$k]";
							$qry = mysql_query($update_class) or die(mysql_error());
														$update_class= "UPDATE third SET `class` = $newclass WHERE ID=$id[$k]";
							$qry = mysql_query($update_class) or die(mysql_error());
							$update_roll_first= "UPDATE first SET `roll` = $rank[$k] WHERE ID=$id[$k]";
							$update_roll_second= "UPDATE second SET `roll` =$rank[$k] WHERE ID=$id[$k]";
							$update_roll_third= "UPDATE third SET `roll` = $rank[$k] WHERE ID=$id[$k]";							
							$qry = mysql_query($update_roll_first) or die(mysql_error());
							$qry = mysql_query($update_roll_second) or die(mysql_error());
							$qry = mysql_query($update_roll_third) or die(mysql_error());
							

							
						}	
				}
}

function degrade_failed($class)
{
		$total_students = find_total_passed_students($class);
		$fail_roll_no = $total_students + 1;
		$sql_query = "SELECT * FROM main WHERE `class`= $class AND `flag`='F' ORDER BY percent DESC";
		$result = mysql_query($sql_query) or die(mysql_error());
			if ($result){
					$num = mysql_numrows($result);
	
					for($k=0; $k<$num; $k++)
						{	
							$row=mysql_fetch_array($result);
							$id[$k]=$row['ID'];
							$current_class[$k] = $row['class'];
							$newclass = $current_class[$k];
							$update_roll_main= "UPDATE main SET `roll` = $fail_roll_no WHERE ID=$id[$k]";
							$update_roll_first= "UPDATE first SET `roll` = $fail_roll_no WHERE ID=$id[$k]";
							$update_roll_second= "UPDATE second SET `roll` = $fail_roll_no WHERE ID=$id[$k]";
							$update_roll_third= "UPDATE third SET `roll` = $fail_roll_no WHERE ID=$id[$k]";
							$qry = mysql_query($update_roll_main) or die(mysql_error());
							$qry = mysql_query($update_roll_first) or die(mysql_error());
							$qry = mysql_query($update_roll_second) or die(mysql_error());
							$qry = mysql_query($update_roll_third) or die(mysql_error());

							$fail_roll_no++;
					}	
				}
}

function find_total_passed_students($class){
		$sql_query = "SELECT rank from main where rank =(SELECT Max(rank) FROM main WHERE `class`= $class)";
		$result = mysql_query($sql_query) or die(mysql_error());
		if($result){
					$row=mysql_fetch_array($result);
					$max=$row['rank'];
			}
	return $max;
	}

?>

</body>
</html>