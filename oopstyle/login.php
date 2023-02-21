<?php

//$user = require "getUser.php";
//
//if( $user )
//{
//    echo 'Hello, ' . $user[ 'login' ];
//}
//else
//{
//    echo "Hello, Guest";
//}

?>

<!--<hr>-->
<!--<a href="/5/procedurestyle/signup.php">SignUP</a> <br>-->
<a href="/5/oopstyle/index.php">Home</a> <br>
<!--<hr>-->
<form action="/5/oopstyle/server.php" method="POST">
    Email: <input type="text" name="email"> <br>
    Password: <input type="password" name="password"> <br>
    <?php if( isset( $_GET[ 'errors' ] ) ) : ?>
        <?php foreach( $_GET[ 'errors' ] as $error ) :?>
            <p style="color: red">
            <?php echo $error . "<br>"; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    <button>Login</button>
</form>