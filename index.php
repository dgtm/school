<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="jquery-1.5.min.js" type="text/javascript"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<script>
function show_confirm(sid){
	console.log(sid);
	var r=confirm("Are you sure you want to delete the student?");
	var delete_hit = "deletion.php?sid=" + sid;
	if (r==true)
  		{
	  	$.ajax({
  		url: delete_hit,
		type: 'GET',
  		data: {id: sid},
  		complete: function(){alert('Deleted. Reload to see your changes');},
		error: function(){alert('Failed to delete');}
			});
		 }
}
$(document).ready(function(){

$('#information').remove();
$("a#inline").fancybox();

$(".editor").live('click',function(){
	//$("#student-editor").hide();
	var sid = $(this).attr('student_id');
	//$("#student-editor").show();
	$('#changedetails').attr('sid_value',sid);
});
$('#changedetails #submit').live('click',function(){
	var student_id = $('#changedetails').attr('sid_value');
	var myname = $('#namer').val();
	var myroll = $('#roller').val();
	var ajax_hit = "changedetails.php?sid=" + student_id;
	$.ajax({
  		url: ajax_hit,
		type: 'POST',
  		data: {namefield: myname, rollfield: myroll},
  		complete: function(){alert('Done. Reload to see your changes');},
		error: function(){alert('Failed to update');}
			});
	return false;
}); 
});
</script>
<title>: School for the Deaf :</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

</head>

<body>
<div style="display:none">
<div id ="student-editor">
<form id="changedetails" sid_value="0">
<label>New name</label>
  <input type="text" name="namefield" id="namer" required="true" /><br /><br />
<label>New roll number</label>
  <input type="text" name="rollfield" id="roller" required="true" size=3/><br />
  <input style="text-align:center" type="submit" name="button" id="submit" value="Change" /><br />
</form>
</div>
</div>
<div id="dvmaincontainer">
  <!--main div container starts here-->
  <div id="dvtopcontainer">
    <!-- top container starts here-->
    <div id="dvlogocontainer">
      <!-- logo container starts here-->
	  <h1>School for the Deaf</h1>
	  <h4>Result Management System</h4>
      
      <!-- logo container ends here-->
    </div>
    <div id="dvnavicontainer">
      <!-- navogation div starts here-->
      <img src="images/navi_left.jpg" alt="" />
<div id="tabs1" >
        <ul>
          <!-- CSS Tabs -->
          <li id="current"><a href="#"><span>H</span></a></li>
          <li><a href="studentadder.php"><span>New Student</span></a></li>
          <li><a href="upgrade_class.php"><span>Upgrade</span></a></li>
          <li><a href="recover.php"><span>Restore</span></a></li>
          <li><a href="backup.php"><span>Backup</span></a></li>
        </ul>
      </div>
      <img src="images/navi_right.jpg" alt="" />
      <!-- navogation div ends here-->
    </div>
    <!-- top container ends here-->
  </div>
  <div id="dvbodycontainer">
    <!-- body div starts here-->

    <div id="dvleftpanel">
      <!-- left pannel div starts here-->
      <div id="topimage">
        <!-- top left div starts here-->
       Search<!--<img src="images/client.jpg" alt="Client Testimonials" width="274" height="34" title="Client Testimonials" /> -->
        <!-- top left div end here-->
      </div>
      <div id="midcont">
        <p>
          <!-- left body div starts here-->
 <form name="studentlister" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Name:<input type="text" name="name" placeholder= "Ravee"/><br /><br />
Class:
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
  <option selected="selected"></option>
</select>
<input type="submit" name="submit" class="printer" value="List" />
</form>

  <!-- banner div starts here-->
          <!-- banner div ends here-->
        </p>
        <p>&nbsp;</p>
        <!-- left body div ends here-->
      </div>
      <div id="leftfoot">
      <div id="topimage"> Print Results</div>
     <div id = "left-nav">

          <!-- banner left div starts here-->
<?php
if(!is_dir("C:/school_results/")){
mkdir("C:/school_results/",0777);
}
?>

<form name="printselect" action='pp.php' method="post">
Class
<select name="select-class">
  <option value="1" selected="selected">1</option>
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
<select name="select-term">
  <option value="first" selected="selected">First Term</option>
  <option value="second">Second Term</option>
  <option value="third">Third Term</option>
</select>
<input type="submit" class="printer" name="submit" value="Print" />
</form>

</div>
      <div id="topimage"> Print Summary</div>
     <div id = "left-nav">

