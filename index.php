<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
<style type="text/css">
html {
    box-sizing: border-box;
}
#main {
	background-color: #FFF;	
	margin-top: 4%;
	margin-right: 10%;
	margin-bottom: 4%;
	margin-left: 14%;
	min-width: 75vw;
	text-align: justify;
	font-family: 'Tajawal', sans-serif;
	min-height: 80%;
}

.cfTitle{	/*Contact form title*/
	color: #B60000; 
	font-size: 1.8em;
}

.cfText{	/*Contact form description*/
	font-size: 1.01em;
}
.formTB{
	font-family: 'Tajawal', sans-serif;
	width: 24%;
	height: 40px;
	font-size: 0.9em;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #555555;
    box-sizing: border-box;
}

.formTA{
	font-family: 'Tajawal', sans-serif;
	width: 48.5%;
	font-size: 0.9em;
    padding: 20px 20px 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #555555;
    box-sizing: border-box;
	resize: none;
}
.formButton {
	font-family: 'Tajawal', sans-serif;
	background-color: #434242;
    color: white;
    border: 1px solid #555555;
	font-size: 0.9em;
    text-decoration: none;
    display: inline-block;
	padding: 16px 32px;
    text-align: center;
	-webkit-transition-duration: 0.4s;
    transition-duration: 0.5s;
    cursor: pointer;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.formButton:hover {
    background-color: white;
    color: #434242;
	box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}



</style>
</head>
<body id="main">
	<div style="font-family: 'Tajawal', sans-serif;">
		<p class="cfTitle"> Hey! This is a feedback/contact form </p>
		<p class="cfText">Please fill out the form below to send me an email and I'll get back to you as soon as possible.</p><br/>

		<form method="POST" action="" enctype="multipart/form-data" style="width: 125%;">
			<input type="hidden" name="action" value="submit">
			<input name="name" type="text" value="" placeholder="Name" class = "formTB"/> 
			<input name="email" type="text" value="" placeholder="Email" class ="formTB"/><br/><br/>
			<textarea name="message" rows="6" placeholder="Message" class = "formTA"></textarea><br/><br/>
			<input type="submit" name ="submit" value="Send Message" class="formButton"/>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="reset" name ="reset" value="Reset Fields" class="formButton"/>
		</form>
	</div>	
<?PHP
	if(isset($_POST["submit"]))
	{
		$name=$_REQUEST['name'];
		$message=$_REQUEST['message'];
		if (($name=="")||($message=="")) {
				print '<br/><b style="color:#B60000">Exception:</b> ';
				echo "<br/><b>All fields are required. Please fill all the fields.</b>";
		}
		else{		
			/*Email code BEGIN*/
			require 'PHPMailer/PHPMailerAutoload.php';
			
			$mail = new PHPMailer;
			
			$mail->isSMTP();									// Set mailer to use SMTP
			$mail->Host = 'YOUR HOST';                 			// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;								// Enable SMTP authentication
			$mail->Username = 'USER@DOMAIN.COM';				// SMTP username
			$mail->Password = 'PASSWORD';						// SMTP password
			$mail->SMTPSecure = 'true';							// Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;									// TCP port to connect to
			
			$mail->setFrom('user@domain.com', $name);
			$mail->addReplyTo($email, $name);
			$mail->addAddress('YOUREMAIL ADDRESS HERE');   		// Add a recipient
			
			$mail->isHTML(true);  // Set email format to HTML

			$bodyContent = "<html>\n"; 
			$bodyContent .= "<head>\n";
			$bodyContent .= "<link href='https://fonts.googleapis.com/css?family=Tajawal' rel='stylesheet'>\n";
			$bodyContent .= "</head>\n";  
			$bodyContent .= "<body style=\"font-family: 'Tajawal', sans-serif; font-size: 1em; font-style: normal; font-weight: 300; color: #4B4B4B;\">\n";
			$bodyContent .= "<br/> Hello Admin!<br/><br/> PFB message from the user - '$name'.<br/><br/>\n";
			$bodyContent .= "Email ID: $email <br/> Message: $message <br/>\n";
			$bodyContent .= "<br/> Regards, <br/> Portfolio manager.<br/><br/>\n";
			$bodyContent .= "</body>\n"; 
			$bodyContent .= "</html>\n"; 
			
			
			$mail->Subject = 'Feedback - YOUR COMPANY NAME';
			$mail->Body    = $bodyContent;
			
			if(!$mail->send()) {
				echo "<br/><span style='color:#B60000;'>Error: </span> <br/>Email could not be sent.";
				echo '<br/>Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo "<br/><b>Your message has been sent! Thank you for reaching out to me/us.</b>";
			}
			/*Email code END*/
		}
	} 
?>
</body>
</head>
</html>