<?php
session_start();



$user = require "getUser.php";

//$user = unserialize( $_SESSION[ 'user' ] );
//
//echo "<pre>";
//var_dump( $user );
//echo "</pre>";
//exit;

require "restricted.php";

if( $user )
{
    echo 'Hello, ' . $user->getLogin();
}
else
{
    echo "Hello, Guest";
}

?>

<hr>
<a href="/5/oopstyle/logout.php">Logout</a> <br>
<a href="/5/oopstyle/index.php">Home</a>
<hr>
