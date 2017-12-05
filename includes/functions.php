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
function makeago($timestamp){
   		$difference = time() - $timestamp;
   		$periods = array("sec", "min", "hr", "day", "week", "month", "year", "decade");
   		$lengths = array("60","60","24","7","4.35","12","10");
   		for($j = 0; $difference >= $lengths[$j]; $j++)
   			$difference /= $lengths[$j];
   			$difference = round($difference);
		/*added by ameen on -18th m -- */	
		if($difference==0 && $periods[$j]=="sec"){
			$text="Just now"; 
			}
		elseif($difference==1 && $periods[$j]=="day"){
			$text="Yesterday ".date('\a\t g:i a',$timestamp);
			}
        elseif($difference==1 && $periods[$j]=="week"){
			$text="Last Week";
			}	
		elseif($periods[$j]=="month"){
			$text=date('F j \a\t g:i a',$timestamp);
			}				
		elseif($periods[$j]=="year"){
			$text=date('F j, Y',$timestamp);
			}	
		else{	
   		 if($difference != 1) $periods[$j].= "s";
   			$text = "$difference $periods[$j] ago";
		}
   			return $text;
}	  
function makeagolong($timestamp){
   		$difference = time() - $timestamp;
   		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   		$lengths = array("60","60","24","7","4.35","12","10");
   		for($j = 0; $difference >= $lengths[$j]; $j++)
   			$difference /= $lengths[$j];
   			$difference = round($difference);
		/*added by ameen on -18th m -- */	
		if($difference==0 && $periods[$j]=="sec"){
			$text="Just now"; 
			}
		elseif($difference==1 && $periods[$j]=="day"){
			$text="Yesterday ".date('\a\t g:i a',$timestamp);
			}
        elseif($difference==1 && $periods[$j]=="week"){
			$text="Last Week";
			}	
		elseif($periods[$j]=="month"){
			$text=date('F j \a\t g:i a',$timestamp);
			}				
		elseif($periods[$j]=="year"){
			$text=date('F j, Y',$timestamp);
			}	
		else{	
   		 if($difference != 1) $periods[$j].= "s";
   			$text = "$difference $periods[$j] ago";
		}
   			return $text;
}	  
function get_all_article($perpage=1000,$cur_page=1){
	                $offset=$perpage*($cur_page-1);
	                 global $connection;
	                 $sql="SELECT *,
					       UNIX_TIMESTAMP(pubdate) AS pubdate
						   FROM articles
						   INNER JOIN categories
						   ON articles.cat_id=categories.cid
						   INNER JOIN admin
						   ON articles.authorid=admin.id
					       ORDER BY aid DESC
						   LIMIT $perpage
						   OFFSET $offset";
						   
					 $result = mysql_query($sql,$connection);	  
					 if(!$result){
						       echo "Error connecting to table articles".mysql_error();
						 }
					 return $result;	  
					 	 
	}
	
function get_article_by_id($aid){
	                 global $connection;
					 $sql="SELECT *,
					       UNIX_TIMESTAMP(pubdate) AS pubdate,
						   UNIX_TIMESTAMP(last_modified) AS last_modified 
					       FROM articles
						   INNER JOIN categories
						   ON articles.cat_id = categories.cid
						   INNER JOIN admin
						   ON articles.authorid=admin.id
						   WHERE aid=$aid";
						   
					 $query=mysql_query($sql,$connection);
					 
					 if(!$query){
						    echo "Error connecting to table for article".mysql_error();
						 }	
					 $result = mysql_fetch_array($query);
					 if($result['0']==0){
						 header("location:pagenotfound.php");
						 }	    
				      return $result;		 
	}
function get_article_by_cat($cid=1,$perpage=100,$cur_page=1){
	                 $offset=$perpage*($cur_page-1);
	                 global $connection;
					 $sql="SELECT *,
					       UNIX_TIMESTAMP(pubdate) AS pubdate
						   FROM articles
						   INNER JOIN categories
						   ON articles.cat_id=categories.cid
						   INNER JOIN admin
						   ON articles.authorid=admin.id
						   WHERE cat_id=$cid
						   ORDER BY aid DESC
						   LIMIT $perpage
						   OFFSET $offset";
	                 $result=mysql_query($sql,$connection);
					 if(!$result){
						   echo "Error selecting articles by category".mysql_error();
						 }
					 return $result;	 
	}
