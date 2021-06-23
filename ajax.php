<?php

if(isset($_POST['inn'])){
	$inn = $_POST['inn'];
	
}

$url = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party'; 
$options = array(
	"query" => $inn,
	"count" => 5
);
$token = '4995bc0f1b57ce4b40383a5bed8f078e4e0727ff';

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url.'?'. http_build_query($options));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Accept: application/json',
		'Content-Type: application/json',
		'Authorization: Token '.$token
	)
);
$response = curl_exec($ch);
$data = json_decode($response, true);
curl_close($ch);

/* echo "<pre>";
print_r($data); */

$test = array();
$test['nameOrg'] = $data['suggestions'][0]['value'];
$test['city'] = $data['suggestions'][0]['data']['address']['data']['city_with_type'];
$test['fullAdress'] = $data['suggestions'][0]['data']['address']['unrestricted_value'];
echo json_encode($test, JSON_UNESCAPED_UNICODE); 
