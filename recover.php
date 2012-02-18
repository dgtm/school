<?php
include("connectordb.php");
$dbname = "school";
$pass="";
if (!empty($_FILES['recover']['name'])){
$decoverfile=$_FILES['recover']['name'];
$oldfile = "upload/" . $_FILES['recover']['name'];
    if (file_exists($oldfile))
      {
	unlink($oldfile);
	move_uploaded_file($_FILES["recover"]["tmp_name"],"upload/" . $_FILES["recover"]["name"]);
	echo "Replaced";
      }
    else
      {
      move_uploaded_file($_FILES["recover"]["tmp_name"],"upload/" . $_FILES["recover"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES['recover']['name'];
      }
$upfile = "upload/" . $_FILES['recover']['name'];
echo $upfile;

$drop = "DROP DATABASE IF EXISTS $dbname";
$result = mysql_query($drop) or die(mysql_error());
if($result){
$create = "CREATE DATABASE $dbname";
$result = mysql_query($create) or die(mysql_error());
if($result){echo "Success";}
else{echo "failed";}
}
$result = mysql_select_db($dbname) or die('Cannot select database');
if($result){
echo $upfile;
echo "<br>"; 
$k = "C:\wamp\www"."\\"."result\upload"."\\".$decoverfile;
echo $k;
echo "<br>";

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($k);
echo $lines;
// Loop through each line
foreach ($lines as $line)
{
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;
 
    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
        // Perform the query
        mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
    }
}

if($result){
echo "backup done";
}
else
{
	echo "failed on select";
}
}
}
?>
<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="recovery"  enctype="multipart/form-data">
  <p>
  <input type="file" name="recover" id="recover"/>
  </p>
  <p>
    <input type="submit" value="Restore">
  </p>
</form>
</body>

</html>


