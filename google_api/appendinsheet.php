<?php
	$msg = "";
    include 'refreshToAccess.php';
	include(__DIR__.'/config.php');
	$accesstoken = getAccessFromRefresh();
	if(isset($_REQUEST['submit'])){
		$range = "Sheet1";
		$curlPost= array('values' => array( array($_POST['sid'],$_POST['sname'],$_POST['scontact'])),'range'=>'Sheet1');
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, 'https://sheets.googleapis.com/v4/spreadsheets/'.$spreadsheetId.'/values/'.$range.':append?valueInputOption='.true);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accesstoken, 'Content-Type: application/json'));	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		//print_r($data);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) {
			//exit('Error : Failed to create spreadsheet');
			$msg = "Failed to add on spreadsheet";
		}
		else{
			$msg = "Data added";
		}
	}
	$sheetdata = getSheetData($accesstoken,$spreadsheetId);
?>
<html>
<head>
  <title>data add in Sheet</title>
  <link rel="stylesheet" href="style.css"></link>
</head>
<body>
  <div class="main-div cust-width-center">
  <span><?= $msg ?></span>
    <form action="" method="post">
        <label for="fname">ID</label>
		<input type="text" id="fname" name="sid" placeholder="id..">
		<label for="fname"> Name</label>
		<input type="text" id="fname" name="sname" placeholder=" name..">
		<label for="fname">Contact Name</label>
		<input type="text" id="fname" name="scontact" placeholder=" name..">
		<input type="submit" value="Submit" name="submit">
    </form>
  </div>
  <div class="main-div cust-width-center">
	<a href="clearsheet.php" >Data clear </a>
  </div>
  <div class="main-div cust-width-center">
  	<span>Data listing</span>
	<table id="customers">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Contact</th>
		</tr>
		<?php foreach($sheetdata as $onedata) {  ?>
		<tr>
			<td><?= !empty($onedata[0]) ? $onedata[0] : '' ?></td>
			<td><?= !empty($onedata[1]) ? $onedata[1] : '' ?></td>
			<td><?= !empty($onedata[2]) ? $onedata[2] : '' ?></td>
		</tr>
		<?php } ?>
	</table>
  </div>
</body>
</html>

<?php
	function getSheetData($accesstoken,$sheetId)
	{
		$curl = curl_init();
		$getUrl ="https://sheets.googleapis.com/v4/spreadsheets/".$sheetId."/values/Sheet1%21A1:Z1000";
		curl_setopt_array($curl, array(
		CURLOPT_URL => $getUrl,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$accesstoken,
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			return  array();
		} else {
			return !empty(json_decode( $response)->values) ? json_decode( $response)->values :  array();
		}
	}
?>