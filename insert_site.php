<!DOCTYPE html>
<html>
<head>
	<title>Search engine in PHP</title>
	</head>
	<body bgcolor="gray">
		<form action="insert_site.php" method="post" enctype="multipart/form-data">
		<table width="500" border="2" cellspacing="2" align="center" bgcolor="orange">
			<tr>
			<td colspan="5" align="center"><h2>Insert new website:</h2></td>
			</tr>

			<tr>
			<td align="right"><b>Site title:</b></td>
			<td><input type="text" name="site_title"></td>
			</tr>

			<tr>
			<td align="right"><b>Site link:</b></td>
			<td><input type="text" name="site_link"></td>
			</tr>

			<tr>
			<td align="right"><b>Site key words:</b></td>
			<td><input type="text" name="site_keywords"></td>
			</tr>

			<tr>
			<td align="right"><b>Site description:</b></td>
			<td><textarea cols="18" rows="8" name="site_desc"></textarea></td>
			</tr>

			<tr>
			<td align="right"><b>Site image:</b></td>
			<td><input type="file" name="site_image"></td>
			</tr>

			<tr>
			
			<td colspan="5" align="center"><input type="submit" name="submit" value="Add site now"></td>
			</tr>
		</table>
			
		</form>


	</body>
	</html>


	<?php 
	
	$user_name = "root";
$password = "";
$database = "search";
$host_name = "localhost";

$con = new mysqli($host_name ,$user_name ,$password,$database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 



	if(isset($_POST['submit']))
	{
			$site_title = $_POST['site_title'];
			$site_link = $_POST['site_link'];
			$site_keywords = $_POST['site_keywords'];
			$site_desc = $_POST['site_desc'];
			$site_image = $_FILES['site_image']['name'];
			$site_image_tmp = $_FILES['site_image']['tmp_name'];


			if($site_title =='' OR $site_link =='' OR $site_keywords=='' OR $site_desc=='' )
			{
				echo "<script>alert('Please fill all the fields')</script>";
				exit();
			}
			else
			{


			$insert_query = "INSERT INTO sites (site_title,site_link,site_keywords,site_desc, site_image) 
			VALUES ('$site_title','$site_link','$site_keywords','$site_desc','$site_image')";

			move_uploaded_file($site_image_tmp, "images/{$site_image}");

			
			if($con->query($insert_query) === TRUE)
			{
				echo "<script>alert('Data inserted into table')</script>";
			}
			else 
			{
				echo "Error: " . $insert_query . "<br>" . mysqli_error($con);
			}

			}
			
	}
	
mysqli_close($con);


	?>