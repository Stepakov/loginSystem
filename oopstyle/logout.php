<?php

session_start();

unset( $_SESSION[ 'user' ] );

header( 'Location: /5/oopstyle/login.php' );