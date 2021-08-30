<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Mail\Mail;
use App\Models\User;
use Carbon\Carbon;
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

    public function postLogin() {

        $validator  = new Validator;
        $validation = $validator->make( $_POST + $_FILES, [
            'email'    => 'required|email',
            'password' => 'required|min:6',

        ] );

        $validation->validate();
        if ( $validation->fails() ) {
            $errors             = $validation->errors();
            $massage            = $errors->firstOfAll();
            $_SESSION['errors'] = $massage;
            return redirect( 'login' );
            exit();
        }

        $user = User::where( 'email', $_POST['email'] )->select( 'id', 'email', 'password', 'verify_time' )->first();
        // return $user;

        if ( $user ) {

            if ( $user->verify_time == null ) {
                $_SESSION['message_error'] = 'Your account is not verifyed';
                return redirect( 'login' );
            }

            if ( password_verify( $_POST['password'], $user->password ) == true ) {
                $_SESSION['message_success'] = 'Login successful';
                return redirect( '' );
            }

            $_SESSION['message_error'] = 'Invalide Credential';
            return redirect( 'login' );

        }

        $_SESSION['message_error'] = 'Opss! try agin';
        return redirect( 'login' );

    }

    public function getRegister() {
        return $this->view( 'register' );
    }

    public function postRegister() {
        // return $_SERVER['HTTPS'];
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
                $body = "Hi Dear{$_POST['username']}  <a href='http://{$_SERVER['HTTP_HOST']}/activet/{$token}'>click heare</a>";
                $mail = new Mail();
                $mail->mailSend( $_POST['email'], $_POST['name'], 'test mail', "{$body}" );

                $_SESSION['message_success'] = 'Registration successful';
                return redirect( 'login' );
                // return '<script type="text/javascript">window.location = "/login"</script>';
            } catch ( Exception $e ) {
                return "Message could not be sent. Mailer Error: {$e->getMessage()}";
                exit();
            }

        }
    }

    public function getActivet( $token = '' ) {

        if ( empty( $token ) ) {
            $_SESSION['message_error'] = 'no token found';
            return redirect( 'login' );
        }

        $user = User::where( 'verify_token', $token )->first();
        if ( $user ) {
            $user->update( [
                'verify_token' => null,
                'verify_time'  => Carbon::now(),

            ] );
            $_SESSION['message_success'] = 'Account active. you can login now.';
            return redirect( 'login' );
            exit();
        }
        $_SESSION['message_error'] = 'Invalid token !';
        return redirect( 'login' );
    }
}