<?php
$mysqliCon = new mysqli("localhost","root","","demos_php");
// Check connection
if ($mysqliCon -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqliCon -> connect_error;
  exit();
}
?>