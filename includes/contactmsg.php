<?php
if(isset($_POST['submit'])){
	     $sender = $_POST['name'];
		 $email = $_POST['email'];
		 $csubject= $_POST['subject'];
		 $message =$_POST['msg'];
	     if(empty($sender)){
			 $smsg="Please enter your name";
		 }
		 if(empty($email)){
			 $emsg="Please enter your email address";
		 }
		 if(!empty($email)){
		    if(!preg_match("/([\w\-)]+\@[\w\-]+\.[\w\-]+)/",$email)){
			   $emsg = "Please enter a valid Email Address e.g youremail@domain.com";
			}
		 }
		 if(empty($csubject)){
			 $submsg="Please enter message subject";
		 }
		 if(empty($message)){
			 $mmsg="Please type a message";
		 }
		 
		if(empty($smsg) && empty($emsg) && empty($submsg) && empty($mmsg)){
			$sender = trim(mysql_real_escape_string($_POST['name']));
		    $email = trim(mysql_real_escape_string($_POST['email']));
			$csubject= trim(mysql_real_escape_string($_POST['subject']));
		    $message = trim(mysql_real_escape_string($_POST['msg']));
			
			 $query="INSERT INTO contacts (contname , contemail , contsubject , contmessage , date)
			         VALUES( '{$sender}','{$email}','{$csubject}','{$message}',NOW() )";
			 $result = mysql_query($query);
			 if($result){
				   $successmsg="Message successfully sent. Thank you!";
				   /*Send email to admins email*/
				   $to="pelihon@gmail.com";
				   $subject=$csubject." from ".$sender." -Muselord USER";
				   $headers="From: ".$sender."\r\n";
				   $headers.="Content-type: text\r\n";
				   $msg=$message;
				   mail($to, $subject , $message, $headers);
				   
				 }		 
			 else{
				  $dbinserterr="Error sending message! Try sending an email!";
				 }	 
		}
		 
	}

?>