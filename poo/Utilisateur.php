<?php

class Utilisateur {
    private $nom;
    private $email;
    private $password;

    public function __construct($nom, $email, $password){
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function cryptMDP($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkMDP($password){
        return password_verify($password, $this->password);
    }
}

