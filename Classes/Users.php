<?php

//    Class users refers to users using the booking manager app

class User
{
    // === Fields  ===
    var $user_id;
    var $user_username;
    var $user_name;
    var $user_surname;
    var $user_password;
    var $user_type;
    var $user_photo;
    var $db;

    // === Constructors  ===
    function __construct(){
        $this->db = new Database();
        $this->user_id = -1;
        $this->user_username = "";
        $this->user_name = "";
        $this->user_surname = "";
        $this->user_password = "";
        $this->user_type = "-1";
        $this->user_photo = "";

    }
    // === Methods  ===

    // === Create a new User entry  ===
    public function setDb(){
        $this->db->setUser($this);
    }
    // === Read a User entry  ===
    public function getDb(){
        $this->db->getUser($this);
    }
    // === Delete a User entry  ===
    public function deleteDb(){
        $this->db->deleteUser($this);
    }
    // === Update a User entry  ===
    public function updateDb(){
        $this->db->updateUser($this);
    }
    // === Login a User to our app  ===
    public function login(){
        $this->db->loginUser($this);
    }
    // === Check if a username exists in our database.This check is usefull when creating new user  ===
    public function isUser(){
        return $this->db->isAlreadyUser($this);
    }
    // === Read all Users entries  ===
    public function getAll(){
        return $this->db->getAllUsers();
    }
}