function get_article_by_author($aid=1,$perpage=100,$cur_page=1){
	                 $offset=$perpage*($cur_page-1);
	                 global $connection;
					 $sql="SELECT *,
					       UNIX_TIMESTAMP(pubdate) AS pubdate
						   FROM articles
						   INNER JOIN admin
						   ON articles.authorid=admin.id
						   INNER JOIN categories
						   ON articles.cat_id=categories.cid
						   WHERE authorid=$aid
						   ORDER BY aid DESC
						   LIMIT $perpage
						   OFFSET $offset";
	                 $result=mysql_query($sql,$connection);
					 if(!$result){
						   echo "Error selecting articles by category".mysql_error();
						 }
					 return $result;	 
	}	
function get_page_feedbacks($pid){
	              
					$sql="SELECT *,UNIX_TIMESTAMP(comdate) AS comdate
					      FROM comments
						  WHERE aid=$pid 
						  ORDER BY comid ASC";/* ORDER BY COALESCE(idreplyto,comid)  note NO SPACE IN FRONT OF COALESCE*/
				   $result = mysql_query($sql);
				   if(!$result){
					         echo "Error selecting Comments".mysql_error();
					   }	
				   return $result;	   	  
	}
function get_feedback_reply($pid,$replyto){
                    $sql="SELECT *,UNIX_TIMESTAMP(comdate) AS comdate
					      FROM comments
						  WHERE aid=$pid
						  AND idreplyto=$replyto
						  ORDER BY comid ASC";
				   $result = mysql_query($sql);
				   if(!$result){
					         echo "Error selecting Comment Reply".mysql_error();
					   }	
				   return $result;	   	  
	
}
function check_if_exist($table,$row,$object){
	             $sql ="SELECT ".$row." FROM ".$table."
				        WHERE $row = ".$object."";
						$resul=mysql_query($sql);
				    	 return $result;		
	}	
function mail_check($address){
	          $sql="SELECT * FROM mailinglist
			        WHERE email='{$address}'";
			  $result = mysql_query($sql);
			  if(!$result){
				    echo "Unable to verify email";
				  }
			  return $result;
			  		
	}
function get_book_list(){
	         $sql="SELECT * FROM books
			       ORDER by bookid ASC";
			 $result=mysql_query($sql);	  
			 return $result ;
	}	
function get_no_downloads($bid){
	                 $sql="SELECT bookname, downloads, extension FROM books WHERE bookid={$bid}";
					 $query=mysql_query($sql);
					 $result=mysql_fetch_array($query);
					 return $result;
	}
function get_book_review(){
	             $sql="SELECT *,UNIX_TIMESTAMP(revdate) AS revdate FROM bookreview
				       ORDER BY id DESC";
				 $result = mysql_query($sql);	  
				 return $result; 
	}
function get_page_name($pid){
                     global $connection;
					 $sql="SELECT aid,title FROM articles
						   WHERE aid=$pid";
					 $result=mysql_query($sql,$connection);
					 
					 if(!$result){
						    echo "Error connecting to table for article".mysql_error();
						 }	   
				      return $result;
}
function get_cat_info($cid){
                    global $connection;
					 $sql="SELECT * FROM categories
						   WHERE cid=$cid";
					 $query=mysql_query($sql,$connection);
					 
					 if(!$query){
						    echo "Error connecting to table for article".mysql_error();
						 }	
				    $result=mysql_fetch_array($query);
				    return $result;
	}
function check_email($email){
                    
					 $sql=mysql_query("SELECT * FROM mailinglist WHERE email='$email'");
					 $email_exist=mysql_num_rows($sql);
					 if($email_exist>0){
						    return true;
						 }	
				     else{
				     return false;
				     }

	}		
function insert_new_email($email){
	        $sql=mysql_query("INSERT INTO mailinglist(email) VALUES('$email')");
			return $sql;
	}		
function get_random_post(){
	      $sql=mysql_query("SELECT aid, title FROM articles ORDER BY RAND() LIMIT 8");
		  if(!$sql){
				echo "Unable to get list of posts you might like".mysql_error();
				}
		  return $sql;
} 		
?>