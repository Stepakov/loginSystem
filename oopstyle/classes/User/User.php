<?php

namespace classes\User;

class User
{
    protected string $login;
    protected string $email;

    /**
     * @param string $login
     * @param string $email
     */
    public function __construct( string $login, string $email )
    {
        $this->login = $login;
        $this->email = $email;
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


}