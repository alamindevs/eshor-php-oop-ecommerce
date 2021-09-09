<?php
namespace App\Controllers\Backend;

use App\Controllers\Controller;
use App\Models\Category;
use App\Rule\UniqueRule;
use Illuminate\Support\Str;
use PDO;
use Rakit\Validation\Validator;

class CategoryController extends Controller {

    public function getIndex() {
        return view( "backend/category/index" );
    }

    public function postIndex() {
        $pdo       = new PDO( 'mysql:host=127.0.0.1;port=3306;dbname=eshor-php-oop-ecommerce;charset=UTF8;', 'root', '' );
        $validator = new Validator;
        $validator->addValidator( 'unique', new UniqueRule( $pdo ) );

        $validation = $validator->make( $_POST, [
            'name' => 'required|unique:categories,name',
        ] );

        $validation->validate();
        if ( $validation->fails() ) {
            $errors             = $validation->errors();
            $massage            = $errors->firstOfAll();
            $_SESSION['errors'] = $massage;
            return redirect( 'dashboard/category' );
            exit();
        }

        $create = Category::create( [
            'name'   => $_POST['name'],
            'slug'   => Str::slug( $_POST['name'] ),
            'status' => (bool) $_POST['status'],
        ] );

        if ( $create ) {
            $_SESSION['message_success'] = 'Category Create Successful';
            return redirect( 'dashboard/category' );
        }

    }
}