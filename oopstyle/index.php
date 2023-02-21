<?php
session_start();

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

<h1>Home</h1>

<hr>

<?php if( ! $user ) : ?>
    <a href="/5/oopstyle/signup.php">SignUP</a> <br>
    <a href="/5/oopstyle/login.php">Login</a> <br>
<?php else : ?>
    <a href="/5/oopstyle/logout.php">Logout</a> <br>
    <a href="/5/oopstyle/cabinet.php">Cabinet</a> <br>
<?php endif; ?>

<hr>