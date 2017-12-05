<?php include('config.php'); ?>
<?php
if($_POST){
	$q=mysql_real_escape_string($_POST['searchword']);
	$sqlquery=mysql_query("SELECT * FROM articles 
	                       WHERE (title like  '%$q%' or content like '%$q%' or adescription like '%q%')
						   ORDER BY pubdate DESC LIMIT 6");
    while($result=mysql_fetch_array($sqlquery)){
		$title=$result['title'];
		$re_title='<b> '.$q.' </b>';
		$finaltitle=str_replace($q, $re_title, $title);
		
if(!empty($finaltitle)){
?>	
<div class="displaybox" align="left">
<?php echo $finaltitle; ?>
</div>
<?php
}
		}						   
	}
	else{}
?>