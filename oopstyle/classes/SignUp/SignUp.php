<?php

namespace classes\SignUp;

use Exception;

class SignUp
{
    private string $login;
    private string $email;
    private string $password;
    private string $passwordConfirmed;

    /**
     * @param string $login
     * @param string $email
     * @param string $password
     * @param string $passwordConfirmed
     */
    public function __construct(string $login, string $email, string $password, string $passwordConfirmed)
    {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->passwordConfirmed = $passwordConfirmed;

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

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash() : string
    {
        return password_hash( $this->password, PASSWORD_DEFAULT );
    }
}