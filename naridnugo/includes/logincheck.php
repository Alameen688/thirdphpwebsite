<?php
session_start();
if(!isset($_SESSION['username'])){
	   header("location:index.php");
	}
else{
	 $session_id=$_SESSION['userid'];
	}	
if(!empty($_GET['s'])){
	     if($_GET['s']=="logout"){
			 unset($_SESSION['username']);
			 header("location:index.php");
			 }
	}		
?>