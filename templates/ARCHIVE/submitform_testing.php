<?php
/* function filterEmail($field)
{
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);

    // Validate e-mail address
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return $field;
    } else {
        return false;
    }
}

function filterString($field)
{
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if (!empty($field)) {
        return $field;
    } else {
        return false;
    }
}

// Define variables and initialize with empty values
$emailErr = $subjectErr = $messageErr = "";
$email = $subject = $message = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate email address
    if (empty($_POST["email"])) {
        $emailErr = "Please enter your email address.";
    } else {
        $email = filterEmail($_POST["email"]);
        if ($email == false) {
            $emailErr = "Please enter a valid email address.";
        }
    }

    // Validate message subject
    if (empty($_POST["subject"])) {
        $subjectErr = "Please enter a subject.";
    } else {
        $subject = filterString($_POST["subject"]);
        if ($subject == false) {
            $subjectErr = "Please enter a valid subject.";
        }
    }

    // Validate user comment
    if (empty($_POST["message"])) {
        $messageErr = "Please enter your message.";
    } else {
        $message = filterString($_POST["message"]);
        if ($message == false) {
            $messageErr = "Please enter a valid message.";
        }
    }

    // Check input errors before sending email
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $new_line = "\r\n";
        $csv_line = array(
            'new_line' => $new_line,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        );
        $fname = 'database.csv';
        $csv_line = implode(',', $csv_line);
        $fcon = fopen($fname, 'a');

        fwrite($fcon, $csv_line);
        fclose($fcon);

        header("Location: https://www.austinscobee.com/thankyou.html");
        exit();
    }
} */


/* $keys = array('email','subject', 'message');
$csv_line = array();
foreach ($keys as $key) {
    array_push($csv_line, '' . $_POST[$key]);
}
$fname = 'database.csv';
$csv_line = implode(',', $csv_line);
// if(!file_exists($fname)){$csv_line = "\r\n" . $csv_line;}
$fcon = fopen($fname, 'a');
$fcontent = "\r\n" . $csv_line;

fwrite($fcon, $fcontent);
fclose($fcon);

header("Location: https://www.austinscobee.com/thankyou.html");
exit(); */


date_default_timezone_set("MST");
$message_date = date("m/d/y");
$message_time = date("H:i:s A");
$csv_line = array(
    'date' => $message_date,
    'time' => $message_time,
    'email' => $_POST['email'],
    'subject' => $_POST['subject'],
    'message' => $_POST['message']
);
$fname = 'database.csv';
$csv_line = implode(',', $csv_line);
$fcon = fopen($fname, 'a');
$fcontent = "\r\n" . $csv_line;

fwrite($fcon, $fcontent);
fclose($fcon);

// header("Location: https://www.austinscobee.com/thankyou.html");
// exit();
require_once "Mail.php";

$from = "austin.scobee@yahoo.com";
$to = "austin.scobee@gmail.com";
$subject = "Testing PHP Mail";
$message = "It worked!";
$headers = 'From: ' . $from;
// $headers = 'From: ' . $from . "\r\n" .
// 'Reply-To: '. $email . "\r\n" .
// 'X-Mailer: PHP/' . phpversion();

$host = "ssl://mail.yahoo.com";
$port = "465";
$username = "austin.scobee@yahoo.com";
$password = "^.9Au2j98#VYEzh";

$smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));

$mail = $smtp->send($to, $headers, $body);

// mail($to, $subject, $message, $headers);


header("Location: https://www.austinscobee.com/thankyou.html");
exit();


/* error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
require_once "Mail.php";

$host = "ssl://smtp.dreamhost.com";
$username = "youremail@example.com";
$password = "your email password";
$port = "465";
$to = "address_form_will_send_TO@example.com";
$email_from = "youremail@example.com";
$email_subject = "Subject Line Here:" ;
$email_body = "whatever you like" ;
$email_address = "reply-to@example.com";

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
echo("<p>Message successfully sent!</p>");
} */
