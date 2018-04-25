<?php
ini_set('memory_limit', '-1');

class MY_Controller extends CI_Controller {

	public $user_details="";
    function __construct() {
        parent::__construct();
		
		if( $this->session->userdata('user_id')=='' || (!$this->session->userdata('user_id')))
        { 
            header('location:'.base_url());
			exit;
        }
		
		if(!$this->session->userdata('sessionUserDetails')) {
			$this->user_details=get_user_details();
		} else {
			$this->user_details=$this->session->userdata('sessionUserDetails');
		}
		$this->output->delete_cache();
	}
}
