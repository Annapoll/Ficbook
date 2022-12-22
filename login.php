<?php include("includes/header.php");
?>

<?php
	session_start();

	?>

	<?php require_once("includes/connection.php"); ?>
	<?php include("includes/header.php"); ?>	 
	<?php
	
	if(isset($_SESSION["session_nickname"])){
	// вывод "Session is set"; // в целях проверки
	header("Location: intropage.php");

	}
		if(isset($_SESSION["session_user"])){
	// вывод "Session is set"; // в целях проверки
	header("Location: intropage.php");

	}

	if(isset($_POST["login"])){

	if(!empty($_POST['nickname']) && !empty($_POST['password'])) {
		$userchb="";
	$nickname=htmlspecialchars($_POST['nickname']);
$nickname = filter_var($_POST['nickname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
if(filter_has_var(INPUT_POST,'nickname'))
{
	$password=htmlspecialchars($_POST['password']);
	$userchb=$_POST["userchb"];
	
	$_SESSION['session_user']=$userchb;	 
	if($userchb===null){
		$userchb='admin';}
	
	$query =mysqli_query($con, "SELECT * FROM $userchb WHERE nickname='".$nickname."' AND password='".$password."'");
	$numrows=mysqli_num_rows($query);


	if($numrows!=0)
 {
while($row=mysqli_fetch_assoc($query))
 {
	$dbnickname=$row['nickname'];
  $dbpassword=$row['password'];
 }
  if($nickname == $dbnickname && $password == $dbpassword)
 {

	 $_SESSION['session_nickname']=$nickname;	 
   header("Location: intropage.php");
	}
	} else {
 $message = "Invalid nickname or password!";
 }
 		}
		else 
		{
			$message = "No nickname";
		}}
	 else {
    $message = "All fields are required!";
	}

}

	?>

<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>
<body>
<div class="container mlogin">
<div id="login">
<h1>Sign in</h1>
<form action="" id="loginform" method="post"name="loginform">
<p><label for="user_login">User name<br>
<input class="input" id="nickname" name="nickname"size="50"
type="text" value=""></label></p>
<p><label for="user_pass">Password<br>
<input class="input" id="password" name="password"size="20"
type="password" value=""></label></p> 
Reader: <input type="checkbox" name="userchb" value="reader"><br>
Writer: <input type="checkbox" name="userchb" value="writer"><br>

<p class="submit"><input class="button" name="login"type= "submit" value="Sign In"></p>
<p class="regtext">Wanna sign up?<br><a href= "register.php">Sign up</a>!</p>
</form>
</div>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
