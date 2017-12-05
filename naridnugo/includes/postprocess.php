<?php
if(isset($_POST['edit'])){
	
	$catid=$_POST['catlist'];
	$title=$_POST['ptitle'];
	$content=$_POST['pcontent'];
	$description=$_POST['adescription'];
    $keyword=$_POST['keyword'];
	$pid=$_POST['postid']; 
	 
	     if(empty($title)){
			 $tmsg="Your article must have a title!";
		 }
		 if(empty($content)){
			 $pmsg="Type your article's Content.";
		 }
		 
		 if($catid==0){
			 $cmsg="Select article's category";
		 }
		 if(empty($description)){
			 $dmsg="Type your article's description (for SEO).";
		 }
		 if(empty($keyword)){
			 $kmsg="Type your article's keywords (for SEO).";
		 }
		 
		 
	    if(empty($tmsg) && empty($pmsg) && empty($cmsg) && empty($dmsg) && empty($kmsg)){
	        $title = mysql_prep($_POST['ptitle']);
		    $content = mysql_prep($_POST['pcontent']);
			$description=mysql_prep($_POST['adescription']);
			$keyword=mysql_prep($_POST['keyword']);
			$pid=$_POST['postid'];
 
	     $sql="UPDATE articles SET 
	           cat_id='{$catid}',
			   title='{$title}',
			   content='{$content}',
			   adescription='{$description}',
			   keywords='{$keyword}',
			   last_modified=NOW()
			   WHERE aid=$pid";
			
	        $result=mysql_query($sql,$connection);
	      if($result){
		       header("location:admin.php?msg=edited");
		  }
	      else{
	             header("location:admin.php?msg=notedited");
		  }
		  
		}
	}

if(isset($_POST['newpost'])){
        $catid =$_POST['catlist'];
	    $title = $_POST['ptitle'];
		$content = $_POST['pcontent'];
		$description=$_POST['adescription'];
		$keyword=$_POST['keyword'];
		$authorid=$_POST['authorid'];
		
		
	     if(empty($title)){
			 $tmsg="Your article must have a title!";
		 }
		 if(empty($content)){
			 $pmsg="Type your article's Content.";
		 }
		 
		 if($catid==0){
			 $cmsg="Select article's category";
		 }
		 if(empty($description)){
			 $dmsg="Type your article's description (for SEO).";
		 }
		 if(empty($keyword)){
			 $kmsg="Type your article's keywords (for SEO).";
		 }
		 
		if(empty($tmsg) && empty($pmsg) && empty($cmsg) && empty($dmsg) && empty($kmsg)){
		    $title = mysql_prep($_POST['ptitle']);
		    $content = mysql_prep($_POST['pcontent']);
		    $description=mysql_prep($_POST['adescription']);
			$keyword=mysql_prep($_POST['keyword']);
			
			 $query="INSERT INTO articles (pubdate , cat_id , title , content , adescription , keywords , authorid)
			         VALUES(NOW(), '{$catid}', '{$title}', '{$content}', '{$description}', '{$keyword}', '{$authorid}')";
			 $result = mysql_query($query);
			 if($result){
				   header("location:admin.php?msg=added");
				 }		 
			 else{ echo mysql_error();
				   header("location:admin.php?msg=notadded");
				 }	 
		}
}
	
if(isset($_POST['delete'])){
	$aid=$_POST['postid'];
	
            $sql="DELETE FROM articles WHERE aid={$aid}";
				 $result=mysql_query($sql);
				 if($result){
					  header("location:admin.php?msg=deleted");
					 }  
				 else{
				   header("location:admin.php?msg=notdeleted");
				 }	 
	}	

elseif(isset($_POST['cancel'])){
	 header("location: admin.php");
	}
?>	
<?php
function mysql_prep($value){
	       $magic_quotes_active = get_magic_quotes_gpc();
		   $new_enough_php = function_exists("mysql_real_escape_string"); /* i.e if server uses PHP >= v4.3.0 */
		   if($new_enough_php){
			   /* if server uses PHP version  v4.3.0 or higher undo the magic quotes effect so that mysql_real_escape_string can work*/
			   if($magic_quotes_active){
				   $value = stripslashes($value);
				   }
			  $value = mysql_real_escape_string($value);	   
		   }
          else{ /* For PHP version  before v4.3.0 :- If magic quotes aren't already on then  addslashes manually */
		  if(!$magic_quotes_active){
			       $value = addslashes($value);
				  /* If magic quotes are active,  then the slashes already exist*/
			  }
		  }
		  return $value;
}  
?>	