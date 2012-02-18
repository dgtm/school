<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
</head>

<body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include("MPDF53/mpdf.php");
include("connectdb.php");

$s=0;$class=0;
$numstudents=0;
if (!empty($_GET['sid'])){
$sid=$_GET['sid'];}
if (!empty($_GET['term'])){
$term=$_GET['term'];
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
$context  = stream_context_create($opts);
$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
$mpdf->SetTitle('Report Card');
$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

$sql="SELECT * FROM `$term` where ID=$sid";
$result = mysql_query($sql) or die(mysql_error());
	if($result)
	{
			$base_url = "http://localhost/result/myreportcard.php?sid=". $sid ."&term=". $term;
			$file_result = file_get_contents($base_url, false, $context);
			$mpdf->WriteHTML($file_result);
			$mpdf->Output();		
	}

?>
</body>
</html>
</body>
</html>