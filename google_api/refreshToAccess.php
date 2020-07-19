<?php
    function  getAccessFromRefresh(){
        include(__DIR__.'/config.php');
        if($REFRESH != ""){
            $url_token = 'https://www.googleapis.com/oauth2/v4/token';      
            $curlPost = 'client_id='.$CLIENTID.'&client_secret='.$SECRETKEY.'&refresh_token='.$REFRESH.'&grant_type=refresh_token';
            $ch = curl_init();    
            curl_setopt($ch, CURLOPT_URL, $url_token);    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
            curl_setopt($ch, CURLOPT_POST, 1);    
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);  
            $data = json_decode(curl_exec($ch), true);  
            $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);    
            if($http_code != 200) 
                throw new Exception('Error : Failed to refresh access token');
            return $data['access_token'];
        }else{
            throw new Exception('Error :  refresh access token not found please add refresh token in config.php file ');
        }
        
    }

?>