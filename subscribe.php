<?php
include('config.php');
include('includes/checklink.php');
include('includes/functions.php');
?>
<?php
if(!empty($_POST['email'])){

 $emailaddress=$_POST['email'];
 if(!preg_match("/([\w\-)]+\@[\w\-]+\.[\w\-]+)/",$emailaddress)){
	 $nemsg="Please enter a valid Email Address (e.g you@domain.com) where you will like to recieve the email updates";
	 }	  
 else{
	 $check_email=check_email($emailaddress);
   if ($check_email==false) {
     $addemail = insert_new_email($emailaddress);

       if(!$addemail){
         $errmsg = "Oops! Error subscribing to email updates, make sure you entered a valid email address.";
       }
   }
   else{
    $errmsg = "Dear Subscriber your email address already exists in our system. Thank You! <br /> If You have not been recieving any of our Email Updates, Please check your Spam Box or You can log your complaints in the form below ";
   }  
 

 }


}
else{
  $errmsg="Please enter an Email Address where you will like to recieve the email updates";
}

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
         <?php 
		 if(!empty($nemsg)){
			 echo $nemsg;
			 }
		 elseif(!empty($errmsg)){
			 echo $errmsg;
			 }	 
		 elseif(!empty($emailaddress)){	 
		 echo $emailaddress." Thank You for subscribing to the email update,<br>You will recieve your first message soon.";
		 }
		 ?> 
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