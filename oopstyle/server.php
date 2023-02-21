<?php

include_once "vendor/autoload.php";

use classes\Db\Db;
use classes\Login\Login;
use classes\SignUp\SignUp;
use classes\User\User;

if( str_contains( $_SERVER[ 'HTTP_REFERER' ], 'login' ) )
{
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ];
    $errors = [];

    try {
        $login = new Login( $email, $password );
    }
    catch( \Exception $e )
    {
        echo $e->getMessage();
    }

    $db = new Db( 'localhost', 'students', 'root', '' );

    $query = "SELECT login, email, password FROM users WHERE email='$email'";

    $db->selectQuery( $query );

    $result = $db->execute();

    $user = $result->fetch( \PDO::FETCH_ASSOC );

    if( ! $user )
    {
        $errors[] = "Email or password are wrong";

        $result = http_build_query( [ 'errors' => $errors ]);

        header( 'Location: /5/oopstyle/login.php?' . $result );
        exit;
    }

    if( ! password_verify( $password, $user[ 'password' ] ) )
    {
        $errors[] = "Email or password are wrong";

        $result = http_build_query( [ 'errors' => $errors ]);

        header( 'Location: /5/oopstyle/login.php?' . $result );
        exit;
    }

//    unset( $user[ 'password' ] );
    $user = new User( $user[ 'login' ], $user[ 'email' ] );

    session_start();

//    var_dump( $user ); exit;

    $_SESSION[ 'user' ] = serialize( $user );

    header( 'Location: /5/oopstyle/cabinet.php' );

}
elseif( str_contains( $_SERVER[ 'HTTP_REFERER' ], 'signup' ) )
{
    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ];
    $passwordConfirmed = $_POST[ 'password_confirmed' ];

    try
    {
        $signup = new SignUp( $name, $email, $password, $passwordConfirmed );
    }
    catch( \Exception $e )
    {
        echo $e->getMessage();
    }

//    $db = new PDO( "mysql:host=localhost;dbname=students", 'root', '' );

    $db = new Db( 'localhost', 'students', 'root', '' );

    $query = "INSERT INTO users ( login, email, password ) VALUES ( '{$signup->getLogin()}', '{$signup->getEmail()}', '{$signup->getPasswordHash()}' )";

    $db->selectQuery( $query );

    try
    {
        $db->execute();
    }
    catch( \Exception $e )
    {
        echo $e->getMessage();
    }

    $lastId = $db->getLastId();

    $query = "SELECT login, email FROM users WHERE id=$lastId";

    $db->selectQuery( $query );

    $result = $db->execute();

    $user = $result->fetch( \PDO::FETCH_ASSOC );

    $user = new User( $user[ 'login' ], $user[ 'email' ] );

    session_start();

    $_SESSION[ 'user' ] = serialize( $user );

    header( 'Location: /5/oopstyle/cabinet.php' );
}