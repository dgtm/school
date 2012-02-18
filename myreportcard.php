<!DOCTYPE html >

<head>
<title>Report Card</title>
<style type="text/css">
body{margin:auto;}
#wholebody{margin-left:80px;}
#school-name{font-size:25px;font-weight:bold;}
#student-name{font-weight:bold;}
.center-text{text-align:center;}
.total-marks{font-weight:bold;}
.smaller-text{font-size:15px; font-weight:bold;}
#resulttable{
	border:thin;
	}
#comment-table{
	border-spacing:0px;
	margin-top:5px;
	}
.marktable{
	margin-top:5px;
	border-spacing:0px;
	border-style:solid;
	border-collapse:collapse;
	border-color:#000;
	border-width:2px;
}
.marktable td, th
{
	border-width:1px;
	border-style:solid;
	border-color:#000;
}


#endtable td, th
{
    margin: 0;
}

</style>

</head>

<body>
<?php

//}
	function str($terms){
		if($terms=="first") {$txt = "First Term";}
		if($terms=="second") {$txt = "Second Term";}
		if($terms=="third") {$txt = "Final";}
		return $txt;
		}
function getname($sid){
$sql="SELECT * FROM main where ID=$sid";
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
$sql="SELECT * FROM main where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$roll=$row['roll'];
	}
	return $roll;
}

?>

<?php
include("connectdb.php");
$sid=$_GET['sid'];
//$this_term=$_GET['term'];
$myname=getname($sid);
$first="first";
$second="second";
$resultpf="";
$percent=0;
$attend=0;
$rank=0;
$terms=$_GET['term'];

//$terms="third";
$actfm[14]=0;$actpm[14]=0;
//showresults($sid,$first);

//start of logic

//$marks[20]=0;
//$myclass=0;
//$numsubs=0;
//$sub[20]="";
//$fm[20]=0;
//$pm[20]=0;
//$flag[20]="";
//function showresults($sid,$terms)
//{	

	$myclass=getclass($sid);
	if($myclass<=5){$numsubs=9;$group=5;}
	else if($myclass<=8){$numsubs=12;$group=8;}
	else {$numsubs=12;$group=10;}
	$sql="SELECT * FROM $terms where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		for($i=1;$i<=$numsubs;$i++)	{$marks[$i] = $row[$i];}
	}
		$sql="SELECT * FROM `first` where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		for($i=1;$i<=$numsubs;$i++)	{$firstmarks[$i] = $row[$i];}
	}
	
		$sql="SELECT * FROM `second` where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		for($i=1;$i<=$numsubs;$i++)	{$secondmarks[$i] = $row[$i];}
	}
	
		$sql="SELECT * FROM `third` where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		for($i=1;$i<=$numsubs;$i++)	{$thirdmarks[$i] = $row[$i];}
	}
	if($terms=="third"){
	$sql="SELECT * FROM `main` where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		for($i=1;$i<=$numsubs;$i++)	{$finalmarks[$i] = $row[$i];$resultpf=$row['flag'];$attend=$row['attend'];$percent=$row['percent'];$rank=$row['rank'];}
	}
	}
	if ($terms!="third"){
	$sql="SELECT * FROM $terms where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		for($i=1;$i<=$numsubs;$i++)	{$resultpf=$row['flag'];$attend=$row['attend'];$percent=$row['percent'];$rank=$row['rank'];}
	}
	}


	
	$sql="SELECT * FROM `$group`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$totalfm=0;
	for($k=1; $k<=$numsubs; $k++)
	{	
	$row=mysql_fetch_array($result);
	$sub[$k]=$row['subject'];
	$fm[$k]=$row['FM'];
	$actfm[$k]=$fm[$k];
	$totalfm=$totalfm+$fm[$k];
	if ($terms=="first"){$fm[$k]=$row['FM']*1/10;$dpfm[$k]=$row['FM'];}
	else if ($terms=="second"){$fm[$k]=$row['FM']*3/10;$dpfm[$k]=$row['FM'];}
	else if ($terms=="third"){$fm[$k]=$row['FM']*6/10;$dpfm[$k]=$row['FM'];}
	$flag[$k]=$row['flag'];
if($myclass<=5){
	$pm[$k]=(4/10)*$fm[$k];
	$actpm[$k]=(4/10)*$actfm[$k];
	}
else if ($myclass<=10 && $flag[$k]=='T'){
	$pm[$k]=(32/100)*$fm[$k];
	$actpm[$k]=(32/100)*$actfm[$k];}
else if ($myclass<=10 && $flag[$k]=='P'){
	$pm[$k]=(4/10)*$fm[$k];
	$actpm[$k]=(4/10)*$actfm[$k];}

else
	echo "There is apparently something wrong with the full marks in the database. Please contact your administrator.";
}
	}

//end of logic

//rowdisplay($numsubs);
?>
<br><br>
<div id="wholebody">
<table width="650" border="0" id="headtable">
  <tr>
    <td width="618" align="center" valign="middle" bgcolor="#FFFFFF"><span id="school-name">Central Higher Secondary School for the Deaf</span></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF">Naxal, Kathmandu</td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo str($terms);?> Examination, 2068</td>
  </tr>
