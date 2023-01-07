<?php

    // MEMORY - CLASE USUARIO
    // SEBASTIAN RJ
    // 13/12/2022
    class Usuario{
        private $username;
        private $password;
        private $email;
        private $rol;
        public function getUsername(){
          return  $this->username ;
        }
        public function setUsername($username):self{
            $this->username = $username;
            return $this;
        }

        public function getPassword(){
            return  $this->password ;
          }
        public function setPassword($password):self{
              $this->password = $password;
              return $this;
        }

        public function getEmail(){
            return  $this->email ;
          }
        public function setEmail($email):self{
              $this->email = $email;
              return $this;
        }
        public function getRol(){
            return  $this->rol ;
          }
        public function setRol($rol):self{
              $this->rol = $rol;
              return $rol;
        }

  


        public function __construct($username, $password,$email,$rol){
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->rol = $rol;
        }

    }

?>