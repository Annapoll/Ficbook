<?php include("includes/header.php"); ?>
<?php

session_start();

if(!isset($_SESSION["session_nickname"])):
header("location:login.php");
else:
$userchb=$_SESSION['session_user'];
$nickname=
$_SESSION['session_nickname'];
$admin="";
$status="";
$id_req="";
$name_story="";
$nickname_writer="";
function getPosts()
{

    $posts = array();
    $posts[0] = $_POST['admin'];
    $posts[1] = $_POST['status'];
    $posts[2] = $_POST['id_req'];

    $posts[3] = $_POST['name_story'];
    $posts[3] = filter_var($data[0], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $posts[4]=$_POST['nickname_writer'];
    return $posts;
}

// Insert
if(isset($_POST['add_to_st']))
{
    
    $data = getPosts();
 
if($data[3]){

$query_for_st=mysqli_query($con,"SELECT `id_writer` FROM `writer` WHERE nickname='".$data[4]."'");
$id_st=mysqli_fetch_assoc($query_for_st);
$id_st=$id_st['id_writer'];


$query=mysqli_query($con, "SELECT * FROM story WHERE name_story='".$data[3]."'");
 $query2=mysqli_query($con, "SELECT * FROM request WHERE name_story='".$data[3]."'");
$numrows=mysqli_num_rows($query);
$numrows2=mysqli_num_rows($query2);
if($numrows==0 && $numrows2==0){

    $insert_Query = "INSERT INTO `story`(`id_request`, `id_writer`, `name_story`,`num_reader`) VALUES ($data[2],$id_st,'$data[3]','0')";
    $update_Query = "UPDATE `request` SET request='1' WHERE id_request='".$data[2]."'";
    try{
        $insert_Result = mysqli_query($con, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($con) > 0)
            {
              
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
        $message= "Error Update ".$ex->getMessage();}}




            }else{
                $message= "Data Not Inserted";
            }
        }
    catch (Exception $ex) {
        $message = "Error Insert ".$ex->getMessage();
    }

}else $message = "Enter other namestory";
}
    
    else $message = "Enter namestory";
}


if(isset($_POST['edit']))
{
    $data = getPosts();
if($data[1]=="Not")
    $req='0';
else
    $req='1';

    $update_Query = "UPDATE `request` SET request='$req' WHERE id_request='".$data[2]."'";
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


if(isset($_POST['add']))
{
    $max_mark=10;
    $data = getPosts();
 

$query_for_wr=mysqli_query($con,"SELECT `id_writer` FROM `writer` WHERE nickname='".$nickname."'");
$id_wr=mysqli_fetch_assoc($query_for_wr);
$id_wr=$id_wr['id_writer'];

$nickname_admin=mysqli_query($con,"SELECT `id_admine` FROM `admin` WHERE nickname= '".$data[0]."'");
                $id_ad=mysqli_fetch_assoc($nickname_admin);
$id_ad=$id_ad['id_admine'];

 $query=mysqli_query($con, "SELECT * FROM story WHERE name_story='".$data[3]."'");
 $query2=mysqli_query($con, "SELECT * FROM request WHERE name_story='".$data[3]."'");
$numrows=mysqli_num_rows($query);
$numrows2=mysqli_num_rows($query2);
if($numrows==0 && $numrows2==0){

    $insert_Query = "INSERT INTO `request`(`id_writer`, `id_admine`, `request`,`name_story`) VALUES ($id_wr,$id_ad,'0','$data[3]')";
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
    }
   
} else $message = "Enter other namestory";
}

if(isset($_POST['find']))
{

    $data = getPosts();
    
   
if($userchb==='writer'){
  $query_for_wr=mysqli_query($con,"SELECT `id_writer` FROM `writer` WHERE nickname='".$nickname."'");

$id_us=mysqli_fetch_assoc($query_for_wr);
$id_us=$id_us['id_writer'];}
else
{
     $query_for_wr=mysqli_query($con,"SELECT `id_admine` FROM `admin` WHERE nickname='".$nickname."'");

$id_us=mysqli_fetch_assoc($query_for_wr);
$id_us=$id_us['id_admine'];} 


    if($data[2]=="" && $userchb=='writer')
    $search_Query =  "SELECT * FROM request WHERE id_writer= '".$id_us."'";
if($data[2]=="" && $userchb==null)
    $search_Query =  "SELECT * FROM request WHERE id_admine= '".$id_us."'";
else
    $search_Query =  "SELECT * FROM request WHERE id_request= '".$data[2]."'";

    $search_Result = mysqli_query($con, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {

            while($row = mysqli_fetch_array($search_Result))
            {
              
             
                $nickname_admin=mysqli_query($con,"SELECT nickname FROM admin WHERE id_admine= '".$row['id_admine']."'");
                $nickname_ad=mysqli_fetch_assoc($nickname_admin);
$nickname_ad=$nickname_ad['nickname'];

                $nickname_wr=mysqli_query($con,"SELECT nickname FROM writer WHERE id_writer= '".$row['id_writer']."'");
                $nickname_writer=mysqli_fetch_assoc($nickname_wr);
$nickname_writer=$nickname_writer['nickname'];


if($row['request']==='0')
    $status="Not";
else
    $status="Yes";
$name_story=$row['name_story'];

            }
        }else{
            $message= "Now you can choose id";
        }
    }else{
        $message= "Result Error";
    }
}
endif;
    ?>

