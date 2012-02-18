<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery-1.5.min.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("connectdb.php");
$sid=$_GET['sid'];

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
$myname=getname($sid);
$myroll = getroll($sid);

?>

<form name="changename" method="post" action="changedetails.php?sid=<?php echo $sid; ?>">
Enter new name for <?php echo $myname;?> :<span id="sprytextfield2">
<label>
  <input type="text" name="namefield" id="text2" required="true" /><br />
</label>
<span class="textfieldRequiredMsg">A value is required.</span></span> 
Enter new roll no.: <span id="sprytextfield1">
<label>
  <input type="text" name="rollfield" id="text1" required="true"/><br />
</label>
<span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
<label>
  <input type="submit" name="button" id="button" value="Change" /><br />
</label>
</form>


</body>
</html>