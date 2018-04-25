<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdf_resource extends MY_Controller 
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
		 
         
        //echo "Access Denied!";
	
	}
	
	public function files($letter_name)
	{
		
		if(isset($letter_name))
		{
			$p=$this->Letter_model->get_path($letter_name);
			  $path = $p[0]['location_path'].'/';
			  //echo($path);exit;
			  $file_name =pathinfo($letter_name);
			  $path=realpath($path.$file_name['basename']);	
			  
			 if(file_exists($path)&& strtolower($file_name['extension']) == 'pdf')
			 {
				$file = file_get_contents($path);
				header("Content-Type: application/pdf");
				echo $file; 
			 }
		}
		  else
		{
			header('HTTP/1.0 401 Unauthorized');
			echo '401 Unauthorized Access! Please login first.';
		}
			
	}
	
	public function firs($pr_id)
	{
		
		
		if($pr_id > 0)
		{
		    $pr=$this->Letter_model->get_pr_path($pr_id);
		    //echo '<pre>'; print_r($pr); die;
		    if(isset($pr['fir_folder']) && file_exists($pr['fir_folder'])) {
    		    $file = file_get_contents($pr['fir_folder']);
				header("Content-Type: application/pdf");
				echo $file; 
			} else
    		{
    			header('HTTP/1.0 401 Unauthorized');
    			echo '401 Unauthorized Access!';
    		}
		} else
		{
			header('HTTP/1.0 401 Unauthorized');
			echo '401 Unauthorized Access!';
		}
			
	}
	
}
