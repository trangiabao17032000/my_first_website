<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
	require 'vendor/autoload.php';


// Instantiation and passing `true` enables exceptions
	if (isset($_POST["email"]) && $_POST['email'] != ""){
	
		$mail = new PHPMailer(true);
		$randomNumber = rand(1000,9999);
		
		
		

		try {
		    //Server settings
		    $mail->SMTPDebug = SMTP::DEBUG_OFF;
		    $mail->SMTPDebug = 0;
		    // $mail->Debugoutput = 'html';
		    $mail->CharSet = 'UTF-8';
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->Host       = "smtp.gmail.com";                    // Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'tienle676@gmail.com';                     // SMTP username
		    $mail->Password   = 'lwbgrnpqyvjsdkvn';                               // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('tien676@gmail.com', 'Cứ hiểu đây là con bot');
		    $mail->addAddress($_POST['email'], '');     // Add a recipient

		    // $mail->FromName = "Demo Send Mail";
		    
		   
		    // $mail->addAddress('ellen@example.com');               // Name is optional
		    $mail->addReplyTo('tien676@gmail.com', 'Information');
		   
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Mã xác thực từ vantienxyz';
		    $mail->Body    = "Mã xác thực của bạn là: ".$randomNumber;
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    setcookie("randomNumber", $randomNumber, time() + 60, "/");
		
		    $content1 = 'Mã xác thực đã được gửi, vui lòng kiểm tra';
		} catch (Exception $e) {
		    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		     $content1 = 'Có lỗi xảy ra, xin vui lòng gửi lại';
		}
	}
	

	

	// if (isset($_GET["page"]) && $_GET["page"]=="authentication"){
	// 			//code here
	// 	// echo $randomNumber;
	// 	if (isset($_COOKIE["randomNumber"]) && isset($_POST["code"]) && $_POST['code'] != "" ){
	// 		echo "ok";
	// 		if ($_COOKIE["randomNumber"] == $_POST['code'] )
	// 			header("Location: http://localhost:8888/update.php/");
	// 		$noteContent = "bạn nhập mã code không đúng!";
	// 	}else{
	// 		$noteContent = "bạn nhập mã code không đúng!";
	// 	}
	// 	// 

	// }

?>
<!-- <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<form action="?page=authentication"method="post">

  <label for="lname">Mã xác thực:</label>
  <input type="text" id="code" name="code"><br><br>
  <input type="submit" value="Submit">
</form>
<form action="?page=getCode"method="post">
  <input type="submit" value="Nếu không nhận được vui lòng thử lại">
</form>
<p> <?= $noteContent; ?> </p>
</body>
</html> -->