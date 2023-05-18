<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "image_upload");
  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
	$location = mysqli_real_escape_string($db, $_POST['location']);
	
	
  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (image, image_text, location) VALUES ('$image', '$image_text', '$location')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
   $result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Objave</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel="stylesheet" type="text/css" href="css/dropdown.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/objavestyle.css'>
    <script src='upvote.js'></script>
</head>
<body>
    
    <nav>

        <ul>
            <li><a href="index.html">Početna</a></li>
			<li><a href="index.html#about"> O nama</a></li>
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Objave</a>
				<div class="dropdown-content">
				<a href="objave.php">Sve objave</a>
				<a href="prijave_obj.php">Prijave</a>
				<a href="pohvale_obj.php">Pohvale</a>
				</div>
				</li>
        </ul>
    </nav>
    <div id="blok1">
        <div id="main"><h1>Objave</h1>
 
            
			<?php 
			
			  while ($row = mysqli_fetch_array($result)) {
			?><div class="post"><div class="slika"><?php
      echo "<div id='img_div'>";
      	echo "<img width='115px' height='115px'  src='images/".$row['image']."'>";
		echo "</div>";
		?></div><div class="comment"><?php
		echo "<div>";
      	echo "<p id='txt'>".$row['image_text']."</p>";
		echo "<br>"; echo "<p id='loc'>".$row['location']."</p>";
		echo "</div>";
		?>
	  </div></div><?php
	 
    }
			?>
			
            
        
       
        </div>
</div>
</body>
</html>