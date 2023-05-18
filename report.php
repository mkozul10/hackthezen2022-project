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
	$category = mysqli_real_escape_string($db, $_POST['category']);
	$review = "prijava";
  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (image, image_text, location, category, review) VALUES ('$image', '$image_text', '$location', '$category','$review')";
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<script>
function drop(){
	document.getElementById("drop").style.display="none";
}
	
</script>
<style>
	
</style>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Prijave</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
	
	 <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='css/reportstyle.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/dropdown.css'>

    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <div id="main">
        <h1>Prijavi problem</h1>

			  <?php
	while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      echo "</div>";
   }  
  ?>
  <div id="unos">
              <form method="POST" action="report.php" enctype="multipart/form-data">
          
                <select id="drp" name="category" class="form-select" aria-label="Default select example">
          <option selected>Odaberi</option>
          <option value="ekologija">Ekologija</option>
          <option value="promet">Promet</option>
          <option value="kriminal">Kriminal</option>
		  <option value="ostalo">Ostalo</option>
        </select>
	
          
  	<input type="hidden" name="size" value="1000000" >
  	
  	  <input type="file" name="image" class="step" id="step2">
  	
	<p id="kom">Ostavite komentar</p>
      <textarea 
      	id="text" 
      	cols="50" 
      	rows="4" 
      	name="image_text" 
      	placeholder="Say something about this image..." id="step4"></textarea>
  	
	
        
        <input type="text" id="address" style="width: 500px;" name="location" id="step5"></input>
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtCgUlZE5goah4Vf-hz-FifJQQw2wJrLY&libraries=places&callback=initMap"></script>
        <script type="text/javascript" src="javas/js.js"></script>
  		<button type="submit" name="upload" id="step5"> POST</button>
 
  </form>
        </div> 
   
</body>
</html>