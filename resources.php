<?php
include('config.php');
include('includes/checklink.php');
include('includes/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<title>Code block</title>
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>

<style>
@font-face{
  font-family:fontawesome;
  font-weight:normal;
  src:url(fonts/fontawesome.ttf); 
  format('ttf');
}
</style>
</head>

<body>
 <div id="header">
   <div id="sitelogo"><img src="images/logo.png" /></div>
   <div id="navigationbar">
   <ul id="navlist">
    <li><a href="index.php">Home</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="resources.php">Resources</a></li>
    <!-- <li>Resources</li>-->
   </ul>
 </div>
   <div id="qformbox">
        <form id="qform" method="post">
         <div id="searchbox">
         <input type="search" class="qinput" value="Search.." />
         <input type="submit" name="search" id="fbut" value="Go" />
         </div>
        </form>
   </div><!--end #qformbox-->
 </div><!--end #header-->
<div id="container">
    <div id="content">
       <div class="pagecont">
        <h2>Our resources are not yet available</h2>
       </div>   
    </div><!--end #content-->

	<div id="right-col">
	
    <?php include('includes/sidebar.php'); ?>
	
   </div><!--end #right-col-->
   
</div><!--end #container-->
  
 <div id="footer">
   <?php include('includes/footer.php'); ?>
 </div>   
</body>
</html>