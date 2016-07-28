<?php

// mail.php

$to      = 'shariffazharullah@gmail.com';
$subject = 'test subject';
$message = 'hello this is a test';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com';

if( mail($to, $subject, $message, $headers) ){

    echo 'Mail was sent';
} else {
    echo 'Couldn\'t send the mail';
}