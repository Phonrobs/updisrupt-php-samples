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
      <h1>Login using UP Office 365 account</h1>
      <?php
        include 'settings.php';

        // create Office 365 login page URL
        // with Tenant up.ac.th (for University of Phayao only)
        // with client_id from Azure AD
        // with redirect_uri that match Reply URI in Azure AD
        $url = $auth_endpoint."?client_id=".$client_id."&redirect_uri=".$reply_url."&response_type=code&resource=".$resource;
        
        // show login link
        echo '<p><a class="btn btn-primary btn-lg" href="'.$url.'" role="button">Click to login</a></p>'; 
      ?>
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