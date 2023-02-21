<?php

function nameIsVerified( string $name ) : void
{
    if( empty( $name ) ) throw new Exception( 'Name is empty' );
}

function emailIsVerified( string $email ) : void
{
    if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) )
        throw new Exception( 'Email is not verified' );
}

function passwordIsVerified( string $password, string $passwordConfirmed ) : string
{
    if( strlen( $password ) <= 3 )
        throw new Exception( 'Password is too short' );
    if( $password !== $passwordConfirmed )
        throw new Exception( 'Password and confirmed password are not equal' );

    return password_hash( $password, PASSWORD_DEFAULT );
}





if( str_contains( $_SERVER[ 'HTTP_REFERER' ], 'login' ) )
{
    $email = $_POST[ 'email' ];
    $password =$_POST[ 'password' ];
    $errors = [];
//    $password = password_hash( $password , PASSWORD_DEFAULT );

    try {
        emailIsVerified( $email );
    }
    catch( \Exception $e )
    {
//        echo $e->getMessage();
//        $data = serialize( [ 'errors' => $e->getMessage() ]);
//        header('Content-Type: application/json; charset=utf-8');
//        echo json_encode($data);
//        exit('error');
        $errors[] = $e->getMessage();
        $result = http_build_query( [ 'errors' => $errors ]);

//        exit( $result );
        header( 'Location: /5/login.php?' . $result );
        exit;
    }

    $db = new PDO( "mysql:host=localhost;dbname=students", 'root', '' );

    $query = "SELECT login, email, password FROM users WHERE email='$email'";

    $result = $db->query( $query );

//    $result = $db->execute();


//    var_dump( $result ); exit;

    $user = $result->fetch( \PDO::FETCH_ASSOC );

    if( ! $user )
    {
        $errors[] = "Email or password are wrong";
//            exit( 'sup' );
        $result = http_build_query( [ 'errors' => $errors ]);

//        exit( $result );
        header( 'Location: /5/login.php?' . $result );
        exit;
    }


//    var_dump( $user[ 'password' ] ); exit;

    if( ! password_verify( $password, $user[ 'password' ] ) )
    {
        $errors[] = "Email or password are wrong";
//            exit( 'sup' );
        $result = http_build_query( [ 'errors' => $errors ]);

//        exit( $result );
        header( 'Location: /5/login.php?' . $result );
        exit;
    }

//    var_dump( $user ); exit;

    session_start();

    $_SESSION[ 'user' ] = serialize( $user );

    header( 'Location: /5/cabinet.php' );

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

//    var_dump( $db );

    $query = "INSERT INTO users ( login, email, password ) VALUES ( '$name', '$email', '$password' )";

//    var_dump( $query );

    $db->query( $query );

    $lastId = $db->lastInsertId();

    $query = "SELECT login, email FROM users WHERE id=$lastId";

    $result = $db->query( $query );

    $user = $result->fetch( \PDO::FETCH_ASSOC );

    session_start();

    $_SESSION[ 'user' ] = serialize( $user );

    header( 'Location: /5/cabinet.php' );

}