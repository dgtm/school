<head>
<script src="jquery-1.5.min.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<?php
include("connectdb.php");
$table="main";
$sid=$_GET['sid'];
$classic=classfinder($sid);
if ($classic<=5){$numsubjects=9;$tabletoread=5;}
else if ($classic<=8){$numsubjects=12;$tabletoread=8;}
else{$numsubjects=12;$tabletoread=10;}
$mark[20]=0;

function classfinder($sid)
{
	$table="main";
$sql="SELECT * FROM `$table` where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$class=$row['class'];
	}
	return $class;
}
	?>

<?php $sid=$_GET['sid'];	$term=$_GET['term'];?>

<form method="post" name="form" id = "marksform" action="editmarks.php?sid=<?php echo $sid?>&term=<?php echo $term;?>">
<?php
//To show values in textbox
$querysql="SELECT * FROM `$term` where ID=$sid";
$result = mysql_query($querysql) or die(mysql_error());
	if($result){	$row=mysql_fetch_array($result);

	for($k=1; $k<=$numsubjects; $k++)
	{
	$mark[$k]=$row[$k];
	}
	}
//
	$sql="SELECT * FROM `$tabletoread`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	$numsubs=mysql_num_rows($result);
	for($k=1; $k<=$numsubs; $k++)
	{	
	$row=mysql_fetch_array($result);
	$sub[$k]=$row['subject'];
	$fm[$k]=$row['FM']; 
	}
	}
	for($k=1;$k<=$numsubs;$k++)
	{
?>
<p><?php echo $sub[$k];?>
<span id="sprytextfield<?php echo $k;?>">
    <input type="text" name="<?php echo $k;?>" id="<?php echo $k;?>" value="<?php echo $mark[$k];?>" class="validity"/>
	<span class="textfieldRequiredMsg">Marks required!</span>
 	<span class="textfieldInvalidFormatMsg">Number required!</span>
 	<span class="textfieldMaxValueMsg">Entered marks exceeds full marks!</span>
</span>
  </p>
 <?php }  ?>
 <span id="sprytextfield_attendance">
    <br />Attendance:<input type="text" name="attend" id="attd"/>
 	<span class="textfieldRequiredMsg">Attendance required!</span>
 	<span class="textfieldInvalidFormatMsg">Attendance is invalid</span>
 	<span class="textfieldMinValueMsg">Attendance must be greater than 0</span>
</span>

 
 
<script type="text/javascript">
<!--
<?php for($k=1;$k<=$numsubs;$k++){?>
var sprytextfield<?php echo $k;?> = new Spry.Widget.ValidationTextField("sprytextfield<?php echo $k;?>","real", {minValue:0, maxValue:<?php echo $fm[$k];?>});
<?php } ?>
var sprytextfield_attendance = new Spry.Widget.ValidationTextField("sprytextfield_attendance","integer",{minValue:0});
-->
</script>
 
<p><!--<span id="spryselect1">
  <label> Select Term<br /></label>
  
  
  Modification no. 2
  <select name="term" size="2" id="term2">
  
  
  <select name="hidden" size="2" id="term2" value="<?php echo $term ?>">
    <option value="first">First Term</option>
    <option value="second">Second Term</option>
    <option value="third">Third Term</option>
  </select><span class="selectRequiredMsg">Please select a term</span></span>-->
</p>
<input type="submit" name="submit" />

</form>