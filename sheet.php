<!DOCTYPE html ><head>
<title>Summary Card</title>
<style type="text/css">
#headtable{border:0px; width:600px;}
#tailtable{margin:auto;}
#class{
font-size:20px;
text-align:center;
}
#term{
font-weight:bold;
font-size:20px;
text-align:center;
}
#name{
font-size:13px;
}
#sub{
	font-size:14px;
}
#summary
{
    border-width: 1px 1px 1px 1px;
    border-spacing: 0;
    border-style: solid;
	width:auto;
	margin:auto;
}

#summary td, th
{
    margin: 0;
    border-width: 1px 1px 1px 1px;
    border-style: solid;
	text-align:center;
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

<body>
<table width="650" border="0" id="headtable" align="center">
  <tr>
    <td width="618" align="center" valign="middle" bgcolor="#FFFFFF"><font size="+2"><strong>Central Higher Secondary School for the Deaf</strong></font></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF">Naxal, Kathmandu</td>
  </tr>

<?php
include("connectdb.php");
if (!empty($_GET['class'])){
$class=$_GET['class'];}
if (!empty($_GET['term'])){
$term=$_GET['term'];}
if (!empty($_GET['year'])){
	$year=$_GET['year'];
printsheet($class,$term,$year);}

function printsheet($myclass,$term,$year){
	?>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo "<span id = 'term'><b>".ucwords($term)." Term Exam, </b><b>".$year."</b></span>"; ?></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?php echo "<div id = 'class'><b>Class: </b>".$myclass."</div>"; ?></td>
  </tr>
    </table>
	<table border="1" id = "summary">
<?php
		if($myclass<=5){$numsubs=9;$group=5;}
	else if($myclass<=8){$numsubs=12;$group=8;}
	else {$numsubs=12;$group=10;}
	printheaders($myclass);
	if($term=="third"){$term = "main";}
	$sql="SELECT * FROM `$term` WHERE class=$myclass ORDER by `roll` ASC";
				$result = mysql_query($sql) or die(mysql_error());
			if ($result){
					$num = mysql_numrows($result);
					for($k=0; $k<$num; $k++)
						{	
							$row=mysql_fetch_array($result);
							$id=$row['ID'];
							printstat($id,$myclass,$term);
						}
			}?>
            </table>
			<?php

	}
	
 function printheaders($myclass){
?>
<tr><td>Roll</td><td>Name</td>
<?php
	if($myclass<=5){$numsubs=9;$group=5;}
	else if($myclass<=8){$numsubs=12;$group=8;}
	else {$numsubs=12;$group=10;}	
	$sql="SELECT * FROM `$group`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	for($k=1; $k<=$numsubs; $k++)
	{	
	$row=mysql_fetch_array($result);
	$sub[$k]=$row['subject'];
?>
<td><div id = "name"><?php echo $sub[$k];?></div></td>
<?php
	}
	}
	?>
    <span id = "name">
<td>Result</td>
<td>Percent</td>
<td>Rank</td>
<td>Attendance</td>
</span>
</tr>
	<?php
}

function printstat($id,$myclass,$term){
	?>
	<tr>
    <span id = "name">
	<?php
	if($myclass<=5){$numsubs=9;$group=5;}
	else if($myclass<=8){$numsubs=12;$group=8;}
	else {$numsubs=12;$group=10;}
	$sql="SELECT * FROM `$term` WHERE ID=$id";
	$result = mysql_query($sql) or die(mysql_error());

	if($result)
	{
		$row=mysql_fetch_array($result);
		?>
        <td><?php echo $row['roll'];?></td>
        <td><?php echo ucwords(strtolower($row['name']));?></td>
		<?php
		for($i=1;$i<=$numsubs;$i++)	{
			?><td><?php $finalmarks[$i] = $row[$i]; echo $finalmarks[$i]; ?></td><?php
			}
		
?><td><?php echo $row['flag']; ?></td>
<td><?php echo $row['percent']; ?></td>
<td><?php echo $row['rank']; ?></td>
<td><?php echo $row['attend']; ?></td>
	</span>
	 </tr>
	 <?php
	}

	}
?>
<table id = "tailtable">
  <tr>
    <td><p>___________________<br>
      &nbsp;&nbsp;&nbsp;&nbsp;Class Teacher
    </p></td>
    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
    <td>________________<br>
    &nbsp;&nbsp;&nbsp;&nbsp;Principal</td>
  </tr>
</table>
</body>
</html>