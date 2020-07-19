<?php
// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	$url = 'https://accounts.google.com/o/oauth2/token';			
		$curlPost = 'client_id=15052052978-qm3atnhqs6smdk3ecf0d05rctshjllga.apps.googleusercontent.com&redirect_uri=http://localhost/php_demos/google_api/codetoaccessker.php&client_secret=AKGpeK26NVqOH5J-VMg65Ax9&code='.$_GET['code'].'&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
        $data = json_decode(curl_exec($ch), true);
        print_r($data);
}
//access_type=offline
?>