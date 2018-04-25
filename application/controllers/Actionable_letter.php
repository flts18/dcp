<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Actionable_letter extends MY_Controller 
{
  function __construct()
    {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Letter_model');
		$this->load->model('General_model');
		$this->load->library("pagination");
    }

	//profile
	function index()
	{
		 
         
        $config = array();
        $config["base_url"] = base_url() . "Actionable_letter/index";
        $config["total_rows"] = $this->Letter_model->fetch_action_count();
        $config["per_page"] = 11;
        $config["uri_segment"] = 3;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
        $data["results"] = $this->Letter_model->fetch_letter_sent($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['active']='action_letter_page';
        
        $data['currentUserRank'] = fetch_rank($this->session->userdata('user_id'));
        
        $content=$this->load->view('pending_letter/pending_action',$data,true);
        render($content);

	
	}
	public function requests_for_approval()
	{
		$config = array();
        $config["base_url"] = base_url() . "Actionable_letter/requests_for_approval";
        $config["total_rows"] = $this->Letter_model->fetch_requests_for_approval_count();
        $config["per_page"] = 11;
        $config["uri_segment"] = 3;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
        $data["results"] = $this->Letter_model->fetch_requests_for_approval_sent($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['active']='request_approval_page';
        $content=$this->load->view('pending_letter/request_approval',$data,true);
        render($content);
	}
	
	public function my_pending()
	{
		$config = array();
        $config["base_url"] = base_url() . "Actionable_letter/my_pending";
        $temp = $this->Letter_model->count_all_pending_list();
		$config["total_rows"]=$temp[0];
        $config["per_page"] = 11;
        $config["uri_segment"] = 3;
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Letter_model->all_pending_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['active']='';
        
        $data['currentUserRank'] = fetch_rank($this->session->userdata('user_id'));
        
        $content=$this->load->view('pending_letter/my_pending',$data,true);
        render($content);

		
	}
	
}
