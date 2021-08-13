<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;

class ProductController extends Controller {

    public function getIndex() {
        return $this->view( 'product' );
    }

}