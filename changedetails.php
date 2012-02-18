<?php
include("connectdb.php");
$sid=$_GET['sid'];
$name=$_POST['namefield'];
$roll=$_POST['rollfield'];
if (!empty($_POST['namefield']) && !empty($_POST['rollfield']) ){
$sql= "UPDATE main SET `name` ='$name' , `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
if($result){
$sql= "UPDATE first SET `name` = '$name', `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
if($result){
$update= "UPDATE second SET `name` = '$name' , `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($update) or die(mysql_error());
if($result){
	$update= "UPDATE third SET `name` = '$name' , `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($update) or die(mysql_error());
if($result){echo "Success";}
}}}}
else if(!empty($_POST['namefield'])){
$sql= "UPDATE main SET `name` ='$name' WHERE ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
if($result){
$sql= "UPDATE first SET `name` = '$name' WHERE ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
if($result){
$update= "UPDATE second SET `name` = '$name' WHERE ID=$sid";
	$result = mysql_query($update) or die(mysql_error());
if($result){
	$update= "UPDATE third SET `name` = '$name' WHERE ID=$sid";
	$result = mysql_query($update) or die(mysql_error());
if($result){echo "Success";}
}}}
	}
	else if(!empty($_POST['rollfield'])){
$sql= "UPDATE main SET `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
if($result){
$sql= "UPDATE first SET `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($sql) or die(mysql_error());
if($result){
$update= "UPDATE second SET `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($update) or die(mysql_error());
if($result){
	$update= "UPDATE third SET `roll`=$roll WHERE ID=$sid";
	$result = mysql_query($update) or die(mysql_error());
if($result){echo "Success";}

}}}}

//header( 'Location:  '.$_SERVER['HTTP_REFERER']);
?>