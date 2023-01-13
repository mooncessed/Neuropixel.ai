<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<style>
body{
	background: rgb(137,123,202);
	background: #ecf0f3;
	 border-radius: 20px;
  padding: 40px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
      
}
.dataTables_wrapper{
  border-radius: 20px;
  padding: 40px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    padding: 4px;
	margin: 5px;
}
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
	margin: 5px;
    background-color: white;
    margin-left: 3px;
}
.box {
        width: 120px;
        height: 30px;
        border: 1px solid #999;
        font-size: 18px;
        color: #1c87c9;
         border-radius: 5px;
        box-shadow: 4px 4px #ccc;
      }


	</style>
</head>	
<body>
<script>
$(document).ready(function () {
    $('#example').DataTable();
});


</script>

<?php
			error_reporting(E_ERROR | E_PARSE);
			$conn = mysqli_connect('localhost', 'root', '', 'dataset');
            // check for connection error
			if($conn->connect_error){
			die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);   } 			
			$sql = "SELECT * FROM images";
            $row = mysqli_query($conn,$sql);
                
?>

<div class="container" style="margin-top: 20px; " >

    <?php echo $deleteMsg??''; ?>
    <div>
	<form action= '' method="POST">
	<table 
	    id="example" style="width:100%"
		data-search="true"
		align="center"
		class="table table-striped table-bordered display table-success"
		cellspacing="0"
        width="100%"
		data-toggle="table"			
		data-filter-control="true" 
		data-show-export="true"
		data-click-to-select="true"
		data-toolbar="#toolbar"
		style="border-radius: 20px;
         padding: 40px;
		 box-sizing: border-box;
		 background: #ecf0f3;
         box-shadow: 14px 14px 20px #cbced1, -14px -14px 20px white;"
		>
       <thead><tr>
	   
         <th class="th-sm" >ID</th>
         <th class="th-sm">Filename</th>
         <th class="th-sm">Size
		 <select class="box" name='size'>
		<?php
		$sql = "SELECT DISTINCT(size) FROM images";
        $row = mysqli_query($conn,$sql);
		while ($size = mysqli_fetch_array(
                        $row,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $size['size'];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $size['size'];
                        // To show the category name to the user
                    ?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
          ?>  
        </select>
		</th class="th-sm">
		 <th>Fit
		 <select class="box" name="fit">
		<?php
		$sql = "SELECT DISTINCT(fit) FROM images";
        $row = mysqli_query($conn,$sql);
		while ($size = mysqli_fetch_array(
                        $row,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $size["fit"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $size["fit"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
          ?>  
        </select>
		 </th>
         <th class="th-sm">Gender
		 <select class="box" name="gender">
		<?php
		$sql = "SELECT DISTINCT(gender) FROM images";
        $row = mysqli_query($conn,$sql);
		while ($size = mysqli_fetch_array(
                        $row,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $size["gender"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $size["gender"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
          ?>  
        </select>
		</th>
         <th class="th-sm">Pose
		 <select class="box" name="pose">
		<?php
		$sql = "SELECT DISTINCT(pose) FROM images";
        $row = mysqli_query($conn,$sql);
		while ($size = mysqli_fetch_array(
                        $row,MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $size["pose"];
                    // The value we usually set is the primary key
                ?>">
                    <?php echo $size["pose"];
                        // To show the category name to the user
                    ?>
                </option>
            <?php
                endwhile;
                // While loop must be terminated
          ?>  
        </select>
		</th>
		
		  </thead>
  
   </form>
   <input type='submit' name='data' value='Display data' class="btn btn-primary" onclick="myFunction()" style="float: right;"> 
 <br>
 <br>
 <br>
 
  <tbody> 
 <div class = "container" id="display-data">
 <?php
		
		
	// database Connection
		$size = $_POST['size'];
        $fit = $_POST["fit"];
		$gender =$_POST["gender"];
        $pose = $_POST["pose"];
	    if(isset($_POST['data'])){
        $query = " select * from images where size='$size' and fit='$fit' and pose='$pose' and gender='$gender'";
        $result = mysqli_query($conn, $query);
		
		if ($result->num_rows > 0) {
  
		while($row = $result->fetch_assoc()) {?>
		<tr class="table-info table-success">       
        <td><?php echo $row['id']; ?></td>
		<td><img src="./image/<?php echo $row['filename']; ?>" width="200" height="200"></td>
		<td><?php echo $row['size']; ?></td>
        <td><?php echo $row['fit']; ?></td> 
		<td><?php echo $row['gender']; ?></td>
		<td><?php echo $row['pose']; ?></td>
        </tr>
		<?php
        }
		}
else {
		echo '<script>alert("No Results found :(")</script>';
		}		
		}
		
    ?>

    </tbody>
	 
     </table>
</div>
   
</div>

</div>
</body>
</html>




								








