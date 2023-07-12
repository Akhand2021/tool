<?php 
$user_ip = $_SERVER['REMOTE_ADDR'];
if($user_ip === '127.0.0.1'){
  echo '<p style="color:red;">WARNING: You are accessing this server from the localhost IP address (127.0.0.1), which may indicate that this code is being tested on a local machine.</p>';
} else {
  echo 'Your IP address is: ' . $user_ip;
}

