<?php

session_start();

if(!isset($_SESSION["session_nickname"])):
header("location:login.php");
else:
?>
	
<?php include("includes/header.php"); 
$userchb=$_SESSION["session_user"];
?>
<div id="welcome">
<h2>Welcome, <span><?php echo $_SESSION['session_nickname'];?>! </span></h2>
  <p><a href="logout.php">Exit</a> from system</p>
   <?php
  if($userchb===null):
  ?>
   <p><a href= "feedback_for_reader.php">Feedback</a>
  <a href= "Story_for_reader.php">Story</a>
  <a href= "request.php">Request</a></p>
</div>
  <?php
endif;
  if($userchb==='reader'):
  ?>
  <p><a href= "feedback_for_reader.php">Feedback</a>
 <a href= "Story_for_reader.php">Story</a></p>
</div>
	 <?php
  endif;
   if($userchb==='writer'):
  ?>
  <p><a href= "feedback_for_reader.php">Feedback</a>
  <a href= "Story_for_writer.php">Story</a></p>
</div>
	 <?php
  endif;
  ?>
<?php include("includes/footer.php"); ?>
	
<?php endif; ?>
