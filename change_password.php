<?php
session_start(); 
require_once "database.php";
?>
<html>
<head>
	<?php
		include('userheader.php');
	?>
	<script type="text/javascript">
		function preventBack(){ window.history.forward();}
		setTimeout("preventBack()",0);
		window.onunload = function () {null};
	</script>
	<title>Update Sub category</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#ADD8E6">
	
		<div class="floatright">	
			<h2>Welcome <?php echo $_SESSION['username'];?></h2><br><br>
			
				<form method='POST'>
					<label class="labelcontrol">Enter Old Password</label><br>
					<input type="text" class="input" name="old_password" size="70" required><br>
					<br>
					<label class="labelcontrol">Enter New Password</label><br>
					<input type="text" class="input" name="new_password"  size="70" required><br>
					<br>
					<button type="submit" name="change_password" class="button1">Change Password</button>
				</form>
		</div>
		
</body>
</html>

<?php
require_once "database.php";
	if(isset($_POST["change_password"])){
		$conn = mysqli_connect($servername,$username,$password,$database);
		if(!$conn){
			die("Couldn't connect to Mysql".mysqli_connect_error());
		}
		$sql = mysqli_query($conn,"select * from user where username = '$_SESSION[username]'");
		$row = mysqli_fetch_assoc($sql);
		$username = $row['username'];
		$password = $row['password'];
		if($password == $_POST["old_password"]){
			$new_password = $_POST["new_password"];
			$query = "update user set password ='$new_password' where username = '$_SESSION[username]'";
			$run_query = mysqli_query($conn,$query);
			echo '<script> alert("Password Changed Successfully")</script>';
		}
		else{
			echo '<script>alert("Updation failed")</script>';
		}	
	}
?>