<?php
	session_start(); 
	include('header.php');
	?>
<html>
<head>
	<script type="text/javascript">
		function preventBack(){ window.history.forward();}
		setTimeout("preventBack()",0);
		window.onunload = function () {null};
	</script>
	<title>Add Category</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#ADD8E6">
		<?php 
			include('sidebar.php');
		?>
	<div class="floatright">	
			<h2>Welcome <?php echo $_SESSION['ausername'];?></h2><br><br>
				<form action="add_category.php" method='POST'>
					<label>Enter Category</label><br>
					<input type="text" name="category" class="input" size="100" required><br>
					<br>
					<label>Enter Description</label><br>
					<textarea rows="5" cols="50" name="description" class="inputtext" style="margin-left: 20px;" required></textarea><br><br>
					<button type="submit" name="submit" id="submit" class="button1">Add Category</button>
				</form>
		</div>
			
		
	

<?php 
	require_once "database.php";
	if(isset($_POST["submit"])){
		$conn = mysqli_connect($servername,$username,$password,$database);
		if(!$conn){
			die("Couldn't connect to Mysql".mysqli_connect_error());
		}
		$category = $_POST['category'];	
		$description = $_POST['description'];
		$sql = "insert into category (category_name,description) values ('$category','$description')";
		$result = mysqli_query($conn,$sql);
		if($result){
			echo '<script> alert("Category added successfully") </script>';
		}
		else{
			echo '<script> alert("Unsuccessful") </script>';
		}
	}
?>
		
</body>
</html>