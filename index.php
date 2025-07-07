<?php
// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Replace with your actual API credentials
$user_id = '642486';
$api_key = 'f716b9119206dd464a90236683a6563f6faceed4';

$data = json_decode(file_get_contents("php://input"), true);

$day = $data['day'];
$month = $data['month'];
$year = $data['year'];
$sign = strtolower($data['sign']);

$url = "https://json.astrologyapi.com/v1/sun_sign_prediction/daily/$sign";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$user_id:$api_key");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
  "day" => $day,
  "month" => $month,
  "year" => $year
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json"
]);

$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($status == 200) {
  echo $response;
} else {
  echo json_encode([
    "error" => "Astrology API call failed",
    "status_code" => $status
  ]);
}
?>