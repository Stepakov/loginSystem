<?php

namespace classes\Login;

use Exception;

class Login
{
    private string $email;
    private string $password;

    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;

        $this->checkEmail();
        $this->checkPassword();
    }

    private function checkEmail() : void
    {
        if( ! filter_var( $this->email, FILTER_VALIDATE_EMAIL ) )
            throw new Exception( 'Email is not verified' );
    }

    private function checkPassword() : void
    {
        if( strlen( $this->password ) <= 3 )
            throw new Exception( 'Password is too short' );
    }

}