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
	<title>Add News</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#ADD8E6">
		<?php 
			include('sidebar.php');
		?>
	<div class="floatright">	
			<h2>Welcome <?php echo $_SESSION['ausername'];?></h2><br><br>
				<form action="" method='POST' enctype="multipart/form-data">
					<h2>Add news</h2>
					<label>Enter Title</label><br>
					<input type="text" name="title" class="input" size="100" required><br>
					<br>
					<label>Enter Description</label><br>
					<textarea rows="5" cols="50" name="description" class="inputtext" style="margin-left: 20px;" required></textarea><br><br>
					<label>Enter Date</label><br>
					<input type="date" name="date" class="input" size="100" required><br>
					<br>
					<label>Enter Thumbnails</label><br>
					<input type="file" name="thumbnails" class="inputimage" size="75" required><br>
					<br>
					<label>Enter Category</label><br>
					
					<select id="" class="input" size="100" name="category" required>
					<?php
						require_once "database.php";
						$conn = mysqli_connect($servername,$username,$password,$database);
						if(!$conn){
							die("Couldn't connect to Mysql".mysqli_connect_error());
						}
						$res = mysqli_query($conn,"select * from category");
						while($row = mysqli_fetch_assoc($res)){
						?>
						<option value="<?php echo $row['category_name'];?>"><?php echo $row['category_name'];?></option>
					<?php 
						}
					?>
					</select><br>
					<br>
					<label>Enter Sub category</label><br>
					
					<select id="" class="input" size="100" name="subcategory">
					<?php
						require_once "database.php";
						$conn = mysqli_connect($servername,$username,$password,$database);
						if(!$conn){
							die("Couldn't connect to Mysql".mysqli_connect_error());
						}
						$res = mysqli_query($conn,"select * from subcategory");
						while($row = mysqli_fetch_assoc($res)){
						?>
						<option value="<?php echo $row['subcategory_name'];?>"><?php echo $row['subcategory_name'];?></option>
					<?php 
						}
					?>
					<option value="--">---</option>
					</select>
						<br>
						<br>
					<button type="submit" name="submit" id="submit" class="button1">Add News</button>
				</form>
		</div>
<?php 
	require_once "database.php";
	if(isset($_POST["submit"])){
		$conn = mysqli_connect($servername,$username,$password,$database);
		if(!$conn){
			die("Couldn't connect to Mysql".mysqli_connect_error());
		}
		$title = $_POST['title'];
		$title = htmlspecialchars($title);
		$title = strip_tags($title);	
		$description = $_POST['description'];
		$description = htmlspecialchars($description);
		$description = strip_tags($description);
		$date = $_POST['date'];
		$category = $_POST['category'];
		$subcategory = $_POST['subcategory'];
		$thumbnails = $_FILES['thumbnails']['name'];
		$tmp_thumbnails = $_FILES['thumbnails']['tmp_name'];
		move_uploaded_file($tmp_thumbnails,"images/$thumbnails");
		$result = mysqli_query($conn,"insert into news (title,description,day,category,subcategory,thumbnails) values('$title','$description','$date','$category','$subcategory','$thumbnails')");
		if($result){
			echo '<script> alert("Successfully added News") </script>';
			header("Location: add_news.php");
		}
		else{
			echo '<script> alert("Unsuccessful attempt!!") </script>';
		}
	}
?>
</body>
</html>
