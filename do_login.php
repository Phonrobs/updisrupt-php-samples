<?php
// get authorization code from Azure AD
$authCode = $_GET["code"];

if(!$authCode){
    echo $_GET["error_description"];
    exit();
}

// not we need access code from Azure AD for ensure use logedin
// by using POST method
$tokenEndpoint = "https://login.microsoftonline.com/d7cbbb08-47a3-4bd7-8347-5018f2744cfb/oauth2/token";

$postData = [
    "grant_type" => "authorization_code",
    "client_id" => "c7b87e3c-b9a1-4655-bfc6-73b886e5a4eb",
    "code" => $authCode,
    "redirect_uri" => "http://localhost/phpsamples/do_login.php",
    "client_secret" => "FphulOGhl+lhpT5yOP/87YFKDMKMtULBhyY5GUV/yu4=",
    "scope" => "openid User.Read"
];

$q = http_build_query($postData);

$ch = curl_init();

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $q);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// post data to Azure AD server
$response = curl_exec($ch);
curl_close($ch);

// validate user's access code
// convert result from JSON to object
$result = json_decode($response);

// keep asscess token in session for use in our app
session_start();
$_SESSION["access_token"] = $result->access_token;

// get user profile
$url = "https://graph.windows.net/d7cbbb08-47a3-4bd7-8347-5018f2744cfb/me?api-version=1.6";

$headers  = array(
    "Authorization: Bearer ".$result->access_token,
    "Content-Type: application/json;odata=minimalmetadata;streaming=true;charset=utf-8"
);

$ch2 = curl_init();

curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_URL, $url);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch2, CURLOPT_HTTPGET, true);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

// post data to Azure AD server
$response2 = curl_exec($ch2);
curl_close($ch2);

$result2 = json_decode($response2);

var_dump($response2);

/*$result = "OK";

if($result == "OK"){
    header("Location: login_success.php?result=".$result);
}
else {
    header("Location: login_error.php?error=".$result);
}*/
?>