<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Response extends CI_Controller
{  
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('template');
        $this->load->model('response_model');
        $this->load->model('user_model');
        $this->load->model('responsetitle_model');   
    }

    // view all users
    function index()
    {
        $data = array();

        $data['title'] = 'Response Page';

        // get data from response model
        $data['response_data'] = $this->response_model->getAllResponses($params=array());


        $data['select_user'] = $this->getUsers();
        $data['select_response_name'] = $this->getRiskResponseTitle();

        // load page to show all registered users
        $this->template->load('default','response', $data);

    }


    // add responses to database table
    function add()
    {
        $this->load->library('uuid');

        // $num_fields = count($_POST['risk_response']['title']);

        $post_date = date('Y-m-d');

        // for ($i = 0; $i < $num_fields; $i++) 
        // {    
            $date = $this->input->post('date');

            // Pack the field up in an array for ease-of-use.
            // $field = array(
            //     'ResponseTitle_title_id' => $_POST['risk_response']['title'][$i],
            //     'users_id' => $_POST['risk_response']['user'][$i],
            //     'created_at' => $post_date,
            //     'updated_at' => $post_date,
            //     'due_date' => $this->getResponseDueDate($date),
            //     'response_uuid' => $this->uuid->generate_uuid()
            // );

            $field = array(
                'ResponseTitle_title_id' => $this->input->post('response_title'),
                'users_id' => serialize($this->input->post('user')),
                'created_at' => $post_date,
                'updated_at' => $post_date,
                'due_date' => $this->getResponseDueDate($date),
                'response_uuid' => $this->uuid->generate_uuid()
            );
            
            // insert risk response data first
            $this->response_model->insertResponse($field);
        // }

        redirect('/', 'auto');
    }


    # get reponse due date of which is after 7 days of the target date
    function getResponseDueDate($date)
    {
        return date("Y-m-d",strtotime("+7 days",strtotime($date)));
    }


    function ajax_response()
    {
        $timestamp = date('Y-m-d');

        $db_response = array();
        
        $data = array(
            'name' => $this->input->post('response_name'),
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        );

        // insert data into database
        $insert_data = $this->responsetitle_model->insertResponse($data);

        if ($insert_data)
        {  
            $this->load->model('response_model');

            $response = $this->responsetitle_model->getResponseTitle();
            
            if($response)
            {
                $options = array();

                foreach ($response as $row) 
                {
                    $response_id = $row->title_id;
                    $response_name = $row->name;
                    $options[$response_id] = $response_name;  
                }
                echo json_encode($options);
            }
        }
    }


    // risk response title
    function getRiskResponseTitle()
    {
        $response = $this->responsetitle_model->getResponseTitle();
        
        if($response)
        {
            $options = array();

            foreach ($response as $row) 
            {
                $title_id = $row->title_id;
                $name = $row->name;
                $options[$title_id] = $name;  
            }
            
            return $options;
        }
        else 
        {
            return 'No Data!';
        }
    }


    // get users
    function getUsers()
    {
        $user = $this->user_model->getUsers();
        
        if($user)
        {
            $options = array();

            foreach ($user as $row) 
            {
                $user_id = $row->user_id;
                $user_name = $row->first_name . " " . $row->last_name;
                $options[$user_id] = $user_name;  
            }
            return $options;
        }
        else
        {
            return 'No Data!';
        }
    }

}