<?php

function check_login($serv, $uname, $upass) {
    $ad = ldap_connect($serv);

        if(!$ad){
            return "Can't create LDAP object!";            
        }
        else {
            $bind = ldap_bind($ad, $uname, $upass);

            if(!$bind){
                return "Wrong username or password!";
            }
            else{
                ldap_unbind($ad);
                return "OK";
            }
        }
}

$username = $_POST["username"];
$password = $_POST["password"];

$server = "ldap://up.local";
$fullUsername = $username;

$result = check_login($server, $fullUsername, $password);

if($result == "OK"){
    header("Location: login_success.php?result=".$result);
}
else {
    header("Location: login_error.php?error=".$result);
}
?>