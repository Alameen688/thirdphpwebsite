<?php
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
function get_all_article($session_id,$perpage=100000,$cur_page=1){
	                $offset=$perpage*($cur_page-1);
	                 global $connection;
	                 $sql="SELECT *,
					       UNIX_TIMESTAMP(pubdate) AS pubdate
						   FROM articles
						   INNER JOIN categories
						   ON articles.cat_id=categories.cid
						   INNER JOIN admin
						   ON articles.authorid=admin.id
						   WHERE admin.id= '{$session_id}'
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
					       UNIX_TIMESTAMP(pubdate) AS pubdate 
					       FROM articles
						   INNER JOIN categories
						   ON articles.cat_id = categories.cid
						   WHERE aid=$aid
						   ";
					 $result=mysql_query($sql,$connection);
					 
					 if(!$result){
						    echo "Error connecting to table for article".mysql_error();
						 }	   
				      return $result;		 
	}
function del_article($aid){
	             global $connection;
				 $sql="DELETE FROM articles WHERE aid={$aid}";
				 $result=mysql_query($sql,$connection);
				 if(!$result){
					    echo "Error deleting article".mysql_error();
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
function get_article_by_cat($cid=1,$perpage=1000000,$cur_page=1){
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
function get_contact_msg(){
	                global $connection;
					$sql="SELECT * FROM contacts";  
					$result=mysql_query($sql); 
					if(!$result){
						 echo "error selecting contact messages".mysql_error();
						}
					return $result;     
	}
function get_unread_msg(){
                    global $connection;
					$sql="SELECT * FROM contacts WHERE opened='0'";  
					$result=mysql_query($sql); 
					if(!$result){
						 echo "error selecting contact messages".mysql_error();
						}
					return $result;    
	                    
	}
function get_all_messages($perpage=100000,$cur_page=1){
	                global $connection;
					$offset=$perpage*($cur_page-1);
					$sql="SELECT *, UNIX_TIMESTAMP(date) AS date
					      FROM contacts
					      ORDER BY id DESC
						  LIMIT $perpage
						  OFFSET $offset";  
					$result=mysql_query($sql); 
					if(!$result){
						 echo "error selecting contact messages".mysql_error();
						}
					return $result;     
	}	
function get_cat_list(){
	               global $connection;
	               $sql="SELECT * FROM categories";
				   $result=mysql_query($sql,$connection);
				   if(!$result){
						    echo "Error getting category list".mysql_error();
						 }
				   return $result;
	}
		
?>	