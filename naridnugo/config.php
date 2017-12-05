<?php
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','ogundiran2315');
define('DB_NAME','marshals');
define('AD_USERNAME','alameen688');
define('AD_PASSWORD','ogundiran2315');

$connection=mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
if(!$connection){
	die("Database Connection Failed ".mysql_error());
	}
$db_select = mysql_select_db(DB_NAME,$connection);
if(!$db_select){
	  die("Database Selection Failed ".mysql_error());
	}
?>