<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {

	function __construct()
    {
	parent::__construct();
	$this->load->model('Letter_model');
    }


	public function index()
	{
		check_user_page_access();
	    $data['active']='home_page';
		$this->load->view('front_page/front');
		
	}

	public function filetraking()
	{
		check_user_page_access();
	    $data['active']='home_page';
		$this->session->set_userdata('file_letter', 'file');
		$content=$this->load->view('front_page/file_front_page',$data,true);
		render($content);
		
		
	}
	
	public function lettertraking()
	{
		check_user_page_access();
	    $data['active']='home_page';
		$this->session->set_userdata('file_letter', 'letter');
		$r=$this->Letter_model->section_and_desig($this->session->userdata('user_id'));
		$a=$r['sec_id'];
		
		 if(substr_count($r['sec_id'],",")>=1)
		 {  
		 	  $multiple_sec=explode(",",$r['sec_id']);
            
		 	  foreach($multiple_sec as $key=>$value)
		 	  {
		 	  	 $data['multiple_section'][$key]=trim($this->Letter_model->section_name($value),',');
                 $data['multiple_persent'][$key]=$this->Letter_model->section_letter_percent($value);

		 	  }
		 	 
		 }
		 else
		 {
		 	$data['persent']=$this->Letter_model->section_letter_percent($a);
		 	$data['section']=trim($this->Letter_model->section_name($a),',');
		 }
		 $data['mypending']=$this->Letter_model->user_letter_percent();
		$content=$this->load->view('front_page/letter_front_page',$data,true);
		render($content);
		
		
	}

	public function action_notifcation()
	{

		 check_user_page_access();
		 $data['action_notifcation']=$this->Letter_model->action_notifcation();
		 $data['notifcation_count']=$this->Letter_model->action_notifcation_count();
	     echo $this->load->view('notification/notification',$data,true);
		
	}
		
	
}
?>