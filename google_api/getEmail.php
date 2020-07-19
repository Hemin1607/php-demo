<?php
    include 'refreshToAccess.php';
    include(__DIR__.'/config.php');
    $accesstoken = getAccessFromRefresh();
    echo $accesstoken;
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.googleapis.com/gmail/v1/users/".$EMAIL."/messages?q=is%3Aunread",
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
    echo "cURL Error #:" . $err;
    } else {
    echo $response;
    }
?>