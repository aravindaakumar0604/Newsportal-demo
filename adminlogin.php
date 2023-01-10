<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
		function preventBack(){ window.history.forward();}
		setTimeout("preventBack()",0);
		window.onunload = function () {null};
	</script>
</head>
<body bgcolor="#ADD8E6">
	<?php
		include('header.php');
	?>
	<div class="main">
		<form action="" method='POST'>
			<label class="side">Admin Username:</label>
			<input type="text" name="ausername" class="input" size="70" required><br>
			<br>
			<label class="side">Admin Password:</label>
			<input type="password" name="apassword" class="input" size="70" required><br>
			<br>
			<button type="submit" name="submit" id="submit" class="button">Login</button>
		</form>
	</div>
<?php
	require_once "database.php";
	session_start();
	if(isset($_POST["submit"])){
		$conn = mysqli_connect($servername,$username,$password,$database);
		if(!$conn){
			die("Couldn't connect to mysql");
		}
		$j = 0;
		$ausername = $_POST['ausername'];
		$apassword = $_POST['apassword'];
		$sql = "select * from admin";
		$result = mysqli_query($conn,$sql);
		$rows = mysqli_num_rows($result);
		while($j < $rows){
			$row = mysqli_fetch_array($result);
			if($ausername == $row['ausername'] && $apassword == $row['apassword']){
				$_SESSION['aid'] = $row['aid'];
				$_SESSION['ausername'] = $row['ausername'];
				$_SESSION['apassword'] = $row['apassword'];
				echo '<script>alert("Successfully login")</script>';
				header("location: adminhome.php");
			}
			$j++;
		}
		echo "<h2 class='danger'>invalid username or password</h2>";
	}
?>
	
</body>
</html>
<?php
		include('footer.php');
	?>