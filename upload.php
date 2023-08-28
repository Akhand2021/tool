<?php
foreach ($_FILES as $file) {
 echo $tempFilePath = $file['tmp_name'];
  $newFilePath = 'uploads/' . $file['name'];
  move_uploaded_file($tempFilePath, $newFilePath);
}
?>
