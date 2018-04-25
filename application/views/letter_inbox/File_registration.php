<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_registration extends CI_Controller {

	function __construct()
    {
	parent::__construct();
	$this->load->model(array('File_model','User_model','General_model'));
	$this->load->library("pagination");
	//$this->load->library("barcode");
  check_user_page_access();
    }


public function index()
	{
	    check_user_page_access();
      check_permission();
	      $data['active']='registration_page';
	      $data['subject']=$this->General_model->view_all_data('fts_subject');
	      $data['authority']=$this->General_model->view_all_data('fts_authority');
	      $data['category']=$this->General_model->view_all_data('fts_category');
	      $content=$this->load->view('file_registration/file_registration',$data,true);
	      render($content);
	}


public function file_regiter()
  {
    check_user_page_access();
    //echo $this->File_model->users_regis_file_count();exit;
    $config = array();
        $config["base_url"] = base_url() . "file_registration/file_regiter";
        $config["total_rows"] = $this->File_model->users_regis_file_count();
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
        $data["results"] = $this->File_model->fetch_reg_file($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['active']='registered_filelist';
        $this->session->set_userdata('page_name','reg_list');
        $content=$this->load->view('file_registration/registered_filelist',$data,true);
      render($content);
  }

public function file_insert()
	               {
		
                        $data['subject']=$this->General_model->view_all_data('fts_subject');
			                $this->load->library('form_validation');
		         //$this->form_validation->set_rules('ref_srl', 'File REF_SRL Number','required|is_unique[fts_file_registration.file_ref_sl_no]',array('is_unique'=> 'This %s already exists.'));
                        $this->form_validation->set_rules('name', 'FILE NAME', 'required|is_unique[fts_file_registration.file_name]');
                        $this->form_validation->set_rules('sub', 'SUBJECT', 'required');
                        $this->form_validation->set_rules('status', 'FILE STATUS', 'required');
                        $this->form_validation->set_rules('priority', 'FILE PRIORITY', 'required');
                        $this->form_validation->set_rules('des', 'FILE DESCRIPTION', 'required');
                       
//new field for others....			  
			   
         $data['subject']=$this->General_model->view_all_data('fts_subject');
        $data['authority']=$this->General_model->view_all_data('fts_authority');
        $data['category']=$this->General_model->view_all_data('fts_category');
			  if($this->input->post('sub', TRUE)=="others")
                	  {
                	
$this->form_validation->set_rules('add_sub', 'Subject of File','required|is_unique[fts_subject.subject_name]',array('is_unique'=> 'This is already exists.'));
		         }
			  
			  
                if ($this->form_validation->run() == FALSE)
                {
                        $content=$this->load->view('file_registration/file_registration',$data,true);
                         render($content);
                }
                else
                {
		            $subject_id='';
                	if($this->input->post('sub', TRUE)=="others")
                	{
                		$sub_add=array("subject_name"=>$this->input->post('add_sub', TRUE));
                		$subject_id=$this->General_model->insert_data('fts_subject',$sub_add);	
                	}
                	else
                	{
                		$subject_id=$this->input->post('sub', TRUE);
                	}

                	$personel_info=$this->General_model->view_data('fts_personel_info',array('user_id'=>$this->session->userdata('user_id')));
                	
			$category='';
                	if($this->input->post('category', TRUE)=="category_Others")
                	{
                		$add_cat=array("category"=>ucfirst($this->input->post('add_cat', TRUE)));
                		$this->General_model->insert_data('fts_category',$add_cat);
				$category=substr(ucfirst($this->input->post('add_cat', TRUE)),0,3);	
                	}
                	else
                	{
                		$category=$this->input->post('category', TRUE);
                	}

                	$personel_info=$this->General_model->view_data('fts_personel_info',array('user_id'=>$this->session->userdata('user_id')));
			
			$authority='';
			if($this->input->post('authority', TRUE)=="add_authority_name")
                	{
                		$add_authority=array("authority_name"=>ucfirst($this->input->post('add_authority_name', TRUE)));
                		$this->General_model->insert_data('fts_authority',$add_authority);
				$authority=substr(ucfirst($this->input->post('add_authority_name', TRUE)),0,3);	
                	}
                	else
                	{
                		$authority=$this->input->post('authority', TRUE);
                	}

                	$personel_info=$this->General_model->view_data('fts_personel_info',array('user_id'=>$this->session->userdata('user_id')));

                      $desig_id=$personel_info[0]['desig_id'];
                      $sec_id=$personel_info[0]['sec_id'];
                	  //$serial_no="001";
                	  $iss_dt=$_POST["issue_dt"];
                	  $iss_year=year($iss_dt);
                	  $prev='CID/'.$this->input->post('authority', TRUE).'/'.$category.'/'.$this->input->post('sub_cat', TRUE).'/';
                	   $post_match=$iss_year;
                      
                      //echo $ref_sl;exit;
                      $file["count"]=$this->File_model->get_files($prev,$post_match);
                      $no=(int)$file["count"];
                      $no=$no+1;
                      $ref_sl='CID/'.$authority.'/'.$category.'/'.$this->input->post('sub_cat', TRUE).'/'.$no.'/'.$iss_year;
                     // echo $ref_sl;exit;
                      $barcode="";
                     //  while(1)
                     //  {
                     //    $barcode=mt_rand(1000, 9999); 
                     //    if($this->File_model->check_brc($barcode))
                     //    break;
                     // }
                      $folder_name=str_replace("/","_",$ref_sl);
                          @mkdir('./repository/'.$folder_name, 0777, true);
                      
                     
                    $bar_img_name=$this->barcode_img_create($barcode,$folder_name);
		              $data_value=array(
		              	               "file_ref_sl_no"=>$ref_sl,
		              	               "file_name"=>$this->input->post('name', TRUE),
		              	               "subject_id"=>$subject_id,
		              	               "user_id"=>$this->session->userdata('user_id'),
		              	               "file_status"=>$this->input->post('status', TRUE),
							                     "file_priority"=>$this->input->post('priority', TRUE),
							                     "description"=>$this->input->post('des', TRUE),
                                   "delete_status"=>'N',
		              	               "file_reg_date"=>date('Y-m-d H:i:s'),
		              	               "desig_id"=>$desig_id,
		              	               "sec_id"=>$sec_id,
                                   "br_image_name"=>$bar_img_name,
                                   "br_value"=>$barcode,
		              	               "folder_name"=>$folder_name
		              	               );
                    
                     
		              //--------inserting data user table
		             if($fid=$this->General_model->insert_data('fts_file_registration',$data_value))
		             {
                  login_log(doctype_action('FC'),'F',$fid);
		             	$this->session->set_flashdata('success_message', 'The File is registered successfully.');
                  redirect('file_registration/download');
                }

                }
	    }



public function almari($file_id)
  {
      check_user_page_access();
        $data['active']='user_list';
        
        $receiver=$this->File_model->section_and_desig($this->session->userdata('user_id'));
       //echo $this->File_model->almari_check($file_id,$this->session->userdata('user_id'));exit;
       
      
                    if($this->File_model->almari_check_history($file_id,$this->session->userdata('user_id'))=='notalmari')
                    {

                     
                        //--------update
                     //echo $this->General_model->update_data('fts_file_movement',$data_value,array('reciver_user_id'=>$this->session->userdata('user_id'),'file_id'=>$file_id));exit;
                    
                        $data_value=array(
                                           
                                           "user_id"=>$this->session->userdata('user_id'),
                                           
                                           "file_id"=>$file_id,
                                           "action_type"=>'A',
                                           "date_of_action"=>date('Y-m-d H:i:s'),
                                           );
                        $this->General_model->insert_data('fts_file_history_info',$data_value);
                        $this->General_model->update_data('fts_file_registration',array('file_move_status'=>'A'),array('file_id'=>$file_id,'user_id'=>$this->session->userdata('user_id')));
                        $this->session->set_flashdata('success_message', 'Dispatched successfully.');
                        login_log(doctype_action('FA'),'F',$file_id);
                   }

          
    redirect('file_registration/file_regiter');
   
  }

public function barcode_img_create($bar_val,$folder_name)
  {
    $bc = new Barcode($bar_val); 
    $nam= time().".jpg";
    $img= $bc->draw('repository/'.$folder_name."/".$nam);
    $this->session->set_userdata('barcode_path','repository/'.$folder_name.'/'.$nam);
    return $nam;
  }

public function download()
  {
    $content=$this->load->view('file_registration/barcode_download',$data=array(),true);
    render($content);
  }
	
}
