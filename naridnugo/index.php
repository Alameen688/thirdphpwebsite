<?php session_start();?>
<?php include('config.php'); ?>
<?php include('includes/adlogin.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/main.css" />
<title>Bello Marshals - Admin</title>
</head>

<body>
<div id="header">
<div id="sitelogo"><img src="images/logo.png" /></div>
</div>
<div class="container">
     <?php 
	    if(!empty($succmsg)){
			echo "<div id=\"successinfo\">".$succmsg."</div>";
			} 
	 ?>
  <div id="adminlogtab">
    <div class="tab">
     <input type="radio" id="tab-1" name="tab-group-1" <?php if(!isset($signposted)){echo "checked"; } ?> />
     <label for="tab-1">Login</label>
     <div class="content">
  <?php if(!empty($errmsg)){echo "<div id=\"logerror\">".$errmsg."</div>";}?>
   <form class="adform" method="post" action="">
   <input type="text" name="username" class="ainput" placeholder="Username" /><br />
   <input type="password" name="password" class="ainput" placeholder="Password" /><br />
   <button type="submit" class="admbtn" name="login">Login</button>
   <div id="fogpass"><a href="#">Forgot your password ?</a></div>
   </form>
     </div>
   </div>
   
  <div class="tab" id="tab2tab">
   <input type="radio" id="tab-2" name="tab-group-1" <?php if(isset($signposted)){echo "checked"; } ?> />
   <label for="tab-2">Sign In</label> 
   <div class="content">
  <?php if(!empty($serrmsg)){echo "<div id=\"logerror\">".$serrmsg."</div>";}?>
   <form class="adform" method="post" action="">
   <input type="text" name="username" class="ainput" placeholder="Username" /><br />
   <input type="text" name="email" class="ainput" placeholder="Email" /><br />
   <input type="password" name="password" class="ainput" placeholder="Password" /><br />
   <button type="submit" class="admbtn" name="signup">Sign In</button>
   </form>
   </div>
  </div>
    
  </div>
  
</div>
</body>
</html>