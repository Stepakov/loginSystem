<?php

require_once 'functions.php';

if( str_contains( $_SERVER[ 'HTTP_REFERER' ], 'login' ) )
{
    $email = $_POST[ 'email' ];
    $password =$_POST[ 'password' ];
    $errors = [];

    try {
        emailIsVerified( $email );
    }
    catch( \Exception $e )
    {
        $errors[] = $e->getMessage();
        $result = http_build_query( [ 'errors' => $errors ]);

        header( 'Location: /5/procedurestyle/login.php?' . $result );
        exit;
    }

    $db = new PDO( "mysql:host=localhost;dbname=students", 'root', '' );

    $query = "SELECT login, email, password FROM users WHERE email='$email'";

    $result = $db->query( $query );

    $user = $result->fetch( \PDO::FETCH_ASSOC );

    if( ! $user )
    {
        $errors[] = "Email or password are wrong";

        $result = http_build_query( [ 'errors' => $errors ]);

        header( 'Location: /5/procedurestyle/login.php?' . $result );
        exit;
    }

    if( ! password_verify( $password, $user[ 'password' ] ) )
    {
        $errors[] = "Email or password are wrong";

        $result = http_build_query( [ 'errors' => $errors ]);

        header( 'Location: /5/procedurestyle/login.php?' . $result );
        exit;
    }

    unset( $user[ 'password' ] );

    session_start();

    $_SESSION[ 'user' ] = serialize( $user );

    header( 'Location: /5/procedurestyle/cabinet.php' );

}
elseif( str_contains( $_SERVER[ 'HTTP_REFERER' ], 'signup' ) )
{
    $name = $_POST[ 'name' ];
    $email = $_POST[ 'email' ];
    $password = $_POST[ 'password' ];
    $passwordConfirmed = $_POST[ 'password_confirmed' ];

    try {
        nameIsVerified( $name );
        emailIsVerified( $email );
        $password = passwordIsVerified( $password, $passwordConfirmed );
    }
    catch( \Exception $e )
    {
        echo $e->getMessage();
    }

//    if( ! empty( $name ) )
//    {
//        echo 'name is verified';
//    }
//    else
//    {
//        echo 'name is not verified';
//    }
//
//    echo "<br>";
//
//    if( filter_var( $email, FILTER_VALIDATE_EMAIL ) )
//    {
//        echo 'email is verified';
//    }
//    else
//    {
//        echo 'email is not verified';
//    }
//
//    echo "<br>";
//
//    if( strlen( $password ) > 3 && $password === $passwordConfirmed )
//    {
//        echo 'password is verified';
//
//        $password = password_hash( $password, PASSWORD_DEFAULT );
//        echo "<br>$password";
//    }
//    else
//    {
//        echo 'password is not verified';
//    }
//
//    echo "<br>";

    //==========================================================

    $db = new PDO( "mysql:host=localhost;dbname=students", 'root', '' );

    $query = "INSERT INTO users ( login, email, password ) VALUES ( '$name', '$email', '$password' )";

    $db->query( $query );

    $lastId = $db->lastInsertId();

    $query = "SELECT login, email FROM users WHERE id=$lastId";

    $result = $db->query( $query );

    $user = $result->fetch( \PDO::FETCH_ASSOC );

    session_start();

    $_SESSION[ 'user' ] = serialize( $user );

    header( 'Location: /5/procedurestyle/cabinet.php' );

}