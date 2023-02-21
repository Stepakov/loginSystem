<?php

if( isset( $_SESSION[ 'user' ] ) )
{
    return unserialize( $_SESSION[ 'user' ] );
}
else
{
    return null;
}