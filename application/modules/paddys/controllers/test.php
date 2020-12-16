<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://postman-echo.com/post",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "Cookie: sails.sid=s%3AHbsNu7U0RjiJ5Q5L6-8X7OepJjUS1Awq.NQ8ACQ1niYcMXbqsUrPL3O7ujFStE6gpg58wc8AW1y8"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
