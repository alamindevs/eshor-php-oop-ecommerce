<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Mail\Mail;
use App\Models\User;
use Exception;
use function App\Helper\bcrypt;
use function App\Helper\redirect;
use Rakit\Validation\Validator;

class HomeController extends Controller {

    public function getIndex() {

        return $this->view( 'home' );

    }

    public function getLogin() {
        return $this->view( 'login' );
    }

    public function getRegister() {
        return $this->view( 'register' );
    }

    public function postRegister() {

        $validator = new Validator;
        // make it
        $validation = $validator->make( $_POST + $_FILES, [
            'name'             => 'required',
            'username'         => 'required',
            'email'            => 'required|email',
            'phone'            => 'required|digits:11',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'agree-term'       => 'required',
        ] );

        $validation->validate();
        if ( $validation->fails() ) {
            // handling errors
            $errors             = $validation->errors();
            $massage            = $errors->firstOfAll();
            $_SESSION['errors'] = $massage;
            return redirect( 'register' );
        } else {
            $token = sha1( $_POST['username'] . $_POST['phone'] . uniqid( 'oop', true ) );
            User::create( [
                'name'         => $_POST['name'],
                'username'     => $_POST['username'],
                'email'        => $_POST['email'],
                'phone'        => $_POST['phone'],
                'password'     => bcrypt( $_POST['password'] ),
                'verify_token' => $token,
            ] );
            try {
                $mail = new Mail();
                $mail->mailSend( $_POST['email'], $_POST['name'], 'test mail', 'success' );

            } catch ( Exception $e ) {
                return "Message could not be sent. Mailer Error: {$e->getMessage()}";
                exit();
            }
            $_SESSION['message_success'] = 'Registration successful';
            return redirect( 'login' );
        }
    }
}