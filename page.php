<?php
include('config.php');
include('includes/checklink.php');
include('includes/functions.php');
include('includes/insertcomment.php');
?>
<?php
    if(!empty($_GET['p'])){
    $pid = $_GET['p'];
	}
	else{
		 header("location:index.php");
		}
    $article = get_article_by_id($pid);
	$get_comments=get_page_feedbacks($pid);
    $com_no = mysql_num_rows($get_comments);
	$pageheading = $article['title'];
	$pagetitle = $pageheading." | Muselord";
	$pagedesc = $article['adescription'];
	$pagekeywords = $article['keywords'];
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<title>Code block</title>
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(


function replyformaction() {
	 
	 $('a.replylink').click(function(){
	   document.getElementById('.replyformbox').append('.commentbodygroup');
	   $('.replyformbox').show();  
	});
	
	$('a.cancelreply').click(function(){
                           $('.replyformbox').hide();
                          });
	
  /*Try to append a reply form
  */	
	
}



	
/*function hidereplyform() { 
                           $('a.cancelreply').click(function(){
						   if ($('.replyformbox').is(':visible')){
							   $('.replyformbox').hide();
						   }
					 })  
	});*/
	
);

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
	<?php
    if(!empty($_GET['p'])){
		   $p_on=$_GET['p'];
		   $next_p=$p_on+1;
		   $next_page_nav= get_page_name($next_p);
		   $next = mysql_fetch_array($next_page_nav);
		   if( $p_on != 1 ){
		      $prev_p=$p_on-1;
			  $prev_page_nav= get_page_name($prev_p);
		     $prev = mysql_fetch_array($prev_page_nav);
	       }
		}
		
	if(!empty($_GET['r'])){
		 $reptoid=$_GET['r'];
		}	
    ?>
    <?php 
    if($com_no==0){ 
       $calc_com_no = "Be the first to comment";
	  } 
    elseif($com_no==1){	  
	  $calc_com_no = $com_no." Comment"; 
   }
   else{
	    $calc_com_no = $com_no." Comments";
	   }
  ?>
	<?php
	if($article){
	        echo "<div class=\"pagecont\">";
            echo "<div class=\"contdate\">".makeagolong($article['pubdate'])."</div>";//date('F j, Y',$article['pubdate'])
	        echo "<h1 class=\"pagehead\">".$article['title']."</h1>";
			echo "<div class=\"pageinfo\">";
            echo "<span class=\"pagecomno\">".$calc_com_no." : </span>Posted by 
			      <span class=\"pageauthor\"><a href=\"author.php?auid=".$article['authorid']."\">".$article['authorname']."</a></span> filed under 
			      <span class=\"pageconcat\"><a href=\"cat.php?catid=".$article['cat_id']."\">".$article['name']."</a></span>";
            echo "</div>";
            echo $article['content'];
	        echo "</div>";/*end .pagecont */
	}
	  ?>
  
  
   <div id="commenthead">Comments</div> 
   
	<div id="commentbox">
	
    <?php 
  while($comment = mysql_fetch_array($get_comments)){	
   /*if the idreplyto field is empty then it is a comment, so set feed_type to 0 (zero) OR
     else it is a reply if idreplyto field is not empty
   */
 if(empty($comment['idreplyto'])){	 
	 echo "<div class=\"eachcomment\">";
	 echo "<div class=\"commentbodygroup\">";
     echo "<div class=\"commentavatar\">";
     echo "<img src=\"images/".$comment['avatar']."\" class=\"avatar\" width=\"80px\" height=\"80px\" />";
     echo "</div>";/* end .commentavatar*/
         
     echo "<div class=\"commentbody\">";
         
     echo "<div class=\"commentinfo\">";
     echo "<div class=\"commentauthor\">";
     echo         $comment['comby'];
     echo "</div>";
     echo "<div class=\"commentdatetime\">";
     echo  makeago($comment['comdate']);//date('F j, Y',$comment['comdate'])
     echo "</div>";
     echo "</div>";/*end .commentinfo*/
           
     echo "<div class=\"commentcontent\">";
     echo      $comment['comcontent'];
     echo "</div>";/*end .commentcontent*/
           
	 echo "<div class=\"reply\">";
     echo "<a class=\"replylink\" href=\"javascript:replyformaction\" onclick='return' aria-label=\"Reply to ".$comment['comby']."\">Reply ↓</a>";          
     echo "</div>";/* end .reply */
	 echo "</div>";/*end .commentbody*/
	 echo "</div>";/*end .commentbodygroup*/ 
   ?>
   <?php
    $replyto=$comment['comid'];
    $comment_reply=get_feedback_reply($pid,$replyto);
	//use foreach 
	while( $reply=mysql_fetch_array($comment_reply)){
	  echo "<div class=\"replybody\">";
      echo "<div class=\"replyavatar\">";
      echo "<img src=\"images/".$reply['avatar']."\" class=\"avatar\" width=\"80px\" height=\"80px\" />";
      echo "</div>";/* end .replyavatar */
      echo "<div class=\"replycontent\">";
      echo "<div class=\"commentinfo\">";
      echo "<div class=\"commentauthor\">".$reply['comby']."</div>";
      echo "<div class=\"commentdatetime\">". makeago($reply['comdate'])."</div>";//date('F j, Y',$reply['comdate'])
      echo "</div>";/*end .commentinfo*/
           
      echo "<div class=\"commentcontent\">";
      echo $reply['comcontent'];
      echo "</div>";/*end .commentcontent*/
      echo "</div>";/*end replycontent*/
		   
      echo "</div>";/*end .replybody*/
	 }
   ?>
   <?php		   
     echo "</div>";/*end .eachcomment*/
  }
  }
 ?>		
    </div><!--end #commentbox-->  
	
    <div id="comformtitle">
	Drop Feedback
    </div>
    
	<div class="commentformbox">
       <form id="commentform" method="post" action="">
         <div id="top-input-grid"> 
          <input type="text" class="cominput" name="username" value="Enter your name"/>
          <input type="text" class="cominput" name="useremail" value="Enter your email"/>
         </div>
          <textarea name="commentcontent" id="comboxarea" rows="10"  placeholder="Write your comment"></textarea><br />
          <input type="submit" name="commentsubmit" id="commentbut" value="Submit Comment" />
       </form>
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