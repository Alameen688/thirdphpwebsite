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
	</script><title>New Article</title>
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
       <div id="postheadtitle"><span class="fa fa-pencil-square"></span> Write New Article</div>
     </div>
     <div class="postform">
     <form method="post" action="" id="adpost">
      <input type="hidden" name="authorid" value="<?php echo $session_id; ?>" />
      <label class="ltitle">Post Title&dArr;</label>
      <input type="text" name="ptitle" class="defaultin pinput" placeholder="Article title goes here..." value="<?php if(!empty($title)){echo $title;}?>" /><br />
      <?php if(!empty($tmsg)){echo "<span class=\"adderror\">".$tmsg."</span><br />";}?>
      <label class="ltitle ptitle">Post Content&dArr;</label><br />
      <textarea id="redactor_content" name="pcontent"><?php if(!empty($content)){echo $content;}?></textarea><br /> 
      <?php if(!empty($pmsg)){echo "<span class=\"adderror\">".$pmsg."</span><br />";}?>
      <label class="ltitle">Description&dArr;</label>
      <input type="text" name="adescription" class="defaultin dinput" placeholder="Enter article short description for SEO" 
       value="<?php if(!empty($description)){echo $description;}?>" /><br />
      <?php if(!empty($dmsg)){echo "<span class=\"adderror\">".$dmsg."</span><br />";}?>
      <label class="ltitle">Keywords&dArr;</label>
      <input type="text" name="keyword" class="defaultin kinput" placeholder="Enter article keywords for SEO" value="<?php if(!empty($keyword)){echo $keyword;}?>" />
      <br />
      <?php if(!empty($kmsg)){echo "<span class=\"adderror\">".$kmsg."</span><br />";}?>
      <label class="ltitle">Category&dArr;</label>
      <select id="catlist" name="catlist">
      <option value="0">Select Category</option>
       <?php 
       $cat_list = get_cat_list();
         while($cat=mysql_fetch_array($cat_list)){
            echo "<option value=".$cat['cid'].">".$cat['name']."</option>"; 
         }
       ?>
      </select><br />
      <?php if(!empty($cmsg)){echo "<span class=\"adderror\">".$cmsg."</span><br />";}?>
      <div id="actionbut">
      <input type="submit" class="btn btn-info" id="savebut" value="Save Article" name="newpost" />
      <input type="submit" class="btn btn-info" value="Cancel" name="cancel" />
      </div>
     </form>
     </div>
     </div>
      
    </div><!--end #content--> 
    <div id="footer">
        <?php include('includes/footer.php'); ?>
      </div>
</div><!--end #container--> 
</body>
</html>