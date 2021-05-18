<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
	require_once "account.php";
//
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
	require 'vendor/autoload.php';


// Instantiation and passing `true` enables exceptions
	if (isset($_GET["send"]) && $_GET["send"]== true){
	
		$mail = new PHPMailer(true);
		
		
		
		

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

		   	  $conn = new mysqli(HOST,USER,PASS,DB);
		      if ($conn -> connect_error === true){
		        echo 'the error is: '.$conn -> connect_error; # cancel execute when error take placeee.
		      }else{

		        $sql = "select * from Persons";
		        $result = $conn -> query($sql);
		        
		        if($result -> num_rows > 0 ){

		          while($data = $result -> fetch_assoc()){
		             if($data['username'] == $_SESSION["username"]){
		                $email = $data['email'];
		                break;
		             }
		        
		           }
		        }  
		       }
		    
		    $mail->addAddress($_SESSION['MAILADMIN'], '');     // Add a recipient

		    // $mail->FromName = "Demo Send Mail";
		    
		   
		    // $mail->addAddress('ellen@example.com');               // Name is optional
		    if (isset($email) && $email != ""){
		    	$mail->setFrom($email, 'Phản hồi từ người dùng: ' . $email);
		    	$mail->addReplyTo($email, 'Trả lời'); 
		    }else{
		    	$mail->setFrom('tien676@gmail.com', 'Phản hồi từ người dùng' . $email);
		    	$mail->addReplyTo('tien676@gmail.com', 'Trả lời');
		    }
		    
		   
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Thông tin phản hồi của người dùng';
		    $mail->Body    = "Nội dung là: ".$_POST['msg'];
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		  
		
		    // echo "Thanh cong";
		} catch (Exception $e) {
		    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		     $content1 = 'Có lỗi xảy ra, xin vui lòng gửi lại';
		}
	}
	
