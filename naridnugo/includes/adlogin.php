<?php 
if(isset($_POST['login'])){
	   
		if(empty($_POST['username'])){
			$umsg = 'Enter your username.';
			}
	
		if(empty($_POST['password'])){
			$pmsg = 'Enter your password.';
		}    
	
    if(empty($umsg)|| empty($pmsg )){
	    $username=stripslashes($_POST['username']);
	    $pass=sha1($_POST['password']);
	    $sql= mysql_query("SELECT * FROM admin WHERE username='$username' AND password='$pass' AND activated='1' LIMIT 1");
		$logincheck=mysql_num_rows($sql);
		if($logincheck > 0){ 
	      while($logdata = mysql_fetch_array($sql)){
			    $id=$logdata['id'];
				$_SESSION['userid'] = $id;
				$username = $logdata["username"];
				$_SESSION['username'] = $username;
				$userpass = $logdata["password"];
				$_SESSION['userpass'] = $userpass;
				$penname = $logdata["authorname"];
				$_SESSION['penname'] = $penname;
		  }
		  mysql_query("UPDATE users SET last_log_date=now() WHERE id='$id' LIMIT 1");
		  header("location:admin.php"); 
		}
		else {
           $succmsg = "Your Account has not been activated wait for sometime OR contact admin if you have waited for up to 12 hours.";
		}
	}
    else {
      // Login failed: display an error message to the user
        $errmsg = "Username and Password do not match.";
    }
}
elseif(isset($_POST['signup'])){
	      
	$signposted=$_POST['signup'];
		  
		  if(empty($_POST['username'])){
			$sumsg = 'Enter your username.';
			}
	      if(empty($_POST['email'])){
			$srmsg = 'Enter your Email Address.';
			}
		  if(empty($_POST['password'])){
			$spmsg = 'Create your password.';
		  }  
	  if(empty($sumsg) || empty($srmsg) || empty($spmsg )){
		  $username=stripslashes($_POST['username']);
		  $email=$_POST['email'];
	      $pass=sha1($_POST['password']);
		  
		    $sql= mysql_query("SELECT username, email FROM admin WHERE username='$username' OR email='$email' LIMIT 1");
		    $codecheck=mysql_num_rows($sql);
		    if($codecheck > 0){ 
		              $serrmsg="Username/Email already exist";
		    }
		    else{
			     $query = mysql_query("INSERT INTO admin (username, password, email, last_log_date, sign_up_date) 
                                       VALUES('{$username}','{$pass}','{$email}',NOW(),NOW())");
				 if($query){
					  $succmsg = "An activation link will be sent to your email within 12 hours after account approval !"; 
					 }	
				 else{
					  $succmsg = "Unable to insert to database".mysql_error(); 
					 }		 			
			   }
	  }
	 else{
		  //empty fields show error msg
		  $serrmsg="Please fill in all fields";
		 }	   
		  
	
}
else{
	 $username = "";
	 $pass =  ""; 
	 $email= ""; 
	 }	 
	?>
	