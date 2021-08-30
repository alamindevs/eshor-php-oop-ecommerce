<?php
namespace App\Controllers\Backend;

use App\Controllers\Controller;

class DashboardController extends Controller {

    public function getIndex() {
        // print_r( $_SESSION['user']['name'] );
        return $this->view( "backend/dashboard" );
    }

}