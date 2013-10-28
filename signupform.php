<?php
session_start();
header('Content-Type: text/html');

require_once('libs.php');
require_once('lib.php');
session_destroy();

get_header('Bookie - Sign Up!');

?>
	
<div id="big_wrapper"> 
	<header id="top_header">
		<header>
		</header>
				<hgroup id="hgroup">
					<h1> The Number One Book dispensary in Town!</h1>
				</hgroup>
				</header>
		
		<link rel="stylesheet" href="main2.css" />
	<div id="new_div">
	<section id="main_section">
		<div id = "article1">
		<article>
			<header>
				<h1>Sign Up</h1>
<h3>Creating your Team Delta Book store account</h3>

<?php	
            if(array_key_exists('error.msg', $_SESSION)){
                echo "<p class='errormsg'>Sorry, please fix the error and try again.</p>";
            }
?>
    <form action="signupprocess.php" method="POST">
                <table>
                <tr>
                	<?php echo form_text_field('First Name: ','fname','text');?>
                 </tr>
                 <tr>
                	<?php echo form_text_field('Last Name: ','lname','text');?>
                </tr>
                <tr>
                	<?php echo form_text_field('Password: ','password','password');?>
                </tr>
                <tr>
                	<?php echo form_text_field('Confirm Password: ','conpass','password');?>
                </tr>
                <tr>
                    <?php echo form_text_field('Email: ','email','text');?>
                </tr>
                <tr>
                    <?php echo form_text_field('Phone Number: ','pnumber','text');?>
                </tr>
                <tr>
                    <?php echo form_text_field('Street Address: ','saddress','text');?>
                </tr>
                <tr>
                	<?php echo form_text_field('City: ','city','text');?>
                </tr>
                </table>
                <p>
                <input type="submit" name="sbutton" value="Sign Up"/>
                <input type="reset" name="rbutton" value="Clear"/>
                </p>
    </form>		
		</article>
		</div>		
	</section>
	</div>
</div> 

<?php get_footer(); ?>