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
    
    <!-- ///////////////////////////////////////////////////    MAKE SURE PROFILEIMAGE IS A SQUARE E.G 160px X 160px    ////////////////////////////////////////////// -->
       <div id="aboutpagecont">
       
         <div id="profilebox">
         
            <div class="eachprofilecontainer">
              <a href="">
              <div class="eachprofilebox">
                <div class="profileimage"><img src="images/lawson.jpg" width="140px" /></div>
                <div class="profilename">Amanambo Amobi</div>
                <div class="profilerank">Founder</div>
                <div class="profiletext">
                 From a none Technical guy with an idea to build one of TIME's Top 50 Sites of 2013, Sir Fellig's is nothing less than magical. But the founder of 
                 Outgrow.me says anyone can learn as long as they are they stay positive
                </div>
              </div><!--end .eachprofilebox-->
              </a>  
            </div><!--end .eachprofilecontainer-->
            
            
            <div class="eachprofilecontainer">
              <a href="">
              <div class="eachprofilebox">
                <div class="profileimage"><img src="images/aadam.jpg" width="140px" /></div>
                <div class="profilename">Bodurin Adam</div>
                <div class="profilerank">General</div>
                <div class="profiletext">
                 From a none Technical guy with an idea to build one of TIME's Top 50 Sites of 2013, Sir Fellig's is nothing less than magical. But the founder of 
                 Outgrow.me says anyone can learn as long as they are they stay positive
                </div>
              </div><!--end .eachprofilebox-->
              </a>  
            </div><!--end .eachprofilecontainer-->
            
            <div class="eachprofilecontainer">
              <a href="">
              <div class="eachprofilebox">
                <div class="profileimage"><img src="images/dammy.jpg" width="140px" /></div>
                <div class="profilename">Akinsanya Damilola</div>
                <div class="profilerank">Deputy General</div>
                <div class="profiletext">
                 From a none Technical guy with an idea to build one of TIME's Top 50 Sites of 2013, Sir Fellig's is nothing less than magical. But the founder of 
                 Outgrow.me says anyone can learn as long as they are they stay positive
                </div>
              </div><!--end .eachprofilebox-->
              </a>  
            </div><!--end .eachprofilecontainer-->
            
            <div class="eachprofilecontainer">
              <a href="">
              <div class="eachprofilebox">
                <div class="profileimage"><img src="images/tony.png" width="140px" /></div>
                <div class="profilename">Bodurin Adam</div>
                <div class="profilerank">General Secretary</div>
                <div class="profiletext">
                 From a none Technical guy with an idea to build one of TIME's Top 50 Sites of 2013, Sir Fellig's is nothing less than magical. But the founder of 
                 Outgrow.me says anyone can learn as long as they are they stay positive
                </div>
              </div><!--end .eachprofilebox-->
              </a>  
            </div><!--end .eachprofilecontainer-->
            
            <div class="eachprofilecontainer">
              <a href="">
              <div class="eachprofilebox">
                <div class="profileimage"><img src="images/muselord.jpg" width="140px" /></div>
                <div class="profilename">Ogundiran Al-Ameen</div>
                <div class="profilerank">PRO/Reviser</div>
                <div class="profiletext">
                 From a none Technical guy with an idea to build one of TIME's Top 50 Sites of 2013, Sir Fellig's is nothing less than magical. But the founder of 
                 Outgrow.me says anyone can learn as long as they are they stay positive
                </div>
              </div><!--end .eachprofilebox-->
              </a>  
            </div><!--end .eachprofilecontainer-->
            
            <div class="eachprofilecontainer">
              <a href="">
              <div class="eachprofilebox">
                <div class="profileimage"><img src="images/alfred.png" width="140px" /></div>
                <div class="profilename">A Victor</div>
                <div class="profilerank">Ass. PRO/Reviser</div>
                <div class="profiletext">
                 From a none Technical guy with an idea to build one of TIME's Top 50 Sites of 2013, Sir Fellig's is nothing less than magical. But the founder of 
                 Outgrow.me says anyone can learn as long as they are they stay positive
                </div>
              </div><!--end .eachprofilebox-->
              </a>  
            </div><!--end .eachprofilecontainer-->
                   
            
         </div><!--end .profilebox-->
         
         <div id="moremembers"><a href="#">View More Members</a></div> 
         
      </div><!--end .aboutpagecont--> 
         
         
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