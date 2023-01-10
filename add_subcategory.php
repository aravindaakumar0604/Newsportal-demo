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
	<title>Add Sub-Category</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#ADD8E6">
		<?php 
			include('sidebar.php');
		?>
	<div class="floatright">	
			<h2>Welcome <?php echo $_SESSION['ausername'];?></h2><br><br>
				<form action="" method='POST'>
					<label>Enter Sub-category</label><br>
					<input type="text" name="subcategory_name" class="input" size="100" required><br>
					<br>
					<label>Select Category</label><br>
					<select id="" class="input" size="100" name="category_id" required>
						<?php
						require_once "database.php";
						$conn = mysqli_connect($servername,$username,$password,$database);
						if(!$conn){
							die("Couldn't connect to Mysql".mysqli_connect_error());
						}
						$res = mysqli_query($conn,"select * from category");
						while($row = mysqli_fetch_assoc($res)){
						?>
						<option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>
					<?php 
						}
					?>
					</select><br>
					<br>
					<button type="submit" name="submit" id="submit" class="button1">Add Sub Category</button>
				</form>
		</div>
			
		
	

<?php 
	require_once "database.php";
	if(isset($_POST["submit"])){
		$conn = mysqli_connect($servername,$username,$password,$database);
		if(!$conn){
			die("Couldn't connect to Mysql".mysqli_connect_error());
		}
		$subcategory_name = $_POST['subcategory_name'];	
		$category_id = $_POST['category_id'];
		$sql = "insert into subcategory (subcategory_name,category_id) values ('$subcategory_name','$category_id')";
		$result = mysqli_query($conn,$sql);
		if($result){
			echo '<script> alert("Sub Category added successfully") </script>';
		}
		else{
			echo '<script> alert("Unsuccessful attempt") </script>';
		}
	}
?>
		
</body>
</html>