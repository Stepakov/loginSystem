<?php

include "vendor/autoload.php";

use classes\User\User;

if( isset( $_SESSION[ 'user' ] ) )
{
    return $user = unserialize( $_SESSION[ 'user' ] );
}
else
{
    return null;
}