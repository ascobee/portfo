<?php
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

header("Location: https://www.austinscobee.com/thankyou.html");
exit();
