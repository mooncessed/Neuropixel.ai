<?php 

// database Connection
$conn = mysqli_connect('localhost', 'root', '', 'dataset');
// check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}

if(isset($_POST['submit'])){

	$filename = $_FILES['image']['name'];
	
	// Select file type
	$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	// valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");
 
 
    $size = $_REQUEST['size'];
		$fit = $_REQUEST['fit'];
		$gender = $_REQUEST['gender'];
		$pose = $_REQUEST['pose'];

		
	
 
	// Check extension
	if( in_array($imageFileType,$extensions_arr) ){
 
	// Upload files and store in database
	
	
	if(move_uploaded_file($_FILES["image"]["tmp_name"],'image/'.$filename)){
		// Image db insert sql
		$insert = "INSERT into images(filename, size, fit, gender, pose) values('$filename', '$size', '$fit','$gender','$pose')";
		if(mysqli_query($conn, $insert)){
			echo '<script language="javascript">';
            echo 'alert("Data inserted successfully")';
			echo '</script>';
		}
		else{
		  echo 'Error: '.mysqli_error($conn);
		}
	}else{
		echo 'Error in uploading file - '.$_FILES['image']['name'].'<br/>';
	}
	}
} 
?>


<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<style>
	

	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap');

input {
  caret-color: red;
}

body {
  margin: 0;
  width: 100vw;
  height: 100vh;
  background: #ecf0f3;
  display: flex;
  align-items: center;
  text-align: center;
  justify-content: center;
  place-items: center;
  overflow: auto;
  font-family: poppins;
}

.container {
 
  display: none;
  position: relative;
  width: 350px;
  height: 650px;
  border-radius: 20px;
  padding: 40px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}


.container1{
  position: relative;
  width: 350px;
  height: 300px;
  border-radius: 20px;
  padding: 40px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}



.brand-title {
  margin-top: 10px;
  font-weight: 900;
  font-size: 1.8rem;
  color: #1DA1F2;
  letter-spacing: 1px;
}

.inputs {
  text-align: left;
  margin-top: 30px;
}

label, input, button {
  display: block;
  width: 100%;
  padding: 0;
  border: none;
  outline: none;
  box-sizing: border-box;
}

label {
  margin-bottom: 4px;
}

label:nth-of-type(2) {
  margin-top: 12px;
}

input::placeholder {
  color: gray;
}

input {
  background: #ecf0f3;
  padding: 10px;
  padding-left: 20px;
  height: 50px;
  font-size: 14px;
  border-radius: 50px;
  box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
}

button {
  color: white;
  margin-top: 20px;
  background: #1DA1F2;
  height: 40px;
  border-radius: 20px;
  cursor: pointer;
  font-weight: 900;
  box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
  transition: 0.5s;
}

button:hover {
  box-shadow: none;
}

a {
  position: absolute;
  font-size: 8px;
  bottom: 4px;
  right: 4px;
  text-decoration: none;
  color: black;
  background: yellow;
  border-radius: 10px;
  padding: 2px;
}

h1 {
  position: absolute;
  top: 0;
  left: 0;
}
	</style>
</head>
<body>



<div class="container" id="container">
 
  <div class="brand-title">Neuropixel.ai</div>
	
	<div class="inputs">
	<form method='post' action='#' enctype='multipart/form-data'>
	<div class="form-group">
	 <input type="file" name="image" id="file" multiple>
	 <center>
	
		
			
<p>
			<label for="firstName">Size:</label>
			<input type="text" name="size" id="size">
			</p>

			
<p>
			<label for="lastName">Fit:</label>
			<input type="text" name="fit" id="fit">
			</p>

			
<p>
			<label for="Gender">Gender:</label>
			<input type="text" name="gender" id="gender">
			</p>

			
<p>
			<label for="Address">Pose in degrees:</label>
			<input type="text" name="pose" id="pose">
			</p>

			
<p>	
		
	</center>
	</div> 
	<div class="form-group"> 
	 <input type='submit' name='submit' value='Upload' class="btn btn-primary">
	</div> 
	</form>
</div>	


</div>







<div class="container1">
<button onclick="myFunction()">Upload Data</button>
<form method='post' action='data.php' enctype='multipart/form-data'>
<button >Display Data</button>
</form>
<form method='post' action='data.php' enctype='multipart/form-data'>
<button >Verify Images</button>
</form>
</div>

<script>
function myFunction() {
  var x = document.getElementById("container");
    
	
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>

</body>
</html>