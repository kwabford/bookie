<html>
<head>
	<title> Posting Result</title>
</head>

<body>
	

<?php
	//create var names
	$isbn = $_POST['isbn'];
	$author = $_POST['author'];
	$title = $_POST['title'];
	$desc = $_POST['description'];
	$price = $_POST['price'];
	
	if(!$isbn || !$author || !$title || !$desc || !$price){
		echo "<h1>Ad not successfully posted</h1>";
		echo "You did not submit all the required info. Please wait to be redirected.</br>";
			header('Refresh: 5; url=http://alas.myweb.cs.uwindsor.ca/placeAd.html');
			exit;
	}
	else{
		echo "<h1> Ad successfully placed!</h1>";
	}
	
	
		if(!get_magic_quotes_gpc()){
			$isbn = addslashes($isbn);
			$author =addslashes($author);
			$title = addslashes($title);
			$desc =addslashes($desc);
			$price = addslashes($price);
			
		}
		
		$db = new mysqli('localhost', 'alas', 'ericalas', 'alas_311');

		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$query = "insert into Books_311 values ('".$isbn."', '".$author."', '".$title."', '".$desc."', '".$price."')";
		$result = $db->query($query);
		
		if($result){
				echo $db->affected_rows." books inserted.";
		}else{
			echo "An error occurred. Try again later.";
		}
		
		$db->close();
?>

</body>
</html>

		
		