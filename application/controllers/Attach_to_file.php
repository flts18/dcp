<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

use iio\libmergepdf\Merger;
		use iio\libmergepdf\Pages;
		
   class Attach_to_file extends MY_Controller {
     
   	
      public function __construct() { 
         parent::__construct();
         $this->load->helper(array('form', 'url')); 
         
         $this->load->model('General_model');
         $this->load->library("pagination");

		
      }
		
      public function index($fid) { 
        // check_permission();
         $data['active']='';
         $data['authority']=$this->General_model->view_all_data('fts_authority');
		 $reg_file_status =$this->File_model->view_file_reg($fid);
          $data['register']=$this->General_model->data_order_by('fts_letter_register',"paper_type","asc");
           $data['register_type']=$this->General_model->data_order_by('fts_register_type',"category_register","asc");
          $data['section_name']=$this->General_model->data_order_by('fts_section',"sec_name","asc");
            $data['designation']=$this->General_model->data_order_by('fts_designation',"desig_name","asc");
              $data['memo_no']=$this->File_model->memono()+1;
			  //print_r($this->File_model->check_file_recive($fid));exit;
			  // print_r($reg_file_status);
        if($this->File_model->check_file_recive($fid)>0)
        {

         $data['data_value']=$this->General_model->view_data('fts_file_registration',array('file_id'=>$fid));
         $content=$this->load->view('file_registration/upload',$data,true);
         render($content);
        }
        
       else
       {

         //echo "<script>alert('Please receive this file at first. Then you can attach.'); </script>";
         // redirect('File_inbox');
		 $this->session->set_flashdata('receive_file', 'Receive the file atfirst.');
         redirect('file_inbox/receive/'.$fid, 'refresh');
    
       }

      } 
      
      
      public function upload_moe($file_id) { 
		    $data['active']='';
			 $data['file_id']=$file_id;
			$content=$this->load->view('file_registration/moe',$data,true);
			render($content);
	   } 
	   
	   
	   public function add_moe_doc($file_id) { 
		  //print_r($file_id);exit;
         
         $data['active']='';
		  $data['file_id']=$file_id;
		
					$path = $this->File_model->moe_folder_fetch($file_id);
					
					$this->load->library('form_validation');
					$folder_full=$path.'/moe';
					//echo $folder_full;exit;
					

                      
                      if (!is_dir($folder_full))
                          @mkdir($folder_full, 0777, true);


               $moe_value=array(

						"user_id"=>$this->session->userdata('user_id'),
						"moe_path"=>$folder_full.'/'.$file_id.'_moe'.'.pdf',
						"file_id"=>$file_id,
						"moe_date"=>date('Y-m-d H:i:s')


						);
								
				if ($this->is_dir_empty($folder_full)) 
				{


					 $config['upload_path']          = $folder_full;
                $config['allowed_types']        = 'pdf';
				$config['file_name']			= $file_id.'_moe';
              //  $config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
				
				
				
                $this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('file_moe'))
						{

						$error = array('error' => $this->upload->display_errors());
						//print_r($error);exit;
						$content=$this->load->view('file_registration/moe',$data,true);
						render($content);
						return;
						}
						else
						{

						//echo $_FILES['file_moe']['name'];exit;

						//print_r($folder_full);exit;
						
						$this->General_model->insert_data('fts_moe_doc',$moe_value);

						//$this->session->set_flashdata('success_message', 'Upload successfully.');
						login_log(doctype_action('FA'),'F',$file_id);
						$data["title"]="Success";
						$data["msg"]="MOE uploaded successfully";
						$content=$this->load->view('common/result_page',$data,true);
						render($content);
						return;



						}

				}
				else
				{

					 $config['upload_path']          = $folder_full;
					$config['allowed_types']        = 'pdf';
					$config['file_name']			= $file_id.'_moe';
				  //  $config['max_size']             = 100;
					//$config['max_width']            = 1024;
					//$config['max_height']           = 768;
					
					$this->load->helper('file');
					delete_files($folder_full);
					
					$this->load->library('upload', $config);

							if ( ! $this->upload->do_upload('file_moe'))
							{

							$error = array('error' => $this->upload->display_errors());
							//print_r($error);exit;
							
							return;
							}
							else
							{
						
					$this->General_model->update_data('fts_moe_doc',$moe_value,array('file_id'=>$file_id));
					$data["title"]="Success";
						$data["msg"]="MOE Updated successfully";
						$content=$this->load->view('common/result_page',$data,true);
						render($content);
						}
						
					
				
//						$content=$this->load->view('file_registration/moe',$data,true);
//						render($content);

			} 
	  }
	  
	  public function is_dir_empty($dir) {
		  if (!is_readable($dir)) return NULL;
		  return (count(scandir($dir)) == 2);
	   }
   
	  
   public function pending_files($recieverId=0)
		{
			$currentUserRank = fetch_rank($this->session->userdata('user_id'));
			if($recieverId > 0)
			{
				$data['active']='pending_files_individual';
				$data['pendingFiles']= $this->File_model->getAllPendingFileIndividual($currentUserRank,$recieverId);
				$content=$this->load->view('file_inbox/pending_file_individual',$data,true);
			} else {
				$data['active']='pending_files';
				$data['pendingFiles']= $this->File_model->getAllPendingFiles($currentUserRank);
				$content=$this->load->view('file_inbox/pending_files',$data,true);
			}
			
			render($content);
		}
		
		public function show_gen() { 
			$fid=$this->input->post('fid', TRUE);
			//echo($fid);exit;
			if($this->input->post('gen_load', TRUE))
			{
			 // echo $fid;exit;
				$data['alreadyAddedGI'] = $this->File_model->alreadyAddedGI($fid);
				$data['gen_val']=$this->File_model->get_gen_ins();
				$data['fid']=$fid;
				echo $content=$this->load->view('file_status/investigation_gen_ins',$data,true);
				
			}
			//render($content);
		}
		
	public function view_plan($fid,$status='') { 
         
        
         $data['active']='';
         //if($this->File_model->check_file_register($fid)>0)
          
			if(strlen($status) > 0 && in_array($status, array('completed','action-taken')))
			{
				if($status == 'completed')
				{
					$st = 'C';
				} elseif($status == 'action-taken')
				{
					$st = 'AT';
				}
				$data['data_value']=$this->File_model->show_plan_by_status($fid,$st);
				$data['spl_ins']=$this->File_model->show_spl_ins_by_status($fid,$st);
				$data['alreadyAddedGI'] = $this->File_model->alreadyAddedGI($fid,$st);
			} else {
				$data['data_value']=$this->File_model->show_plan($fid);
				$data['spl_ins']=$this->File_model->show_spl_ins($fid);
				$data['alreadyAddedGI'] = $this->File_model->alreadyAddedGI($fid);
			}
			
           
		  $data['gen_val']=$this->File_model->get_gen_ins();
           //echo '<pre>'; print_r($data);exit;
		$data['fid']=$fid;
        $content=$this->load->view('file_status/investigation_plan_files',$data,true);
        render($content);
          //}
        

      } 
      
      public function action_remarks($action_id){
		$data['active']='';
        $data['results']=$this->File_model->getAllRemarks($action_id);
		$this->File_model->setAllNewRemarks($action_id);
		$content=$this->load->view('file_status/action_remarks',$data,true);
        render($content);
      }
	  
	   public function action_history($pid) { 
         
        
         $data['active']='';
         //if($this->File_model->check_file_register($fid)>0)
          
          // $data['data_value']=$this->File_model->show_plan($fid);
           //print_r($data['data_value']);exit;
		$data['result']=$this->File_model->show_act_history($pid);
		$data['history']=$this->File_model->show_date_history($pid);
		//print_r($data['history']);exit;
        $content=$this->load->view('file_status/action_history',$data,true);
        render($content);
          //}
        

      } 
	  
	  public function ch_act_target()
     {
        $act_id=$this->input->post('id', TRUE);
		//$text="";
		$text=$this->input->post('act_name', TRUE);
		$dt=$this->input->post('nxt_dt', TRUE);
		//echo($dt);exit;
		$this->db->select('act_target_dt,file_id,plan_user_id,act_target_dt	');
        $this->db->from('fts_plan_action');
        $this->db->where('action_id',$act_id);
        $query = $this->db->get();
        $result=$query->result_array();
		$date1=$result[0]['act_target_dt'];
           //
		   //echo($dt);exit;
           $act_data=array(
					"file_id"=>$result[0]['file_id'],
					 "action_id"=>$act_id,
					 "plan_user_id"=>$result[0]['plan_user_id'],
					 "plan_status"=>'P',
					 "new_target_date"=>dt_format($dt),
					 "superior_user_id"=>$this->session->userdata('user_id'),
					 "prev_act_date"=>$result[0]['act_target_dt'],
					  "remarks" =>$text,
					);
					
		  //return $this->db->affected_rows();
		  $this->db->update('fts_plan_action', array('action_status'=>'P','remarks'=>$text,'act_target_dt'=>dt_format($dt)),array('action_id'=>$act_id)); 
		 
		   if($this->db->affected_rows()){
			   //return "pln";
			   //
			    
			   
			  // return($this->db->affected_rows());
			   if($act=$this->General_model->insert_data('fts_plan_history', $act_data)){
				   //print_r($act_data);exit;
				  // echo "okk";exit;
				 echo '<label style="color:green">Next Date:'.$dt.'</label>';exit;
			   }
		   }
		//echo $this->input->post('nxt_dt', TRUE);exit;
       // echo $this->File_model->ch_act_target($act_id,$text,$dt);
     }
	  
	  public function view_plan_req() { 
         
        
         $data['active']='';
         //if($this->File_model->check_file_register($fid)>0)
          
           $data['data_value']=$this->File_model->show_plan_req();
           //print_r($data['data_value']);exit;
		
        $content=$this->load->view('file_status/plan_req',$data,true);
        render($content);
          //}
        

      } 
	  
	  public function acc_plan()
     {
        $plan_id=$this->input->post('id', TRUE);
		
        echo $this->File_model->accept_plan($plan_id);
       
     }
	 
	 public function set_act_target()
     {
        $act_id=$this->input->post('id', TRUE);
		$target=$this->input->post('target', TRUE);
        echo $this->File_model->set_act_target($act_id,$target);
     }
	 
	public function view_action($pid) { 
         
        
         $data['active']='';
         //if($this->File_model->check_file_register($fid)>0)
          
           $data['res']=$this->File_model->show_plan_action($pid);
           //print_r($data['res']);exit;
		
        $content=$this->load->view('file_status/plan_action',$data,true);
        render($content);
          //}
        

      } 
	public function plan($fid)
  {
   

        $data["res"] = $this->File_model->fetch_file_ref($fid);
		
		$data['user']=$this->General_model->data_order_by('fts_user',"name","asc");
       
		$this->load->library('form_validation');
		 $this->form_validation->set_rules('file_ref_sl_no', 'FILE NO','required');
		// $this->form_validation->set_rules('target_dt', 'Target Date','required');
                       
                      
                        $this->form_validation->set_rules('plan_dt', 'Plan date', 'required');
                     
						$this->form_validation->set_rules('ctrl_officer', 'Controlling Officer', 'required');
        
		$file=$this->File_model->file_sec_biId($fid);
		$data["co"]=$file['controlling_officer'];
			if(fetch_rank($this->session->userdata('user_id'))>4){
				$ss_user=$this->session->userdata('user_id');
			}
			else{
				$ss_user=$this->File_model->get_sup_user($file['sub_sec'],'4');
			}
		
		if ($this->form_validation->run() == TRUE)
                {
                        
				 
					 
					 $acttion_arr=$this->input->post('pln_action', TRUE);
					  $acttion_target_arr=$this->input->post('target_dt', TRUE);
					 
						$data_arr=array();
						  foreach($acttion_arr as $key=>$val){
                                  //"plan_id"=>$plan_id,
								  $data_arr[]= $data_action=array(
								  "file_ref_sl_no"=>$this->input->post('file_ref_sl_no', TRUE),
								  "plan_user_id"=>$this->input->post('plan_by', TRUE),
		              	          "action"=>$val,
                                   "set_act_user"=>$this->session->userdata('user_id'), 
								  "controlling_officer"=>$this->input->post('ctrl_officer',true),
								  "set_dt"=>dt_format($this->input->post('plan_dt',true)),
								  "superior_user_id"=>$ss_user,
								   "file_id"  =>$fid,
								   "action_status"=>'P',
                                   "act_target_dt"=>dt_format($acttion_target_arr[$key]),);
								 }
								// echo'<pre>';
		              	      //print_r ($data_arr) ;exit;  
					 
					 
								  
				   $action_id=$this->db->insert_batch('fts_plan_action',$data_arr);
					
						
						//$this->session->set_flashdata('success_message', 'The File is updated successfully.');
						login_log(doctype_action('FPOI'),'F',$fid);
									  
						 $data["title"]="Success";
						  $data["msg"]="The plan is added successfully";
                     $content=$this->load->view('common/result_page',$data,true);
                      render($content);
					  return;
				 
				 //}
				 
				}
				
        $content=$this->load->view('file_registration/file_plan',$data,true);
      render($content);
  }

