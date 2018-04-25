<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'/libraries/pdfparser/vendor/autoload.php';
include APPPATH.'/libraries/merge/vendor/autoload.php';
require_once (APPPATH.'/libraries/merge/FPDI/fpdi.php');
require_once(APPPATH.'/libraries/merge/FPDI/fpdf.php');
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
class Letter_registration extends MY_Controller {
 
 	function __construct()
    {
	parent::__construct();
	$this->load->model(array('Letter_model','User_model','General_model'));
	$this->load->library("pagination");
  //$this->user_details=check_user_page_access();
  
    }


public function index()
	{
    
        
        $data['active']='registration_page';
        $data['authority']=$this->General_model->view_all_data('fts_authority');
        $data['register']=$this->General_model->data_order_by('fts_letter_register',"paper_type","asc");
        $data['section_name']=$this->General_model->data_order_by('fts_section',"sec_name","asc");
        $data['register_type']=$this->Letter_model->all_register_type();
        $data['designation']=$this->General_model->data_order_by('fts_designation',"desig_name","asc");
        $content=$this->load->view('letter_registration/upload',$data,true);
        render($content);
          
	}
public function sction_wise_pending()
  {
    $data["section"] = $this->Letter_model->access_sec($this->session->userdata('user_id'));
  }

public function letter_register()
  {
   $config = array();
        $config["base_url"] = base_url() . "letter_registration/letter_register";
        $config["total_rows"] = $this->Letter_model->users_regis_letter_count();
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
        $data["results"] = $this->Letter_model->fetch_reg_letter($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['active']='registered_letterlist';
        
        $data['currentUserRank'] = fetch_rank($this->session->userdata('user_id'));
        
        $this->session->set_userdata('page_name','reg_list');
        $content=$this->load->view('letter_registration/registered_letterlist',$data,true);
      render($content);
  }

public function letter_insert()
	{
		//echo("okkkkk");exit;
		
		check_user_page_access();
        //$data['active']='user_list';
        
        //$receiver=$this->File_model->section_and_desig($this->session->userdata('user_id'));



		

       
        $this->load->library('form_validation');
        
				$this->form_validation->set_rules('issue_dt', 'issue_dt', 'required');
				$this->form_validation->set_rules('authority', 'sending_authority', 'required');
//				if($this->input->post("addr_ext") !=1){
//				$this->form_validation->set_rules('designation[]', 'designation', 'required');
//				 }
				 $this->form_validation->set_rules('ltr_sub', 'Subject', 'required'); 
				$this->form_validation->set_rules('memono', 'Memo No', 'required|callback_memono');     
				$this->form_validation->set_rules('reg_type', 'Category of Register', 'required');


				if($this->input->post('authority', TRUE)=="add_authority_name")
                    {
                  
$this->form_validation->set_rules('add_authority_name', 'add_authority_name','required|is_unique[fts_authority.authority_name]',array('is_unique'=> 'This is already exists.'));
             }
			

			
			
			$authority_id='';
//                  if($this->input->post('authority_id', TRUE)=="add_authority_name")
//                  {
//                    
//					//alert("okkk");
//					$auth_add=array("authority_name"=>strtoupper($this->input->post('add_authority_name', TRUE)));
//                    $authority_id=$this->General_model->insert_data('fts_authority',$auth_add);  
//                  }
//                  else
//                  {
//                    $authority_id=$this->input->post('authority_id', TRUE);
//                  }




				$peti_name='';
				$peti_add='';
				$sender_email='';
				$email_add='';	

				  if($this->input->post('authority_id', TRUE)==1)
                  {
					  //echo("0kkkk");exit;
                    $peti_name=$this->input->post('petitioner_name', TRUE);
					$peti_add=$this->input->post('petitioner_add', TRUE);
					$authority_id=$this->input->post('authority_id', TRUE);
					$this->form_validation->set_rules('petitioner_name', 'Please insert petitioner name','required');
					$this->form_validation->set_rules('petitioner_add', 'Please insert petitioner address','required');

                    
                  }
                  else if($this->input->post('authority_id', TRUE)==17)
                  {
					  //echo("0kkkk");exit;
                    $sender_email=$this->input->post('email_sender_name', TRUE);
					$email_add=$this->input->post('email_add', TRUE);
					$authority_id=$this->input->post('authority_id', TRUE);
					$this->form_validation->set_rules('email_sender_name', 'Please insert sender name','required');
					$this->form_validation->set_rules('email_add', 'Please insert email','required');

                    
                  }
				  else if($this->input->post('authority_id', TRUE)=="add_authority_name")
				{
						$auth_add=array("authority_name"=>strtoupper($this->input->post('add_authority_name', TRUE)));
                    $authority_id=$this->General_model->insert_data('fts_authority',$auth_add); 
				}
                  else
                  {
                    $authority_id=$this->input->post('authority_id', TRUE);
                  }

				$folder_name='repository/letter/'.date('Y').'/'.date('m').'/'.date('d');
                      
                         if (!is_dir($folder_name))
                          @mkdir($folder_name, 0777, true);

			
			if(isset($_FILES['letterfile']['name']) && $_FILES['letterfile']['name']!=""){
				$cpt=0;
				$file_count=0;
				$this->load->library('upload');
				$files = $_FILES;
				$success_file=array();
				
				
//				if(isset($_FILES['letterfile']['name']))
//				{
//				$this->form_validation->set_rules('letterfile', 'Upload letter', 'required');
//				$cpt = count($_FILES['letterfile']['name']);
//				}


          //echo $cpt;exit; 


		 



    $m = new Merger();   
//    for($i=0; $i<$cpt; $i++)
//    {   
			$cp=1;
			$cp_no=$cp[0]['cp_no']+$cp[0]['page_count'];

			$ex=pathinfo($files['letterfile']['name'],PATHINFO_EXTENSION);
			$file_name=str_replace(".".$ex,"_".time(),$files['letterfile']['name']).'.'.$ex;  
			//echo $file_name;exit; 
			$_FILES['letterfile']['name']= $file_name;
			$_FILES['letterfile']['type']= $files['letterfile']['type'];
			// $_FILES['letterfile']['tmp_name']=$files['letterfile']['tmp_name'];
			$_FILES['letterfile']['error']= $files['letterfile']['error'];
			$_FILES['letterfile']['size']= $files['letterfile']['size'];    

        //$this->upload->initialize($this->set_upload_options());
        
       
        $m->addFromFile($files['letterfile']['tmp_name']);
         
     
          //  }
      
	  
						$pdf_name=time().'.pdf';
						$pdf_path_name=$folder_name.'/'.$pdf_name;
						file_put_contents($pdf_path_name, $m->merge());
						// if ( $this->upload->do_upload($pdf_name)) {
						// $path='repository/'.$this->dir.'/'. $pdf_name;
						$page=$this->getNumPagesPdf($pdf_path_name); 

						$parser = new \Smalot\PdfParser\Parser();
						$pdf    = $parser->parseFile($pdf_path_name);
						$text = $pdf->getText();  



        
			}
			else{
			$text ="";
			$pdf_name="";
			$folder_name="";
			$page="";
			}


			$reg_type_id=$this->input->post('ref_sl');


			//echo ("kkk".$this->form_validation->run());exit;
         if ($this->form_validation->run() == TRUE)
                {
					//echo "okkkk";exit;
					
					$letter_data=array(
                                         //"note_text"=>$note_text,

										
										"sl_no"=>$this->input->post('ref_sl'),
										"memo_no"=>$this->input->post('memono'),
										"pre_id_no"=>$this->input->post('pre_letter_no'),
										"issue_dt"=>dt_format($this->input->post('issue_dt')),
										"subject"=>$this->input->post('ltr_sub'),
										"register_id"=>$this->input->post('letter_cat'),
										"email"=>$email_add,
										"email_sender"=>$sender_email,
										"peti_name"=>$peti_name,
										"peti_address"=>$peti_add,
										//"reg_type_id"=>$this->input->post('reg_type'),
										"ref_serial"=>$reg_type_id,
										"reg_type_id"=>$this->input->post('reg_type'),
										"sending_authority"=>$authority_id,
										//"authority_name"=>$auth_add,
										"user_id"=>$this->session->userdata('user_id'),
										//"dormant"=>'1',
										"reg_dt"=>date('Y-m-d'),
										"addressing_desig_id"=>$this->input->post('designation',true),
										"location_path"=>$folder_name,
										"letter_name"=>$pdf_name,
										"page_count"=>$page,
										"content"=>strtolower($text),
										"regis_status"=>'L',
										"letter_move_status"=>'P'
                                 );
								 
		//print_r($letter_data);exit;
		$pr_id=$this->General_model->insert_data('fts_letter_record',$letter_data);
		//$this->General_model->update_data('fts_file_registration',array('is_dormant'=>1),array("file_id"=>$file_id));
		//login_log(doctype_action('FD'),'F',$file_id);
		//redirect('file_inbox/dispatch_success');
		$data["msg"]="The Document is successfully added.";
		$data["title"]="Success";
		$content=$this->load->view('common/result_page',$data,true);
		render($content);return;

             }
		$data['active']='registration_page';
		$data['authority']=$this->General_model->view_all_data('fts_authority');
        $data['register']=$this->General_model->data_order_by('fts_letter_register',"paper_type","asc");
        $data['section_name']=$this->General_model->data_order_by('fts_section',"sec_name","asc");
        $data['register_type']=$this->Letter_model->all_register_type();
        $data['designation']=$this->General_model->data_order_by('fts_designation',"desig_name","asc");
		$content=$this->load->view('letter_registration/upload',$data,true);
        render($content);

	}

	
	
 public function success_p($data)
{
  
  $content=$this->load->view('common/result_page',$data,true);
                          render($content);
                               
}

public function almari($file_id)
  {
      
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
                        
                   }

          
    redirect('letter_registration/letter_register');
   
  }
public function edit_letters($letter_id)
	{
		//print_r($letter_id);exit;
		$data['active']='';
		$data["results"] = $this->Letter_model->fetch_letters($letter_id);
		//print_r($data["results"]);exit;
		$data['designation']=$this->General_model->data_order_by('fts_designation',"desig_name","asc");
		$content=$this->load->view('letter_registration/letter_edit',$data,true);
        render($content);
	}



