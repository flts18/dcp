<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Track_letter extends MY_Controller {
     
	function __construct()
    {
	parent::__construct();
	$this->load->model('Letter_model');
	$this->load->model('General_model');
	$this->load->library("pagination");
    //$this->user_details=check_user_page_access();
  
    }


   
  //track file bybarcode
  public function track_letter_bymemono()
  {
  
    if(trim($this->input->post('memono', TRUE))!="")
        {
             $this->session->set_userdata(array('memono'=>trim($this->input->post('memono', TRUE))));
             $this->session->set_userdata(array('year'=>$this->input->post('year', TRUE)));
        }
    $memono=trim($this->session->userdata('memono', TRUE));
    $year=$this->session->userdata('year', TRUE);
    $config = array();
        $config["base_url"] = base_url()."Track_letter/track_letter_bytext";
        $config["total_rows"] = $this->Letter_model->count_letter_memo($memono,$year);
        $config["per_page"] = 10;
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
        
   
    
        $data['active']='memo_page';
        $data["results"] = $this->Letter_model->track_letter_bymemono(trim($memono),$year,$config["per_page"],$page);
        $content=$this->load->view('track_letter/by_memono',$data,true);
        render($content); 
      
    
  }

  //track file track_letter_bytext
     public function track_letter_bytext()
    {      
        if(trim($this->input->post('text', TRUE))!="")
        {
			$this->session->set_userdata(array('text'=>trim($this->input->post('text', TRUE))));
			$this->session->set_userdata(array('search_type'=>trim($this->input->post('search_typ', TRUE))));
        }
		
	$config = array();
        $config["base_url"] = base_url()."Track_letter/track_letter_bytext";
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
		
        $text=trim($this->session->userdata('text'));
		$str=strtolower($text);
		
		$search_type=$this->session->userdata('search_type', TRUE);
      
        //config for bootstrap pagination class integration
		$config["total_rows"] = $this->Letter_model->count_letter_description($str);
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
		 $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		 //echo "oo";exit;
		$data["results"] = $this->Letter_model->track_letter_bytext(trim($str),$search_type,$config["per_page"],$page);
		
        $this->pagination->initialize($config);
		$data['active']='by_text_page';
        $data["links"] = $this->pagination->create_links();
              
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
        $config["base_url"] = base_url()."track_letter/track_letter_bysubject";
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


//track letter by paper_type
  public function track_letter_bycategory()
  {
           $paper_type="";
        $data['paper_type']=$this->General_model->data_order_by('fts_letter_register',"paper_type","asc");
       
        if($this->input->post('cat', TRUE)!="")
        {
             $this->session->set_userdata(array('paper_type'=>$this->input->post('cat', TRUE)));
    //$this->session->set_userdata(array('paper_type'=>$this->input->post('des', TRUE)));
    
        }
        $paper_type=$this->session->userdata('paper_type');
        $config = array();
        $config["base_url"] = base_url()."Track_letter/track_letter_bycategory";
        $config["total_rows"] = $this->Letter_model->count_letter_bycategory($paper_type);
        $config["per_page"] = 10;
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
        $data["results"] =$this->Letter_model->track_letter_bycategory($paper_type,$config["per_page"],$page);
        $data["links"] = $this->pagination->create_links(); 
        $content=$this->load->view('track_letter/by_category',$data,true);
        render($content); 
         
  }

//track letter bydate
  public function track_letter_bydate()
  {
     //$content=$this->load->view('track_file/by_date');
   
        //echo($this->input->post('from_issue_dt', TRUE).$this->input->post('to_issue_dt', TRUE));exit;
        if(($this->input->post('from_issue_dt', TRUE)!="") && ($this->input->post('to_issue_dt', TRUE)!=""))
    {
        $this->session->set_userdata(array('from_reg_dt'=>$this->input->post('from_issue_dt', TRUE)));
        $this->session->set_userdata(array('to_reg_dt'=>$this->input->post('to_issue_dt', TRUE)));
    }
    
        $from_reg_dt=$this->session->userdata('from_reg_dt');
        $to_reg_dt=$this->session->userdata('to_reg_dt');
        
        $config = array();
        $config["base_url"] = base_url()."track_letter/track_letter_bydate";
        //$config["total_rows"] = $this->Letter_model->count_letter_date(implode("/",$reg_dt));
        $config["total_rows"] = $this->Letter_model->count_letter_date($this->input->post('from_issue_dt', TRUE),$this->input->post('to_issue_dt', TRUE));
        $config["per_page"] = 10;
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
        
        $data["results"] = $this->Letter_model->track_letter_bydate($from_reg_dt,$to_reg_dt,$config["per_page"],$page);
        
        $data["links"] = $this->pagination->create_links();

      
        
        //$data['section']= $this->File_model->General_model->view_all_data('fts_section');   
        $reg_dt=$this->session->userdata('reg_dt');
        $content=$this->load->view('track_letter/by_date',$data,true);
        render($content); 
        
  }
  
  
  
  //track letter bysending authority
  public function track_letter_bysending_authority()
  {
  
 
    $authority="";
   // $data['authority']=$this->General_model->view_all_data('fts_authority');
    $data['authority']=$this->General_model->data_order_by('fts_authority',"authority_name","asc");
    if($this->input->post('sec', TRUE)!="")
    {
    $this->session->set_userdata(array('authority_id'=>$this->input->post('sec', TRUE)));
    }
    $authority=$this->session->userdata('authority_id');
    

    $config = array();
        $config["base_url"] = base_url()."track_letter/track_letter_bysending_authority";

        $config["total_rows"] = $this->Letter_model->count_letter_bysending_authority($authority);
        $config["per_page"] = 10;
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
