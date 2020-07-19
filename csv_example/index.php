<?php $msg=""; ?>
<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="w3-container w3-blue">
  <h2>Input Form</h2>
</div>

<form class="w3-container" id="form-user-info" action="" method="post">
  <p>
  <label>First Name</label>
  <input class="w3-input" type="text" name="form[name]"></p>
  <p>
  <label>Last Name</label>
  <input class="w3-input" type="text" name="form[lname]"></p>
  <p>
  <label>Email</label>
  <input class="w3-input" type="text" name="form[email]"></p>
  <p>
  <label>Select Language</label>
  <select class="w3-input"  name="form[language]">
    <option>English</option>
    <option>Spanish</option>
    <option>French</option>
    <option>Hindi</option>
    <option>Gujarati</option>
  </select>
</p>
<p>
  <button class="w3-btn w3-blue" name="creatcsv">Create CSV</button>
</p>
</form>
</body>
</html> 
<?php 
  if(isset($_REQUEST['creatcsv'])){
    $fp = fopen('persons.csv', 'a'); 
    fputcsv($fp, $_REQUEST['form']);
    fclose($fp);
    $msg= "Check You csv in persons.csv root folder";
    echo $msg;
  }
?>