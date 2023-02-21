<?php

$user = require "getUser.php";

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
<a href="/5/oopstyle/login.php">Login</a> <br>
<a href="/5/oopstyle/index.php">Home</a> <br>
<hr>

<form action="/5/oopstyle/server.php" method="POST">
    Name: <input type="text" name="name"> <br>
    Email: <input type="text" name="email"> <br>
    Password: <input type="password" name="password"> <br>
    Password_confirmed: <input type="password" name="password_confirmed" > <br>
    <button>Login</button>
</form>