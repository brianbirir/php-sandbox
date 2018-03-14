<?php

    class Response_model extends CI_Model {

        
        public function __construct()
        {
            parent::__construct();
        }


        // add risk response
        function insertResponse($data)
        {
            return $this->db->insert('Response', $data);
        }


        // get all risk responses
        function getAllResponses($params = array())
        {
            $this->db->select('*');
            $this->db->from('Response');

            if(array_key_exists('user_id',$params))
            {
                $this->db->where('user_id',$params['user_id']);
            }

            $query = $this->db->get();
            return ($query->num_rows() > 0) ? $query->result() : false;
        }


        // get risk responses by date
        function getResponseByDate($start_date, $end_date)
        {
            
        }


        // filter risk response by date and user
        function filterResponse($user_id, $start_date, $end_date)
        {
            
        }
        
    }