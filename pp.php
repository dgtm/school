<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
ini_set('memory_limit', '720M');
include("MPDF53/mpdf.php");
include("connectdb.php");

$s=0;$class=0;
$numstudents=0;
if (!empty($_POST['select-class'])){
$class=$_POST['select-class'];}
if (!empty($_POST['select-term'])){
$term=$_POST['select-term'];
}
$postdata = http_build_query(
    array(
        'a' => 'b'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'GET',
		'header'=>"Content-Type: text/html; charset=utf-8",
        'content' => $postdata
    )
);
$year_today = date("Y");
$context  = stream_context_create($opts);
$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
$mpdf->SetTitle('Report Card');
$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

$sql="SELECT * FROM `$term` where class=$class ORDER BY roll ASC";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{	$numstudents = mysql_numrows($result);
		for($k=0; $k<$numstudents; $k++){
			$row=mysql_fetch_array($result);
			$pid=$row['ID'];
			$base_url = "http://localhost/result/myreportcard.php?sid=". $pid ."&term=". $term;
			$file_result = file_get_contents($base_url, false, $context);
			$mpdf->WriteHTML($file_result);
			$mpdf->AddPage();
	}
	$backup_file = 'C:/school_results/'.$year_today.'_class_'.$class.'_'.$term.'_term.pdf' ;
	$mpdf->Output($backup_file);
	$mpdf->Output();		
}
//$pdf_title = "Report Card for Class" + $class;
?>
</body>
</html>