	function letter_update()
  {
    $id=$this->input->post('l_id');
	$memo=$this->input->post('memo_no');
	$cpfrom=$this->input->post('ltr_cp_from');
	$cpto=$this->input->post('ltr_cp_to');
	$subject=$this->input->post('sub');
	$auth=($this->input->post('authority')=='Other')?$this->input->post('add_authority_name'):$this->input->post('authority');
	

	$data_value=array(
			"memo_no" => $memo,
			"cp_no_from" => $cpfrom,
			"cp_no_to" => $cpto,
			"subject"=> $subject,
			"sending_authority"=>$auth
			//"ext_receiver"=>$usr
			
			
          );

    
    if($this->General_model->update_data('fts_letter_record',$data_value,array('letter_id'=>$id)))
    {
      
       //$this->General_model->update_data('fts_letter_record',$data_value,array('parent_file'=>$this->input->post('letter_id')));
      //$this->session->set_flashdata('success_message', 'The Letter is updated successfully.');
      login_log(doctype_action('FE'),'F',$id, TRUE);
                  
                  redirect('letter_registration/letter_edit_success/'.$id);
                 // echo($this->input->post('letter_id', TRUE));exit; 
    }
              
                  
    
  }
  
    public function star_letter_reports()
	{
		$rating = 5;
		if($this->input->post('rating_val', TRUE))
		{
			$rating = $this->input->post('rating_val', TRUE);
		}
		$data["results"] = $this->Letter_model->fetch_star_letter_reports($rating);
		$data['active']='star_letter';
		$data['rating']= $rating;
		$content=$this->load->view('letter_registration/star_letter_reports',$data,true);
		render($content);
	}

