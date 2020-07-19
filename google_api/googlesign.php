<?php 
include 'config.php';
?>
<!DOCTYPE html>
<html>
<style>
.google {
  background-color: #dd4b39;
  color: white;
}
input,
.btn {
  width: 15%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}
</style>
<body>
<div style="text-align : center">
    <a href="https://accounts.google.com/o/oauth2/auth?
scope=https://www.googleapis.com/auth/userinfo.profile 
https://www.googleapis.com/auth/userinfo.email 
https://www.googleapis.com/auth/spreadsheets 
 https://mail.google.com/ 
 https://www.googleapis.com/auth/gmail.modify 
 https://www.googleapis.com/auth/gmail.compose
 https://www.googleapis.com/auth/gmail.send 
https://www.googleapis.com/auth/plus.me&redirect_uri=<?php echo $REDIRECT_URL; ?>&response_type=code&client_id=<?php echo $CLIENTID?>
&access_type=offline" class="google btn">
          <i class="fa fa-google fa-fw"></i> Login with Google+
        </a>
</div>
    <body>
</html>