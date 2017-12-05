<?php
include('config.php');
include('includes/logincheck.php');
include('includes/functions.php');
?>
<?php
         if(isset($_GET['tp'])){
	        $cur_page=$_GET['tp'];
	     }
         else{
	        $cur_page=1;
	     }	
		 $totalposts=mysql_num_rows(get_all_article($session_id));
		 $total_msg_no=mysql_num_rows(get_contact_msg());
	
?>
<?php
         $per_page=5;
	     $totalmsg=mysql_num_rows(get_all_messages());	
	     $totalpages=ceil($totalmsg/$per_page);
         
		 $check_content = mysql_fetch_array(get_all_messages());
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
	$(document).ready(function() { 
$(".togglerow").click(function () { 
  if ($(this).next().is(":hidden")) {
	$("div #showmsgbox").hide();
    $(this).next().slideDown("fast"); 
  } else { 
    $(this).next().hide(); 
  } 
}); 
});

function toggleReplyBox(subject,sendername,senderid,recName,recID,replyWipit) {
	$("#subjectShow").text(subject);
	$("#recipientShow").text(sendername);
	document.replyForm.pmSubject.value = subject;
	document.replyForm.pm_sender_name.value = sendername;
	document.replyForm.pmWipit.value = replyWipit;
	document.replyForm.pm_sender_id.value = senderid;
	document.replyForm.pm_rec_name.value = recName;
	document.replyForm.pm_rec_id.value = recID;
    document.replyForm.replyBtn.value = "Send reply to "+recName;
    if ($('#replyBox').is(":hidden")) {
		  $('#replyBox').fadeIn(1000);
    } else {
		  $('#replyBox').hide();
    }      
}
function processReply () {
	
	  var pmSubject = $("#pmSubject");
	  var pmTextArea = $("#pmTextArea");
	  var sendername = $("#pm_sender_name");
	  var senderid = $("#pm_sender_id");
	  var recName = $("#pm_rec_name");
	  var recID = $("#pm_rec_id");
	  var pm_wipit = $("#pmWipit");
	  var url = "scripts_for_profile/private_msg_parse.php";
      if (pmTextArea.val() == "") {
		   $("#PMStatus").text("Please type in your message.").show().fadeOut(6000);
      } else {
		  $("#pmFormProcessGif").show();
		  $.post(url,{ subject: pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderID: senderid.val(), rcpntName: recName.val(), rcpntID: recID.val(), thisWipit: pm_wipit.val() } ,  function(data) {
			   document.replyForm.pmTextArea.value = "";
			   $("#pmFormProcessGif").hide();
			   $('#replyBox').slideUp("fast");
			   $("#PMFinal").html("&nbsp; &nbsp;"+data).show().fadeOut(8000);
           });  
	  }
}

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
    
    
       <div id="mailcontainer">
       
        <?php
		  $total_msg_no=mysql_num_rows(get_contact_msg());
          $unread_msg_no=mysql_num_rows(get_unread_msg());
            if($total_msg_no!=0){
                echo '<div class="notificationbox">';
		        echo 'You have <span class="unread"><a href="mailbox.php">'.$unread_msg_no.' unread</a></span> messages from site users. '; 
                echo '<span class="inboxnote"><a href="mailbox.php">Inbox('.$total_msg_no.')</a></span>';
                echo '</div>';
			}
		?>
        <div id="msgcontainer">
          <?php
            $get_messages=get_all_messages($per_page,$cur_page);
            while($message=mysql_fetch_array($get_messages)){
            echo "<div class=\"togglerow\" ";
			if($message['opened']==1){
		    echo "id=\"openedmsgbox\"";
		    }
			else {
			echo "id=\"msgbox\"";
			}
			echo ">";
            echo "<div id=\"msgsubject\">";
            echo $message['contsubject'];
            echo "</div>";
            echo "<div id=\"msgsender\">";
            echo "&raquo;".$message['contname'];
            echo "</div>";
            echo "<div id=\"msgdate\">";
            echo date('F j, Y', $message['date']);
            echo "</div>";
            echo "</div>";//end#msgbox 
			echo "<div id=\"showmsgbox\">";
			echo $message['contmessage'];
			echo "<br /><a href=\"javascript:toggleReplyBox('".$message['contsubject'],$message['contname'],$message['contemail'],$message['id']."')\">REPLY</a>";
			echo "</div>";
			
            }
         ?>
        </div>
        
       </div>
	   
	  
	  
    <div id="pagicon">
    <ul id="pagination" >
    <?php
    if($totalpages>1){
	   
     if($cur_page>1){
	        echo '<a href="mailbox.php?tp='.($cur_page-1).'"><li class="pagetrack">prev</li></a>'; 
	 }
	 for($i=1; $i <= $totalpages; $i++){
		  if($cur_page==$i){
			    echo '<a href="mailbox.php?tp='.$i.'"><li class="pageno on">'.$i.'</li></a>';
			  }
		  else{ 
		         echo '<a href="mailbox.php?tp='.$i.'"><li class="pageno">'.$i.'</li></a>';
			  }	  
		 }
	 if($cur_page<$totalpages){
		    echo '<a href="mailbox.php?tp='. ($cur_page+1) .'"><li class="pagetrack">next</li></a>';
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