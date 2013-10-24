<!-- Group 8 
August 15 2013 
Project 60-334 -->
<?php
function form_text_field($label, $htmlname, $type)
{
	echo '<td><label for="'.htmlspecialchars($htmlname).'">'.htmlspecialchars($label).'</label></td>';
	  
	echo"<td>";
	echo '<input type="'.htmlspecialchars($type).'" name="'.htmlspecialchars($htmlname).'"';
		if (isset($_SESSION[$htmlname]) === true){
		  echo ' value="'.htmlspecialchars($_SESSION[$htmlname]).'" ';
		}
	echo '/></td><td>';
		 if (array_key_exists($htmlname.'.msg', $_SESSION)){
			  echo "<p class='errormsg'>".htmlspecialchars($_SESSION[$htmlname.'.msg'])."</p>";
		 }
		 else echo "&nbsp;";
	echo"</td>";
}

function form_textarea_field($label, $htmlname){
	echo '<td><label for="'.htmlspecialchars($htmlname).'">'.htmlspecialchars($label).'</label></td>';
	
	echo"<td>";
	echo '<textarea name="'.htmlspecialchars($htmlname).'"';
		if (isset($_SESSION[$htmlname]) === true){
		  echo ' value="'.htmlspecialchars($_SESSION[$htmlname]).'" ';
		}
	echo '></textarea></td><td>';
	 	if (array_key_exists($htmlname.'.msg', $_SESSION)){
			  echo "<p class='errormsg'>".htmlspecialchars($_SESSION[$htmlname.'.msg'])."</p>";
		 }
		 else echo "&nbsp;";
	echo"</td>";
}

function form_text_field_with_array($label, $htmlname, $type, $array)
{
	echo '<td><label for="'.htmlspecialchars($htmlname).'">'.htmlspecialchars($label).'</label></td>';
	  
	echo"<td>";
	echo '<select name="'.htmlspecialchars($htmlname).'"';
		foreach ($array as $choice){
			if (isset($_SESSION[$htmlname]) && $_SESSION[$htmlname] == $choice){
				$sel = ' selected="selected"';
			}else{
				  $sel = '';
			}
		echo "><option value=\"$choice\"$sel>$choice</option>\n";
		}
		echo "</select></td><td>\n";
		 if (array_key_exists($htmlname.'.msg', $_SESSION)){
			  echo "<p class='errormsg'>".htmlspecialchars($_SESSION[$htmlname.'.msg'])."</p>";
		 }
	echo"</td>";
}



?>