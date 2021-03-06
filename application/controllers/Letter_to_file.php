<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Letter_to_file extends MY_Controller {
  
 	function __construct()
    {
	parent::__construct();
	$this->load->model(array('Letter_model','User_model','General_model'));
	$this->load->library("pagination");
   //$this->user_details=check_user_page_access();
    }


public function index()
	{
	     // check_user_page_access();
        $data['active']='';
        $content=$this->load->view('letter_to_file/letter_to_file',$data,true);
        render($content);
          
	}

public function letter($id)
  {
      // if($this->Letter_model->check_not_pending($id) || $this->Letter_model->check_myregister($id))
       // {
        //check_user_page_access();
        $data['active']='';
        $content=$this->load->view('letter_to_file/letter_to_file',$data,true);
        render($content);
      // }
       // else
      // {
       //echo '<script>alert("your action is not completed")</script>';
         // redirect('letter_inbox', 'refresh');
      // }
  }

public function insert_to_file($letter_id)
  {
      //  check_user_page_access();
        $data['active']='';
         $result=$this->General_model->view_data('fts_file_registration',array('file_id'=>$this->input->post('fileid',TRUE)));
         //echo $this->db->last_query();exit;

         if($result != NULL ){


               $result2=$this->General_model->view_data('fts_letter_record',array('letter_id'=>$letter_id));
                 
                 $destination_folder=$result[0]['folder_name'];

                $source_folder=$result2[0]['location_path'];
                $file_name=$result2[0]['letter_name'];
                 $cp_no="";
				 $cp_to="";
                $cp=$this->File_model->fetch_cp($this->input->post('fileid',TRUE));

                
               // print_r($cp);exit;
                 if($cp[0]['cp_no_to']>=1) 
                 {
                   $cp_no=$cp_no+$cp[0]['cp_no_to']+$cp[0]['page_count']; 
				   $cp_to=$cp_no+$result2[0]['page_count'];
                }
                else
                {
                  $cp_no=$cp[0]['cp_no_from']+1; 
                }

            rename(APPPATH.'../'.$source_folder.'/'.$file_name, APPPATH.'../'.$destination_folder.'/'.$file_name);
      //print_r($cp[0]['page_count']);exit;
              if($this->General_model->update_data('fts_letter_record',array('file_id'=>$this->input->post('fileid',TRUE),'location_path'=>$destination_folder,'attached_by'=>$this->session->userdata('user_id'),'cp_no_to'=>$cp_to,'cp_no_from'=>$cp_no),array('letter_id'=>$letter_id)))
                
                $this->session->set_flashdata('success_message', 'Letter inserted to a File successfully.');
              login_log(doctype_action('LAF'),'L',$letter_id);
              $content=$this->load->view('letter_to_file/letter_to_file',$data,true);
              render($content);
      }
      else{
        //echo("dsdsd");exit;
        $data['active']='';
        $this->session->set_flashdata('Error', 'File does not exist.');
        $content=$this->load->view('letter_to_file/letter_to_file',$data,true);
        render($content);
      }    
  }

	public function search_file()
  {
    
       
        $results= $this->Letter_model->search_file($this->input->post('keyword',TRUE));
        foreach($results as $value)
        {
            if(substr_count($this->input->post('keyword',TRUE),"/")>0)
            {
           echo '<li class="list-group-item" onclick="set_file('.$value["file_id"].',\''.$value["file_ref_sl_no"].'\')">'.$value["file_ref_sl_no"].'</li>';
           }
		   else if(is_numeric($this->input->post('keyword',TRUE))){
			   echo '<li class="list-group-item" onclick="set_file('.$value["file_id"].',\''.$value["file_id"].'\')">'.$value["file_id"].'</li>';
		   }
           else
           {
            echo '<li class="list-group-item" onclick="set_file('.$value["file_id"].',\''.$value["file_name"].'\')">'.$value["file_name"].'</li>';
           }
        }
        
  }

}
