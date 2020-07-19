<?php
  include 'refreshToAccess.php';
  include(__DIR__.'/config.php');
  $AccessToken = getAccessFromRefresh();
  if(isset($_REQUEST['submit'])){
    $AccessToken = getAccessFromRefresh();
    $message = "To: ".$_POST['todata']."\r\nFrom: ".$EMAIL."\r\nSubject: ".$_POST['subject']."\r\n  \n\n ".$_POST['body']."  <h1>Message</h1>: its working ok thanks";
    //$message = base64_encode($message);
    // $message = str_replace("/\+/g","-",$message);
    // $message = str_replace("/\//g","_",$message);
    $ch = curl_init('https://www.googleapis.com/upload/gmail/v1/users/me/messages/send'); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $AccessToken", 'Accept: application/json', 'Content-Type: message/rfc822'));    
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $message);
    $data = curl_exec($ch);
    print_r($data);
  }
  $mailids = getAllMail($AccessToken,$EMAIL);
  $mailInfoArray  = array();
  if(!empty($mailids->messages)){
    foreach($mailids->messages as $oneemail){
     $mailinfo =  getMailDetails($AccessToken,$oneemail->id);
     $onedata =   array('body' => $mailinfo->snippet,
        'fromemail' => $mailinfo->payload->headers[2]->value,
        "subject" => $mailinfo->payload->headers[3]->value,
        "time" => $mailinfo->payload->headers[4]->value
      );
      array_push($mailInfoArray,$onedata);
    }
  }
  
?>
<html>
<head>
  <title>data add in Sheet</title>
  <link rel="stylesheet" href="style.css"></link>
</head>
<body>
  <div class="main-div cust-width-center">
    <form action="" method="post">
        <label for="fname">To</label>
		<input type="text" id="fname" name="todata" placeholder="id..">
		<label for="fname"> Subject</label>
		<input type="text" id="fname" name="subject" placeholder=" name..">
		<label for="fname">Body</label>
		<input type="text" id="fname" name="body" placeholder=" name..">
		<input type="submit" value="Submit" name="submit">
    </form>
  </div>
  <div class="main-div cust-width-center">
  	<span>Email listing</span>
	<table id="customers">
		<tr>
			<th>From</th>
			<th>Subject</th>
      <th>Mail</th>
		</tr>
		<?php foreach($mailInfoArray as $onedata) {  ?>
		<tr>
			<td><?= $onedata['fromemail']; ?></td>
			<td><?= $onedata['subject']; ?></td>
      <td><?= $onedata['body']; ?></td>
		</tr>
		<?php } ?>
	</table>
  </div>
</body>
</html>
<?php
  function getMailDetails($accesstoken,$id)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.googleapis.com/gmail/v1/users/me/messages/".$id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer ".$accesstoken,
        "cache-control: no-cache",
        "postman-token: 772d0bdf-472a-bf03-c58d-e2904bea7764"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return  array();
    } else {
      return json_decode($response);
    }
  }
  function getAllMail($accesstoken,$EMAIL)
  {
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
      return array();
    } else {
      return json_decode($response);
    }
  }
?>
