<html>
<head>
  <title>Create Sheet</title>
  <link rel="stylesheet" href="style.css"></link>
</head>
<body>
  <div class="main-div cust-width-center">
    <form action="" method="post">
        <label for="fname">Sheet Name</label>
		<input type="text" id="fname" name="sheetname" placeholder="Sheet name..">
		<span></span>
		<input type="submit" value="Submit" name="submit">
    </form>
  </div>
</body>
</html>
<?php
	if(isset($_REQUEST['submit'])){
		include 'refreshToAccess.php';
		$accesstoken = getAccessFromRefresh();
		$curlPost = array('properties' => array('title' => $_POST['sheetname']));
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, 'https://sheets.googleapis.com/v4/spreadsheets');		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accesstoken, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			exit('Error : Failed to create spreadsheet');
		echo "Sheet created..! <a href='".$data['spreadsheetUrl']."'  target='_blank' > Click and check </a>";
		echo "<br/>";
		print_r( array('spreadsheet_id' => $data['spreadsheetId'], 'spreadsheet_url' => $data['spreadsheetUrl']) );
	}	
?>