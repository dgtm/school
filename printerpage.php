<!DOCTYPE html>
<head>
<script src="jquery-1.5.min.js"></script>
<title>Untitled Document</title>
<script language="JavaScript">
DA = (document.all) ? 1 : 0

function HandleError()	
{
alert("\nNothing was printed. \n\nIf you do want to print this page, then\nclick on the printer icon in the toolbar above.")
return true;
}
</script>
</head>

<body>
<div id="container">

<input type="submit" id="button" value="Click here to start">

<!--<iframe id="newframe" src="index.html"></iframe>-->
</div>
<div id="frame-area"></div>

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

<?php $numstudents=0;?>
<?php
include("connectdb.php");
$s=0;$class=0;
if (!empty($_POST['select-class'])){
$class=$_POST['select-class'];}
if (!empty($_POST['select-term'])){
$term=$_POST['select-term'];
}
$myval=array();


$sql="SELECT * FROM `$term` where class=$class";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{	$numstudents = mysql_numrows($result);
		for($k=0; $k<$numstudents; $k++){
			$row=mysql_fetch_array($result);
			$pid=$row['ID'];
			array_push($myval,$pid);
	}
	}
?>
<script type="text/javascript">

function printUrl(uniqueId, urlToPrint) {
    $('body:first').append('<iframe style="position:fixed;top:0;left:0;height:500px;width:700px;border:1;" id="' + uniqueId + '" name="' + uniqueId + '" src="' + urlToPrint + '" onload="frames[\'' + uniqueId + '\'].focus();frames[\'' + uniqueId + '\'].print();"></iframe>');
}
$('#button').click(function(){
					var arrayofIds=[];
					var term="<?php echo $term?>";

					k=0;
					<?php for ($i=0;$i<$numstudents;$i++){ ?>
					arrayofIds[k]=<?php echo $myval[$i];?>;
					k=k+1;
					<?php }?>	
								alert(term);											 

		$.each(arrayofIds,function(index,value){printUrl(index, "myreportcard.php?sid="+value+"&term="+term);
					});
				});
</script>

</body>
</html>