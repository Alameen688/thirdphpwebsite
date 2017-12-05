<?php
if(isset($_POST['commentsubmit'])){
	      $postid=$_GET['p'];
	      $cbname=$_POST['username'];
	      $cbemail=$_POST['useremail'];
		  $cbcontent=$_POST['commentcontent'];
		  
		  
         if(empty($postid)){
			 $nopostid="Could not get the post id";
			 }
	    
		 if(empty($cbname)){
			 $cbnmsg="Please enter your name";
			 }
		 if(empty($cbemail)){
			 $cbemsg="Please enter your email, it will be confidential";
			 }	 
		 if(empty($cbcontent)){
			 $cbcmsg="Please type your comment";
			 }	
		 
	if(empty($nopostid)&&empty($cbnmsg)&&empty($cbemsg)&&empty($cbcmsg)){	
	
            $cbname=mysql_prep($_POST['username']);
			$cbemail=mysql_prep($_POST['useremail']);
			$cbcontent=mysql_prep($_POST['commentcontent']);

			      $sql="INSERT INTO comments(comby, email, comdate, comcontent, aid) 
					    VALUES('{$cbname}', '{$cbemail}', NOW(), '{$cbcontent}', {$postid})";
						 $result=mysql_query($sql);
			             if(!$result){
				              $error="Error posting comment";
			                }
			             else {
			                  $fmsg="Your Comment has been posted";
			                }
					 			 
	}
	
}
else{ 
        $postid="";
        $cbname="";
        $cbemail="";
		$cbcontent="";
	  }
?>