<?php include("includes/header.php"); ?>
<?php

session_start();

if(!isset($_SESSION["session_nickname"])):
header("location:login.php");
else:
?>
<?php
	
$name_story= $_POST['name_story'];
$num_reader =$_POST['num_reader'];
$avarage_score = $_POST['avarage_score'];
$name_writer =$_POST['name_writer'];

$name_user =$_SESSION['session_nickname'];
$query_for_us=mysqli_query($con,"SELECT `id_reader` FROM `reader` WHERE nickname='".$name_user."'");
$id_reader =mysqli_fetch_assoc($query_for_us);
$id_reader=$id_reader['id_reader'];
$text_comment = "";
$mark = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$userchb=$_SESSION["session_user"];

function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['name_story'];
    $posts[0] = filter_var($posts[0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $posts[1] = $_POST['num_reader'];
    $posts[2] = $_POST['avarage_score'];
    $posts[3] =$_POST['name_writer'];
    $posts[4] =$_POST['mark'];
     $posts[5] =$_POST['text'];
    return $posts;
}

if(isset($_POST['read']))
{
    
    $data = getPosts();
 
$num_reader=$data[1]+1;

$data = getPosts();
    $update_Query = "UPDATE `story` SET num_reader='$num_reader' WHERE name_story='".$data[0]."'";
       try{ $update_Result = mysqli_query($con, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                $message= "Data Updated";
            }else{
                $message= "Data Not Updated";
            }
        }
    } catch (Exception $ex) {
        $message= "Error Update ".$ex->getMessage();
    }}


// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `story` WHERE name_story='".$data[0]."'";
    try{
        $delete_Result = mysqli_query($con, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
               $message= "Data Deleted";
               $name_story= "";
$num_reader ="";
$avarage_score = "";
$name_writer ="";
            }else{
                $message= "Data Not Deleted";
            }
        }
    } catch (Exception $ex) {
        $message= "Error Delete ".$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `story` SET num_reader='$data[1]', average_score ='$data[2]' WHERE name_story='".$data[0]."'";
       try{ $update_Result = mysqli_query($con, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                $message= "Data Updated";
            }else{
                $message= "Data Not Updated";
            }
        }
    } catch (Exception $ex) {
        $message= "Error Update ".$ex->getMessage();
    }
}
/// Insert

if(isset($_POST['insert']))
{
    $max_mark=10;
    $data = getPosts();
 
if(filter_input(INPUT_POST,'mark',FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION) &&  $_POST['mark']<=$max_mark && $_POST['mark']>=0){
 $query_for_st=mysqli_query($con,"SELECT `id_story` FROM `story` WHERE name_story='".$data[0]."'");
$id_st=mysqli_fetch_assoc($query_for_st);
$id_st=$id_st['id_story'];


    $insert_Query = "INSERT INTO `feedback`(`id_reader`, `id_story`, `text_comment`,`mark`) VALUES ($id_reader,$id_st,'$data[5]',$data[4])";
    try{
        $insert_Result = mysqli_query($con, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                $message ="Data Inserted";
            }else{
                $message= "Data Not Inserted";
            }
        }
    } catch (Exception $ex) {
        $message= "Error Insert ".$ex->getMessage();
    }}
    else $message = "You must enter another mark ";
}

// Search

if(isset($_POST['search']))
{
    $name_story = getPosts();
   
  $search_Query =  "SELECT * FROM story WHERE name_story='".$name_story[0]."'";
    
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
            $message= "No Data For This Id";
            $name_story= "";
$num_reader ="";
$avarage_score = "";
$name_writer ="";
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
<?php 
if($userchb=='reader' || $userchb==null ):?>
<form action="Story_for_reader.php" id="findform" method="post"name="findform">


 <p><label for="name_story">Name<br>
 <input class="input" id="name_story" name="name_story"size="32"  type="text"  value="<?php echo $name_story;?>"></label></p>

<p><label for="num_read">Number of reader<br>
<input class="input" id="num_reader" name="num_reader" size="32"type="value" value="<?php echo $num_reader;?>"></label></p>

<p><label for="avarage_score">Avarage score<br>
<input class="input" id="avarage_score" name="avarage_score"size="32"   type="value" value="<?php echo $avarage_score;?>"></label></p>

<p><label for="name_writer">Name of writer<br>
<input class="input" id="name_writer" name="name_writer"size="32"   type="value" value="<?php echo $name_writer;?>"></label></p>


<?php
if($userchb===null):
    ?>
<p class="submit"><input class="button" id="search"  style="margin:5px;" name= "search" type="submit" value="Find"></p>  
<p class="submit"><input class="button" id="delete"  style="margin:5px;" name= "delete" type="submit" value="Delete"></p>
<p class="submit"><input class="button" id="update"  style="margin:5px;" name= "update" type="submit" value="Edit"></p>
<p><p><p><a href="request.php">Check</a> new request</p>
</p></p>
<?php endif;?>



<?php 
if($userchb==='reader' ):?>
<p class="submit"><input class="button" id="search"  style="margin:5px;" name= "search" type="submit" value="Find"></p>	 
<p class="submit"><input class="button" id="add_button"  style="margin:5px;" name= "add_button" type="submit" value="Add feedback"></p>
<p class="submit"><input class="button" id="read"  style="margin:5px;" name= "read" type="submit" value="Mark as read"></p> 
<?php
if(isset($_POST['add_button'])):
    ?>
   

<p><label for="mark">Mark<br>
<input class="input" id="mark" name="mark" size="32"   type="value" value="<?php echo $mark;?>"></label></p>

<p><label>Text<br>
<textarea name="text" cols="32" rows="10" placeholder="<?php echo $text_comment;?>"></textarea></p>
 <p class="submit"><input class="button" id="insert" name= "insert" type="submit" value="Save"></p>
<?php endif; ?>
<?php endif;?>

<p><a href="feedback_for_reader.php">Want</a> find feedback to other story</p>
<p><a href="logout.php">Exit</a> from system</p>
 <?php endif; ?>


 <?php endif; ?>

 </form>
</div>
</div>

</body>
</html>
