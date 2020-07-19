
<?php
    include 'refreshToAccess.php';
    include(__DIR__.'/config.php');
	$accesstoken = getAccessFromRefresh();
    $range = "Sheet1!A1:Z1000";
	$ch = curl_init();		
	curl_setopt($ch, CURLOPT_URL, 'https://sheets.googleapis.com/v4/spreadsheets/'.$spreadsheetId.'/values/'.$range.':clear');		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
	curl_setopt($ch, CURLOPT_POST, 1);		
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accesstoken, 'Content-Type: application/json'));	
    $data = json_decode(curl_exec($ch), true);
	$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
	if($http_code != 200){
        exit('Error : Failed to clear spreadsheet');
    }
    else{

        echo "Data clear";
        header('Location: appendinsheet.php');
    }
?>