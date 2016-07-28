<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

// require '../class.phpmailer.php';
require "../PHPMailer/class.phpmailer.php";

define('GUSER', 'leaves.eee@gmail.com'); // GMail username
define('GPWD', 'leaves@eee'); // GMail password

function smtpmailer($to, $from, $from_name, $subject, $body) {
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$Mail->Priority = 1;
	$mail->IsHTML(true);
	// $Mail->CharSet = 'UTF-8';
 //  	$Mail->Encoding = '8bit';
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}

// smtpmailer("shariffazharullah@gmail.com", 'leaves.eee@gmail.com' , 'EEE Dept., NITC', 'Approval for leave request', 'Hello World!');

// smtpmailer('shariffazharullah@mail.com', 'shariffazharullah@mail.com', 'Azhar', 'test mail message', 'Hello World!');

?>