public function change_act_status()
  {
	$action_id= $this->input->post('id');
	$act_status= $this->input->post('act_status');
	$rem=  $this->input->post('rem');
	$plan_status="";
	$act_data;
	$file=$this->File_model->get_file_sec($action_id);
	//echo $act_status;	exit;
	//$file_id=$this->File_model->get_file_id($action_id);
	$user=$this->File_model->get_user_pln($action_id);
	//print_r( $file);exit;
	$sup_usr=0;
	
	if($act_status=="CH_DT"){
	
		$plan_status="CD";
		
		// $file_sec=$this->File_model->get_file_sec($action_id);
		// $file_id=$this->File_model->get_file_id($action_id);
		$count_req=$this->File_model->req_sup_user($action_id);
		//echo($count_req);exit;
		if($count_req <=60){
			if($user[0]['user_rank']>4){
				$ss_user=$user[0]['plan_user_id'];
			}
			else{
				$ss_user=$this->File_model->get_sup_user($file['sub_sec'],'4');
			}
			
		//echo($ss_user);exit;
			$sup_usr=$ss_user;
		}
	else if($count_req > 60 && $count_req <= 120){
			if($user[0]['user_rank']>5){
				$dig_user=$user[0]['plan_user_id'];
			}
			else{
				$dig_user=$this->File_model->get_sup_user($file['sub_sec'],'5');
			}
			$sup_usr=$dig_user;
			//echo($sup_usr);exit;
		}
		else if($count_req > 120 &&  $count_req <= 180){
			
				$ig_user=$this->File_model->get_sup_user($file['sub_sec'],'7');
				
		
			$sup_usr=$ig_user;
		}
		else if($count_req > 180 ){
			
				$adg_user=$this->File_model->get_sup_user($file['sub_sec'],'8');
				
		
			$sup_usr=$adg_user;
		}
		//echo($sup_usr);exit;
		$act_data=array(
				 "action_id"=>$action_id,
				 "file_id"=>$file['file_id'],
				 "plan_user_id"=>$this->session->userdata('user_id', TRUE),
				 "change_dt_req"=>1,
				 "plan_status"=>$plan_status,
				 "action_taken_dt"=>date('Y-m-d'),
				 "superior_user_id"=>$sup_usr,
				 "remarks" =>$rem
                );
		}
		else if($act_status=="AT"){
			$plan_status="AT";
			if($user[0]['user_rank']>4){
				$ss_user=$user[0]['plan_user_id'];
			}
			else{
				$ss_user=$this->File_model->get_sup_user($file['sub_sec'],'4');
			}
			$sup_usr=($sup_usr ==0)?$ss_user:$sup_usr;
			$act_data=array(
					"file_id"=>$file['file_id'],
					 "action_id"=>$action_id,
					 "plan_user_id"=>$this->session->userdata('user_id', TRUE),
					 "plan_status"=>'AT',
					  "action_taken_dt"=>date('Y-m-d'),
					  "remarks" =>$rem,
					);
		}	
		
	//print_r ($act_data);exit;	
	//echo($plan_status);exit;
		if(isset($act_data)){
			//print_r ($act_data);exit;	
			//print_r ($this->General_model->insert_data('fts_plan_history',$act_data));exit;	
			 //$act=$this->General_model->insert_data('fts_plan_history',$act_data);
			 //return($act);exit;	
			 if($act=$this->General_model->insert_data('fts_plan_history',$act_data)){
				
				$this->General_model->update_data('fts_plan_action',array("action_status"=>$plan_status, "superior_user_id"=>$sup_usr),array('action_id'=>$action_id));
					
					
					 if($plan_status=='AT'){
						 echo 'Action Taken';
					 }
					  else if($plan_status=='CD'){
						   echo 'Request to Change Deadline';
					  }
				   }
		}  
				  
				 
				
  }
   public function add_gen_instruction($fid)
  {
	  //echo '<pre>'; print_r($_POST); die;
	  //if($this->input->post('add_general', TRUE)){
		  
	  
				$acttion_arr=$this->input->post('chk_gen_ins', TRUE);
				$target_arr=$this->input->post('target_dt', TRUE);
				
				$this->load->library('form_validation');
				
				$this->form_validation->set_rules('target_dt', 'Target Date','required');
				//echo($this->form_validation->run());exit;
				//if ($this->form_validation->run() == TRUE){
					//print_r($target_arr);exit;
					$file = $this->File_model->file_sec_biId($fid);
					//print_r($file);exit;
					
					if(isset($acttion_arr) || count($acttion_arr)>0){
						$data_action=array();
						if(fetch_rank($this->session->userdata('user_id'))>4){
							$sup_usr=$this->session->userdata('user_id');
						}
						else{
							$sup_usr=$this->File_model->get_sup_user($file['sub_sec'],'4');
						}
							 foreach($acttion_arr as $key=>$val){
									  //"plan_id"=>$plan_id,
									  $data_action[]= $data_arr=array(
									"file_ref_sl_no"=>$file['file_ref_sl_no'],
									  "plan_user_id"=>$this->session->userdata('user_id'),
									  "action"=>$val,
									   "set_act_user"=>$this->session->userdata('user_id'), 
									  "controlling_officer"=>$file['controlling_officer'],
									  "set_dt"=>(date('Y-m-d')),
									  "superior_user_id"=>$sup_usr,
									   "file_id"  =>$fid,
									   "action_status"=>'P',
									   "gen_ins"=>'1',
									   "act_target_dt"=>dt_format($target_arr[$key])
									 );
							     
							 }
						 
						 //print_r($data_action);exit;
									  
					   if($action_id=$this->db->insert_batch('fts_plan_action',$data_action)){
					       $this->General_model->update_data('fts_plan_action',array('is_delete'=>1),array('file_id'=>$fid, "gen_ins" =>'0',"spl_ins" =>'0'));	  
						   login_log(doctype_action('FPOI'),'F',$fid);
							redirect('Attach_to_file/view_plan/'.$fid);		  
							
						  //return;
					   }
					}
				
	  //}
    
  }
  public function add_action($fid)
  {
		
		//echo("kkhh");
		$check=$this->File_model->check_file_pr($fid,$this->input->post('pr_no',TRUE));
	if($check==0){
		$pr_id=$this->add_pro_report($fid);
		//echo("qqqqq");exit;
		$this->add_accused_report($pr_id,$fid);
		$this->add_seizure_report($pr_id,$fid);
		$this->add_witness_report($pr_id,$fid);
		$this->add_arrest_report($pr_id,$fid);
		$this->add_invest_report($pr_id,$fid);
        $data["res"] = $this->File_model->file_sec_biId($fid);
		
       $data['user']=$this->General_model->data_order_by('fts_user',"name","asc");
		$this->load->library('form_validation');
		 $this->form_validation->set_rules('file_ref_sl_no', 'FILE NO','required');
		$file = $this->File_model->file_sec_biId($fid);
		$sup_usr="";
		if(fetch_rank($this->session->userdata('user_id'))>4){
				$sup_usr=$this->session->userdata('user_id');
		}
		else{
				$sup_usr=$this->File_model->get_sup_user($file['sub_sec'],'4');
			}
		
		if ($this->form_validation->run() == TRUE)
                {
				$date=$this->input->post('targett_dt',TRUE);
			    $pln_inst=$this->input->post('pln_action',TRUE);

				$data_action=array();
					$inst_id=array();
                 if(isset($pln_inst) && count($pln_inst)>0){
					 foreach($pln_inst as $key=>$val){
					 
					 $data_action[]=array(
                                 
								  "action"=>$pln_inst[$key],
								  "plan_user_id"=>$this->input->post('plan_by', TRUE),
                                  "set_act_user"=>$this->session->userdata('user_id'),
								
								   "controlling_officer"=>$file['controlling_officer'],
								  "superior_user_id"=>$sup_usr,
                                  "pr_id"=>$pr_id,
								  "file_id"  =>$fid,
								   "action_status"=>'P',
								   "spl_ins"=>'1',
								   "set_dt"=>dt_format($this->input->post('plan_dt', TRUE)),
                                  
								   "act_target_dt"=>dt_format($date[$key])
								 
		              	          );
					 }
					 //echo '<pre>';print_r($data_action); exit;

			      $this->db->insert_batch('fts_plan_action',$data_action);
				  foreach($data_action as $key=>$val){
						  $action_id[$key]=$this->db->insert_id();
				  }
					if(isset($action_id)){
					    
					    $this->File_model->checkDraftValueExist($fid);
					    
						$this->General_model->update_data('fts_plan_action',array('is_delete'=>1),array('file_id'=>$fid, "gen_ins" =>'0',"spl_ins" =>'0'));
						
						//$this->session->set_flashdata('success_message', 'The File is updated successfully.');
						login_log(doctype_action('FPOI'),'F',$fid);
									  
						 $data["title"]="Success";
						 $data["msg"]="PR is added successfully";
                     $content=$this->load->view('common/result_page',$data,true);
                      render($content);
					  return;
					}
					
				 
				 
				 }
				}
			
				
				$this->attach_pro_report($fid,$pr_id);
		}
	else{
						$data["title"]="Error";
						 $data["msg"]="This PR is allready added.";
                     $content=$this->load->view('common/err',$data,true);
                      render($content);
	}
        // $content=$this->load->view('file_registration/file_plan_action',$data,true);
      // render($content);
  }
  
  public function attach_toReg_File($fid) { 
         
        
         $data['active']='';
         //if($this->File_model->check_file_register($fid)>0)
          //{
            $data['authority']=$this->General_model->view_all_data('fts_authority');
          $data['register']=$this->General_model->data_order_by('fts_letter_register',"paper_type","asc");
           $data['register_type']=$this->General_model->data_order_by('fts_register_type',"category_register","asc");
          $data['section_name']=$this->General_model->data_order_by('fts_section',"sec_name","asc");
            $data['designation']=$this->General_model->data_order_by('fts_designation',"desig_name","asc");
           $data['data_value']=$this->General_model->view_data('fts_file_registration',array('file_id'=>$fid));
           $content=$this->load->view('file_registration/upload',$data,true);
           render($content);
          //}
        

      } 
	
  public function attach_note_toFile($fid) { 
         
         $data['active']='';
         //if($this->File_model->check_file_register($fid)>0)
          //{
            $data['authority']=$this->General_model->view_all_data('fts_authority');
            $data['designation']=$this->General_model->view_all_data('fts_designation');
             $data['register']=$this->General_model->view_all_data('fts_letter_register');
			 $data["user"] = $this->General_model->data_order_by('fts_user',"name","asc");
              $data["results"] = $this->File_model->file_dispatch($fid);
			  $data["file_note"] =$this->File_model->file_note($fid);
           $data['data_value']=$this->General_model->view_data('fts_file_registration',array('file_id'=>$fid));
           $content=$this->load->view('file_registration/file_note',$data,true);
           render($content);
          //}
        

      }

	public function update_pr_report($fid,$pr_id)
	{
		$this->load->model('User_model');
		$userId = $this->session->userdata('user_id');
		
		$userSec = $this->User_model->usr_section($userId);
		$checkUserHasAccess = $this->File_model->checkPrEditAccess($userSec[0]['sec_id'],$userId,$fid,$pr_id);
		//echo '<pre>'; print_r($checkUserHasAccess); die;
		if($checkUserHasAccess)
		{
			//echo "<script>alert('Sorry!! you have no access to change this file..'); </script>";
			// redirect('File_inbox');
			$this->session->set_flashdata('pr_report_error', 'Sorry!! you have no access to change this file.');
			//exit;
			
			$fidCode = id_encrypt($fid);
			redirect('file_inbox/file_view_crime/?fid='.$fidCode, 'refresh');
		}
		
		$data['sub']=$this->File_model->fetch_sub($fid);
			
		$data['results']=$this->File_model->fetch_pr_data($fid);
		$data['invt']=$this->File_model->fetch_inv_data($fid);
		$data['acc']=$this->File_model->fetch_pr_accused($fid);
		$data['sei']=$this->File_model->fetch_pr_seizure($fid);
		$data['arr']=$this->File_model->fetch_pr_arrest($fid);
		$data['witn']=$this->File_model->fetch_pr_witness($fid);
		
		$data['fid']=$fid;
		$data['pr_id']=$pr_id;
		$data['user']=$this->User_model->fetch_co();
		
		$content=$this->load->view('file_registration/update_progress_report',$data,true);
		render($content);
	}


	public function attach_pro_report($fid,$pr_id="",$indication='') { 
         
          
         $data['active']='';
		 //echo $pr_id;exit;
		 $data['pr_id']=$pr_id;
		 $rank=2;
		 $this->load->model('User_model');
            $data['sub']=$this->File_model->fetch_sub($fid);
            
            $draftPrData = $this->File_model->getPrDraftData($fid);
             /**if ($_SERVER['REMOTE_ADDR'] == '117.248.148.47') {  
						//echo "<pre>"; print_r($draftPrData['draft_res']); exit;
					//echo $draftPrData['draft_res']; exit;
					$dataarr = json_decode($draftPrData['draft_res']);
					
						
						echo "<pre>";
						print_r($dataarr); exit;
					} **/
            $data['acc_d'] = array();
			$data['sei_d'] = array();
			$data['arr_d'] = array();
			$data['witn_d'] = array();
			$data['invt_d'] = array();
			$data['draftValue'] = 0;
			
			if(count($draftPrData) > 0)
		    {
		        $draftVal = json_decode($draftPrData['draft_res'], true); 
		        $data['results'][0] = $draftVal['basic'];
		        $data['invt'][0] = $draftVal['invest'];
		        
		        $data['acc_d'] = $draftVal['accused'];
				$data['sei_d'] = $draftVal['seizure'];
				$data['arr_d'] = $draftVal['arrest'];
				$data['witn_d'] = $draftVal['wit'];
				$data['invt_d'] = $draftVal['invest'];
				
				$data['draftValue'] = 1;
		        
		    }
			else {
			    $data['results']=$this->File_model->fetch_pr_data($fid);
			    $data['invt']=$this->File_model->fetch_inv_data($fid);
			}
                $data['acc']=$this->File_model->fetch_pr_accused($fid);
			   
			    $data['sei']=$this->File_model->fetch_pr_seizure($fid);
			    $data['arr']=$this->File_model->fetch_pr_arrest($fid);
			    $data['witn']=$this->File_model->fetch_pr_witness($fid);
			   
			    $fid=array(file_name_folder($fid));
			
			    $data['fid']=$fid;
			   
			   
			    $data['user']=$this->User_model->fetch_co();
			
		        $data['indication'] = $indication;
		 
                $content=$this->load->view('file_registration/progress_report',$data,true);
                render($content);

      } 
	 public function pr_save_as_draft_ajax()
	{
		$dataResult = 0;
		if(isset($_POST))
		{
			//echo '<pre>'; print_r($_POST); die;
			$data = array();
			
			$file_id = $this->input->post('file_id',TRUE);
			
			$data['file_ref_sl_no'] = $this->input->post('file_ref_sl_no',TRUE);
			$data['folder_name'] = $this->input->post('folder',TRUE);
			$data['pr_no'] = $this->input->post('pr_no',TRUE);
			
			if($this->input->post('pr_date',TRUE) != '') {
				$data['pr_date'] = dt_format($this->input->post('pr_date',TRUE));
			} else {
				$data['pr_date'] = '';
			}
			
			$data['case_no'] = $this->input->post('case_no',TRUE);
			if($this->input->post('case_date_reg',TRUE) != '') {
				$data['case_date_reg'] = dt_format($this->input->post('case_date_reg',TRUE));
			} else {
				$data['case_date_reg'] = '';
			}
			
			$data['under_sec'] = $this->input->post('under_sec',TRUE);
			$data['io_name'] = $this->input->post('io_id',TRUE);
			$data['io_email'] = $this->input->post('io_email',TRUE);
			$data['io_contact'] = $this->input->post('io_contact',TRUE);
			$data['email'] = $this->input->post('email',TRUE);
			$data['phone'] = $this->input->post('phone',TRUE);
			$data['name_co'] = $this->input->post('name_co',TRUE);
			$data['control_ord_no'] = $this->input->post('control_ord_no',TRUE);
			$data['po'] = $this->input->post('po',TRUE);
			
			$data['ord_no'] = $this->input->post('ord_no',TRUE);
			$data['from_cd'] = $this->input->post('from_cd',TRUE);
			$data['to_cd'] = $this->input->post('to_cd',TRUE);
			$data['cd_date'] = $this->input->post('cd_date',TRUE);
			
			$data['do'] = $this->input->post('do',TRUE);
			
			
			if($this->input->post('date_assum_cid',TRUE) != '') {
				$data['date_assum_cid'] = dt_format($this->input->post('date_assum_cid',TRUE));
			} else {
				$data['date_assum_cid'] = '';
			}
			
			
			$data['gist_fir'] = $this->input->post('gist_fir',TRUE);
			$data['io_id'] = $this->input->post('io_id',TRUE);
			
			$total['basic'] = $data;
			
			
			$acc_name=$this->input->post('accused_name',TRUE);
			$acc_father=$this->input->post('accused_fname',TRUE);
			$crm_ant_acc=$this->input->post('crm_antecedent_accused',TRUE);
			$acc_add=$this->input->post('accused_add',TRUE);
			
			$accused=array();
			
			
			
			if(isset($acc_name) && count($acc_name)>0){
				foreach($acc_name as $key=>$val){
				$accused[]=array(
						"accussed_id"=>0,
						"accussed_name"=>$acc_name[$key],
						"accus_father"=>$acc_father[$key],
						"crm_antecedent_accused"=>$crm_ant_acc[$key],
						"accus_addr"=>$acc_add[$key]
					);
				}
			}
			$total['accused'] = $accused;
			
			
			$seize=$this->input->post('seizure',TRUE);
			$seizure_date=$this->input->post('seizure_date',TRUE);
			$seizure_time=$this->input->post('seizure_time',TRUE);
			$seize_witt=$this->input->post('seizure_wit',TRUE);
			
			$seizure=array();
			
			
			
			if(isset($seize) && count($seize)>0){
				foreach($seize as $key=>$val){
					$seiz=array(
						"seizure_id"=>0,
						"desc_seize"=>$seize[$key],
						"seizure_time"=>$seizure_time[$key],
						"seizure_witness"=>$seize_witt[$key]
					);
					
					if($seizure_date[$key] != '') {
						$seiz["seizure_date"] = dt_format($seizure_date[$key]);
					} else {
						$seiz["seizure_date"] = '';
					}
					$seizure[] = $seiz;
			   }
			}
			$total['seizure'] = $seizure;
			
			
			
			$personw=$this->input->post('wit_person',TRUE);
			$witness=$this->input->post('witness',TRUE);
			$wit_date=$this->input->post('wit_date',TRUE);
			
			$wit=array();
			
			
			
			if(isset($personw) && count($personw)>0){
				foreach($personw as $key=>$val){
					$w=array(
						"witness_id"=>0,
						"wit_name"=>$personw[$key],
						//"wit_date"=>dt_format($wit_date[$key]),
						"gist_state"=>$witness[$key]
					);
					
					if($wit_date[$key] != '') {
						$w["wit_date"] = dt_format($wit_date[$key]);
					} else {
						$w["wit_date"] = '';
					}
					$wit[] = $w;
				}
			}
			$total['wit'] = $wit;
			
			$person=$this->input->post('arrest_person',TRUE);
			$acc_fname=$this->input->post('arr_fname',TRUE);
			$arrest_date=$this->input->post('arr_date',TRUE);
			$acc_address=$this->input->post('arr_address',TRUE);
  
			$arrest=array();
			
			if(isset($person) && count($person)>0){
				foreach($person as $key=>$val){
					$arrs=array(
							"arrest_id"=>0,
							"arrest_name"=>$person[$key],
							"arrest_father"=>$acc_fname[$key],
							"arrest_addr"=>$acc_address[$key]
						);
					if($arrest_date[$key] != '') {
						$arrs["arrest_date"] = dt_format($arrest_date[$key]);
					} else {
						$arrs["arrest_date"] = '';
					}
					$arrest[] = $arrs;
				}	
			}
			$total['arrest'] = $arrest;
			
			$other_step=$this->input->post('other_step',TRUE);
			$fact_invest=$this->input->post('fact_invest',TRUE);
			$dev_in_case=$this->input->post('dev_in_case',TRUE);
			$crim_gang=$this->input->post('crim_gang',TRUE);
			 
			$invest=array(
						"other_step"=>$other_step,
						"fact_invest"=>$fact_invest,
						"dev_in_case"=>$dev_in_case,
						"crim_gang"=>$crim_gang
					);
			
			$total['invest'] = $invest;
			
			$draftValue = json_encode($total);
			$dataResult = $this->File_model->savePrDraft($file_id,$draftValue);
		}
		echo json_encode($dataResult); exit;
	}
	
    public function add_note($file_id)
  {
	  
        $data['active']='user_list';
        
        //$receiver=$this->File_model->section_and_desig($this->session->userdata('user_id'));
       $data["results"] = $this->File_model->file_dispatch($file_id);
	   
        $this->load->library('form_validation');
       // $folder_name=$data["results"][0]['folder_name'].'/note';
		//print_r($folder_name);exit;
                    
                           	 $note_text=$this->input->post('note');
                 
						   $currentDateTime = date("H:i");
						$newTime = date('h:i A', strtotime($currentDateTime));
                   //echo($newTime);exit;
       $this->form_validation->set_rules('usr_id', 'User Name is required','required');
        $note_data=array(
                             "note_text"=>$note_text,
							 "nsp_id"   =>strtoupper($this->input->post('nsp1',TRUE)),
							 "to_nsp"   =>trim(strtoupper($this->input->post('nsp2',TRUE))),
							 "multi_notesheet"=>0,
                             "signature"=>$this->input->post('sig',TRUE),
							//"signature"=>$auth,
							 //"note_dt" =>date('Y-m-d'),
							"note_dt" =>dt_format($this->input->post('issue_dt',TRUE)),
							 "note_time"=>$newTime,
                             "file_ref_sl_no"=>$this->input->post('file_ref_sl_no',TRUE),
                             "file_id"=>$file_id,
                             "user_id"=>$this->input->post('usr_id',TRUE),
								//"user_id"=>$this->session->userdata('user_id'),
                             "note_type"=>$this->input->post('note_type',true)
                     );
         if ($this->form_validation->run() == TRUE)
                {

                if($this->input->post('add_note',true))
				{
					//exit;
					$note_data['is_draft']=0;
					$note_id=$this->General_model->insert_data('fts_file_note',$note_data);
					$data["msg"]="Note is successfully added.";
				}
				//print_r($this->input->post('add_note',true));exit;
				if($this->input->post('save_draft',true))
				{
					//exit;
					if($this->input->post('notid',TRUE))
					{
						$note_data['is_draft']=1;

						$this->General_model->update_data('fts_file_note',$note_data,array('note_id'=>$this->input->post('notid',TRUE)));
					}
					else
					{
					$note_data['is_draft']=1;

					$note_id=$this->General_model->insert_data('fts_file_note',$note_data);
					//print_r($note_id);exit;
					}
					$data["msg"]="Note is successfully added as draft.";
					 //redirect('file_inbox/dispatch');
					
				}

				if($this->input->post('dispatch',true))
				{
					//exit;
					if($this->input->post('notid',TRUE))
					{
						$note_data['is_draft']=1;

						$this->General_model->update_data('fts_file_note',$note_data,array('note_id'=>$this->input->post('notid',TRUE)));
					}
					else
					{
					$note_data['is_draft']=1;

					$note_id=$this->General_model->insert_data('fts_file_note',$note_data);
					//print_r($note_id);exit;
					}
					
					 redirect(base_url()."file_inbox/dispatch/".$file_id);
					
				}



					//print_r($note_id);exit;
				//$draft_note =$this->File_model->draft_note($note_id);
				//print_r($draft_note);exit;




                        //$note_id=$this->General_model->insert_data('fts_file_note',$note_data);
                         login_log(doctype_action('FN'),'F',$file_id);
                         //redirect('file_inbox/dispatch_success');
                         
                         $data["title"]="Success";
                     $content=$this->load->view('common/result_page',$data,true);
                      render($content);


                }
				
    
  }

 public function add_final_report($file_id)
  {
      
        $data['active']='user_list';
        
        //$receiver=$this->File_model->section_and_desig($this->session->userdata('user_id'));
       
        $this->load->library('form_validation');
        
        //$this->form_validation->set_rules('doc_type', 'doc_type is required','required');
         $this->form_validation->set_rules('finalize_dt', 'Date is required','required');
          //$this->form_validation->set_rules('pr_des', 'remarks is required','required');
           $this->form_validation->set_rules('sender_name', 'signature is required','required');
            $this->form_validation->set_rules('file_ref_sl_no', 'file_ref_sl_no is required','required');
			

			$dcon=0;
			if($this->input->post('transfered')=="DECONTROLLED")
			{
				$dcon='1';
			}
        
                                 
         if ($this->form_validation->run() == TRUE)
                {
					$final_data=array(
                                         //"note_text"=>$note_text,
                                        
										
                                        "finalize_dt"=>dt_format($this->input->post('finalize_dt',TRUE)),
                                        
                                        "final_remark"=>$this->input->post('final_remark',TRUE),
                                         "signature"=>strtoupper($this->input->post('sender_name',TRUE)),
                                         "file_ref_sl_no"=>$this->input->post('file_ref_sl_no',TRUE),
										 "handed_to"=>$this->input->post('transfered',TRUE),
										 "handed_to_other"=>$this->input->post('pl_specifyyy',TRUE),
										 "order_of_others"=>$this->input->post('ord_specify',TRUE),
										 "order_by"=>$this->input->post('order_by',TRUE),
										 "ref_no"=>$this->input->post('orderno',TRUE),
										 "handed_dt"=>dt_format($this->input->post('handed_dt',TRUE)),
                                         "file_id"=>$this->input->post('file_id', TRUE),
                                         "user_id"=>$this->session->userdata('user_id'),
										 "other_form"=>$this->input->post('specify', TRUE),
										 "dcon"=>$dcon,	
										 "dormant"=>'1',
										 
                                         //"note_type"=>$this->input->post('note_type',true)
                                 );
								 
						if($this->input->post('final_form',TRUE))
					{
						$finalFormValue = $this->input->post('final_form',TRUE);
						if($finalFormValue == 'CHARGE SHEET')
						{
							$final_data['charge_sheet'] = 1;
						}
						if($finalFormValue == 'SUPPLEMENTARY CHARGE SHEET')
						{
							$final_data['sup_chargesheet'] = 1;
						}
						if($finalFormValue == 'FRT')
						{
							$final_data['frt'] = 1;
						}
						if($finalFormValue == 'FRMF')
						{
							$final_data['frmf'] = 1;
						}
						if($finalFormValue == 'FRF')
						{
							$final_data['frf'] = 1;
						}
						if($finalFormValue == 'CIVIL IN NATURE')
						{
							$final_data['civil_in_nature'] = 1;
						}
					}	
                        $pr_id=$this->General_model->insert_data('fts_final_report',$final_data);
						$this->General_model->update_data('fts_file_registration',array('is_dormant'=>1),array("file_id"=>$file_id));
                          //login_log(doctype_action('FD'),'F',$file_id);
                         //redirect('file_inbox/dispatch_success');
                         $data["msg"]="The Document is successfully added.";
                         $data["title"]="Success";
                     $content=$this->load->view('common/result_page',$data,true);
                      render($content);return;
             }
			 
			  $data['active']='';
         // if($this->File_model->check_file_register($file_id)>0)
          // {
            $data['authority']=$this->General_model->view_all_data('fts_authority');
            $data['designation']=$this->General_model->view_all_data('fts_designation');
            $data['register']=$this->General_model->view_all_data('fts_letter_register');
            $data["results"] = $this->File_model->file_dispatch($file_id);
            $data['data_value']=$this->General_model->view_data('fts_file_registration',array('file_id'=>$file_id));
            $content=$this->load->view('file_registration/charge_sheet',$data,true);
            render($content);
          // }
    }



