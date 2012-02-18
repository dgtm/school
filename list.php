<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<form name="studentlister" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
List by name:<input type="text" name="name" /><br />
Alternatively, List students of Class
 <select name="select-class">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
<input type="submit" name="submit" value="List" />
</form>
</body>

<?php
$main="main";
include("connectdb.php");

if (!empty($_POST['name'])){
	$myname = $_POST['name'];
$sql="SELECT * FROM `$main` where name like '%$myname%'";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{

	$num = mysql_numrows($result);
		 echo "<table border=1 width=400 align=center><tr><td>"."Name"."</td><td>Class</td><td>Roll</td>"."</tr>";

	for($k=0; $k<$num; $k++)
	{	
		$row=mysql_fetch_array($result);
		$id[$k]=$row['ID'];
		$name[$k]=$row['name'];
		$roll[$k]=$row['roll'];
		$class[$k]=$row['class'];
?>
	        <tr><td>

<a href="viewdetails.php?sid=<?php echo $id[$k]; ?>"><?php echo $name[$k];?></a></td><td><?php echo $class[$k];?></td><td><?php echo $roll[$k]."</td></tr>";?>
	<?php }	
	?>
    </table>
    <?php
	}
	}
else if (!empty($_POST['select-class'])){
	$myclass = $_POST['select-class'];
	echo "Class::".$myclass;
	$sql="SELECT * FROM `$main` where class=$myclass ORDER BY roll";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{

	$num = mysql_num_rows($result);
	
	 echo "<table border=1 width=400 align=center><tr><td>"."Name"."</td><td>Roll</td>"."</tr>";
	for($k=0; $k<$num; $k++)
	{	
		$row=mysql_fetch_array($result);
		$id[$k]=$row['ID'];
		$name[$k]=$row['name'];
		$roll[$k]=$row['roll']; 
		?>
        <tr><td>
		<a href="viewdetails.php?sid=<?php echo $id[$k]; ?>"><?php echo $name[$k];?></a></td><td><?php echo $roll[$k]."</td></tr>";?>
        
        <?php

	}?>	
	</table>
	<?php
    }
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