<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>











<body>
<div class="searchsmth">
<div id="login">
<h1>Request</h1>

<?php if($userchb!=='reader' ):?>


<form action="request.php" id="findform" method="post"name="findform">




<?php if($userchb===null ):?>

<p><label for="name_story">Your nickname<br>
 <input class="input" id="nickname" name="nickname"size="32"  type="text"  value="<?php echo $nickname;?>"></label></p>

 <p><label for="name_story">Nickname of writer<br>
 <input class="input" id="nickname_writer" name="nickname_writer"size="32"  type="text"  value="<?php echo $nickname_writer;?>"></label></p>



<p><label for="status">Status<br>
<input class="input" id="status" name="status"size="32"   type="value" value="<?php echo $status;?>"></label></p>

<p><label for=name_story>Name story<br>
<input class="input" id="name_story" name="name_story"size="32"   type="value" value="<?php echo $name_story;?>"></label></p>

<label for="id_req">ID of your request</label>
 <select name="id_req">
      <option   value="<?php echo $id_req;?>">
</option>

 <?php

$req=mysqli_query($con,"SELECT * FROM request where id_admine='".$id_us."'");
 

  while($row = mysqli_fetch_array($req)):?>

<option  value="<?php echo $row['id_request'];?>"><?php echo $row['id_request'] ; ?>
</option>


<?php endwhile;?></select></p>

<p class="submit"><input class="button" id="edit"  style="margin:5px;" name= "edit" type="submit" value="Edit"></p>    
<p class="submit"><input class="button" id="find"  style="margin:5px;" name= "find" type="submit" value="Find"></p> 
<p class="submit"><input class="button" id="add_to_st"  style="margin:5px;" name= "add_to_st" type="submit" value="Add to story"></p> 
<p><p><p><a href="feedback_for_reader.php">Want</a> find feedback to other story</p>
<?php endif;?>

<?endif;?>


<?php if($userchb==='writer'): ?>

 <p><label for="name_story">Your nickname<br>
 <input class="input" id="nickname" name="nickname"size="32"  type="text"  value="<?php echo $nickname;?>"></label></p>

<label for="admin">Choose admine</label>
 <select name="admin">

</option>
 <?php
$admin=mysqli_query($con,"SELECT * FROM admin ");
  while($row = mysqli_fetch_array($admin)):?>
<option  value="<?php echo $row['nickname'];?>"><?php echo $row['nickname'] ; ?>
</option>
<?php endwhile;?></select></p>




<p><label for="status">Status<br>
<input class="input" id="status" name="status"size="32"   type="value" value="<?php echo $status;?>"></label></p>
<p><label for=name_story>Name story<br>
<input class="input" id="name_story" name="name_story"size="32"   type="value" value="<?php echo $name_story;?>"></label></p>


<label for="id_req">ID of your request</label>
 <select name="id_req">
      <option   value="<?php echo $id_req;?>"><?php echo $id_req ; ?>
</option>

 <?php

$req=mysqli_query($con,"SELECT * FROM request where id_writer='".$id_us."'");
 

  while($row = mysqli_fetch_array($req)):?>

<option  value="<?php echo $row['id_request'];?>"><?php echo $row['id_request'] ; ?>
</option>


<?php endwhile;?></select></p>




<p class="submit"><input class="button" id="add"  style="margin:5px;" name= "add" type="submit" value="Add"></p>    
<p class="submit"><input class="button" id="find"  style="margin:5px;" name= "find" type="submit" value="Find"></p>	 
<p><p><p><a href="feedback_for_reader.php">Want</a> find feedback to other story</p>

<?php endif;?>


<p><a href="logout.php">Exit</a> from system</p></p></p>


<?php endif;?>

 </form>
</div>
</div>

</body>
</html>
