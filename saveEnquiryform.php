<?php 

require("mail/class.phpmailer.php");

$name = $_POST['your-name'];
$email = $_POST['your-email'];
$subject = $_POST['your-subject'];
$message = $_POST['your-message'];

$captcha = $_POST['g-recaptcha-response'];

// if(!$captcha)
// {
// 	//echo '<h2>Please check the the captcha form.</h2>';
//   	?>
// 		<script>
// 			alert("Please check the the captcha form.");
// 			window.location = 'contact.php';
// 		</script>
// 	<?php
		 
//     exit;
// }

$secretKey = "6Lcu1SglAAAAAGg4lnU5UoH8Esqwp6u1RCTbI0kh";
$ip = $_SERVER['REMOTE_ADDR'];
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&remoteip=".$ip);
$responseKeys = json_decode($response,true);
		
if(intval($responseKeys["success"]) !== 1) 
{

	$body = " 
				<h3>Enquiry Form</h3><br>

				Name : $name <br>
				Email : $email <br>
				Subject: $subject <br>
				Message: $message <br>
				";

	$mail = new PHPMailer();
	$mail->SetLanguage('en','phpmailer/language/');
	/* $mail->IsSMTP(); // set mailer to use SMTP */
	$mail->SMTPDebug  = 1;    
	$mail->Host = "mail.arinex.com"; // specify main and backup server
	//$mail->Port = 465 ; // set the port to use
	$mail->SMTPAuth = false; // turn on SMTP authentication
	$mail->Username = ""; // your SMTP username or your gmail username
	$mail->Password = ""; // your SMTP password or your gmail password
	$from = $email; // Reply to this email

	//$to="";
	$to="orchidmas.dubai@gmail.com"; 

	//$name="Jersey Name"; // Recipient's name
	$mail->From = $from;
	$mail->FromName = $name; // Name to indicate where the email came from when the recepient received
	
	$mail->AddAddress($to);
	//$mail->AddAddress($to1,$name);
	$mail->AddReplyTo($from,$name);
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML(true); // send as HTML
	$mail->Subject = "ENQUIRY FORM";
	$mail->Body = $body; //HTML Body
	$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
	
	if(!$mail->Send())
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
	else
	{
		//echo "Your enquiry succesfully send";
		?>
		<script>
			alert("Your request has been successfully send.");
			window.location = 'index.php';
		</script>
		<?php
	}
}
else 
{ 
?>
	<script>
		location.reload();
	</script>	
<?php  
}
?>
