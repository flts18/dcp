<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_letter extends CI_Controller {

	function __construct()
    {
	parent::__construct();
	$this->load->model('Letter_model');
	$this->load->model('General_model');
	$this->load->library("pagination");
  
    }


   
  //track file bybarcode
  public function track_letter_bymemono()
  {
    $memono=trim($this->input->post('memono', TRUE));
    $year=$this->input->post('year', TRUE);
    
   
    
        $data['active']='memo_page';
        $data["results"] = $this->Letter_model->track_letter_bymemono(trim($memono),$year);
        $content=$this->load->view('track_letter/by_memono',$data,true);
        render($content); 
      
    
  }

  //track file track_letter_bytext
    public function track_letter_bytext()
    {
       
        //var_dump($this->input->post('des', TRUE));exit();
        if(trim($this->input->post('text', TRUE))!="")
        {
        $this->session->set_userdata(array('text'=>trim($this->input->post('text', TRUE))));
        
        }
        $text=trim($this->session->userdata('text'));
        $config = array();
        $config["base_url"] = base_url()."Track_letter/track_letter_bytext";
        $config["total_rows"] = $this->Letter_model->count_letter_description($text);
        $config["per_page"] = 8;
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
        $data['active']='by_text_page';
        //echo $description;exit;
        $str=strtolower(preg_replace('/\s+/', '',$text));

        $data["results"] = $this->Letter_model->track_letter_bytext(trim($str),$config["per_page"],$page);
       // print_r( $data["results"]);exit;
        $data["links"] = $this->pagination->create_links();
        //$data['section']= $this->File_model->General_model->view_all_data('fts_section');       
        $content=$this->load->view('track_letter/by_text',$data,true);
        render($content);   
            
            
        
    }


    public function letter_history($letter_id)
  {
    $data["active"]="";
    $data["history"]= $this->Letter_model->letter_history($letter_id);
    $content=$this->load->view('letter_inbox/letter_history',$data,true);
    render($content); 
      
  }
 


//track letter by subject
  public function track_letter_bysubject()
  {
    $description="";
    if($this->input->post('des', TRUE)!="")
    {
    $this->session->set_userdata(array('description'=>$this->input->post('des', TRUE)));
   
    }
        $description=$this->session->userdata('description');
        $config = array();
        $config["base_url"] = base_url()."letter_inbox/track_letter_bysubject";
        $config["total_rows"] = $this->Letter_model->count_letter_subject($description);
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
        $data['active']='by_subject_page';
        $data["results"] = $this->Letter_model->track_letter_bysubject($description,$config["per_page"],$page);
        $data["links"] = $this->pagination->create_links();
        $data['section']= $this->General_model->view_all_data('fts_letter_record');   
        $content=$this->load->view('track_letter/by_subject',$data,true);
        render($content); 
      
      
  }


//track letter by category
  public function track_letter_bycategory()
  {
        $category="";
        $data['category']=$this->General_model->view_all_data('fts_category');
        if($this->input->post('cat', TRUE)!="")
        {
             $this->session->set_userdata(array('category'=>$this->input->post('cat', TRUE)));
    //$this->session->set_userdata(array('category'=>$this->input->post('des', TRUE)));
    
        }
        $category=$this->session->userdata('category');
        $config = array();
        $config["base_url"] = base_url()."letter_inbox/track_letter_bycategory";
        $config["total_rows"] = $this->Letter_model->count_letter_bycategory($category);
        $config["per_page"] = 2;
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
        $data["active"]="by_category_page";
        $data["results"] =$this->Letter_model->track_letter_bycategory($category,$config["per_page"],$page);
        $data["links"] = $this->pagination->create_links(); 
        $content=$this->load->view('track_letter/by_category',$data,true);
        render($content); 
         
  }

//track letter bydate
  public function track_letter_bydate()
  {
     //$content=$this->load->view('track_file/by_date');
        $reg_dt="";
        if($this->input->post('issue_dt', TRUE)!="")
    {
        $this->session->set_userdata(array('reg_dt'=>$this->input->post('issue_dt', TRUE)));
    
    }
        $reg_dt=$this->session->userdata('reg_dt');
        $config = array();
        $config["base_url"] = base_url()."letter_inbox/track_letter_bydate";
        $config["total_rows"] = $this->Letter_model->count_letter_date($reg_dt);
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
        $data['active']='by_date_page';
        $data["results"] = $this->Letter_model->track_letter_bydate($reg_dt,$config["per_page"],$page);
        $data["links"] = $this->pagination->create_links();
        //$data['section']= $this->File_model->General_model->view_all_data('fts_section');   
        $content=$this->load->view('track_letter/by_date',$data,true);
        render($content); 
        
  }
  
  
  
  //track letter bysending authority
  public function track_letter_bysending_authority()
  {
  
    $authority="";
    $data['authority']=$this->General_model->view_all_data('fts_authority');
    if($this->input->post('sec', TRUE)!="")
    {
    $this->session->set_userdata(array('authority_id'=>$this->input->post('sec', TRUE)));
    }
    $authority=$this->session->userdata('authority_id');
    

    $config = array();
        $config["base_url"] = base_url()."letter_inbox/track_letter_bysending_authority";
        $config["total_rows"] = $this->Letter_model->count_letter_bysending_authority($authority);
        $config["per_page"] = 2;
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
        $data["active"]="by_sending_authority_page";
        $data["results"] = $this->Letter_model->track_letter_bysending_authority($authority,$config["per_page"],$page);
        $data["links"] = $this->pagination->create_links();
        //$data['section']= $this->File_model->General_model->view_all_data('fts_authority');   
        $content=$this->load->view('track_letter/by_sending_authority',$data,true);
        render($content); 
      
    
  }
  
  
  
  
}
