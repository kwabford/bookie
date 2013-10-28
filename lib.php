<?php
session_start();
require_once('dblibs.php');
//$DEBUG = 1;

if(!isset( $_SESSION['uname']) )
{
  $_SESSION['uname'] = "Guest";
}

// Adjust svg background dynamically
$accent_color = (isset($_SESSION['accent_color'])) ? $_SESSION['accent_color'] : '777777';
/* holds all the utility functions */

// place holder database code
$userType = '';

if(isset($_GET['u']))
  $userType = $_GET['u'];

// Html output
function print_prologue($title = "Bookie") {
global $accent_color;

echo <<<MADNESS
  <html>
  <head>
    <title>$title</title>
    <link href="style-debug.css" type="text/css"  rel="stylesheet"/>
  </head>
  <body>
<!--  <object id="bg_overlay" type="image/svg+xml"
MADNESS;

echo "data='pixie_bg.php?col=$accent_color'>";

echo <<<MADNESS
  </object>--!>
  <div id="pagewrapper">
MADNESS;

}

function print_epilogue() {
echo <<<BOBR
</body></html>
BOBR;
}

function get_header($title = "Bookie", $user_type = 1) {
  print_prologue($title);
  //echo "<div id='header'>HEADER</div>";
  $loggedIn = isset($_SESSION['loggedIn']);
  $isAdmin = isset($_SESSION['admin_time']);
  global $userType, $DEBUG;

// ********* DEBUG *********** //
if ($DEBUG)
{
echo '<pre>';
print_r($_SESSION);
echo htmlspecialchars(SID);
echo session_id() ."\n";
echo session_save_path();
echo '</pre>';
}
// ********* DEBUG *********** //

echo <<<ZORM
  <div id='header'>
    <a href='index.php'>Logo</a>
    <div id='menu'>
      <a href='index.php'>Home</a> |  
ZORM;
//<a href='contact.php'>Contact</a> |
if($isAdmin){
  echo "<a href='admin.php'>Admin</a> | ";
  echo "<a href='logout.php'>Logout Admin</a>";
} else if($loggedIn){
   echo "<a href='myAds.php'>My Book Ads</a> | ";
   echo "<a href='logout.php'>Logout ". $_SESSION['uname'] ."</a>";
} else {
	echo "<a href='signupform.php'>Sign Up</a>";
   //echo "<a href='login.php'>Login</a>";
}

echo <<<ZORM
    </div>
  </div>

  <div id="contentwrapper">
  <div id="content">
ZORM;
}

function get_footer($user_type = 1) {
  echo '</div> <!-- content -->';
  echo '</div> <!-- contentwrapper -->';
  echo "<div id='footer'>Copyright Team 5 2013</div>";
  print_epilogue();
}

//* Asserts that a user is logged in.
//* If not, then redirects to Login page with a message
function assert_logged_in(){
  if ( !isset($_SESSION["loggedIn"]) && !isset($_SESSION["admin_time"]) ) {
    $_SESSION["error"] = "Must be logged in to do that.";
    header('location: login.php');
    die();
  }

}

// outputs an error, and resets the $_SESSION['error'] value
function show_and_reset_error()
{
	echo "<div class='error'>";
	echo $_SESSION['error'];
	echo "</div>";
	
	unset($_SESSION['error']);
}

// outputs an success message, and resets the $_SESSION['success'] value
function show_and_reset_success()
{
	echo "<div class='success'>";
	echo $_SESSION['success'];
	echo "</div>";
	
	unset($_SESSION['success']);
}

// Assumes $_SESSION['error'] or $_SESSION['success'] were set in a process file
function show_message()
{
	if( isset($_SESSION['error']) ){
	  show_and_reset_error();
	}
	
	if( isset($_SESSION['success']) ){
	  show_and_reset_success();
	}
}

function get_gallery_form() {
	
  echo "<h3>Display current user's pictures and comments (thread forum).</h3>";

show_message();

  echo '<form action="processPicsEdits.php" method="post">';
  print_form_buttons();
  // Set up array for picture filepaths
  $pic_locs = array();
  
  if ( isset($_SESSION['uid']) ) {
     $db = new DB();
     $pic_locs = $db->get_image_locations($_SESSION['uid']);
  } else if( isset($_SESSION['admin_time']) ) {
	 $db = new DB();
     $pic_locs = $db->pic_info_all_pics();
  }
  
  if (0 && $pic_locs){
    echo "<pre>";
    print_r($pic_locs);
    echo "</pre>";
  }
  

  foreach ($pic_locs as $row){
    $i = $row['pid'];
    echo "<a href='viewpic.php?imgid=$i'><div class ='thumb' style='background-image:url(\"".$row['filepath']."\");'>";
    if($row['private'])
      echo '<div class="private">Private</div>';
    echo "</div></a>\n";
    echo '<input type="checkbox" style="float:left;" name="picsToProcess[]" value="'.$i.'" style="z-index=10;" />';
  }
    print_form_buttons();
  echo '</form>';

}

function print_form_buttons(){
  echo '<div class="form_buttons"><input type="submit" name="delete" value="Delete" />';
  echo '<input type="submit" name="private" value="Make Private" />';
  echo '<input type="submit" name="public" value="Make Public" />';
  echo '<input type="reset" value="Reset" /></div>';
}
?>
