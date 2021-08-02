<?php 

    class Logout extends Controller {
        
        public function index() {
            $this->model('User_model')->logout();
            header('Location: '. BASE_URL .'/login');
            exit;
        }
    }