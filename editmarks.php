
<?php

//pass ID, term and marks
include("connectdb.php");

$sid =$_GET['sid'];
$terms = $_GET['term'];
$attend = $_POST['attend'];


$name=namefinder($sid);
$myclass=classfinder($sid);
$numsubjects=numsubs($sid);
echo "Name: ".$name."<br>";
echo "Class: ".classfinder($sid)."<br>";
echo "Roll No.: ".rollfinder($sid)."<br><br>";
$payroll = rollfinder($sid);
$next_one = find_next_roller($myclass,$payroll);
if ( $next_one != false){
	$next_student_link = "termexam.php?sid=".$next_one."&term=".$terms;
	?>
    <h2>
	<a href= "<?php echo $next_student_link; ?>">Enter marks for Roll No. <?php echo ($payroll+1) ?></a>
    </h2>
   <?php } 
echo $terms." Term Exam"."<br>"."Review Marks:"."<br><br>";
$marks[14]=0;
$fullmarks[14]=0;
$flag[14]="";
$i=0;
for($i=1;$i<=$numsubjects;$i++)
{	
$marks[$i]=$_POST[$i];
}

$tablemain="main";
$table="main";

// displayform();
editmarks($terms,$sid,$marks,$myclass,$attend);
ranker($terms,$sid,$myclass);
ranker($tablemain,$sid,$myclass);
showresults($sid,$terms);
?>




<?php
function find_next_roller($class,$roll)
{		$next_roll = $roll + 1 ;
		$sql="SELECT * FROM `main` where class=$class and roll=$next_roll";
		$result = mysql_query($sql) or die(mysql_error());
		if($result){
			$row=mysql_fetch_array($result);
			$nextrollid = $row['ID'];
		}
		else{
			$nextrollid = false;
			}
	return $nextrollid;

}
function showresults($sid,$terms)
{	$sub[20]="";$marks[20]=0;
	$myclass=classfinder($sid);
	if($myclass<=5){$numsubs=9;$group=5;}
	else if($myclass<=8){$numsubs=12;$group=8;}
	else {$numsubs=12;$group=10;}
	$sql="SELECT * FROM `$terms` where ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{$row=mysql_fetch_array($result);


			for($i=1;$i<=$numsubs;$i++)
	{
		
	
		$marks[$i] = $row[$i];
}
	
	}
	
	
	$sql="SELECT * FROM `$group`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	for($k=1; $k<=$numsubs; $k++)
	{	$row=mysql_fetch_array($result);
	$sub[$k]=$row['subject'];
	}
	}
	for($k=1; $k<=$numsubs; $k++)
	{	
	echo $sub[$k].": \t \t ".$marks[$k]."<br>";
	}
	echo "<br>";
	
}

function ranker($terms,$sid,$myclass)				//Orders by desc and then updates the rank
{
	$tablemain="main";
	$sql="SELECT * FROM `$terms` where class=$myclass AND flag='P' ORDER BY total desc";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{

	$num = mysql_numrows($result);
	
	for($k=0; $k<$num; $k++)
	{	
		$row=mysql_fetch_array($result);
		$rank[$k]=($k+1);
		$id[$k]=$row['ID'];
		$flag[$k]=$row['flag'];
		if($flag[$k]=='P'){
			$update= "UPDATE `$terms` SET rank = $rank[$k] WHERE ID=$id[$k]";
			$qry = mysql_query($update) or die(mysql_error());
							}
		else if($flag[$k]=='F'){
			$update= "UPDATE `$terms` SET rank=0 WHERE ID=$id[$k]";
			$qry = mysql_query($update) or die(mysql_error());
			}
	}	
	
	}
}


