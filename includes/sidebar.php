<div id="squaread" class="rightbox">
    <img src="images/ad3.jpg" width="280" />
    </div><!--end #squaread-->
	
	<div id="subscribe" class="rightbox">
      <div class="rhead">EMAIL UPDATES</div><!--to our newsletter-->
       <div id="sformbox">
        <form action="subscribe.php" method="post">
         <input type="text" name="email" class="input einput" value="Email Address.." />
         <input type="submit" id="sbut" name="subscribe" value="Subscribe" />
        </form>
       </div><!--end #sformbox-->
    </div><!--end #subscribe-->
	
    <div id="popost" class="rightbox">
     <div class="rhead">POSTS YOU MAY LIKE</div>
     <ul class="popcont">
   <?php
     $get_rand_post=get_random_post();
     while($random_post=mysql_fetch_array($get_rand_post)){
       echo "<li><a href=\"page.php?p=".urlencode($random_post['aid'])."\">".$random_post['title']."</a></li>";
	 }
   ?>
      </ul>
    </div><!--end #popost-->
	
    <div id="fbpost" class="rightbox">
     <div class="rhead">LIKE US ON FACEBOOK</div>
    </div><!--end #fbpost-->