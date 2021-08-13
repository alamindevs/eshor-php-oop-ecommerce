<?php
namespace App\Controllers;

class Controller {

    public function view( $view ) {
        if ( !empty( $view ) ) {
            require_once __DIR__ . '/../../view/' . $view . '.php';
        } else {
            echo 'no view ';
        }

    }

}