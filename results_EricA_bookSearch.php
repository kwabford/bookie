<html>
<head> 
	<title> U of W Search Results</title>
</head>

<body>
	<h1>Search Results</h1>
	<?php	
		$searchtype = $_POST['searchtype'];
		$searchterm = trim($_POST['searchterm']);
		
		if(!$searchtype || !$searchterm){
				echo "You have not entered Search details. Please go back and try again";
				exit;
		}
		
		if(!get_magic_quotes_gpc()){
			$searchterm = addslashes($searchterm);
			$searchtype =addslashes($searchtype);
		}
		echo "you are looking for $searchterm";
		
                $db = new mysqli('localhost', 'alas', 'ericalas', 'alas_311');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
		
		
		
		$query = "SELECT * from Books_311 where ".$searchtype." like '%".$searchterm."%'";
		  


if(!$result = $db->query($query)){
    die('There was an error running the query [' . $db->error . ']');
}
		
		  $num_results = $result->num_rows;
		
		  echo "<p>Number of books found: ".$num_results."</p>";
		
		  for ($i=0; $i <$num_results; $i++) {
		     $row = $result->fetch_assoc();
		     echo "<p><strong>".($i+1).". Title: ";
		     echo htmlspecialchars(stripslashes($row['Title']));
		     echo "</strong><br />Author: ";
		     echo stripslashes($row['Author']);
		     echo "<br />ISBN: ";
		     echo stripslashes($row['ISBN']);
		     echo "<br />Price: ";
		     echo stripslashes($row['Price']);
		     echo "</p>";
		  }
		
		  $result->free();
		  $db->close();
	
	?>
</body>
</html>