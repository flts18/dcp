<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Letter_inbox extends MY_Controller {

     public $user_details="";
    function __construct()
    {
    parent::__construct();
    $this->load->model('Letter_model');

    $this->load->model('General_model');
    $this->load->model('User_model');
    $this->load->library("pagination");
    //$this->user_details=check_user_page_access();
    }


    public function index()
    {
       
        
        $config = array();
        $config["base_url"] = base_url() . "Letter_inbox/index";
        $config["total_rows"] = $this->Letter_model->inbox_letter_count();
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
        $data["results"] = $this->Letter_model->fetch_letter_inbox($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['active']='letter_inbox_page';
        $content=$this->load->view('letter_inbox/letter_inbox',$data,true);
        render($content);


    }

   
  
  
  

public function dispatch($letter_id)
  {
       
       if($this->Letter_model->check_not_pending($letter_id) || $this->Letter_model->check_myregister($letter_id))
       {
           $data['active']='user_list';
        $data['designation']=$this->General_model->data_order_by('fts_designation',"desig_name","asc");
        $data['section_name']=$this->General_model->data_order_by('fts_section',"sec_name","asc");
        $sender=$this->Letter_model->section_and_desig($this->session->userdata('user_id'));
       
       
        $this->load->library('form_validation');
        if($this->input->post('receiver_type', TRUE)=='IN'){


        $this->form_validation->set_rules('designation', 'Addressed to (Designation)', 'required');
        $this->form_validation->set_rules('user_id', 'Addressed to (name)', 'required');
         }
         else if($this->input->post('receiver_type', TRUE)=='EX'){
            $this->form_validation->set_rules('receiver_name', 'receiver_name', 'required');
           $this->form_validation->set_rules('receiver_address', 'receiver address', 'required');
         }
        $actionable_data=array();

        $action='';
        $actionable_data["deadline_dt"]="";
       $reciver=array("desig_id"=>'',"sec_id"=>'');
        if(trim($this->input->post('user_id', TRUE))!="")
        {
          $reciver=$this->Letter_model->section_and_desig($this->input->post('user_id', TRUE));
        }
        if($this->input->post('actionable_id', TRUE)=='Actionable')
        {
              if($this->input->post('actionable_name', TRUE)=='others')
            {
              $action=$this->input->post('act_name', TRUE);
            }
            else
            {
              $action=$this->input->post('actionable_name', TRUE);
            }
         
          $d=explode("/",$this->input->post('deadline_dt'));
          $dt=$d[2].'-'.$d[1].'-'.$d[0];
          $actionable_data["deadline_dt"]= $dt;

        }
        else
        {
          $action=$this->input->post('actionable_id', TRUE);
        }
     
        $actionable_data["letter_id"]=$letter_id;
        $actionable_data["action_details"]=$action;
       if($this->input->post('actionable_id', TRUE)=="Not Actionable"){
            $actionable_data["action_status"]="No";
        }
        else{
            $actionable_data["action_status"]="P";
        }
        if($this->input->post('user_id', TRUE)!=""){
          $temp_sec=$this->User_model->usr_section($this->input->post('user_id', TRUE));
                     $val=$this->User_model->check_parent_sec($temp_sec[0]['sec_id']);
                     if(count($val)==0){
                      $section=$temp_sec[0]['sec_id'];
                      //echo("jjj");
                     }
                     else{
                      $section=$this->User_model->check_parent_sec($temp_sec[0]['sec_id']);
                      $section=$section[0]['sec_id'];
                     }
        }
        else{$section=0;}
       
                $movement_data=array(
                                       "recv_desig_id"=>$this->input->post('designation', TRUE)!=""?$this->input->post('designation', TRUE):0,
                                       "receiver_id"=>$this->input->post('user_id', TRUE)!=""?$this->input->post('user_id', TRUE):0,
                                       "reciever_sec"=>$section,
                                       "sender_id"=>$this->session->userdata('user_id'),
                                       "sender_desig_id"=>$sender['desig_id'],
                                       "letter_id"=>$this->input->post('letter_id', TRUE),
                                       //"letter_move_status"=>'M',
                                       "dispatch_dt_time"=>date('Y-m-d H:i:s'),
                                       "ext_receiver"=>$this->input->post('receiver_address', TRUE)
                                       //"dispatch_key"=> mt_rand(100000, 999999),
                                       //"letter_status"=>'D'
                                       );
  
                      $history_data=array( 
                                           
                                           "sender_user_id"=>$this->session->userdata('user_id'),
                                           "sender_section_id"=>$sender['sec_id'],
                                           "sender_desig_id"=>$sender['desig_id'],
                                           "recv_id"=>$this->input->post('user_id', TRUE)!=""?$this->input->post('user_id', TRUE):0,
                                           "receiver_section_id"=>$this->input->post('user_id', TRUE)!=""?$reciver['sec_id']:0,
                                           "receiver_desig_id"=>$this->input->post('user_id', TRUE)!=""?$reciver['desig_id']:0,
                                           "letter_id"=>$this->input->post('letter_id', TRUE),
                                           "date_of_action"=>date('Y-m-d H:i:s'),
                                           );

                     $external_reciver_data=array(
                                       
                                       "organization"=>$this->input->post('receiver_name', TRUE),
                                       "address"=> preg_replace('/\s\s+/', ' ',$this->input->post('receiver_address', TRUE))
                                       
                                       );

         if ($this->form_validation->run() == TRUE)
                {

                   if(trim($this->input->post('receiver_address', TRUE))!="")
                           {
                            
                            $address=preg_replace('/\s\s+/', ' ',$this->input->post('receiver_address', TRUE));
                
                            if($this->Letter_model->extranal_address_exists($address))
                            {
                            $this->General_model->insert_data('fts_external_address',$external_reciver_data);
                            }
                           }
                           
                    if($this->Letter_model->letter_id_check($letter_id)==1)
                    {
                      if($this->General_model->update_data('fts_letter_movement',$movement_data,array('letter_id'=>$this->input->post('letter_id', TRUE))))
                       {
                         //echo $actionable_data['deadline_dt'];
                          $letter_history_id=$this->General_model->insert_data('fts_letter_history_info',$history_data);
                           $actionable_data['trail_letter_id']=$letter_history_id;
                           $actionable_id=$this->General_model->insert_data('fts_actionable_letter',$actionable_data);
                           $this->General_model->update_data('fts_letter_movement',array('action_id'=>$actionable_id),array('letter_id'=>$this->input->post('letter_id', TRUE)));
               //$this->General_model->insert_data('fts_file_note',$note_data);
                         login_log(doctype_action('LD'),'L',$letter_id);  
                              redirect('letter_inbox/success_p');
                       }

                    }
                     else
                     {   //--------inserting data 
                       if($this->General_model->insert_data('fts_letter_movement',$movement_data))
                       {
                       // echo "el ".$actionable_data['deadline_dt'];exit;
                          $this->General_model->update_data('fts_letter_record',array('letter_move_status'=>'M'),array('letter_id'=>$this->input->post('letter_id', TRUE),'user_id'=>$this->session->userdata('user_id')));
                          $letter_history_id=$this->General_model->insert_data('fts_letter_history_info',$history_data);
                          $actionable_data['trail_letter_id']=$letter_history_id;
                           $actionable_id=$this->General_model->insert_data('fts_actionable_letter',$actionable_data);
                           $this->General_model->update_data('fts_letter_movement',array('action_id'=>$actionable_id),array('letter_id'=>$this->input->post('letter_id', TRUE)));
                         // $this->General_model->insert_data('fts_file_note',$note_data);
                           login_log(doctype_action('LD'),'L',$letter_id);  
                               redirect('letter_inbox/success_p'); 
                                  
                       }
                   }
                }
            
        $data["results"] = $this->Letter_model->letter_dispatch($letter_id);
       // print_r(  $data["results"]);
//echo $data['results'][0]["sender_desig_id"];exit;
         $data["desig_name"] =$this->Letter_model->desig_name($data['results'][0]["sender_desig_id"]);
     $content=$this->load->view('letter_inbox/letter_dispatch',$data,true);
     render($content);
  }
  else
  {
    echo '<script>alert("your action is not completed")</script>';
     redirect('letter_inbox', 'refresh');
  }
    
  }

    public function letter_action_status()
     {
        $letter_id=$this->input->post('id', TRUE);
        echo $this->Letter_model->letter_status_chang($letter_id);
     }

     public function letter_status_accept()
     {
        $letter_id=$this->input->post('id', TRUE);
        echo $this->Letter_model->letter_status_accept($letter_id);
     }
public function success_p()
{
   $data["msg"]="Letter dispatch successfully.";
   $data["title"]="Success";
  $content=$this->load->view('common/result_page',$data,true);
                          render($content);
                               
}
  public function file_view()
  {
     
    //echo $file_id=id_decrypt($file_id);exit;
      
      $get_vars = $this->input->get('fid');
      $file_id=id_decrypt($get_vars);
      $config = array();
      
        $config["base_url"] = base_url() . "file_inbox/file_view/?fid=$get_vars";
        $config["total_rows"] = $this->File_model->letter_count($file_id);
        $config["per_page"] = 1;
        $config["uri_segment"] = 3;
        $config['page_query_string'] = TRUE;
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

        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3): 0;
         $page = ($this->input->get('per_page')) ? $this->input->get('per_page'): 0;
        $data["results"] = $this->File_model->fetch_doc($config["per_page"], $page,$file_id );
        $data["folder"] = $this->General_model->view_data('fts_file_registration',array('file_id'=>$file_id) );
        $data["file_note"] =$this->File_model->file_note($file_id);
        $data["links"] = $this->pagination->create_links();
        $data['active']='';
        $content=$this->load->view('file_inbox/file_view',$data,true);
        render($content);


  }


  
    public function fetch_emp_name()
    {
        
        //echo("kokokok");exit;
        $results="";
        if($this->input->post('section',TRUE) !=""){
            $results= $this->Letter_model->get_user($this->input->post('designation',TRUE),$this->input->post('section',TRUE));
            //echo("okkkk");exit;  
            print_r($results);
            echo $this->input->post('designation',TRUE);echo $this->input->post('section',TRUE) ;       
        }
           
        else
        {


            $results= $this->Letter_model->get_user($this->input->post('designation',TRUE));
          }
        //echo '<option value="">---Select one---</option>';
        foreach($results as $value)
        {
            if($this->session->userdata('user_id')!=$value['user_id'])
          echo '<option value="'.$value['user_id'].'">'.$value['name'].'</option>';
        }

    }

    public function receive($file_id)
  {
      
        $data['active']='user_list';
        
        //$receiver=$this->File_model->section_and_desig($this->session->userdata('user_id'));
       
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('file_key_number', 'Flie key Number','required');
         if ($this->form_validation->run() == TRUE)
                {
                     $data_value=array(
                                       "file_receive_key"=>$this->input->post('file_key_number', TRUE),
                                       "delete_status"=>'N',
                                       "received_date_time"=>date('Y-m-d H:i:s'),
                                        "file_status"=>'R'
                                       );
                        //--------update
                     //echo $this->General_model->update_data('fts_file_movement',$data_value,array('reciver_user_id'=>$this->session->userdata('user_id'),'file_id'=>$this->input->post('file_id', TRUE),'dispatch_key'=>$this->input->post('file_key_number', TRUE)));exit;
                     if($this->General_model->update_data('fts_file_movement',$data_value,array('reciver_user_id'=>$this->session->userdata('user_id'),'file_id'=>$this->input->post('file_id', TRUE),'dispatch_key'=>$this->input->post('file_key_number', TRUE))))
                     {

                        $data_value=array(
                                           
                                           "user_id"=>$this->session->userdata('user_id'),
                                           
                                           "file_id"=>$this->input->post('file_id', TRUE),
                                           "action_type"=>'R',
                                           "date_of_action"=>date('Y-m-d H:i:s'),
                                           );
                        $this->General_model->insert_data('fts_file_history_info',$data_value);
                        $this->session->set_flashdata('success_message', 'Dispatched successfully.');
                        redirect('File_inbox');
                                
                                
                     }
                     else
                     {
                      $this->session->set_flashdata('error_message', 'File key number did not matched.');
                     }

                }
               
    $data["results"] = $this->Letter_model->letter_dispatch($letter_id);
    $data["desig_name"] =$this->Letter_model->desig_name($data['results'][0]["sender_desig_id"]);
    
    $content=$this->load->view('letter_inbox/letter_receive',$data,true);
    render($content);
  }

function ajax_extranal_letter_send()
  {

        $org=$this->input->post("org", TRUE);
       
        $result=$this->Letter_model->extranal_letter_send($org);
        foreach ($result as $key => $value) 
        {
          echo '<p style="color:white;cursor:pointer;" id="exid'.$key.'" onclick="extrnal_value(&quot;exid'.$key.'&quot;)">'.$value['address'].'</p><hr>';
        };
        


  }
 
}
