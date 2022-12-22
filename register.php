<?php include("includes/header.php"); ?>

<body>
<div class="container mregister">
<div id="login">
 <h1>Sign up</h1>
<form action="register.php" id="registerform" method="post"name="registerform">
 <p><label for="user_login">Nickname<br>
 <input class="input" id="nickname" name="nickname"size="50"  type="text" value=""></label></p>
<p><label for="user_pass">E-mail<br>
<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>

<p><label for="user_pass">Password<br>
<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
Reader: <input type="checkbox" name="userchb" value="reader"><br>
Writer: <input type="checkbox" name="userchb" value="writer"><br>

<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Sign up"></p>
	  <p class="regtext">Already hav an account?<br> <a href= "login.php">Enter your user name</a>!</p>
 </form>
</div>
</div>

<?php

	
	if(isset($_POST["register"])){

	
	

	if(!empty($_POST['nickname']) && !empty($_POST['email'])  && !empty($_POST['password'])) {

  $nickname= htmlspecialchars($_POST['nickname']);
$nickname = filter_var($_POST['nickname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


 $email=htmlspecialchars($_POST['email']);
$email = filter_var ($_POST ['email'],
FILTER_SANITIZE_EMAIL);
if(filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)){
$userchb=$_POST["userchb"];

 $password=htmlspecialchars($_POST['password']);

 $query=mysqli_query($con, "SELECT * FROM writer WHERE nickname='".$nickname."'");
$query1=mysqli_query($con, "SELECT * FROM reader WHERE nickname='".$nickname."'");
$query2=mysqli_query($con, "SELECT * FROM admin WHERE nickname='".$nickname."'");



 $numrows=mysqli_num_rows($query);
 $numrows1=mysqli_num_rows($query1);
 $numrows2=mysqli_num_rows($query2);

if($numrows==0 && $numrows1==0 && $numrows2==0)
   {
	$sql="INSERT INTO $userchb
  (nickname, email, password)
	VALUES('$nickname','$email', '$password')";
  $result=mysqli_query($con, $sql);
 if($result){
	$message = "Account Successfully Created";
} else {
 $message = "Failed to insert data information!";
  }
	} else {
	$message = "That username already exists! Please try another one!";
   }}else
   {$message = "Email not valid";}
	} else {
	$message = "All fields are required!";
	}
	}
	?>

	<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>
<?php include("includes/footer.php"); ?>
</body>
</html>