public function add_pro_report($file_id)
    {
       
	  
        $data['active']='user_list';
		$this->load->library('form_validation');
        
		$this->form_validation->set_rules('pr_no', 'Pr No is required','required');
		$this->form_validation->set_rules('pr_date', 'Pr Date is required','required');
		$this->form_validation->set_rules('case_no', 'Fir/Case No is required','required');
		$this->form_validation->set_rules('case_date_reg', 'Date of registration is required','required'); 
		$this->form_validation->set_rules('under_sec', 'Under case is required','required');

		$this->form_validation->set_rules('io_email', 'IO Email is required','required');
		$this->form_validation->set_rules('io_contact', 'IO Contact is required','required');
		$this->form_validation->set_rules('name_co', 'CO Name is required','required');
		$this->form_validation->set_rules('po', 'Place of occurence is required','required');
		$this->form_validation->set_rules('do', 'Date of occurence is required','required');
		$this->form_validation->set_rules('date_assum_cid', 'Date of assumption is required','required');
		$this->form_validation->set_rules('date_assum_cid', 'Date of assumption is required','required');
		$this->form_validation->set_rules('gist_fir', 'GIST of the FIR is required','required');
	    
		$folder_name=$this->input->post('folder', TRUE);
		$folder_full=$folder_name.'/'.'fir';
        if (!is_dir($folder_full)) {
                @mkdir($folder_full, 0777, true);
		}
		$fir_file = '';
		$config['upload_path']          = $folder_full.'/';
		$config['allowed_types']        = 'pdf';
		$config['max_size']             = 1000;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);
						
			if ($this->form_validation->run() == TRUE)
			{
				
				$pr_data=array(
					"file_ref_sl_no"=>$this->input->post('file_ref_sl_no', TRUE),
					"pr_no"=>$this->input->post('pr_no',TRUE),
					"pr_date"=>dt_format($this->input->post('pr_date',TRUE)),
					"case_no"=>$this->input->post('case_no',TRUE),
					"case_date_reg"=>dt_format($this->input->post('case_date_reg',TRUE)),
					"under_sec"=>$this->input->post('under_sec',TRUE),
					"name_co"=>$this->input->post('name_co',TRUE),
					"po"=>$this->input->post('po', TRUE),
					"do"=>($this->input->post('do', TRUE)),
					"from_cd"=>($this->input->post('from_cd', TRUE)),
					"to_cd"=>($this->input->post('to_cd', TRUE)),
					"cd_date"=>($this->input->post('cd_date', TRUE)),
					"date_assum_cid"=>dt_format($this->input->post('date_assum_cid',TRUE)),
					"file_id"=>$file_id,
					"user_id"=>$this->session->userdata('user_id',true),
					"gist_fir"=>$this->input->post('gist_fir',TRUE),
					"control_ord_no"=>$this->input->post('control_ord_no',TRUE),
				);
					
				$io_details=array(
					"case_no"=>$this->input->post('case_no',TRUE),
					"io_name"=>$this->input->post('io_id',TRUE),
					"io_email"=>$this->input->post('io_email', TRUE),
					"ord_no"=>$this->input->post('ord_no', TRUE),
					"io_contact"=>$this->input->post('io_contact', TRUE)
				);
				$io_history=array(
					"file_id"=>$file_id,
					"case_no"=>$this->input->post('case_no',TRUE),
				//	"ord_no"=>$this->input->post('ord_no', TRUE),
					"pr_date"=>dt_format($this->input->post('pr_date',TRUE))
				);
				
				//e
				//echo("okkk");
				if(isset($folder_name)){
					//echo("fgggggg");
					if (!$this->upload->do_upload('firupload'))
					{
						// echo("tttt");
						$error = $this->upload->display_errors();
						//$error =implode('<br>',$error);
						$this->session->set_flashdata('error_message', $error);
						$this->attach_pro_report($file_id); exit;
					}
					$uploadData = $this->upload->data();
				   //echo("wwwww");
					if(isset($uploadData['orig_name']) && strlen($uploadData['orig_name']) > 0) {
						// echo("qqqqq");
						$fir_file=$folder_full.'/'.$uploadData['orig_name'];
						if(is_executable($fir_file)){
							@unlink($fir_file);
							$this->attach_pro_report($file_id);
							exit;
						}
					}
				}
				//echo("ddddddd");
				
				$pr_data['fir_folder'] = $fir_file;
				$io_id=$this->General_model->insert_data('fts_pr_io_details',$io_details);
				$pr_data["io_id"]=$io_id;
				$pr_id=$this->General_model->insert_data('fts_pr_report',$pr_data);
				$io_history=array(
					"io_id"=>$io_id,
					"pr_id"=>$pr_id
				);
				$io_id=$this->General_model->insert_data('fts_pr_io_history',$io_history);	
				login_log(doctype_action('FD'),'F',$file_id);
				return $pr_id;
			}		
						
						
	}
			

	public function add_accused_report($pr_id,$file_id)
    { 
		
	  
        $data['active']='user_list';	
				$acc_name=$this->input->post('accused_name',TRUE);
				$acc_father=$this->input->post('accused_fname',TRUE);
				$crm_ant_acc=$this->input->post('crm_antecedent_accused',TRUE);
			    $acc_add=$this->input->post('accused_add',TRUE);
				
				$acc_id1=$this->input->post('acc_id1',TRUE);
				
					
					$accused=array();
					$accussed_id=array();
					if(isset($acc_name) && count($acc_name)>0){
						foreach($acc_name as $key=>$val){
						$accused[]=array(
											 
											
											"accussed_name"=>$acc_name[$key],
											"accus_father"=>$acc_father[$key],
											"crm_antecedent_accused"=>$crm_ant_acc[$key],
											"accus_addr"=>$acc_add[$key],
											"pr_id"=>$pr_id
										);
						}
						
						$this->db->insert_batch('fts_pr_accussed_det',$accused);
						
					}
						
					$acc_rel=array();
					//print_r(($acc_id1));exit;
					if(isset($acc_id1) || count($acc_id1)>0){
						//print_r($acc_id1);exit;
						foreach($acc_id1 as $key=>$val){
							
						$acc_rel[$key]=array(
											"accussed_id"=>$val,
											"pr_id"=>$pr_id
										);
						}				
						$acc_id_in=$this->db->insert_batch('fts_pr_accus',$acc_rel);
						
					} 	
					login_log(doctype_action('FD'),'F',$file_id);
									
	}

			
								
	public function add_seizure_report($pr_id,$file_id)
    {
      
	  
        $data['active']='user_list';
		
				$seize=$this->input->post('seizure',TRUE);
				$seizure_date=$this->input->post('seizure_date',TRUE);
				
				$seize_witt=$this->input->post('seizure_wit',TRUE);
				
			   $seize1=$this->input->post('sei_id1',TRUE);
				$seizure_time=$this->input->post('seizure_time',TRUE);
				
				
				
				
				$seizure=array();
				$seizure_id=array();
					if(isset($seize) && count($seize)>0){
						foreach($seize as $key=>$val){
							$seizure[]=array(
										"desc_seize"=>$seize[$key],
										"seizure_date"=>dt_format($seizure_date[$key]),
										"seizure_time"=>$seizure_time[$key],
										"seizure_witness"=>$seize_witt[$key],
										"pr_id"=>$pr_id
									);
					   }
					    $this->db->insert_batch('fts_pr_seizure_det',$seizure);
						
					}
						
					
					$seizure1=array();
					//print_r(($seizure_id2));exit;
					if(isset($seize1) || count($seize1)>0){
						
						foreach($seize1 as $key=>$val){
							//print_r($val);exit;
						    $seizure1[$key]=array(
											"seizure_id"=>$val,
											"pr_id"=>$pr_id
										);
						}
						$seizure_id1=$this->db->insert_batch('fts_pr_seizure',$seizure1);
					} 
	   				
                        
                        login_log(doctype_action('FD'),'F',$file_id);
						
	}							
		


			public function add_arrest_report($pr_id,$file_id)
			{
				
	  
				$data['active']='user_list';
      
				$person=$this->input->post('arrest_person',TRUE);
				$acc_fname=$this->input->post('arr_fname',TRUE);
				
				$arrest_date=$this->input->post('arr_date',TRUE);
				$acc_address=$this->input->post('arr_address',TRUE);
      
				$person1=$this->input->post('arr_id1',TRUE);
	  
				$arrest=array();
				$arrest_id=array();
					if(isset($person) && count($person)>0){
						foreach($person as $key=>$val){
								$arrest[]=array(
                                         
                                        
										"arrest_name"=>$person[$key],
										"arrest_father"=>$acc_fname[$key],
										"arrest_date"=>dt_format($arrest_date[$key]),
										"arrest_addr"=>$acc_address[$key],
										"pr_id"=>$pr_id
									);
						}
					
						$this->db->insert_batch('fts_pr_arrest_det',$arrest);
						
					}
					if(isset($person1) || count($person1)>0){
						
						foreach($person1 as $key=>$val){
							
						    $arres1[$key]=array(
											"arrest_id"=>$val,
											"pr_id"=>$pr_id
										);
						}
						$arrest_id1=$this->db->insert_batch('fts_pr_arrest',$arres1);
						
					} 
	   				
						login_log(doctype_action('FD'),'F',$file_id);
						
									
	}
				                      
                                         
								 
		public function add_witness_report($pr_id,$file_id)
				{
					
					
	  
					$data['active']='user_list';
      
       
				$personw=$this->input->post('wit_person',TRUE);
				$witness=$this->input->post('witness',TRUE);
				$wit_date=$this->input->post('wit_date',TRUE);
				$personw_id=$this->input->post('wit_id1',TRUE);
				
				
			   $wit=array();
			   $witness_id=array();
					if(isset($personw) && count($personw)>0){
						foreach($personw as $key=>$val){
							$wit[]=array(
												 
												
										"wit_name"=>$personw[$key],
										"wit_date"=>dt_format($wit_date[$key]),
										"gist_state"=>$witness[$key],
										"pr_id"=>$pr_id
									);
						}
						$this->db->insert_batch('fts_pr_witness_det',$wit);
						
					}
						
					
					
					//print_r(count($seize1));exit;
					if(isset($personw_id) || count($personw_id)>0){
						
						foreach($personw_id as $key=>$val){
							//print_r($val);exit;
						    $witness[$key]=array(
											"witness_id"=>$val,
											"pr_id"=>$pr_id
										);
						}
						$wit_id1=$this->db->insert_batch('fts_pr_witness',$witness);
					} 
				
                          login_log(doctype_action('FD'),'F',$file_id);		
             }						
											
 public function add_invest_report($pr_id,$file_id)
    {
      
	  $this->load->library('form_validation');
		$other_step=$this->input->post('other_step',TRUE);
		//echo($other_step);exit;
		$fact_invest=$this->input->post('fact_invest',TRUE);
		$dev_in_case=$this->input->post('dev_in_case',TRUE);
		$crim_gang=$this->input->post('crim_gang',TRUE);
		$inv_id=$this->input->post('invt_id1',TRUE);
		 
		$invest_id=array();
		$invest_arr=array();
		
					$invest=array(
						"other_step"=>$other_step,
						"fact_invest"=>$fact_invest,
						"dev_in_case"=>$dev_in_case,
						"crim_gang"=>$crim_gang,
						"pr_id"=>$pr_id
					);
						/**$this->db->insert_batch('fts_pr_investigation_det',$invest);**/
						
					$this->General_model->insert_data('fts_pr_investigation_det',$invest);
						
						//print_r($seizure_new);exit;
					

					//print_r(count($seize1));exit;
				
						login_log(doctype_action('FD'),'F',$file_id);
	}

     public function do_upload($fid) {


		include APPPATH.'/libraries/pdfparser/vendor/autoload.php';
		include APPPATH.'/libraries/merge/vendor/autoload.php';
		require_once (APPPATH.'/libraries/merge/FPDI/fpdi.php');
		require_once(APPPATH.'/libraries/merge/FPDI/fpdf.php');
		


       $this->load->library('form_validation');
                       $this->form_validation->set_rules('issue_dt', 'issue_dt', 'required');
                        $this->form_validation->set_rules('authority', 'sending_authority', 'required');
                        if(trim($this->input->post('receiver_address', TRUE))==""){
							$this->form_validation->set_rules('designation', 'Addressed to Designation', 'required');
                        }
                        $this->form_validation->set_rules('ltr_sub', 'Subject', 'required');      
                       
                      
//new field for others....        
        $data['data_value']=$this->General_model->view_data('fts_file_registration',array('file_id'=>$fid));
        
         $data['authority']=$this->General_model->view_all_data('fts_authority');
         $data['designation']=$this->General_model->view_all_data('fts_designation');
          $data['register']=$this->General_model->view_all_data('fts_letter_register');
        
         if($this->input->post('authority', TRUE)=="add_authority_name")
          {
                  
              $this->form_validation->set_rules('add_authority_name', 'add_authority_name','required|is_unique[fts_authority.authority_name]',array('is_unique'=> 'This is already exists.'));
             }
        
        
                if ($this->form_validation->run() == FALSE)
                {
                        $content=$this->load->view('file_registration/upload', $data,true); 
                         render($content);
                }
                else
                {
                $authority_id='';

                  if($this->input->post('authority_id', TRUE)=="add_authority_name")
                  {
					  //echo("ok1");exit;
                    $auth_add=array("authority_name"=>$this->input->post('add_authority_name', TRUE));
                    $authority_id=$this->General_model->insert_data('fts_authority',$auth_add);  
                  }
                  else
                  {
					 // echo("ok2");
                    $authority_id=$this->input->post('authority', TRUE);
					//echo($authority_id);exit;
                  }

      
         
            $uid=$this->input->post('user_id');
                     if($uid == NULL)
                        $uid=0;
               //print_r(count($_FILES));exit;       
         if(count($_FILES) != 0){


        
                $cpt=0;
               $file_count=0;
               $config['allowed_types']= 'pdf';
               $this->load->library('upload', $config);
              
                $files = $_FILES;
                $success_file=array();
                if(isset($_FILES['letterfile']['name']))
                {
               $this->form_validation->set_rules('letterfile', 'Upload letter', 'required');
               $cpt = count($_FILES['letterfile']['name']);
                }
                

                    $m = new Merger();  
                     $cp=$this->File_model->fetch_cp($fid);

                 if($cp[0]['cp_no']>=1) 
                 {
                  
                              $cp_no=$cp[0]['cp_no']+$cp[0]['page_count']; 
                                }
                                else
                                {
                                  $cp_no=1; 
                                }
                          for($i=0; $i<$cpt; $i++)
                          {
                           $ex=pathinfo($files['letterfile']['name'][$i],PATHINFO_EXTENSION);
                              $file_name=str_replace(".".$ex,"_".time(),$files['letterfile']['name'][$i]).'.'.$ex;  
                               
                              $_FILES['letterfile']['name']= $file_name;
                              $_FILES['letterfile']['type']= $files['letterfile']['type'][$i];
                              $_FILES['letterfile']['tmp_name']=$files['letterfile']['tmp_name'][$i];
                              $_FILES['letterfile']['error']= $files['letterfile']['error'][$i];
                              $_FILES['letterfile']['size']= $files['letterfile']['size'][$i];    

                              $this->upload->initialize($this->set_upload_options());
                              
                             
                              $m->addFromFile($files['letterfile']['tmp_name'][$i]);
                               
                           
                      			}
                            $pdf_name=time().'.pdf';
                            $folder_name=$data['data_value'][0]['folder_name'];
                            $pdf_path_name=$folder_name.'/'.$pdf_name;
                            file_put_contents($pdf_path_name, $m->merge());
                            // if ( $this->upload->do_upload($pdf_name)) {
                                         // $path='repository/'.$this->dir.'/'. $pdf_name;
                                          $page=$this->getNumPagesPdf($pdf_path_name); 

                                           $parser = new \Smalot\PdfParser\Parser();
                                           $pdf    = $parser->parseFile($pdf_path_name);
                                           $text = $pdf->getText();
                                          // $text=preg_replace('/\s+/', '',$text);

                           // $reg_type_id=substr($this->input->post('ref_sl'), 1);
            }
            else{
              $pdf_name="";
                            $folder_name="";
                            $pdf_path_name="";
                            $text="";
                            $cp_no=0;
                            $page=0;
            }
                     if($this->input->post('user_id') == "" || $this->input->post('user_id') == NULL)
                         $uid=0;

                    $attach=array( 
                      "file_id"=>$fid,
                      "memo_no"=>$this->input->post('memono',true),
                      "sl_no"=>$this->input->post('slno'),
					  "cp_no_from"  =>$this->input->post('ltr_cp_from',true),
					  "cp_no_to"  =>$this->input->post('ltr_cp_to',true),
                       "register_id"=>$this->input->post('letter_cat',true),
                      //  "reg_type_id"=>$reg_type_id,
                      // "ref_serial"=>$reg_type_id,
                      "issue_dt"=>dt_format($this->input->post('issue_dt',true)),
                      "sending_authority"=>$authority_id,
                      "subject"=>$this->input->post('ltr_sub',true),
                      "addressing_desig_id"=>$this->input->post('designation',true)?$this->input->post('designation',true):0,
					  "ext_receiver"	=>$this->input->post('receiver_address',true),
                      "addressing_user_id"=>$uid,
                      "reg_dt"=>date('Y-m-d'),
                      "user_id"=>$this->session->userdata('user_id',true),
                      "location_path"=>"",
                      "letter_name"=>$pdf_name,
                     
                      "page_count"=>$page,
                      "content"=>strtolower($text),
                      "regis_status"=>'F'
                      );
             //echo $files['letterfile']['name'][$i];
          //  $success_file[$i]=$files['letterfile']['name'][$i];
             //$file_count++;
			 
			 $external_reciver_data=array(
                                             
                                             "organization"=>$this->input->post('receiver_name', TRUE),
                                             "address"=> preg_replace('/\s\s+/', ' ',$this->input->post('receiver_address', TRUE))
                                             
                                             );
											 
         if( $this->General_model->insert_data('fts_letter_record',$attach))
         {
			  if(trim($this->input->post('receiver_address', TRUE))!="")
                                 {
                                  
                                  $address=preg_replace('/\s\s+/', ' ',$this->input->post('receiver_address', TRUE));
								$this->load->model('Letter_model');
                                  if($this->Letter_model->extranal_address_exists($address))
                                  {
                                  $this->General_model->insert_data('fts_external_address',$external_reciver_data);
                                  }
                                 }
          login_log(doctype_action('FL'),'F',$fid);
           $data["msg"]="Page attached successfully.";
          $data["title"]="Success";
          $this->success_p($data);

          
        }
         
			}
         
      } 


      private function set_upload_options()
{   
    //upload an image options
    $config = array();
    //$config['upload_path'] ='repository/'.$this->dir;
    $config['allowed_types'] = 'pdf';
    $config['max_size']      = '800000';
    $config['overwrite']     = FALSE;

    return $config;
}

public function success_p($data)
{
  
  $content=$this->load->view('common/result_page',$data,true);
                          render($content);
                               
} 
public function getNumPagesPdf($path){
    $fp = @fopen(preg_replace("/\[(.*?)\]/i", "",$path),"r");
    $max=0;
    while(!feof($fp)) {
            $line = fgets($fp,255);
            if (preg_match('/\/Count [0-9]+/', $line, $matches)){
                    preg_match('/[0-9]+/',$matches[0], $matches2);
                    if ($max<$matches2[0]) $max=$matches2[0];
            }
    }
    fclose($fp);
    if($max==0){
        $im = new imagick($path);
        $max=$im->getNumberImages();
    }

    return $max;
}
   public function file_list() { 
         
      $config = array();
        $config["base_url"] = base_url() . "attach_to_file/file_list";
        $config["total_rows"] = $this->File_model->registered_file_count();
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
        $data["results"] = $this->File_model->fetch_file_data($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        
        $data['active']='file_list_page';
    $content=$this->load->view('file_inbox/file_list',$data,true);
    render($content);


      } 
} 

?>