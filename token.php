
<?php

/*
  Made in sandbox, but work with live priaid
  email@brunodasilva.com
  
  Thank you.
*/

$user = 'priaidID';
$pass = 'passid';

echo getPriaidToken($user, $pass);

function getPriaidToken($user, $pass) {
  
  $uri = 'https://sandbox-authservice.priaid.ch/login';

  $ch = curl_init();

  curl_setopt($ch,CURLOPT_URL, $uri); 
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $k = base64_encode(hash_hmac('md5', $uri, $pass, true));

  $head = array("POST /login?format=json HTTP/1.1", "Host: sandbox-authservice.priaid.ch","Authorization: Bearer {$user}:{$k}", "Content-Length: 0");


  curl_setopt($ch,CURLOPT_HTTPHEADER,$head);

  $result = curl_exec($ch);

  curl_close($ch);

  $r = json_decode($result);


  return $r->{'Token'};

}

?>
