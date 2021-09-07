<?php

function view( $view ) {

    if ( !empty( $view ) ) {
        require_once __DIR__ . '../../view/' . $view . '.php';
    } else {
        echo 'no view ';
    }

}

if ( !function_exists( 'redirect' ) ) {

    function redirect( $value = null ) {

        return header( "Location: /$value" );

    }

}

if ( !function_exists( 'bcrypt' ) ) {

    function bcrypt( $value = null ) {

        return password_hash( $value, PASSWORD_BCRYPT );

    }

}