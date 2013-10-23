<html>
	<h3>Success. Please Wait to be redirected</h3>
</html>

<?php	
		
	$to = 'alas.eric@gmail.com';
	$email = $_POST['mail'];
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$isbn = $_POST['isbn'];
	
	$subject = "Reply from UWin Book: ".$isbn;
	
	
	$message = "Reply from: ".$name."\n".
				"Email: ".$email."\n".
				"Message: \n".$comment."\n";
				
	$headers =  "From: webmaster@example.com";
	mail($to, $subject, $message, $headers);
	header('Refresh: 5; url=http://alas.myweb.cs.uwindsor.ca/index.html');
?>
	