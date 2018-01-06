<?php

class Users_model extends CI_Model{

    private $id;
    private $username;
    private $password;
    private $passwordRepeat;
    private $email;


    public function __construct()
    {
        parent::__construct();

    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     *
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }

    /**
     * @param mixed $passwordRepeat
     */
    public function setPasswordRepeat($passwordRepeat)
    {
        $this->passwordRepeat = $passwordRepeat;
    }

    function getFirstnames(){
        $query = $this->db->query('SELECT firstnames FROM users');
    }

    public function getAllUsers(){
        $this->db->select('username');
        $this->db->from('Users');
        $this->db->order_by('id','DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_User($postData)
    {
        $this->db->insert('users', $postData);
    }
}