<?php
session_start();

include 'settings.php';

// get authorization code from Azure AD
$auth_code = $_GET["code"];

if(!$auth_code){
    echo $_GET["error_description"];
    exit();
}

// not we need access code from Azure AD for ensure use logedin
// by using POST method
$postData = [
    "grant_type" => "authorization_code",
    "client_id" => $client_id,
    "code" => $auth_code,
    "redirect_uri" => $reply_url,
    "client_secret" => $client_secret,
    "resource" => $resource
];

$q = http_build_query($postData);

$ch = curl_init();

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $token_endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $q);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// post data to Azure AD server
$response = curl_exec($ch);
curl_close($ch);

// validate user's access code
// convert result from JSON to object
$result = json_decode($response);

if(isset($result->error)){
    // error occur
    // show error page
    header("Location: login_error.php?error=".$result->error_description);
}
else {
    // success
    // keep asscess token in session for use in our app    
    $_SESSION["access_token"] = $result->access_token;

    // show success page
    header("Location: login_success.php");
}
?>