    <div id="dashboardboxlayer">
      <div id="admindatabox">
        <div id="adminimage">
         <img src="users/drphysics/drphysics.jpg" width="100" />
        </div>
        <div id="admininfo">
        <?php if(!empty($_SESSION['penname'])){ echo $_SESSION['penname']; } else{ echo $_SESSION['username']; }?>
        <div id="adminstatus">Online</div><div id="adminoutlink"><a href="admin.php?s=logout">Log Out</a></div>
        </div>
      </div>
      <div class="dasboardlist">
        <ul id="dashlist">
         <a href="newpost.php"><li><span class="fa fa-pencil rspace"> </span>Write</li></a>
         <a href="admin.php"><li><span class="fa fa-book rspace"> </span>Articles<span class="datano lspace"><?php echo $totalposts; ?></span></li></a>
         <a href="mailbox.php"><li><span class="fa fa-envelope rspace"> </span>Mailbox<span class="datano lspace"><?php echo $total_msg_no; ?></span></li></a>
         <a href=""><li><span class="fa fa-comments rspace"> </span>Comments</li></a>
         <a href=""><li><span class="fa fa-group rspace"> </span>Latest Members</li></a>
         <a href=""><li><span class="fa fa-thumbs-up rspace"> </span>Likes</li></a>
         <a href=""><li><span class="fa fa-edit rspace"> </span>Bio</li></a>
        </ul>
      </div>
	 </div>