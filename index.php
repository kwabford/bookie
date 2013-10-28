<?php
include_once 'lib.php';
/*
function get_gallery() {
  $db = new DB();
  $pics_info = $db->get_image_locations();
  
  if ($pics_info){
    foreach ($pics_info as $row){
      $i = $row['pid'];
      echo "<a href='viewpic.php?imgid=$i'><div class ='thumb' style='background-image:url(\"".$row['filepath']."\");'>";
    //echo "<img src='".$row['filepath']."' />"; 
      echo "</div></a>\n";
    }
  } else {
    echo "<p> No Public Pics :(</p>";
  }
}
*/
get_header('Bookie - Easy book exchange.');

// Content
show_message(); // Error handling

echo <<<WACKO
	<h1> Search Catalog </br> U of W</h1>
	
	<form action="purchase_book.php" method="post">
		Choose Search Type:<br/>
		<select name="searchtype">
			<option value ="author">Author</option>
			<option value="title">Title</option>	
			<option value="isbn">ISBN</option>
			<option value="coursenum">Course#</option>
			<option value="major">Major</option>
			
		</select>
		<br/>
		Enter Search Query:<br/>
		<input name="searchterm" type="text" size="40">
		<br/>
		<input type="submit" name="submit" value="Search"/>
	</form>
WACKO;

get_footer();
 ?>
