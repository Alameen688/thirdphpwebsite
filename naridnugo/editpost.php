<?php 
      include('config.php'); 
      include('includes/logincheck.php');	  
	  include('includes/postprocess.php');
	  include('includes/functions.php');
	  
	  $totalposts=mysql_num_rows(get_all_article($session_id));
	  $total_msg_no=mysql_num_rows(get_contact_msg());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />

	<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>

	<!-- Redactor is here -->
	<link rel="stylesheet" href="redactor/redactor.css" />
	<script src="redactor/redactor.min.js"></script>

	<script type="text/javascript">
	$(document).ready(
		function()
		{
			$('#redactor_content').redactor();
		}
	);
	</script><title>Edit Article</title>
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
  <?php include('includes/adminheader.php'); ?>
</div>
  <div class="container">
  
    <div id="left-col">
     <?php include('includes/dashboard.php'); ?> 
    </div><!--end #left-col-->

    <div id="content">
     
     <div class="postformbox">
     
     <div id="postformheader">
       <div id="postheadtitle"><span class="fa fa-pencil-square"></span> Edit Your Article</div>
     </div>
     
     <div class="postform">
     <?php 
       if(!empty($_GET['pid'])){
	     $peditid=$_GET['pid'];
	   }
	   else{
		 header("location:admin.php");
		}
	   
	  $get_comments=get_page_feedbacks($peditid);
      $com_no = mysql_num_rows($get_comments);
	   
      $get_post=get_article_by_id($peditid);
         while($post=mysql_fetch_array($get_post)){
     ?>
     <form method="post" action="" id="adpost">
      <input type="hidden" name="postid" value="<?php echo $post['aid']; ?>" />
      <label class="ltitle">Post Title&dArr;</label>
      <input type="text" name="ptitle" class="defaultin pinput" value="<?php echo $post['title']; ?>" /><br />
      <?php if(!empty($tmsg)){echo "<span class=\"adderror\">".$tmsg."</span><br />";}?>
      <label class="ltitle ptitle">Post Content&dArr;</label><br />
      <textarea id="redactor_content" name="pcontent"><?php echo $post['content']?></textarea><br /> 
      <?php if(!empty($pmsg)){echo "<span class=\"adderror\">".$pmsg."</span><br />";}?>
      <label class="ltitle">Description&dArr;</label>
      <input type="text" name="adescription" class="defaultin dinput" value="<?php echo $post['adescription'];?>" /><br />
      <?php if(!empty($dmsg)){echo "<span class=\"adderror\">".$dmsg."</span><br />";}?>
      <label class="ltitle">Keywords&dArr;</label>
      <input type="text" name="keyword" class="defaultin kinput" value="<?php echo $post['keywords'];?>" /><br />
      <?php if(!empty($kmsg)){echo "<span class=\"adderror\">".$kmsg."</span><br />";}?>
      <label class="ltitle">Category&dArr;</label>
      <select id="catlist" name="catlist">
       <?php 
       $cat_list = get_cat_list();
       while($cat=mysql_fetch_array($cat_list)){
            echo "<option value=".$cat['cid']."";
            echo ( $cat['cid'] == $post['cat_id'] ) ? " selected" : "";
            echo ">".$cat['name']."</option>"; 
       }
       ?>
      </select><br />
      <?php if(!empty($cmsg)){echo "<span class=\"adderror\">".$cmsg."</span><br />";}?>
      <!--<label>Date Modified:</label>
      <input type="date" name="pdate" class="pdinput" placeholder="YYYY-MM-DD" /><br />
      -->
      <div id="actionbut">
      <input type="submit" class="btn btn-info" id="savebut" value="Save Changes" name="edit" />
      <input type="submit" class="btn btn-info" value="Cancel" name="cancel" />
      <input type="submit" name="delete" class="delbut" value="Delete Article" onclick="return confirm('Are you sure you want to delete this Article ?')" />
      </div>
     </form>
        <?php
         }
        ?>
     </div><!--end .postform-->
     
     </div><!--end .postformbox-->
     
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
     echo "<img src=\"../images/".$comment['avatar']."\" class=\"avatar\" width=\"80px\" height=\"80px\" />";
     echo "</div>";/* end .commentavatar*/
         
     echo "<div class=\"commentbody\">";
     
	 if($comment['status']=='blocked'){	
	    echo "<a class=\"btn unblockbut\" href=\"\">Unblock</a>";  
	 }
	 else{	
	    echo "<a class=\"btn blockbut\" href=\"\">Block</a>";
	 }  
	 	 
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
    $comment_reply=get_feedback_reply($peditid,$replyto);
	//use foreach 
	while( $reply=mysql_fetch_array($comment_reply)){
	  echo "<div class=\"replybody\">";
	  
      echo "<div class=\"replyavatar\">";
      echo "<img src=\"../images/".$reply['avatar']."\" class=\"avatar\" width=\"80px\" height=\"80px\" />";
      echo "</div>";/* end .replyavatar */
	  
      echo "<div class=\"replycontent\">";
	  
	  echo "<a class=\"btn blockbut\" href=\"\">Block</a>";
	  
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
    
      </div><!--end #content--> 
      <div id="footer">
        <?php include('includes/footer.php'); ?>
      </div>
     </div><!--end #container--> 
</body>
</html>