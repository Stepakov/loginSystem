<?php
session_start();

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

<h1>Home page</h1>

<hr>

<?php if( ! $user ) : ?>
<a href="/5/signup.php">SignUP</a> <br>
<a href="/5/login.php">Login</a> <br>
<?php else : ?>
<a href="/5/logout.php">Logout</a> <br>
<a href="/5/cabinet.php">Cabinet</a> <br>
<?php endif; ?>

<hr>