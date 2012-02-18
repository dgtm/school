<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery-1.5.min.js" type="text/javascript"></script>
<title>Student Details</title>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>

<body>


<?php
include("connectdb.php");
$sid=$_GET['sid'];
//if(student_exists($sid)){echo "Yes";}
?>

<?php
$myname=getname($sid);
echo "Name: ".getname($sid)."<br>";
echo "Class: ".getclass($sid)."<br>";
echo "Roll No.: ".getroll($sid)."<br>";
$first="first";
$second="second";
$third="third";
?>
<style>
</style>
<div id = "linker">
<ul>
<li><a href="deletion.php?sid=<?php echo $sid?>">Delete this student</a></li>
</ul>
</div> 

<div id = "enter">
 Enter Marks
                <ul>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=first">First Term</a></li>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=second">Second Term</a></li>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=third">Third term</a>
                </li>
                </ul>
</div>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script>
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>

<form name="changename" method="post" action="changedetails.php?sid=<?php echo $sid; ?>">
Enter new name for <?php echo $myname;?> :<span id="sprytextfield2">
<label>
  <input type="text" name="namefield" id="text2" /><br />
</label>
<span class="textfieldRequiredMsg">A value is required.</span></span> 
Enter new roll no.: <span id="sprytextfield1">
<label>
  <input type="text" name="rollfield" id="text1" /><br />
</label>
<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
<label>
  <input type="submit" name="button" id="button" value="Change" /><br />
</label>
</form>

<table width="800" border="1">
  <tr>
    <td><?php showresults($sid,$first);?>
    <a href="termexam.php?sid=<?php echo $sid?>&term=first">Edit marks for First Term</a><br />
        <a href="print_single.php?sid=<?php echo $sid?>&term=first">Print report card for First Term</a>

</td>
    <td><?php showresults($sid,$second);?>
    <a href="termexam.php?sid=<?php echo $sid?>&term=second">Edit marks for Second Term</a><br />
            <a href="print_single.php?sid=<?php echo $sid?>&term=second">Print report card for Second Term</a>

</td>
    <td><?php showresults($sid,$third);?>
    <a href="termexam.php?sid=<?php echo $sid?>&term=third">Edit marks for Third term</a><br />
                <a href="print_single.php?sid=<?php echo $sid?>&term=third">Print report card for Final Term</a>

</td>
  </tr>
</table>
<?php
function showresults($sid,$terms)
{	$sub[20]="";$marks[20]=0;
	$myclass=getclass($sid);
	if($myclass<=5){$numsubs=9;$group=5;}
	else if($myclass<=8){$numsubs=12;$group=8;}
	else {$numsubs=12;$group=10;}
	$sql="SELECT * FROM `$terms` where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	$row=mysql_fetch_array($result);
	for($i=1;$i<=$numsubs;$i++){$marks[$i] = $row[$i];}
	$sql="SELECT * FROM `$group`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	for($k=1; $k<=$numsubs; $k++)
	{	$row=mysql_fetch_array($result);
		$sub[$k]=$row['subject'];
	}
	}
	echo $terms." Term result"."<br>";
	for($k=1; $k<=$numsubs; $k++)
	{	
	echo $sub[$k];
	echo str_repeat("&nbsp;", 10);
	echo $marks[$k]."<br>";
	}
	echo "<br>.<br>";
}
}
function getname($sid){
$sql="SELECT * FROM `main` where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$name=$row['name'];
	}
	return $name;
}
function getclass($sid){
$sql="SELECT * FROM main where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$class=$row['class'];
	}
	return $class;
}
function getroll($sid){
$sql="SELECT * FROM `main` where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$roll=$row['roll'];
	}
	return $roll;
}

?>

<section id="menu">
<nav>
  <ul>
<li><a href="index.php">Home</a></li>
    <li><a href='print_single.php?sid=<?php echo $sid ?>&term=third'>Print Final Result</a></li>
  </ul>
  </nav>
</section>


</body>

</html>