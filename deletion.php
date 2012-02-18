<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deletion Succeded</title>
</head>

<body>
<?php 
include("connectdb.php");
$sid= $_GET['sid'];
delete($sid);
echo "Successfully deleted the student";
function delete($sid){
$sql = "DELETE FROM `main` WHERE ID=$sid";
$qry = mysql_query($sql) or die(mysql_error());	
$sql = "DELETE FROM `first` WHERE ID=$sid";
$qry = mysql_query($sql) or die(mysql_error());
$sql = "DELETE FROM `second` WHERE ID=$sid";
$qry = mysql_query($sql) or die(mysql_error());
$sql = "DELETE FROM `third` WHERE ID=$sid";
$qry = mysql_query($sql) or die(mysql_error());
}
//header( 'Location:  '.$_SERVER['HTTP_REFERER']);
?>
</body>
</html>