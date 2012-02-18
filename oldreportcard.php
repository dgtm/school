<!DOCTYPE html >

<head>
<title>Report Card</title>
<style type="text/css">
#markstable, #totaltable,#resulttable
{
    border-width: 1px 1px 1px 1px;
    border-spacing: 0;
    border-style: solid;
}

#markstable td, th
{
    margin: 0;
    border-width: 1px 1px 0px 0px;
    border-style: solid;
}

#totaltable td, th
{
    margin: 0;
    border-width: 0px 1px 0px 0px;
    border-style: solid;
}

#endtable td, th
{
    margin: 0;
    border-width: 1px 1px 1px 1px;
    border-style: solid;
}

</style>
<script language="JavaScript">
DA = (document.all) ? 1 : 0

function HandleError()	
{
alert("\nNothing was printed. \n\nIf you do want to print this page, then\nclick on the printer icon in the toolbar above.")
return true;
}
</script>
</head>

<script language="VBScript">

Sub window_onunload()
On Error Resume Next
Set WB = nothing
On Error Goto 0
End Sub

Sub Print()
OLECMDID_PRINT = 6
OLECMDEXECOPT_DONTPROMPTUSER = 2
OLECMDEXECOPT_PROMPTUSER = 1


On Error Resume Next

If DA Then
call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)

Else
call WB.IOleCommandTarget.Exec(OLECMDID_PRINT ,OLECMDEXECOPT_DONTPROMPTUSER,"","","")

End If

If Err.Number <> 0 Then
If DA Then
Alert("Nothing Printed :" & err.number & " : " & err.description)
Else
HandleError()
End if
End If
On Error Goto 0
End Sub

If DA Then
wbvers="8856F961-340A-11D0-A96B-00C04FD705A2"
Else
wbvers="EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
End If

document.write "<object ID=""WB"" WIDTH=0 HEIGHT=0 CLASSID=""CLSID:"
document.write wbvers & """> </object>"
</script>

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
$historymain = "historymain";
$historyfirst = "historyfirst";
$historysecond = "historysecond";
$historythird = "historythird";
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
	$sql="SELECT * FROM $historymain where ID=$sid ";
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
<table width="650" border="0" id="headtable">
  <tr>
    <td width="618" align="center" valign="middle" bgcolor="#FFFFFF"><font size="+2"><strong>Central Higher Secondary School for the Deaf</strong></font></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF">Naxal, Kathmandu</td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo str($terms);?> Examination, 2068</td>
  </tr>
</table>
<br>
<table width="655" border="0" id="nametable">
  <tr>
    <td width="420">Name: <?php echo getname($sid);?></td>
    <td width="136">Class: <?php echo getclass($sid);?></td>
    <td width="85">Roll: <?php echo getroll($sid);?></td>
  </tr>
</table>
<table width="625" border="1">
  <tr align="center" valign="middle">
    <td width="40" rowspan="2"><strong>SN</strong></td>
    <td width="195" rowspan="2"><strong>Subjects</strong></td>
    <td width="39" rowspan="2"><strong>FM</strong></td>
    <td width="39" rowspan="2"><strong>PM</strong></td>
    <td width="83" rowspan="2"><strong>Term Marks</strong><br></td>
    <td colspan="4"><strong>Annual Result</strong></td>
  </tr>
  <tr>
    <td width="39" align="center"><font size="-2">I (10%)</font></td>
    <td width="40" align="center">II (30%)</td>
    <td width="42" align="center">III (60%)</td>
    <td width="50" align="center">Total</td>
  </tr>
</table>
<table width="627" border="0" id="markstable">
  <?php 
	$full_fm=0;
	$full_pm=0;
	$grandfinal=0;
for($k=1; $k<=$numsubs; $k++)
	{?>
  <tr>
    <td width="42" rowspan="2" align="center"><?php echo $k;?></td>
    <td width="209" rowspan="2" valign="middle"><?php echo $sub[$k];?></td>
    <td width="42" rowspan="2" align="center"><?php echo $actfm[$k];?></td>
    <td width="42" rowspan="2" align="center"><?php echo $actpm[$k];?></td>
    <td width="90" rowspan="2" align="center"><?php
	//pf lgic
	if($marks[$k]<$actpm[$k]){
	echo $marks[$k]."*";
	}
	else
	echo $marks[$k];?></td>
  </tr>
   <tr>
    <td width="42" height="30" align="center"><?php if ($terms == "first" || $terms == "third" ){echo round($firstmarks[$k]*10/$actfm[$k],1);}  ?></td>
    <td width="42" align="center"><?php if ($terms == "second" || $terms == "third" ){echo round($secondmarks[$k]*30/$actfm[$k],1);} ?></td>
    <td width="42" align="center"><?php if ($terms == "third" || $terms == "third" ){echo round($thirdmarks[$k]*60/$actfm[$k],1);} ?></td>
    <td width="51" align="center"><?php 

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
  
 
</table>
<table width="627" border="0" id="totaltable">
  <tr>
    <td width="43"><strong>Total</strong></td>
    <td width="209">&nbsp;</td>
    <td width="29"><strong><?php echo $totalfm; ?></strong></td>
    <td width="31" align="center"><strong><?php echo $full_pm; ?></strong></td>
    <td width="90">&nbsp;</td>
    <td width="128">&nbsp;</td>
    <td width="51" align="center"><strong><?php echo $grandfinal; ?></strong></td>
  </tr>
</table>
<br>
<table width="627" border="0" id="resulttable">
  <tr id="endtable">
    <td width="157" align="left" valign="top">Result: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <strong>
      <?php if ($resultpf=="P"){echo "Pass";} else if($resultpf=="F"){echo "<b>Fail</b>";} ?>
    </strong></td>
    <td width="171" align="left" valign="top">Percentage: <?php echo $percent."%"; ?></td>
    <td width="135" align="left" valign="top">Position: <?php if ($resultpf=="P"){echo $rank;} else if($resultpf=="F"){echo "";}?></td>
    <td width="146" align="left" valign="top">Attendance: <?php echo $attend; ?></td>
  </tr>
  <tr>
    <td height="55" colspan="4" valign="top"><br>
    Teacher's Comments:<br>
    <table width="592" height="62" border="1" id="comment-table">
      <tr>
        <td width="582" height="56">&nbsp;</td>
      </tr>
    </table><br></td>
  </tr>
  <tr>
    <td><p>___________________<br>
      Class Teacher
    </p></td>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: <?php echo date("j/n/Y")?></td>
    <td>________________<br>
    Principal</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>