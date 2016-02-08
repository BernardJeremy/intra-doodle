<?php

//Get config from config file
$configText = file_get_contents(__DIR__ . "/config.json");
$configJson = json_decode($configText, true);

// if post parameter is empty
if ($_POST["link"] == "") {
  $error = "No link sended";
  return;
}

$activityLink = $_POST["link"] . "?format=json";

// add login and password from config to parameters
$fields = array(
  'login' => urlencode($configJson['login']),
  'password' => urlencode($configJson['password']),
);

//url-ify the data for the POST
$fields_string = "";
foreach($fields as $key=>$value) {
  $fields_string .= $key.'='.$value.'&';
}
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $activityLink);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
$result = curl_exec($ch);

if($result === false)
{
  curl_close($ch);
  $error = 'Activity link failure : No result';
  return;
}

//close connection
curl_close($ch);

$json = json_decode($result, true);
$dates = array();

if (!isset($json['events'])) {
  $error = 'Activity link failure : No events';
  return;
}

// add each event slot to list
foreach ($json['events'] as $event)
{
  $dateBegin = date('Ymd', strtotime($event["begin"]));
  $timeBegin = date('Gi', strtotime($event["begin"]));
  $timeEnd = date('Gi', strtotime($event["end"]));
  if (array_key_exists($dateBegin, $dates)) {
    $dates["$dateBegin"] .= urlencode('|') . urlencode('|')  . $timeBegin . "-" .  $timeEnd;
  } else {
    $dates["$dateBegin"] = $timeBegin . "-" .  $timeEnd;
  }
}

// doodle options field
$fields = array(
  'local' => urlencode('fr'),
  'type' => urlencode('date'),
  'title' => urlencode($json['events'][0]['title']),
  'name' => urlencode($configJson['display_name']),
  'location' => urlencode($configJson['display_location']),
);

$fields = $fields + $dates;

//url-ify the data to create url
$fields_string = "";
foreach($fields as $key=>$value) {
  $fields_string .= $key.'='.$value.'&';
}
$fields_string = rtrim($fields_string, '&');

$link =  $configJson['doodle_create_url'] . "?" . $fields_string;

?>
