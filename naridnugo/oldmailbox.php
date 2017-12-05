<?php include('config.php');?>
<?php include('includes/logincheck.php');?>
<?php include('includes/functions.php')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/admin.css" />

<title>Admin Area- Muselord</title>
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script type="text/javascript">

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

</script>

</head>

<body>
<div id="header">
<?php include('includes/adminheader.php'); ?>
</div>

<div class="adcontainer">
<div id="loginmsg">You are logged in as <?php echo $_SESSION['username'];?> <a href="admin.php?s=logout">Log out</a></div>
<?php
$contact=mysql_fetch_array(get_contact_msg());
$total_msg_no=mysql_num_rows(get_contact_msg());
$unread_msg_no=mysql_num_rows(get_unread_msg());
if($total_msg_no!=0){
           echo '<div class="notificationbox">';
		   echo 'You have <span class="unread"><a href="viewcontact.php">'.$unread_msg_no.' unread</a></span> messages from site users. '; 
           echo '<span class="inboxnote"><a href="viewcontact.php">Inbox('.$total_msg_no.')</a></span>';
           echo '</div>';
}
?>
<?php
if(isset($_GET['tp'])){
	        $cur_page=$_GET['tp'];
	}
else{
	 $cur_page=1;
	}	
	
    $per_page=10;
	$total_post=mysql_num_rows(get_all_article($session_id));	
	$total_pages=ceil($total_post/$per_page);
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
</div><!-- end #msgcontainer -->



<div id="pagicon">
<ul id="pagination" >
<?php 

if($total_pages>1){
  if($cur_page>1){
	  echo '<a href="admin.php?tp='.($cur_page-1).'"><li class="pagetrack">Prev</li></a>';
  }
  for($p=1;$p<=$total_pages;$p++){
	     if($cur_page==$p){
			    echo '<a href="admin.php?tp='.$p.'"><li class="pageno on">'.$p.'</li></a>';
			 }
		 else{	 
			  echo '<a href="admin.php?tp='.$p.'"><li class="pageno">'.$p.'</li></a>';
		 }
	  }
  if($cur_page<$total_pages){
	  echo '<a href="admin.php?tp='.($cur_page+1).'"><li class="pagetrack">Next</li></a>';
	  }
}
?>
</ul>
 <!--end #pagicon--></div>
 <div id="replyBox" style="display:none; width:680px; height:264px; background-color: #005900; background-repeat:repeat; border: #333 1px solid; top:51px; position:fixed; margin:auto; z-index:50; padding:20px; color:#FFF;">
<div align="right"><a href="javascript:toggleReplyBox('close')"><font color="#00CCFF"><strong>CLOSE</strong></font></a></div>
<h2>Replying to <span style="color:#ABE3FE;" id="recipientShow"></span></h2>
Subject: <strong><span style="color:#ABE3FE;" id="subjectShow"></span></strong> <br>
    <form action="javascript:processReply();" name="replyForm" id="replyForm" method="post">
	   <input type="text" id="email" />
       <textarea id="pmTextArea" rows="8" style="width:98%;"></textarea><br />
       <input type="hidden" id="pmSubject" />
       <input type="hidden" id="pm_rec_id" />
       <input type="hidden" id="pm_rec_name" />
       <input type="hidden" id="pm_sender_id" />
       <input type="hidden" id="pm_sender_name" />
       <input type="hidden" id="pmWipit" />
       <br />
       <input name="replyBtn" type="button" onclick="javascript:processReply()" /> 
       &nbsp;&nbsp;&nbsp; <span id="pmFormProcessGif"><img src="images/loading.gif" width="28" height="10" alt="Loading" /></span>
       <div id="PMStatus" style="color:#F00; font-size:14px; font-weight:700;">&nbsp;</div>
    </form>
</div>
</div><!--end .adcontainer -->

<!--<div class="footer">
&nbsp;
</div>-->
</body>
</html>