<?php include("includes/header.php"); ?>
<?php

session_start();

if(!isset($_SESSION["session_nickname"])):
header("location:login.php");
else:
?>
<?php
	
$name_story= "";
$num_reader ="";
$avarage_score="";
$name_writer ="";


$userchb=$_SESSION["session_user"];
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['name_story'];
    $posts[1] = $_POST['num_reader'];
    $posts[2] = $_POST['avarage_score'];
    $posts[3] =$_POST['name_writer'];
  
    return $posts;
}




// Search

if(isset($_POST['search']))
{
    $data= getPosts();
      $data[0] = filter_var($data[0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $search_Query =  "SELECT * FROM story WHERE name_story='".$data[0]."'";
 
    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
              
                $name_story = $row['name_story'];
                $num_reader = $row['num_reader'];
                $avarage_score = $row['average_score'];
 $query_for_wr=mysqli_query($con,"SELECT `nickname` FROM `writer` WHERE id_writer='".$row['id_writer']."'");
$id_wr=mysqli_fetch_assoc($query_for_wr);
$id_wr=$id_wr['nickname'];
$name_writer=$id_wr;
            }
        }else{
            $message= "No Data For This Story";
        }
    }else{
        $message= "Result Error";
    }
}
	?>


<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>
<body>
<div class="searchsmth">
<div id="login">
<h1>Search Story</h1>
  

 <?php if($userchb==='writer'):?>

<form action="Story_for_writer.php" id="findform" method="post"name="findform">



 <p><label for="name_story">Name<br>
 <input class="input" id="name_story" name="name_story"size="32"  type="text"  value="<?php echo $name_story;?>"></label></p>

<p><label for="num_read">Number of reader<br>
<input class="input" id="num_reader" name="num_reader" size="32"type="value" value="<?php echo $num_reader;?>"></label></p>

<p><label for="avarage_score">Avarage score<br>
<input class="input" id="avarage_score" name="avarage_score"size="32"   type="value" value="<?php echo $avarage_score;?>"></label></p>

<p><label for="name_writer">Name of writer<br>
<input class="input" id="name_writer" name="name_writer"size="32"   type="value" value="<?php echo $name_writer;?>"></label></p>





<p class="submit"><input class="button" id="search"  style="margin:5px;" name= "search" type="submit" value="Find"></p>	 
<p class="submit"><input class="button" id="add"  style="margin:5px;" name= "add" type="button" value="Add" onClick='location.href="request.php"'></p>  



<p><p><p><a href="feedback_for_reader.php">Want</a> find feedback to other story</p>
<p><a href="logout.php">Exit</a> from system</p></p></p>
 <?php endif; ?>
 <?php endif; ?>

 </form>
</div>
</div>

</body>
</html>
