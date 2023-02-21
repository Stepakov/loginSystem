<?php
session_start();
$user = require "getUser.php";

require "restricted.php";

if( $user )
{
    echo 'Hello, ' . $user[ 'login' ];
}
else
{
    echo "Hello, Guest";
}

?>

<hr>
<a href="/5/logout.php">Logout</a> <br>
<a href="/5/index.php">Home</a>
<hr>
