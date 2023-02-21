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
<a href="/5/procedurestyle/signup.php">SignUP</a> <br>
<a href="/5/procedurestyle/login.php">Login</a> <br>
<?php else : ?>
<a href="/5/procedurestyle/logout.php">Logout</a> <br>
<a href="/5/procedurestyle/cabinet.php">Cabinet</a> <br>
<?php endif; ?>

<hr>