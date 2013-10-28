<?php
include_once 'lib.php';
get_header('U of W Search Results');

// Content
show_message(); // Error handling

echo "<h1>Search Results</h1>";

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
		// TODO:  consolidate DB Credentials
                $db = new mysqli('localhost', 'alas', 'ericalas', 'alas_311');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
		
		//find a way to make isbn and course number an exact search!!!! ******
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
		     echo "<br />Description: ";
		     echo stripslashes($row['desc']);
		     echo "<br />Course Number ";
		     echo stripslashes($row['coursenum']);
		     echo "<br />Major ";
		     echo stripslashes($row['major']);
		     
		     echo "<br />Price: ";
		     echo stripslashes($row['Price']);
		     echo "</p>";
		  }
		
		  $result->free();
		  $db->close();

echo <<<WACKO

	<h1>Purchase a book? </h1>
	<!-- will there be a shopping cart? a wish/watch list?-->
	<form action="purchaseform.php" method="post">
		<br/>
		Enter ISBN of Book:<br/>
		<input name="isbn" type="text" size="40">
		<br/>
		<input type="submit" name="submit" value="Search"/>
	</form>

WACKO;
//*/	

get_footer();
?>