<?php

define('API_URL', 'https://api.virtuagym.com/api/v1/');
define('API_KEY', ''); // See https://github.com/virtuagym/Virtuagym-Public-API
define('CLUB_KEY', ''); // System Settings -> Business Info -> Advanced -> Club Key
define('CLUB_ID', ''); // Part of the Club Key: CS-XXXX-ACCESS-123 where XXXX is your Club ID

$fname = "Peter";
$lname = "Smith";
$email = "peter@test.gmail.com";

$customer_data = array(
    "firstname" => $fname,
    "lastname" => $lname,
    "email" => $email,
    "is_pro" => true
);
$data_string = json_encode($customer_data);

$url = API_URL . 'club/' . CLUB_ID . '/member?api_key=' . API_KEY . '&club_secret=' . CLUB_KEY;
$ch = curl_init($url);
curl_setopt_array(
    $ch,
    array(
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_RETURNTRANSFER => true
    )
);
$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result);

echo 'Response: <br /><br />';
echo '<pre>';
var_dump($response);
echo '</pre>';