function editmarks($term,$sid,$marks,$myclass,$attend)
{
	$failed_in_final="";
$failed_this_term="";
	$tablemain="main";
	$total_marks=0;
	$full_fm=0;
	$fm[20]=0;
	$sum[20]=0;
	$termfirst[20]=$termsecond[20]=$termthird[20]=0;
 	if ($myclass<=5)		{$classgroup=5;}
 	else if ($myclass<=8){$classgroup=8;}
	else if ($myclass>8){$classgroup=10;}
	else					{echo"Class group info incorrect";}
		$sql="SELECT * FROM `$term` where ID=$sid";
		$result = mysql_query($sql) or die(mysql_error());
		if($result){
			$numsubjects=numsubs($sid);
for($i=1;$i<=$numsubjects;$i++)		
		{
			$upsql= "UPDATE `$term` SET `$i` = $marks[$i] WHERE ID=$sid";
			$total_marks+=$marks[$i];
			$qry = mysql_query($upsql) or die (mysql_error());
			if($qry)
			{
			//	echo "Marks updated";
			}
			else {echo"Marks could not be updated.";}
		}
				$sql="SELECT * FROM `first` where ID=$sid";
				$result = mysql_query($sql) or die(mysql_error());
		if($result)
			{
						$row=mysql_fetch_array($result);
									for($i=1;$i<=$numsubjects;$i++)
									{$termfirst[$i]=$row[$i];}
			}
				$sql="SELECT * FROM `second` where ID=$sid";
				$result = mysql_query($sql) or die(mysql_error());
		if($result)
			{
						$row=mysql_fetch_array($result);
									for($i=1;$i<=$numsubjects;$i++)
									{$termsecond[$i]=$row[$i];}
			}
				$sql="SELECT * FROM `third` where ID=$sid";
				$result = mysql_query($sql) or die(mysql_error());
		if($result)
			{
						$row=mysql_fetch_array($result);
									for($i=1;$i<=$numsubjects;$i++)
									{$termthird[$i]=$row[$i];}
			}
		
		$totalsql="UPDATE `$term` SET total = $total_marks WHERE ID=$sid";
		
		
		$try = mysql_query($totalsql) or die (mysql_error());
				if($try){//echo "Table $term Updated.";
				}

		$class=classfinder($sid);
		$total_sum=0;
	for($i=1;$i<=$numsubjects;$i++){
		$sql="SELECT * FROM `$classgroup`";
		$result = mysql_query($sql) or die(mysql_error());
		$numsubs=mysql_num_rows($result);	
	for($k=1; $k<=$numsubs; $k++)
	{			$go=mysql_fetch_array($result);
		$fm[$k]=$go['FM'];
		$subj[$k]=$go['subject'];
		}

/*		$sum[$i]=$termfirst[$i]*10/$fm[$i]+$termsecond[$i]*30/$fm[$i]+$termthird[$i]*60/$fm[$i];
*/
		$sum[$i]=$termfirst[$i]*10/100+$termsecond[$i]*30/100+$termthird[$i]*60/100;

$total_sum=$total_sum+$sum[$i];
		$total_main_sql="UPDATE `$tablemain` SET `$i`=$sum[$i] WHERE ID=$sid";
		$qry = mysql_query($total_main_sql) or die (mysql_error());
		
		if($qry){
				$total_final_sql="UPDATE `$tablemain` SET `total`=$total_sum WHERE ID=$sid";
		$qry = mysql_query($total_final_sql) or die (mysql_error());
		}
		else{echo"Total not updated";}
		}
	} //close for

$sql="SELECT * FROM `$classgroup`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	$numsubs=mysql_num_rows($result);	
	for($k=1; $k<=$numsubs; $k++)
	{	
	$row=mysql_fetch_array($result);
	$sub[$k]=$row['subject'];
	$fm[$k]=$row['FM'];
	$flag[$k]=$row['flag'];
	$full_fm=$full_fm+$fm[$k];
	//////////////////////////////////////////////////////////////////
	if($myclass<=5)
	$pm[$k]=(4/10)*$fm[$k];
	else if ($myclass<=10 && $flag[$k]=='T')
	$pm[$k]=(32/100)*$fm[$k];
	else if ($myclass<=10 && $flag[$k]=='P')
	$pm[$k]=(4/10)*$fm[$k];

	if($sum[$k] < $pm[$k]){
		$failed_in_final = true;
	}
	
	if($marks[$k] < $pm[$k]){
		$failed_this_term = true;
	}
	
	/////////////////////////////////////////////////////////////////////
	}
	
	if($failed_this_term == true){
		$fail_main_sql="UPDATE `$term` SET `flag`='F' WHERE ID=$sid";
		$qry = mysql_query($fail_main_sql) or die (mysql_error());
		}else{
		$pass_main_sql="UPDATE `$term` SET `flag`='P' WHERE ID=$sid";
		$qry = mysql_query($pass_main_sql) or die (mysql_error());
			}
			
	if($failed_in_final == true){
		$fail_main_sql="UPDATE `$tablemain` SET `flag`='F' WHERE ID=$sid";
		$qry = mysql_query($fail_main_sql) or die (mysql_error());
		}else{
		$pass_main_sql="UPDATE `$tablemain` SET `flag`='P' WHERE ID=$sid";
		$qry = mysql_query($pass_main_sql) or die (mysql_error());
			}
		
		for($k=1; $k<=$numsubs; $k++)
	{	
	$row=mysql_fetch_array($result);
	$fm[$k]=$row['FM'];
	$full_fm=$full_fm+$fm[$k];
	}
		$percent=($total_sum/$full_fm)*100;
		$percent_this_term=($total_marks/$full_fm)*100;
			$percent_sql="UPDATE `$tablemain` SET `percent`=$percent WHERE ID=$sid";
			$result = mysql_query($percent_sql) or die(mysql_error());
		$percent_sql="UPDATE `$term` SET `percent`=$percent_this_term WHERE ID=$sid";
		$result = mysql_query($percent_sql) or die(mysql_error());
		$attendance = "UPDATE `$term` SET `attend`=$attend WHERE ID=$sid";
				$result = mysql_query($attendance) or die(mysql_error());

	}//end of if result

