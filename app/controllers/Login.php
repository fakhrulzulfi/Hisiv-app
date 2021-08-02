<?php 

    class Login extends Controller {
        public function index() {
            $this->view('login/login');
        }

        public function verify() {
            $password = $_POST['password'];

            if( $this->model('User_model')->verifyPass($password, $_POST) ) {
                $_SESSION['user'] = $_POST['username'];
                header('Location: '. BASE_URL .'/dashboard' );
                exit;
            } else {
                header('Location: '. BASE_URL .'/login');
                exit;
            }
        }
    }