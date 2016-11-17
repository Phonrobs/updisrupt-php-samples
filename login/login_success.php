<?php 
    session_start();
?>
<html>
<head>
    <title>Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="css/customize.css">
</head>
<body>

<div class="container">
   <div class="jumbotron">
  <h1>Login Success!</h1>
  <p>
  <h3>Authorization Code:</h3>
  <textarea class="form-control" rows="6" readonly>
  <?php
    include 'settings.php';

    $access_token = $_SESSION["access_token"];

    echo $access_token;    
  ?>
  </textarea>
  </p>
  <p>
  <h3>Current User Information:</h3>
  <?php 
    // get user profile
    $headers  = array(
        "Authorization: Bearer ".$access_token,
        "Content-Type: application/json;odata=minimalmetadata;streaming=true;charset=utf-8",
        "Accept: application/json;odata=minimalmetadata"
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $graph_endpoint."/me?api-version=1.6");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // post data to Azure AD server
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response);

    var_dump($response);
  ?>
  </p>
  <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Back to login page</a></p>
</div>
</div>

    <script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
  
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>