<?php include("includes/header.php");

?>

<?php

session_start();

if(!isset($_SESSION["session_nickname"])):
header("location:login.php");
else:
?>

<?php
	
$name_story= "";
$userchb=$_SESSION["session_user"];
$id_reader ="";
$text_comment = "";
$mark = "";
$id_feedback="";
 $id_for_edit="";
$nickname="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);




function getPosts()
{

    $posts = array();
    $posts[0] = $_POST['name_story'];
    
    $posts[1] = $_POST['id_reader'];
	$posts[2] = $_POST['text'];
    $posts[3] = $_POST['mark'];
    $posts[4] = $_POST['id_feedback'];
    
    return $posts;
}



// Insert
if(isset($_POST['insert']))
{
	$max_mark=10;
    $data = getPosts();
 
if(filter_input(INPUT_POST,'mark',FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION) &&  $_POST['mark']<=$max_mark){
 $query_for_st=mysqli_query($con,"SELECT `id_story` FROM `story` WHERE name_story='".$data[0]."'");
$id_st=mysqli_fetch_assoc($query_for_st);
$id_st=$id_st['id_story'];

$nickname=
$_SESSION['session_nickname'];

$query_for_r=mysqli_query($con,"SELECT `id_reader` FROM `reader` WHERE nickname='".$nickname."'");
$id_r=mysqli_fetch_assoc($query_for_r);
$id_r=$id_r['id_reader'];


    $insert_Query = "INSERT INTO `feedback`(`id_reader`, `id_story`, `text_comment`,`mark`) VALUES ($id_r,$id_st,'$data[2]',$data[3])";
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
        echo 'Error Insert '.$ex->getMessage();
    }}
    else $message = "No valid data";
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();

$name_story = filter_var($_POST['name_story'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $delete_Query = "DELETE FROM `feedback` WHERE id_feedback='".$data[4]."'";
    try{
        $delete_Result = mysqli_query($con, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                $message= "Data Deleted";
            }else{
                $message= "Data Not Deleted";
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
	$max_mark = 10;
	if(filter_input(INPUT_POST,'mark',FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION) &&  $_POST['mark']<=$max_mark && $_POST['mark']>=0){
    $data = getPosts();echo $id_for_edit;
    $update_Query = "UPDATE `feedback` SET text_comment='$data[2]', mark ='$data[3]' WHERE id_feedback='".$data[4]."'";
       try{ $update_Result = mysqli_query($con, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
                $message = "Data Updated";
            }else{
               $message = "Data Not Updated";
            }
        }
    } catch (Exception $ex) {
        $message = "Error Update ".$ex->getMessage();
    }}
    else $message = "Not Valid mark";
}

// Search

if(isset($_POST['search']))
{

    $data = getPosts();
    
   

    $query_for_st=mysqli_query($con,"SELECT `id_story` FROM `story` WHERE name_story='".$data[0]."'");
$id_st=mysqli_fetch_assoc($query_for_st);
$id_st=$id_st['id_story'];

    if($data[4]=="")
    $search_Query =  "SELECT * FROM feedback WHERE id_story= '".$id_st."'";
else
    $search_Query =  "SELECT * FROM feedback WHERE id_feedback= '".$data[4]."'";

    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {

            while($row = mysqli_fetch_array($search_Result))
            {
              
              $name_story=$data[0];
               
                $nickname_reader=mysqli_query($con,"SELECT nickname FROM reader WHERE id_reader= '".$row['id_reader']."'");
                $nickname=mysqli_fetch_assoc($nickname_reader);
$nickname=$nickname['nickname'];


                $mark = $row['mark'];
                $text_comment = $row['text_comment'];
             

            }
        }else{
            $message= "Be the first to comment on this story";
        }
    }else{
        $message= "Result Error";
    }
}
	?>

<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>

<body>
<div class="feed">
<div id="login">
<h1>Search of feedback</h1>

<form action="feedback_for_reader.php" id="feed" method="post"name="feed">
<label for="name_story">Name Story</label>
 <select name="name_story">
     <option   value="<?php echo $name_story;?>"><?php echo $name_story ; ?>
</option>
 <?php
$name_of_search =$name_story;
$story=mysqli_query($con,"SELECT * FROM story ");
 

  while($row = mysqli_fetch_array($story)):?>

<option  value="<?php echo $row['name_story'];?>"><?php echo $row['name_story'] ; ?>
</option>


<?php endwhile;?></select></p>

 <label for="id_feedback">ID of feedback</label>
 <select name="id_feedback">ID of feedback<br>
    <option   value="<?php echo $id_feedback;?>"><?php echo $id_feedback ; ?>
</option>
    <?php
$id_feed=mysqli_query($con,"SELECT * FROM feedback WHERE id_story='".$id_st."'");
 

  while($row = mysqli_fetch_array($id_feed)):

   $id_feedback= $row['id_feedback'];?>

<option  value="<?php echo $id_feedback;?>"><?php echo $row['id_feedback'] ; ?>
</option>


<?php endwhile;?>
</select></p>



<p><label for="id_reader">Nickname of reader<br>
<input class="input" id="id_reader" name="id_reader" size="35"type="value" value="<?php echo $nickname;?>"></label></p>

<p><label for="mark">Mark<br>
<input class="input" id="mark" name="mark" size="35"   type="value" value="<?php echo $mark;?>"></label></p>

<p><label>Text<br>
<textarea name="text" cols="32" rows="10" placeholder="<?php echo $text_comment;?>"></textarea></p>
 
<?php if($userchb==='writer'):?>
   <p class="submit"><input class="button" id="search"  style="margin:5px;" name= "search" type="submit" value="Find"></p> 
   <p><p><p><a href="Story_for_writer.php">Want</a> find other story</p>
</p></p>
    <?php endif; ?>

<?php if($userchb==='reader'):?>
<p class="submit"><input class="button" id="search"  style="margin:5px;" name= "search" type="submit" value="Find"></p>
<p class="submit"><input class="button" id="insert"  style="margin:5px;" name= "insert" type="submit" value="Add"></p>

</p></p>

<?php if($_SESSION['session_nickname']==  $nickname):?>
<p class="submit"><input class="button" id="delete" style="margin:5px;" margin-right="2px" name= "delete" type="submit" value="Delete"></p> 
<p class="submit"><input class="button" id="update"  style="margin:5px;" name= "update" type="submit" value="Edit"></p>
<p><p><p><a href="Story_for_reader.php">Want</a> find  other story</p>
</p></p>
<?php endif; ?>

<?php endif; ?>


<?php if($userchb===null):?>
<p class="submit"><input class="button" id="delete" style="margin:5px;" margin-right="2px" name= "delete" type="submit" value="Delete"></p> 

<p class="submit"><input class="button" id="search"  style="margin:5px;" name= "search" type="submit" value="Find"></p>
<p><p><p><a href="Story_for_reader.php">Want</a> find  other story</p>
</p></p>
<?php endif; ?>



<p><a href="logout.php">Exit</a> from system</p>
<?php endif; ?>

 </form>
</div>
</div>

</body>
</html>
