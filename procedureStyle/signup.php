<?php

$user = require "getUser.php";

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
<a href="/5/procedurestyle/login.php">Login</a> <br>
<a href="/5/procedurestyle/index.php">Home</a> <br>
<hr>

<form action="/5/procedurestyle/server.php" method="POST">
    Name: <input type="text" name="name"> <br>
    Email: <input type="text" name="email"> <br>
    Password: <input type="password" name="password"> <br>
    Password_confirmed: <input type="password" name="password_confirmed" > <br>
    <button>Login</button>
</form>