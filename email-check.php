<?php
$email = "test@gmail.com"; // replace with the email to be verified

// Step 1: Check if the email is in a valid format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid email format";
  exit;
}

// Step 2: Get the domain name from the email
list($username, $domain) = explode('@', $email);

// Step 3: Check if the domain exists and has a valid MX record
if (!checkdnsrr($domain, 'MX')) {
  echo "Invalid email domain";
  exit;
}

// Step 4: Try to connect to the email server and simulate sending an email
$socket = fsockopen($domain, 25, $errno, $errstr, 30);
if (!$socket) {
  echo "Could not connect to email server";
  exit;
}

// Step 5: Send the HELO command to the server
fputs($socket, "HELO " . $_SERVER['HTTP_HOST'] . "\r\n");
$resp = fgets($socket, 1024);
if (substr($resp, 0, 3) != '250') {
  echo "Invalid HELO response";
  exit;
}

// Step 6: Send the MAIL FROM command to the server
fputs($socket, "MAIL FROM: <" . $_SERVER['SERVER_ADMIN'] . ">\r\n");
$resp = fgets($socket, 1024);
if (substr($resp, 0, 3) != '250') {
  echo "Invalid MAIL FROM response";
  exit;
}

// Step 7: Send the RCPT TO command to the server
fputs($socket, "RCPT TO: <" . $email . ">\r\n");
$resp = fgets($socket, 1024);

// Step 8: Close the connection to the server
fputs($socket, "QUIT\r\n");
fclose($socket);

// Step 9: Check the response from the server to see if the email is valid
if (substr($resp, 0, 3) != '250') {
  echo "Invalid email address";
  exit;
}

echo "Email is valid";
