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