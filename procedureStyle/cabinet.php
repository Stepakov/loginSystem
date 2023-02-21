<?php
session_start();
$user = require "getUser.php";

var_dump( $user );

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
<a href="/5/procedurestyle/logout.php">Logout</a> <br>
<a href="/5/procedurestyle/index.php">Home</a>
<hr>