//	if($total_sum >= (4/10)*$full_fm){
//		$pass_main_sql="UPDATE `$tablemain` SET `flag`='P' WHERE ID=$sid";
//		$qry = mysql_query($pass_main_sql) or die (mysql_error());
//	}
//	else{
//		$fail_main_sql="UPDATE `$tablemain` SET `flag`='F' WHERE ID=$sid";
//		$qry = mysql_query($fail_main_sql) or die (mysql_error());
//	
//		}

else{echo "Student Record doesn't exist";}
}


function rollfinder($sid)
{
	$table="main";
$sql="SELECT * FROM `$table` where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$class=$row['roll'];
	}
	return $class;
}

function namefinder($sid)
{
	$table="main";
$sql="SELECT * FROM `$table` where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
		$row=mysql_fetch_array($result);
		$class=$row['name'];
	}
	return $class;
}

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

function numsubs($sid)
{
$class=classfinder($sid);
if($class<=5){$tabletoread=5;}
else if($class<=8){$tabletoread=8;}
else {$tabletoread=10;}
$sql="SELECT * FROM `$tabletoread`";
	$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
	$numsubjects=mysql_num_rows($result);
	}
return $numsubjects;
}

?>
<?php if($terms=="first"){?>

                <ul>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=second">Enter marks for Second Term</a></li>
                  <li><a href="viewdetails.php?sid=<?php echo $sid?>">View details of this student</a></li>
                </ul>
				<?php }?>
             <?php   if($terms=="second"){?>

                <ul>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=first">Enter marks for First Term</a></li>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=third">Enter marks for Third Term</a></li>
                <li><a href="viewdetails.php?sid=<?php echo $sid?>">View details of this student</a></li>
                </ul>
				<?php }?>
                
                             <?php   if($terms=="third"){?>

                <ul>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=first">Enter marks for First Term</a></li>
                <li><a href="termexam.php?sid=<?php echo $sid?>&term=second">Enter marks for Second Term</a></li>
                <li><a href="viewdetails.php?sid=<?php echo $sid?>">View details of this student</a></li>
                </ul>
				<?php }?>
                <a href="studentadder.php">Add new Student</a>
                
                <section id="menu">
<nav>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="studentadder.php">Add Student</a></li>
<li><a href="list.php">List Students</a></li>
<li><a href='print_single.php?sid=<?php echo $sid ?>&term=<?php echo $terms ?>'>Print Result</a></li>

</ul>
</nav>
</section>