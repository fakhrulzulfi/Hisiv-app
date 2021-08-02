<?php 

    class User_model {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function get() {
            $this->db->query('SELECT * FROM tb_user');
        
            return $this->db->resultSet();
        }

        public function getUserByIdentifier($username) {
            $this->db->query('SELECT * FROM tb_user WHERE username=:username');
            $this->db->bind('username', $username);

            return $this->db->single();
        }

        public function verifyPass($password, $data) {

            $checkUser = $this->getUserByIdentifier($data['username']);

            if( $checkUser == false ) {
                return false;
            } 

            $password_user = $checkUser['password'];
            $password_input = $password;
            
            if( $password_user != $password_input ) {
                return false;
            }

            return true;
        }

        public function logout() {
            session_unset();
            session_destroy(); 
        }
    }