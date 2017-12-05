<?php
include('config.php');
include('includes/checklink.php');
include('includes/functions.php');
require_once('includes/contactmsg.php');
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
       
       <h2 class="ctitle">We want to hear from you leave us a message</h2>
       
       <div id="contactintro">
          Don't be shy, drop us an email and say hello! We are a really nice bunch of people :) .<br />
          <span class="csubtext">You can find us literally anywhere, just push a button and we’re there</span>
       </div>
	     <div id="contactlistbox">
              	<div class="contact-left-grid">
				    <p><img src="images/phonesmall.png" class="conicon" /><div class="ctext">(+234) 81-201-63524</div></p>
					<p><img src="images/twittersmall.png" class="conicon" /><div class="ctext"><a href="#">@bellomarshals</a></div></p>
			    </div>
				
                <div class="contact-right-grid">
			     	<p><img src="images/gmailsmall.png" class="conicon" /><div class="ctext"><a href="mailto:hello@dreams.com">Contact@bellomarshals.com</a></div></p>
					<p><img src="images/facebooksmall.png" class="conicon" /><div class="ctext"><a href="#">facebook.com/bellomarshals</a></div></p>
	      		</div>
         </div>        
								
        <div id="orcontitle">OR drop your feedback or any complaints directly through this webpage</div> 
          
          <div id="contactform">                        
	         <form id="contactf" method="post" action="">
                <span id="name">Name:</span>
                <input type="text" class="cinput" name="name" placeholder="Enter your name" value="<?php if(!empty($sender)){echo $sender;}?>"/><br />
                <?php if(!empty($smsg)){echo "<span class=\"cerrormsg\">".$smsg."</span><br />";}?>
                <span id="email">Email:</span>
                <input type="email" class="cinput" name="email" placeholder="Enter your email" value="<?php if(!empty($email)){echo $email;}?>"/><br />
                <?php if(!empty($emsg)){echo "<span class=\"cerrormsg\">".$emsg."</span><br />";}?>
                <span id="subject">Subject:</span>
                <input type="text" class="cinput" name="subject" placeholder="Enter message subject(title)" value="<?php if(!empty($csubject)){echo $csubject;}?>"/>
                <br />
                <?php if(!empty($submsg)){echo "<span class=\"cerrormsg\">".$submsg."</span><br />";}?>
                <span id="conmsgcontent">Message:</span>
                <textarea name="msg" id="msgbox" cols="50" rows="8"><?php if(!empty($message)){echo $message;}?></textarea><br />
                <?php if(!empty($mmsg)){echo "<span class=\"cerrormsg\">".$mmsg."</span><br />";}?>
                <input type="submit" name="submit" id="contbut" value="Send Message" />
             </form>
         </div>

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