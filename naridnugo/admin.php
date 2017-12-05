<?php
include('config.php');
include('includes/logincheck.php');
include('includes/functions.php');
?>
<?php
if(!empty($_GET['p'])){
	      $cur_page=$_GET['p'];
	  }
  else{
	    $cur_page=1;
	  }  
?>
<?php
 $perpage=5; /*Set the number of articles to be displayed per page*/
  $totalposts=mysql_num_rows(get_all_article($session_id));
  $totalpages=ceil($totalposts/$perpage);
  $total_msg_no=mysql_num_rows(get_contact_msg());
  
  $check_content = mysql_fetch_array(get_all_article($session_id,$perpage,$cur_page));
  if($check_content[0]==0){
	  header("location:pagenotfound.php");
  }
  
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
<title>codeblock</title>
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	
});
</script>
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

   <div id="left-col">
      <?php include('includes/dashboard.php'); ?> 
   </div><!--end #left-col-->

    <div id="content">
      
	  <?php
        if(isset($_GET['msg'])){
	         $msgcode=$_GET['msg'];
	         if($msgcode=="edited"){
		         echo "<div id=\"editedbox\">";
		         echo "<strong>Welldone!</strong> The Article has been edited successfully.";
		         echo "</div>";
			 }
	        elseif($msgcode=="notedited"){
	             echo "<div id=\"noteditedbox\">";
		         echo "<strong>Oops!</strong> Error editing article!";
			     echo "</div>";
			}
	        elseif($msgcode=="added"){
	             echo "<div id=\"editedbox\">";
		         echo "<strong>Welldone!</strong> Article has been created successfully.";
			     echo "</div>";
			}
			     	   
	        elseif($msgcode=="notadded"){
		         echo "<div id=\"noteditedbox\">";
		         echo "<strong>Oops!</strong> Error creating new article.";
		         echo "</div>";
			}
	   
	        elseif($msgcode=="deleted"){
	             echo "<div id=\"editedbox\">";
		         echo "<strong>OK!</strong> Article has been deleted successfully. undo";
			     echo "</div>";
			}
	   
	        elseif($msgcode=="notdeleted"){
		         echo "<div id=\"noteditedbox\">";
		         echo "<strong>Oops!</strong> Unable to delete article.";
		         echo "</div>";
			}
	       else{ echo "";
		   }
		}
      ?> 
    <?php
  $get_content = get_all_article($session_id,$perpage,$cur_page);
  
  while($article = mysql_fetch_array($get_content)){
            $pid=$article['aid'];
            $get_comments=get_page_feedbacks($pid);
            $com_no = mysql_num_rows($get_comments);
			
			echo "<div class=\"eachcont\">";
	        echo "<div class=\"contdate\">".makeagolong($article['pubdate'])."</div>";//date('F j, Y', $article['pubdate'])
	        echo "<h1 class=\"conthead\"><a href=\"editpost.php?pid=".$article['aid']."\">".$article['title']."</a></h1>"; 
            echo stripslashes(substr($article['content'],0,700))."......";
	        echo "<a id=\"continue\" class=\"fa fa-pencil\" href=\"editpost.php?pid=".$article['aid']."\"> Edit Post</a>";
	        echo "<div class=\"continfo\">";
	        echo "<ul class=\"infolist\">";
	        echo "<li><span class=\"infohead\">COMMENTS</span><br />";
			if($com_no==0){
				  echo "No Comments";
				}
			elseif($com_no==1){
				  echo "1 Comment";
				}	
			else{
				echo $com_no." Comments";
			}   
		    echo "</li>";
	        echo "<li><span class=\"infohead\">CATEGORY</span><br />";
			echo "<a href=\"cat.php?catid=".$article['cat_id']."\">".$article['name']."</a>";
			echo "</li>";
	        echo "<li><span class=\"infohead\">AUTHOR</span><br>".$article['authorname']."</li>";
	        echo "</ul>";
	        echo "</div>";/*end .continfo*/
	        echo "</div>";/*end .eachcont*/
	    
	  }
  ?>
       
	   
	  
	  
    <div id="pagicon">
    <ul id="pagination" >
    <?php
    if($totalpages>1){
	   
     if($cur_page>1){
	        echo '<a href="admin.php?p='.($cur_page-1).'"><li class="pagetrack">prev</li></a>'; 
	 }
	 for($i=1; $i <= $totalpages; $i++){
		  if($cur_page==$i){
			    echo '<a href="admin.php?p='.$i.'"><li class="pageno on">'.$i.'</li></a>';
			  }
		  else{ 
		         echo '<a href="admin.php?p='.$i.'"><li class="pageno">'.$i.'</li></a>';
			  }	  
		 }
	 if($cur_page<$totalpages){
		    echo '<a href="admin.php?p='. ($cur_page+1) .'"><li class="pagetrack">next</li></a>';
		 }
    }
    ?>  	
 
    </ul>
    </div><!--end #pagination-->
    </div><!--end #pagicon-->
    	 
	<div id="footer">
     <?php include('includes/footer.php'); ?>
    </div> 
      
    </div><!--end #content-->
	
</div><!--end #container-->
     
</body>
</html>