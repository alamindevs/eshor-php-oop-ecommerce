<?php
namespace App\Controllers\Frontend;

class UserController {

    public function getIndex() {
        require_once __DIR__ . '/../../../view/home.php';
    }

}