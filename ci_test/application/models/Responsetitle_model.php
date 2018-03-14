<?php

    class Responsetitle_model extends CI_Model 
    {

        public function __construct()
        {
            parent::__construct();
        }
        
        
        // insert response data
        function insertResponse($data)
        {
            return $this->db->insert('ResponseTitle', $data);
        }
        

        // get single response
        function getSingleResponse($id)
        {
            $this->db->select('*');
            $this->db->from('ResponseTitle');
            $this->db->where('title_id',$id);
            $query = $this->db->get();
            $row = $query->row();
            return ($query->num_rows() == 1) ? $row : false;
        }
        

        // get all response titles
        function getResponseTitle()
        {
            $this->db->select('*');
            $this->db->from('ResponseTitle');
            $query = $this->db->get();
            return ($query->num_rows() > 0) ? $query->result() : false;
        }


        // get title name
        function getResponseTitleName($id)
        {
            $this->db->select('*');
            $this->db->from('ResponseTitle');
            $this->db->where('title_id',$id);
            $query = $this->db->get();
            $row = $query->row();
            return (isset($row)) ? $row->name : false;
        }

        // update response
        function updateResponse($data,$id)
        {
            $this->db->set($data);
            $this->db->where('title_id',$id);
            $this->db->update('ResponseTitle',$data);
            return true;
        }


        // delete response
        function deleteResponse($response_id)
        {
            $this->db->delete('ResponseTitle',array('title_id'=>$response_id));
            return true;
        }
    }