  public function letter_edit_success()
  {
    
    $content=$this->load->view('letter_inbox/letter_success',$data=array(),true);
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

	public function search_authority()
  {
    
      check_user_page_access();
        $results= $this->Letter_model->search_authority(trim($this->input->post('keyword',TRUE)));
        //echo "<pre>";print_r($results);exit;
        foreach($results as $value)
        {
  
           echo '<li class="list-group-item" onclick="set_item('.$value["authority_id"].',\''.$value["authority_name"].'\')">'.$value["authority_name"].'</li>';
        }
        echo '<li class="list-group-item" onclick="set_item('.'\''.'add_authority_name'.'\''.',\''.'Other'.'\')">Other</li>';
		exit;	
  }

  public function lettercat()
  {
    
      
      $sl_no=$this->Letter_model->slno($this->input->post('letter_cat',TRUE))+1;
     // print_r($this->Letter_model->slno($this->input->post('letter_cat',TRUE)));exit;
      echo $sl_no;
        
      

  }

   public function registercat()
  {
    
      
      if($this->input->post('reg_type',TRUE)!="")
      {
      $ref_sl=$this->Letter_model->refno($this->input->post('reg_type',TRUE))+1;
     // print_r($this->Letter_model->slno($this->input->post('letter_cat',TRUE)));exit;
      $reg_name=$this->Letter_model->get_register($this->input->post('reg_type',TRUE));
      $ref=sprintf("%02d", $ref_sl);
      echo $ref;
    }
    else
    {
      echo "";
    }
        
      

  }


  function memono()
  {
     
    if($this->Letter_model->memono_check($this->input->post('memono',TRUE),year($this->input->post('issue_dt')),$this->input->post('reg_type',TRUE))>0)
    {
      $this->form_validation->set_message('memono', 'The {field} already exist');
      return FALSE;
    }
    else
    {
      return TRUE;
    }

  }


}
