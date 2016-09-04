<!DOCTYPE html>
<html>
<head>
<title>Result page</title>

<style type="text/css">
	.results 
	{
		margin-left:5%;
		margin-right: 12%;
		margin-top: 10px;
	}


</style>
</head>
<body bgcolor="#F5DEB3">

<form action="results.php" method="post">

	<img src="logo.png" alt="logo" width="500px" height="200px">
	<span><b>Write your key word</b></span>
		<input type="text" name="user_query" size="80"> 

		<input type="submit" name="result" value="Search now">


	</form>

	<a href="search.html"><button>Go back</button></a>
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


if(isset($_POST['search']))
	{
		$post_value = $_POST['user_query'];
		if($post_value=='')
		{
			echo "<script>alert('Please go back and write something in the search box')</script>";
			exit();
		}

		$result_query = "SELECT * FROM sites WHERE site_keywords LIKE '%$post_value%'";


	$run_result = 	$con->query($result_query);

	

if ($run_result->num_rows > 0) {


    // output data of each row
    while($row = $run_result->fetch_assoc()) {
    	$site_title = $row['site_title'];
		$site_link=$row['site_link'];
		$site_desc=$row['site_desc'];
		$site_image=$row['site_image'];



        echo "<div>

		<h2>$site_title</h2>
		<a href='$site_link' target='_blank'>$site_link</a>
		<p align='justify'>$site_desc</p> 
		<img src='images/$site_image' width='100' height='100' />
</div>";
    }
}
   
 else 
{
   echo "<p><b>Nothing was found in the database</b></p>";
		exit();
}
}
$con->close();
?>