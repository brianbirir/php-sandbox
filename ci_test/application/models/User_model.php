<?php

class User_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }


    // insert data into users table
    function insertUser($data)
    {
        return $this->db->insert('User', $data);
    }


    // get a single user
    function getUser($id)
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        $row = $query->row();
        return ($query->num_rows() == 1) ? $row : false;
    }


    // get all users
    function getUsers()
    {
        $this->db->select('*');
        $this->db->from('User');
        $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->result() : false;
    }


    // get a single user
    function getUserNames($id)
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        $row = $query->row();
         
        if($query->num_rows() == 1)
        {
            $first_name = $row->first_name;
            $last_name = $row->last_name;
            $full_name = $first_name." ".$last_name;
            return $full_name;
        }
        else
        {
            return FALSE;
        }  
    }


    // get user's email address
    function getUserEmail($id)
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        $row = $query->row();
        return ($query->num_rows() == 1) ? $row->email : false;
    }


    // update user
    function updateUser($data,$id)
    {
        $this->db->set($data);
        $this->db->where('user_id',$id);
        $this->db->update('User',$data);
        return true;
    }
}
?>