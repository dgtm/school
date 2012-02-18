<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("connectdb.php");
$name = $_POST['name'];
$class = $_POST['class'];
$roll = $_POST['roll'];
$totalstudent=3;
$id=randgen($totalstudent);
$sid=check($id,$totalstudent);

		$sql="SELECT * FROM main WHERE name='$name' AND `roll`= $roll AND `class`= $class ";
$result = mysql_query($sql) or die(mysql_error());
		if($result) {	$rows=mysql_num_rows($result);
					if ($rows>0) {echo "$name is already present in class $class . Please try changing the roll number.";}
					else{
					$roll_sql="SELECT * FROM main WHERE`roll`= $roll AND `class`= $class ";
					$result = mysql_query($roll_sql) or die(mysql_error());
					if($result) {
					$rows=mysql_num_rows($result);
					if ($rows>0) {echo "Roll no. $roll is already present in class $class . Please try changing the roll number.";}
					else{
					$finsql="INSERT INTO `first`(`name` , `class`, `roll`, `ID`, `batch`) VALUES ('$name', '$class', '$roll', '$sid', 0)";
					$sinsql="INSERT INTO `second`(`name` , `class`, `roll`, `ID`, `batch`) VALUES ('$name', '$class', '$roll', '$sid', 0)";
					$tinsql="INSERT INTO `third`(`name` , `class`, `roll`, `ID`, `batch`) VALUES ('$name', '$class', '$roll', '$sid', 0)";
					$mainsql="INSERT INTO `main`(`name` , `class`, `roll`, `ID`, `batch`) VALUES ('$name', '$class', '$roll', '$sid', 0)";
		$qry = mysql_query($mainsql) or die (mysql_error());
				$qry = mysql_query($finsql) or die (mysql_error());
						$qry = mysql_query($sinsql) or die (mysql_error());
							$qry = mysql_query($tinsql) or die (mysql_error());
					
			if($qry)
			{
				echo "$name added to class $class"."<br>";
				?>
                Enter Marks
                <ul>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=first">First Term</a></li>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=second">Second Term</a></li>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=third">Third Term</a></li>

                </ul>
                <a href="studentadder.php">Add new Student</a>
                <?php
			}
			else {echo"$name could not be added.";}
			}
			}}}
function randgen($length)
{
	$random= "";

	srand((double)microtime()*1000000);

	$data = "45729839";
	$data .= "1234567890";

	for($i = 0; $i < $length; $i++)
	{
		$random .= substr($data, (rand()%(strlen($data))), 1);
	}

	return $random;
}
//function to check uniqueness
function check($num,$totalstudent)
{
		$new=$num;		
		$uniq=" SELECT * FROM main";
		$chk= mysql_query($uniq) or die (mysql_error());
		if($chk)
		{
			
			while($row=mysql_fetch_array($chk))
			{
				
				if($new==$row['ID'])
				{
						$ranx=randgen($totalstudent);
						$new=check($ranx,$totalstudent);
				}				
			}
		}
		return($new);
		
}			
?>
<section id="menu">
<nav>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="studentadder.php">Add Student</a></li>
<li><a href="list.php">List Students</a></li>
<li>Edit Student Info</li>

</ul>
</nav>
</section>
</body>
</html>