</table>
<br><br><br>
<table width="655" border="0" id="nametable">
  <tr>
    <td width="420">Name: <span id="student-name"><?php $naam = getname($sid); echo ucwords(strtolower($naam));?></span></td>
    <td width="136">Class: <span id="student-name"><?php echo getclass($sid);?></span></td>
    <td width="85">Roll: <span id="student-name"><?php echo getroll($sid);?></span></td>
  </tr>
</table>
<table width="627" class="marktable">
  <tr align="center" valign="middle">
    <td width="40" class = "center-text" rowspan="2"><strong>SN</strong></td>
    <td width="195" class = "center-text" rowspan="2"><strong>Subjects</strong></td>
    <td width="39" class = "center-text" rowspan="2"><strong>FM</strong></td>
    <td width="39" class = "center-text" rowspan="2"><strong>PM</strong></td>
    <td width="83" class = "center-text" rowspan="2"><strong>Term Marks</strong><br></td>
    <td colspan="4" class = "center-text"><strong>Annual Result</strong></td>
  </tr>
  <tr>
    <td width="40" class = "smaller-text" align="center">I (10%)</td>
    <td width="40" class = "smaller-text" align="center">II (30%)</td>
    <td width="40" class = "smaller-text" align="center">III (60%)</td>
    <td width="50" class = "smaller-text" align="center">Total</td>
  </tr>
  <?php 
	$full_fm=0;
	$full_pm=0;
	$grandfinal=0;
for($k=1; $k<=$numsubs; $k++)
	{?>
  <tr>
    <td width="40" rowspan="2" align="center"><?php echo $k;?></td>
    <td width="195" rowspan="2" valign="middle"><?php echo $sub[$k];?></td>
    <td width="39" rowspan="2" align="center"><?php echo $actfm[$k];?></td>
    <td width="39" rowspan="2" align="center"><?php echo $actpm[$k];?></td>
    <td width="83" rowspan="2" align="center"><?php
	//pf lgic
	if($marks[$k]<$actpm[$k]){
	echo $marks[$k]."*";
	}
	else
	echo $marks[$k];?></td>
  </tr>
   <tr>
    <td width="40" height="30" align="center"><?php if ($terms == "first" || $terms == "third" ){echo round($firstmarks[$k]*10/100,1);}  ?></td>
    <td width="40" height="30" align="center"><?php if ($terms == "second" || $terms == "third" ){echo round($secondmarks[$k]*30/100,1);} ?></td>
    <td width="40" height="30" align="center"><?php if ($terms == "third" || $terms == "third" ){echo round($thirdmarks[$k]*60/100,1);} ?></td>
    <td width="50" height="30" align="center"><?php 

	//////////////////////////////////////////////////////////////////
	$full_pm = $full_pm+$actpm[$k];
if($terms=="third"){
	$grandfinal=$grandfinal+$finalmarks[$k];
	if($finalmarks[$k]>= $actpm[$k])
	echo $finalmarks[$k];
	else
	echo $finalmarks[$k]."*";
}
else{
	$grandfinal=$grandfinal+$marks[$k];
	if($marks[$k]>= $actpm[$k])
	echo $marks[$k];
	else
	echo $marks[$k]."*";
	
	}
	?></td>
  </tr>
  <?php } ?>
  <tr>
  	<td width="40" class="total-marks" rowspan="2" align="center">Total</td>
    <td width="195" rowspan="2" valign="middle"></td>
    <td width="39" class="total-marks" rowspan="2" align="center"><?php echo $totalfm; ?></td>
    <td width="39" class="total-marks" rowspan="2" align="center"><?php echo $full_pm; ?></td>
    <td colspan="4" class="total-marks" align="center"></td>
    <td width="83" class="total-marks" rowspan="2" align="center"><?php echo $grandfinal; ?></td>
  </tr> 
</table>
<br>
<table width="627" border="0" id="resulttable">
  <tr id="endtable">
    <td width="157" align="left" valign="top">Result: &nbsp;&nbsp;&nbsp;&nbsp;  <strong>
      <?php if ($resultpf=="P"){echo "Pass";} else if($resultpf=="F"){echo "<b>Fail</b>";} ?>
    </strong></td>
    <td width="171" align="left" valign="top">Percentage: <?php echo $percent."%"; ?></td>
    <td width="135" align="left" valign="top">Position: <?php if ($resultpf=="P"){echo $rank;} else if($resultpf=="F"){echo "";}?></td>
    <td width="146" align="left" valign="top">Attendance: <?php echo $attend; ?></td>
  </tr>
  <tr>
    <td height="125" colspan="4" valign="top"><br>
    Teacher's Comments
<!--    <table width="592" height="62" border="1" id="comment-table">
      <tr>
        <td width="582" height="56">&nbsp;</td>
      </tr>
    </table>--></td>
  </tr>
  <tr>
    <td><p>___________________<br>
      Class Teacher
    </p></td>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: <?php echo date("j/n/Y")?></td>
    <td>________________<br>
    Principal</td>
  </tr>
</table>
</div>
<br>
</body>
</html>