<form name="lister" action="sheet.php" method="get">
Class:
 <select name="class">
  <option value="1" selected="selected">1</option>
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
Term:
<select name="term">
  <option value="first" selected="selected">First Term</option>
  <option value="second">Second Term</option>
  <option value="third">Third Term</option>
</select>
<br>
Year:
<input type="text" name="year" placeholder ="Enter Year" />
<input type="submit" class="printer" name="submit" value="Print" />
</form>
</div>

      </div>
      <!-- left pannel div ends here-->
    </div>
    <div id="dvrightpanel">
      <!-- right panel div starts here-->
      <div id="student-list-table">
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
		 echo "<table border=1 width=400 align=center style='border-radius:10px'><tr><td>"."Name"."</td><td>Class</td><td>Roll</td><td colspan=3>Edit Marks</td>"."</tr>";

	for($k=0; $k<$num; $k++)
	{	
		$row=mysql_fetch_array($result);
		$id[$k]=$row['ID'];
		$name[$k]=$row['name'];
		$roll[$k]=$row['roll'];
		$class[$k]=$row['class'];
?>
<tr>
<td><a href="viewdetails.php?sid=<?php echo $id[$k]; ?>"><?php echo $name[$k];?></a> <span class="at-right"><span class='minisize'><a id="inline" class="editor" student_id = <?php echo $id[$k]; ?> href="#student-editor">Edit</a></span>|<a class="deleter" onClick="show_confirm(<?php echo $id[$k]; ?>)">Delete</a></span></td>
<td><?php echo $class[$k];?></td>
<td><?php echo $roll[$k];?></td>
<td class='minisize'><a href='termexam.php?term=first&sid=<?php echo $id[$k]; ?>'>First</a></td>
<td class='minisize'><a href='termexam.php?term=second&sid=<?php echo $id[$k]; ?>'>Second</a></td>
<td class='minisize'><a href='termexam.php?term=third&sid=<?php echo $id[$k]; ?>'>Third</a></td>
</tr>
	<?php }	
	?>
    </table>
    <?php
	}
	}
else if (!empty($_POST['select-class'])){
	$myclass = $_POST['select-class'];
	?><h2><?php echo "Class ".$myclass; ?> </h2><?php
	$sql="SELECT * FROM `$main` where class=$myclass ORDER BY roll";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{

	$num = mysql_num_rows($result);
	
	 echo "<table border=1 width=400 align=center style='border-radius:10px'><tr><td>"."Name"."</td><td>Roll</td><td colspan=3 style='text-align:center'>Edit Marks</td>"."</tr>";
	for($k=0; $k<$num; $k++)
	{	
		$row=mysql_fetch_array($result);
		$id[$k]=$row['ID'];
		$name[$k]=$row['name'];
		$roll[$k]=$row['roll']; 
		?>
        <tr>
<td><a href="viewdetails.php?sid=<?php echo $id[$k]; ?>"><?php echo $name[$k];?></a> <span class="at-right"><span class='minisize'><a id="inline" class="editor" student_id = <?php echo $id[$k]; ?> href="#student-editor">Edit</a></span>|<a class="deleter" onClick="show_confirm(<?php echo $id[$k]; ?>)">Delete</a></span></td>
<td><?php echo $roll[$k]; ?></td>
<td class='minisize'><a href='termexam.php?term=first&sid=<?php echo $id[$k]; ?>'>First</a></td>
<td class='minisize'><a href='termexam.php?term=second&sid=<?php echo $id[$k]; ?>'>Second</a></td>
<td class='minisize'><a href='termexam.php?term=third&sid=<?php echo $id[$k]; ?>'>Third</a></td>
</tr>
        
        <?php

	}?>	
	</table>
	<?php
    }
	}
?>
</div>
      <div class="learn"><span><a href="#">NEXT CLASS</a></span></div>
      <!-- right panel div ends here-->
    </div>
    <!-- body div ends here-->
  </div>
  <div id="dvfootercontainer">
    <!-- footer div starts here-->
    <div id="foottop">
      <p>&nbsp;</p>
      <div class="design"><a href="#">	<img src="images/studio.jpg" alt="Studio7designs" border="0" title="Studio7designs" /></a> </div>
    </div>
    <!-- footer div ends here-->
  </div>
  <!--main div container ends here-->
</div>

</body>
<style>
.at-right{float:right;}
.deleter{cursor:pointer;}
</style>
</html>
