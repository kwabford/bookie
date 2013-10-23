<html>
<head> 
	<title> U of W Book Purchase</title>
</head>

<body>
	<h3>Purchasing:</h3>
	<?php	
		$isbn = $_POST['isbn'];
		
		if(!$isbn){
				echo "You have not entered book's ISBN.";
				exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$isbn = addslashes($isbn);
		}
		echo "you are looking for $isbn";
		
                $db = new mysqli('localhost', 'alas', 'ericalas', 'alas_311');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
		
		//find a way to make isbn and course number an exact search!!!! ******
			$query = "SELECT * from Books_311 where ISBN = '{$isbn}'";
		
		


if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
}
			$row = $result->fetch_assoc();
		     echo "<p><strong>Title: ";
		     echo htmlspecialchars(stripslashes($row['Title']));
		     echo "</strong><br />Author: ";
		     echo stripslashes($row['Author']);
		     echo "<br />ISBN: ";
		     echo stripslashes($row['ISBN']);
		     $temp_isbn = $row['ISBN'];
		     echo "<br />Description: ";
		     echo stripslashes($row['desc']);
		     echo "<br />Course Number ";
		     echo stripslashes($row['coursenum']);
		     echo "<br />Major ";
		     echo stripslashes($row['major']);     
		     echo "<br />Price: ";
		     echo stripslashes($row['Price']);
		     echo "</p>";
		  
		  $result->free();
		  $db->close();


?>
		<form action="successpurchase.php" method="post">
		Name:<br>
		<input type="text" name="name" value=""><br>
		E-mail:<br>
		<input type="text" name="mail" value=""><br>
		<?php
		echo "ISBN:<br>";
		echo '<input type="text" name="isbn" value='.$isbn.'><br>';
		?>
		Comment:<br>
		<input type="text" name="comment" value="" size="50"><br><br>
		<input type="submit" value="Send">
		</form>


	
</body>
</html>