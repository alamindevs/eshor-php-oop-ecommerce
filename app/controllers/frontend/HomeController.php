<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;

class HomeController extends Controller {

    public function getIndex() {

        return $this->view( 'home' );

    }

}