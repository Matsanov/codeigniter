<?php

class Image_model extends CI_Model{

    private $id;
    private $username;
    private $password;
    private $passwordRepeat;
    private $email;


    public function __construct()
    {
        parent::__construct();

    }


    public function getImage($where) {
        $query = $this->db->get_where('images', $where);
    }

    public function getAll() {
        return $this->db->get_where('images')->result_array();
    }

    public function getLimitImages() {
        $this->db->select('*');
        $this->db->from('Images');
        $this->db->order_by('id','DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getImagesByUser() {
        $this->db->select('*');
        $this->db->from('Images');
        $this->db->where('userID',$this->session->userdata('user')['id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCommentsByImageId($image_id) {
        // Only comments
        //return $this->db->select("*")->from('Images')->where('image_id', $image_id)->get()->result_array();

        // Comments with users
        $this->db->select('c.comment_text, u.username, c.image_id, c.comment_id');
        $this->db->from('Comments as c');
        $this->db->join('Users as u', 'c.user_id = u.id');
        $this->db->where(['c.image_id' => $image_id]);
        return $this->db->get()->result_array();
    }


    public function addImage($postData)
    {
        $this->db->insert('images', $postData);
    }

    public function addComment($commentData)
    {
        return $this->db->insert('comments', $commentData);
        //$this->db->update('images', $commentData, array('id' => $id));
        //$this->db->where('id' == $id)->insert('images',$commentData);
    }
}