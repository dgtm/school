<?php
include("connectdb.php");
$dbname = "school";
$pass="";
$backupFile = 'backup'.date("Y-m-d-H-i-s").'.sql';
$command = "C:\wamp\bin\mysql\mysql5.5.8\bin\mysqldump --opt -h localhost -u root $dbname > $backupFile";
system($command);
header('Content-disposition: attachment; filename="backup.sql"');
header('Content-type: application/sql');
readfile($backupFile);
?>

