<?php
include('config.php');
include('includes/functions.php');
?>
<?php
if(!empty($_GET['auid'])){
$auid=$_GET['auid'];
}
else{
	  header("location:index.php");/*Returns to index if category id is empty*/
}

$cat_info=get_cat_info($auid);

?>
<?php
  if(!empty($_GET['p'])){
	      $cur_page=$_GET['p'];
	  }
  else{
	    $cur_page=1;
	  }  
  $perpage=6; /*Set the number of articles to be displayed per page*/
  $totalposts=mysql_num_rows(get_article_by_author($auid));
  $totalpages=ceil($totalposts/$perpage);
  $check_author_content = mysql_fetch_array(get_article_by_author($auid,$perpage,$cur_page));
  if($check_author_content[0]==0){
	   header('location:author.php?auid='.$cur_page.'');/*returns you to the first page of the current author page if $cur_page is empty*/
	  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<title>codeblock</title>
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
  $get_by_author = get_article_by_author($auid,$perpage,$cur_page);
  
  while($article = mysql_fetch_array($get_by_author)){
			$pid=$article['aid'];
            $get_comments=get_page_feedbacks($pid);
            $com_no = mysql_num_rows($get_comments);	
			
			echo "<div class=\"eachcont\">";
	        echo "<div class=\"contdate\">".makeagolong($article['pubdate'])."</div>"; //date('F j, Y', $article['pubdate'])
	        echo "<h1 class=\"conthead\"><a href=\"page.php?p=".$article['aid']."\">".$article['title']."</a></h1>"; 
            echo substr($article['content'],0,700)."......";
	        echo "<a id=\"continue\" class=\"fa fa-link\" href=\"page.php?p=".$article['aid']."\">Read Post</a>";
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
	        echo "<li><span class=\"infohead\">AUTHOR</span><br /><a href=\"author.php?auid=".$article['authorid']."\">".$article['authorname']."</a></li>";
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
	        echo '<a href="author.php?auid='.$auid.'&amp;p='.($cur_page-1).'"><li class="pagetrack">prev</li></a>'; 
	 }
	 for($i=1; $i <= $totalpages; $i++){
		  if($cur_page==$i){
			    echo '<a href="author.php?auid='.$auid.'&amp;p='.$i.'"><li class="pageno on">'.$i.'</li></a>';
			  }
		  else{ 
		         echo '<a href="author.php?auid='.$auid.'&amp;p='.$i.'"><li class="pageno">'.$i.'</li></a>';
			  }	 
		 }
	 if($cur_page<$totalpages){
		    echo '<a href="author.php?auid='.$auid.'&amp;p='.($cur_page+1).'"><li class="pagetrack">next</li></a>';
		 }
		 
  }
  ?>
 
    </ul>
    </div><!--end #pagination-->
    </div><!--end #pagicon-->
    	 
	  
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