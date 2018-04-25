<?php
class Letter_model extends CI_Model
{
    public function __construct()
    {
	parent::__construct();
    }

	
	//inbox_letter_count
    public function inbox_letter_count() {
        $user_id=$this->session->userdata('user_id');
        $query = $this->db->query("select receiver_id from fts_letter_movement where receiver_id ='$user_id' ");
        return $query->num_rows();
    }
  //sent letter
    public function sent_letter_count() {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('letter_id');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
        $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		$this->db->where('ac.action_sender ='. $this->session->userdata('user_id'));
		$this->db->where('ac.action_receiver = h.recv_id or h.sender_user_id= '. $this->session->userdata('user_id'));
        $this->db->where('ac.deadline_dt !=', '0000-00-00');
		$this->db->where('ac.action_status !=', 'C');
      
      
        $query = $this->db->get();
		
        //echo $this->db->last_query();exit;
        return $query->num_rows();

    }
	public function fetch_letters($letter_id)
	{
		$this->db->select('l.letter_id,l.cp_no_from,l.sending_authority,l.cp_no_to,l.memo_no,l.subject,l.addressing_user_id,l.ext_receiver');
        $this->db->from('fts_letter_record l');
		//$this->db->join('fts_authority a', 'l.sending_authority =a.authority_id');
        $this->db->where("(l.letter_id='$letter_id')");
		$query = $this->db->get();
        //echo $this->db->last_query();exit;
        $result=$query->result_array();
        return $result;
	}
    public function users_regis_letter_count() {
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $this->db->where('regis_status','L');
        $this->db->from('fts_letter_record');
        return $this->db->count_all_results();
        }

        public function letter_count($file_id) {
       
        $query = $this->db->query("select * from fts_letter_record where file_id='$file_id'");
        return $query->num_rows();
    }
	
	public function fetch_requests_for_approval_count()
	{
		$user_id=$this->session->userdata('user_id');
        $this->db->select('r.letter_id');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		$this->db->where('ac.action_sender ='. $this->session->userdata('user_id'));
		$this->db->where('ac.action_receiver = h.recv_id' );
        $this->db->where('ac.action_details =', 'Request Approval');
        
        $query = $this->db->get();
		
        //echo $this->db->last_query();exit;
        $result=$query->num_rows();


        return $result;
	}
	
	public function fetch_requests_for_approval_sent($limit, $start) {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.letter_id,r.subject,ac.action_remark,
	r.memo_no,r.location_path,r.reg_dt,ac.action_receiver,
	h.date_of_action,a.authority_name,ac.action_id,ac.action_status,r.issue_dt,r.subject,r.letter_name,
	h.recv_id,ac.action_details,
	ac.request_approval_status');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
        $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		$this->db->where('ac.action_sender ='. $this->session->userdata('user_id'));
		$this->db->where('ac.action_receiver = h.recv_id' );
        $this->db->where('ac.action_details =', 'Request Approval');
        $this->db->order_by("ac.trail_letter_id","asc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
		
        $result=$query->result_array();
		return $result;
	}
	
public function getAttachment($l_id) {
        //$user_id=$this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('fts_attachment_letter');
        $this->db->where("(letter_id='$l_id') ");
		
        
        $query = $this->db->get();
		
        $result=$query->result_array();
		//print_r($result);exit;
        return $result;
        }

    // fetch_file_data
    public function fetch_file_data($limit, $start) {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.file_id,r.file_ref_sl_no,r.sec_id,r.subject_id,r.file_reg_date,r.file_name,m.file_id m_file_id,m.received_date_time,m.dispatch_key,m.file_receive_key,m.file_status,m.reciver_user_id,s.subject_name,se.sec_name');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
        $this->db->join('fts_subject s', 'r.subject_id =s.subject_id','left');
        $this->db->join('fts_section se', 'r.sec_id =se.sec_id');
        $this->db->where("(r.user_id= $user_id and m.file_id is null)");
        $this->db->or_where('m.reciver_user_id', $this->session->userdata('user_id'));
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $result=$query->result_array();
        return $result;
        }
		
		
		//track file byname
		public function track_letter_byname($file_name,$limit,$start)
		{
			
        $this->db->select('r.file_id,r.file_name,r.file_ref_sl_no,r.sec_id,r.description,r.file_reg_date,r.file_name,m.from_desig_id,m.dispatch_date_time,m.received_date_time,m.reciver_user_id');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id=m.file_id','left');
        $this->db->where("(r.file_name='$file_name')");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
       //echo $this->db->last_query();
        $result=$query->result_array();
        return $result;
		}
		
		public function get_pr_path($pr_id)
		{
			
            $this->db->select('fir_folder');
            $this->db->from('fts_pr_report');
            $this->db->where("(pr_id='$pr_id')");
           
            $query = $this->db->get();
           //echo $this->db->last_query();
            $result=$query->row_array();
            return $result;
		}
		
		public function get_path($letter_name)
		{
			
        $this->db->select('location_path');
        $this->db->from('fts_letter_record');
        $this->db->where("(letter_name='$letter_name')");
       
        $query = $this->db->get();
       //echo $this->db->last_query();
        $result=$query->result_array();
        return $result;
		}
		
		//count total row using name
        public function count_letter_name($file_name)
        {
        	$query = $this->db->query("SELECT letter_id FROM fts_file_registration where file_name='$file_name'");
        	return $query->num_rows(); 
        }
		
		
//track letter bydate
        public function track_letter_bydate($from_reg_dt,$to_reg_dt,$limit,$start)
        {
            //echo($from_reg_dt.$to_reg_dt);exit;
            if(($from_reg_dt !=  NULL) && ($to_reg_dt !=  NULL)){


        $from_reg_dt=explode('/',$from_reg_dt);
         $from_reg_dt= $from_reg_dt[2].'-'.$from_reg_dt[1].'-'.$from_reg_dt[0];

         $to_reg_dt=explode('/',$to_reg_dt);
         $to_reg_dt= $to_reg_dt[2].'-'.$to_reg_dt[1].'-'.$to_reg_dt[0];

        //$this->db->select('*');
        $this->db->select('r.*,m.receiver_id,m.sender_id,m.ext_receiver,re.paper_type,au.authority_name');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_movement m', 'r.letter_id=m.letter_id','left');
        $this->db->join('fts_letter_register re', 'r.register_id=re.register_id');
        $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id');
        $this->db->where('r.reg_dt>=', $from_reg_dt);
        $this->db->where('r.reg_dt<=', $to_reg_dt);
        //$this->db->where('r.reg_dt <=', $reg_dt);
        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
       //echo $this->db->last_query();exit;
         
        $result=$query->result_array();
       
        //print_r($result);exit;
        $data=array();
        $section=array();
        $name=array();
        $file_ref=array();
        foreach ($result as $row) 
             {
                $data[] = $row;
                if($row['receiver_id']!=0)
                {
                 $name[$row['letter_id']]=$this->user_name($row['receiver_id']);
                 $sec=$this->section_and_desig($row['receiver_id']);
                 $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                 if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
                 
                 //print_r($row['file_id']);exit;
                }
                else if($row['ext_receiver']!=NULL)
                {
                   $name[$row['letter_id']]=$row['ext_receiver'];
                 
                  $section[$row['letter_id']]="";
                  
                 }
                 else
                {
                   $name[$row['letter_id']]=$this->user_name($row['user_id']);
                  $sec=$this->section_and_desig($row['user_id']);  
                  $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                  if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                }
              }
             }
  
             $data_value[0]=$data;
             $data_value[1]=$section;
             $data_value[2]= $name;
             $data_value[3]= $file_ref;
             return $data_value;
             
             }
        }


        public function get_file($file_id)
    {

        $this->db->select('file_ref_sl_no');
        $this->db->from('fts_file_registration');
        $this->db->where('file_id',$file_id);
        $query = $this->db->get();
        $result=$query->result_array(); 
		$ref="";
        //echo($result[0]['file_ref_sl_no']);exit; 
		if(isset($result) && count($result)){
			$ref=$result[0]['file_ref_sl_no'];
		}
        
        return $ref;
    }

         public function user_name($user_id)
    {
        $this->db->select('name');
        $this->db->from('fts_user');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        $result=$query->result_array();  
		if(count($result)>0){
			return $result[0]['name'];
		}
        else
			return '' ;
    }

 
        
    public function slno($register_id)
    {
       $this->db->select_max('sl_no');
       $this->db->like('reg_dt',date('Y'), 'after');
       $this->db->where('register_id',$register_id);
       $query = $this->db->get('fts_letter_record'); 
       $result=$query->row();
       //echo($this->db->last_query());exit;
       return $result->sl_no;  
    }
    
    public function refno($register_type)
    {
       $this->db->select_max('ref_serial');
       $this->db->like('reg_dt',date('Y'), 'after');
       $this->db->where('reg_type_id',$register_type);
       $query = $this->db->get('fts_letter_record'); 
       $result=$query->row();
       //echo($this->db->last_query());exit;
       return $result->ref_serial;  
    }
	
     public function get_register($reg_id)
    {
        $this->db->select('category_register');
        $this->db->from('fts_register_type');
        $this->db->where('reg_type_id',$reg_id);
        $query = $this->db->get();
        $result=$query->result_array();
        if(count($result)>0) {
            return $result[0]['category_register'];
        }
        return 0;
    }	

     public function self_check($lid)
    {
        $query = $this->db->query("SELECT * FROM fts_letter_movement where letter_id=$lid  and recv_status='S'");
        if($query->num_rows()==1)
        return 'self';
        else
        return '';    
         
    }
    public function all_register_type()
    {
        $this->load->model('User_model');
        $sec_id=$this->User_model->usr_section();
        //print_r($sec_id);exit;
        if(count($sec_id)==0){
            return $this->session->userdata('fullname');
        }
        $this->db->select('reg_type_id,category_register');
        $this->db->from('fts_register_type');
        $this->db->where('sec_id',$sec_id[0]['sec_id']);
        $query = $this->db->get();
        $result=$query->result_array();  
        //print_r($result);exit;
        return $result;
    }   
     
       //count total row using date
 public function count_letter_date($frm_dt,$to_dt)
    {
       //echo($reg_dt);exit;
       if(($frm_dt !=  NULL) && ($to_dt !=  NULL)){
        $frm_dt=explode('/',$frm_dt);
         $frm_dt= $frm_dt[2].'-'.$frm_dt[1].'-'.$frm_dt[0];

         $to_dt=explode('/',$to_dt);
         $to_dt= $to_dt[2].'-'.$to_dt[1].'-'.$to_dt[0];
        $query = $this->db->query("SELECT letter_id FROM fts_letter_record where reg_dt>='$frm_dt' and reg_dt<='$to_dt'");
        return $query->num_rows(); 
        }
    }

      //count total row using date
 public function count_letter_memo($memo,$yr)
    {
       //echo($reg_dt);exit;
       if(($memo !=  NULL) && ($yr !=  NULL)){
        

         $dt=$yr;
        $query = $this->db->query("SELECT letter_id FROM fts_letter_record where memo_no='$memo' and reg_dt like '$dt%'");
        return $query->num_rows(); 
        }
    }


//count total row using paper_type
        public function count_letter_bycategory($paper_type)
        {
            $query = $this->db->query("SELECT letter_id FROM fts_letter_record where register_id='$paper_type'");
            return $query->num_rows(); 
        }
		
//track letter bycat
        public function track_letter_bycategory($paper_type,$limit,$start)
        {
            $paper_type=$paper_type!=""?$paper_type:'NULL';
            $this->db->select('r.*,m.receiver_id,m.sender_id,m.ext_receiver,re.paper_type,au.authority_name');
            $this->db->from('fts_letter_record r');
            $this->db->join('fts_letter_movement m', 'r.letter_id=m.letter_id','left');
             $this->db->join('fts_letter_register re', 'r.register_id=re.register_id','left');
            $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id','left');
            $this->db->like('r.register_id',$paper_type);
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            $result=$query->result_array();
       
            //print_r($this->db->last_query());exit;
             $data=array();
            $section=array();
            $name=array();
            $file_ref=array();
            foreach ($result as $row) 
             {
                $data[] = $row;
                if($row['receiver_id'] !=0)
                {
                 $name[$row['letter_id']]=$this->user_name($row['receiver_id']);
                 $sec=$this->section_and_desig($row['receiver_id']);
                 $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                 if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
                }
                else if($row['ext_receiver']!=NULL)
                {
                   $name[$row['letter_id']]=$row['ext_receiver'];
                 
                  $section[$row['letter_id']]="";
                  
                 }
                 else
                {
                   $name[$row['letter_id']]=$this->user_name($row['user_id']);
                  $sec=$this->section_and_desig($row['user_id']);  
                  $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                  if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
              }
             }
  
             $data_value[0]=$data;
             $data_value[1]=$section;
             $data_value[2]= $name;
             $data_value[3]= $file_ref;
             return $data_value;
        
        }
        //count total row using category_id
 //public function count_letter_cat_id($file_subject_id)
    //{
       // $query = $this->db->query("SELECT * FROM fts_file_registration where subject_id='$file_subject_id'");
       // return $query->num_rows(); 
    //}   
        


		//track file bydescription
		public function track_letter_bydescription($description,$limit,$start)
		{
		$this->db->select('r.file_id,r.file_ref_sl_no,r.subject_id,r.file_name,r.description,m.received_date_time,m.file_id,m.from_desig_id,m.reciver_user_id,m.file_status,s.subject_name,u.name,p.sec_id');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id=m.file_id','left');
        $this->db->join('fts_personel_info p','m.reciver_user_id=p.user_id','left');
		$this->db->join('fts_subject s', 'r.subject_id=s.subject_id');
		$this->db->join('fts_user u', 'u.user_id=p.user_id');
		$this->db->like('r.description',$description);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
       //echo $this->db->last_query();
        $result=$query->result_array();
		 $data=array();
        $section=array();
        foreach ($result as $row) 
		 {
                $data[] = $row;
                $section[$row['file_id']]=$this->section_name($row['sec_id']);
             }

             $data_value[0]=$data;
             $data_value[1]=$section;
             
       return $data_value;
        
		}
		
		
		
		//count total row using subject
        public function count_letter_subject($description)
        {
            $query = $this->db->query("SELECT letter_id FROM fts_letter_record where subject='$description'");
            return $query->num_rows(); 
        }



 

        //track letter bysubject
        public function track_letter_bysubject($description,$limit,$start)
        {
            $description=$description!=""?$description:'NULL';
            $this->db->select('r.*,m.receiver_id,m.sender_id,m.ext_receiver,re.paper_type,au.authority_name');
            
            $this->db->from('fts_letter_record r');
            $this->db->join('fts_letter_movement m', 'r.letter_id=m.letter_id','left');
            $this->db->join('fts_letter_register re', 'r.register_id=re.register_id','left');
            $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id','left');
            $this->db->like('r.subject',$description);
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            $result=$query->result_array();
       
            //print_r($result);exit;
             $data=array();
            $section=array();
            $name=array();
            $file_ref=array();
            foreach ($result as $row) 
             {
                $data[] = $row;
                if($row['receiver_id'] !=0 )
                {
                 //echo("0000000");exit;
                 $name[$row['letter_id']]=($this->user_name($row['receiver_id']))?$this->user_name($row['receiver_id']):' ';
                 $sec=$this->section_and_desig($row['receiver_id']);
                 $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                  if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
                }
                else if($row['ext_receiver'] !=NULL)
                {
                   //echo("okkkk");exit;
                   $name[$row['letter_id']]=$row['ext_receiver'];
                 
                  $section[$row['letter_id']]="";
                  
                 }
                 else
                {
                    //echo("okkkk 1111");exit;
                   $name[$row['letter_id']]=$this->user_name($row['user_id']);
                  $sec=$this->section_and_desig($row['user_id']);  
                  $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                   if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
              }
             }
  
             $data_value[0]=$data;
             $data_value[1]=$section;
             $data_value[2]= $name;
             $data_value[3]= $file_ref;
             return $data_value;
        
        }

        //count total row using subject_id
 public function count_letter_sub_id($file_subject_id)
    {
        $query = $this->db->query("SELECT letter_id FROM fts_file_registration where subject_id='$file_subject_id'");
        return $query->num_rows(); 
    }   
        
        //track file bysection
        public function track_letter_bysection($sec_id,$limit,$start)
        {
        $this->db->select('r.file_id,r.file_ref_sl_no,r.sec_id,r.subject_id,r.description,r.file_reg_date,r.file_name,m.from_desig_id,m.dispatch_date_time,m.received_date_time,m.reciver_user_id,p.user_id,p.desig_id,p.sec_id,s.sec_name,u.name,m.file_status');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id=m.file_id','left');
        $this->db->join('fts_personel_info p','m.reciver_user_id=p.user_id','left');
        $this->db->join('fts_section s', 'p.sec_id=s.sec_id');
        $this->db->join('fts_user u', 'u.user_id=p.user_id');
        $this->db->where("(p.sec_id='$sec_id')");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $result=$query->result_array();
        return $result; 
        }   
        
        //count total row using sec_id
 public function count_letter_secid($file_sec_id)
    {
        $query = $this->db->query("SELECT letter_id FROM fts_file_registration where sec_id='$file_sec_id'");
        return $query->num_rows(); 
    }
        

    //file history
        public function letter_history($letter_id)
        {
        $this->db->select('*');
        $this->db->from('fts_letter_history_info h');
        $this->db->join('fts_actionable_letter a','h.trail_letter_id = a.trail_letter_id');
        $this->db->where('h.letter_id',$letter_id);
        $query = $this->db->get();
        $result=$query->result_array();
        $sender_name=array();
		$data=array();
        $reciver_name=array();
        $sender_section=array();
        $reciver_section=array();
             foreach ($result as $row) 
             {
                $data[] = $row;
                $sender_id=$row['sender_user_id'];
                $receiver_id=$row['recv_id'];
                $sender=$this->user_details($sender_id);
                $sender_name[$row['trail_letter_id']]=$sender[0]['name'];
                $sender_section[$row['trail_letter_id']]=$this->section_name($row['sender_section_id']);
                $reciver_name[$row['trail_letter_id']]="";
                //$reciver_section[$row['']]="";
                $ext_receiver=$this->fetch_ext_receiver($row['letter_id']);
                if(isset($receiver_id)&& $receiver_id !=0 )
                {
                 $receiver=$this->user_details($receiver_id);
                 $reciver_name[$row['trail_letter_id']]=$receiver[0]['name'];
                 $reciver_section[$row['trail_letter_id']]=$this->section_name($row['receiver_section_id']);
                }
                else if($ext_receiver!= "")
                {

                 $reciver_name[$row['trail_letter_id']]=$ext_receiver;
                 $reciver_section[$row['trail_letter_id']]="";
                }

            
            }
            //echo count($reciver_name);exit;
             $data_value[0]=$data;
             $data_value[1]=$sender_name;
             $data_value[2]=$reciver_name;
             $data_value[3]=$sender_section;
             $data_value[4]=$reciver_section;
             return $data_value;
             
        }


// fetch_letter_inbox
    public function fetch_letter_inbox($limit, $start) {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.letter_id,r.reg_dt, r.ref_serial, r.sl_no,t.category_register,r.location_path,r.letter_name,sending_authority,memo_no,issue_dt,subject,m.dispatch_dt_time,ac.action_remark,ac.action_details,ac.deadline_dt,m.recv_status,ac.action_id,letter_move_status,ac.action_status,u.name,m.comments,r.star_mark,r.star_given_by,xu.name AS ratingGivenUser');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_movement m', 'r.letter_id =m.letter_id');
		//$this->db->join('fts_attachment_letter att', 'm.letter_id =att.letter_id','left');
        $this->db->join('fts_user u', 'm.sender_id =u.user_id','left');
        $this->db->join('fts_register_type t', 'r.reg_type_id=t.reg_type_id','left');
        //$this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
        $this->db->join('fts_actionable_letter ac', 'm.action_id =ac.action_id','left');
        $this->db->where("(m.receiver_id='$user_id') ");
		$this->db->where("r.file_id='0'");
		
		$this->db->join('fts_user xu', 'xu.user_id =r.star_given_by','left');
		//$this->db->where("m.letter_status","R");
        //$this->db->or_where('m.receiver_id', $this->session->userdata('user_id'));
        $this->db->limit($limit, $start);
        $query = $this->db->get();
		
        //echo $this->db->last_query();exit;
        $result=$query->result_array();
		//print_r($result);exit;
		return $result;
        }


public function fetch_ext_receiver($lid) {

        
            $query =$this->db->query("select ext_receiver from  fts_letter_movement where letter_id='$lid' ");
        
        $result=$query->result_array();
       // echo $this->db->last_query();exit;
       // print_r($result);exit;
        if(is_array($result) && count($result)>0){
            return $result[0]['ext_receiver'];
        }
        else{
            return "";
        }
        
       
        }


    public function fetch_cp($fid) {

        if($this->letter_count($fid))
        {
            $query =$this->db->query("select cp_no,page_count from  fts_letter_record where cp_no in (select max(cp_no) from fts_letter_record where file_id='$fid')");
        
        $result=$query->result_array();
       // echo $this->db->last_query();exit;
        return $result;
        }
        return 0;
        }

    
    public function fetch_doc($limit, $start,$file_id) {
        
        $this->db->select('l.cp_no,l.letter_name');
        $this->db->from('fts_letter_record l');
        $this->db->where("(l.file_id='$file_id')");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $result=$query->result_array();
        return $result;
        }

        public function letter_note($file_id) {
        $this->db->select('*');
        $this->db->from('fts_file_note f');
        $this->db->where("(f.file_id='$file_id')");
        $this->db->order_by("f.note_id","desc");
        $query = $this->db->get();
        $result=$query->result_array();
        return $result;
        }

    public function fetch_reg_letter($limit,$start) {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('l.letter_id,l.reg_dt, l.ref_serial, l.sl_no ,r.paper_type,d.desig_name,t.category_register,l.location_path,l.letter_name,sending_authority,memo_no,issue_dt,a.authority_name,peti_name,peti_address,email_sender,l.email,subject,letter_move_status,l.star_mark,l.star_given_by,ux.name AS ratingGivenUser');
        $this->db->from('fts_letter_record l');
		$this->db->join('fts_user ux', 'ux.user_id =l.star_given_by','left');
		
        $this->db->join('fts_authority a', 'a.authority_id =l.sending_authority');
        $this->db->join('fts_register_type t', 't.reg_type_id =l.reg_type_id');
        $this->db->join('fts_letter_register r', 'r.register_id =l.register_id');
        $this->db->join('fts_designation d', 'l.addressing_desig_id =d.desig_id','left');
        $this->db->where("(regis_status= 'L')");
        
        $this->db->where('l.user_id',$user_id);
         $this->db->order_by("l.letter_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $result=$query->result_array();
        return $result;
        }
    
    public function fetch_star_letter_reports($rating) {
        //$user_id=$this->session->userdata('user_id');
        $this->db->select('l.letter_id,l.reg_dt, l.ref_serial, l.sl_no ,r.paper_type,d.desig_name,t.category_register,l.letter_name,l.memo_no,l.issue_dt,a.authority_name,l.subject,letter_move_status,l.star_mark,l.star_given_by,ux.name AS ratingGivenUser');
        $this->db->from('fts_letter_record l');
		
		$this->db->join('fts_user ux', 'ux.user_id =l.star_given_by','left');
		
		$this->db->join('fts_authority a', 'a.authority_id =l.sending_authority');
        $this->db->join('fts_register_type t', 't.reg_type_id =l.reg_type_id');
        $this->db->join('fts_letter_register r', 'r.register_id =l.register_id');
        $this->db->join('fts_designation d', 'l.addressing_desig_id =d.desig_id','left');
        $this->db->where("(l.regis_status= 'L')");
        //$this->db->where('l.user_id',$user_id);
		
		$this->db->where('l.star_mark',$rating);
		
		$query = $this->db->get();
        $result=$query->result_array();
        return $result;
	}

    public function get_files($pre,$post_match)
        {
            $this->db->select('fts_file_registration');
            $this->db->from('fts_file_registration');
            $this->db->like('file_ref_sl_no',$pre,'after');
            $this->db->like('file_ref_sl_no',$post_match,'before');
            $row = $this->db->count_all_results();
            return $row; 
            
        }
   public function designation($condition) 
    {   
        $this->db->where_in('desig_id',$condition); 
        $query = $this->db->get('fts_designation');
       return $query->result_array();
       //echo $this->db->last_query();
    }


    // file_dispatch
    public function letter_dispatch($letter_id) {
        $this->db->select('r.letter_id,r.pre_id_no,r.letter_name,r.memo_no,r.reg_dt,r.subject,r.sending_authority,m.sender_desig_id');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_movement m', 'r.letter_id =m.letter_id','left');
        
        $this->db->where('r.letter_id',$letter_id);
        
        $query = $this->db->get();
        $result=$query->result_array();
		//print_r($result);exit;
        return $result;
        }



      // get_user
    public function get_user($designation_id,$sec="no_sec") {
        $this->db->select('p.user_id');
        $this->db->from('fts_personel_info p');
        if($sec=="no_sec"){
           
            $this->db->where('p.desig_id',$designation_id);
        }
        else{
            
            $this->db->where('p.desig_id',trim($designation_id));
            //$this->db->where_in('p.sec_id',trim($sec));
            $this->db->where('FIND_IN_SET('.$sec.', p.sec_id)');
        }
        $query = $this->db->get();
       // echo($this->db->last_query());exit;
       $result=$query->result_array();
        $str="";
         foreach( $result as $value)
         {
            $str.=$value['user_id'].',';
         }
          
      return  $this->get_user_name($str);

        }  
        

    public function section_name($section_id)
    {
        $section_id=explode(',', $section_id);
        $this->db->select('s.sec_name');
        $this->db->from('fts_section s');
        $this->db->where_in('s.sec_id',$section_id);
        $query = $this->db->get();
        $result=$query->result_array();
        $section_name="";
         foreach ($result as $row) 
         {
            $section_name.=$row['sec_name'].',';
         }
         return $section_name;
    }
    
    public function user_details($user_id) 
    {
        
        $this->db->select('*');
        $this->db->from('fts_user u');
        $this->db->join('fts_personel_info p', 'u.user_id=p.user_id');
        $this->db->where('u.user_id',$user_id);
        $query = $this->db->get();
        $result=$query->result_array();
        return  $result;
    } 

         // get_user_name
    public function get_user_name($user_id) {
        $user_id=explode(",",$user_id);
        $this->db->select('u.name,p.user_id');
        $this->db->from('fts_user u');
        $this->db->join('fts_personel_info p', 'u.user_id=p.user_id');
        $this->db->where_in('p.user_id',$user_id);
        $query = $this->db->get();
        $result=$query->result_array();
        return  $result;
        }  

    public function section_and_desig($user_id)
    {
        $this->db->select('p.desig_id,p.sec_id');
        $this->db->from('fts_personel_info p');
        $this->db->where('p.user_id',$user_id);
        $query = $this->db->get();
        $result=$query->result_array();
        return  $result[0]; 
    }


     public function letter_id_check($letter_id)
    {
        $query = $this->db->query("SELECT * FROM fts_letter_movement where letter_id=$letter_id");
        return $query->num_rows(); 
    }

    public function desig_name($desig_id)
    {
        $desig_id=explode(',', $desig_id);
        $this->db->select('d.desig_name');
        $this->db->from('fts_designation d');
        $this->db->where_in('d.desig_id',$desig_id);
        $query = $this->db->get();
        $result=$query->result_array();
        $desig_name="";
         foreach ($result as $row) 
         {
            $desig_name.=$row['desig_name'].',';
         }
         return $desig_name;
    }

    public function attach_correspondance_page($file_id)
    {
        $query = $this->db->query("SELECT * FROM fts_letter_record where file_id=$file_id");
        return $query->num_rows(); 
    }

   public function check_letter_recive($file_id)
    { 
        $user_id=$this->session->userdata('user_id');
        $query = $this->db->query("SELECT r.file_id FROM fts_file_registration r left join fts_file_movement m  on r.file_id=m.file_id where (r.user_id=$user_id and m.file_id is null) or (m.reciver_user_id=$user_id and m.file_status='R')");
        return $query->num_rows(); 
    }

   public function almari_check($file_id,$reciver_user_id)
    {
        $query = $this->db->query("SELECT file_id FROM fts_file_movement where file_id=$file_id and reciver_user_id=$reciver_user_id and file_status='A'");
        if($query->num_rows()==1)
        return 'almari';
        else
        return 'notalmari';    
         
    }

    public function almari_check_history($file_id,$user_id)
    {
        $query = $this->db->query("SELECT * FROM fts_file_history_info where file_id=$file_id and user_id=$user_id and action_type='A'");
        if($query->num_rows()==1)
        return 'almari';
        else
        return 'notalmari';    
         
    }

     //track_letter_bymemono
        public function track_letter_bymemono($memono,$year)
        {
            $memono=$memono!=""?$memono:'NULL';
            $year=$year!=""?$year:'NULL';
        $this->db->select('r.*,m.receiver_id,m.sender_id,m.ext_receiver,re.paper_type,au.authority_name');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_movement m', 'r.letter_id=m.letter_id','left');
        $this->db->join('fts_letter_register re', 'r.register_id=re.register_id','left');
        $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id','left');
        $this->db->like("r.memo_no",$memono);
        $this->db->like('r.issue_dt',$year,'after');
        $query = $this->db->get();
       
        $result=$query->result_array();
       
        //print_r($result);exit;
        $data=array();
        $section=array();
        $name=array();
        $file_ref=array();
        foreach ($result as $row) 
             {
                $data[] = $row;
                 if($row['receiver_id']!=0)
                {
                 $name[$row['letter_id']]=$this->user_name($row['receiver_id']);
                 $sec=$this->section_and_desig($row['receiver_id']);
                 $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                 if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
                }
                else if($row['ext_receiver']!=NULL)
                {
                   $name[$row['letter_id']]=$row['ext_receiver'];
                 
                  $section[$row['letter_id']]="";
                  
                 }
                 else
                {
                   $name[$row['letter_id']]=$this->user_name($row['user_id']);
                  $sec=$this->section_and_desig($row['user_id']);  
                  $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                  if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
              }
             }
  
             $data_value[0]=$data;
             $data_value[1]=$section;
             $data_value[2]= $name;
             $data_value[3]= $file_ref;
             return $data_value;
             
        }



 


//track file bytext
        public function track_letter_bytext($text,$search_type,$limit,$start)
        {
			 $text=$text!=""?$text:'NULL';
			 $sql_str="";
			 if($search_type=="EXACT"){
				 $sql_str="content like '%".$text."%'";
			 }
			 else if($search_type=="NORMAL"){
				 $text=explode(" ",$text);

				 foreach($text as $value){
					  $sql_str.="content like '%".$value."%' and ";

				 } 
				 $sql_str=substr($sql_str,0,-4);
			 }
			if(strlen($sql_str) > 0) { 
			 $sql_str= 'WHERE '.$sql_str; 
			 
				$limitText = $start > 0?$start.','.$limit:$limit;
				$sql = "SELECT `r`.*, 
					`m`.`receiver_id`, 
					`m`.`sender_id`, 
					`m`.`ext_receiver`, 
					`re`.`paper_type`, 
					`au`.`authority_name`,
					`reg`.`category_register`,
					(SELECT name FROM fts_user WHERE user_id = m.receiver_id) AS receiverName
					
					FROM `fts_letter_record` `r` 
					LEFT JOIN `fts_letter_movement` `m` ON `r`.`letter_id`=`m`.`letter_id` 
					LEFT JOIN `fts_letter_register` `re` ON `r`.`register_id`=`re`.`register_id` 
					LEFT JOIN `fts_authority` `au` ON `r`.`sending_authority`=`au`.`authority_id` 
					LEFT JOIN `fts_register_type` `reg` ON `reg`.`reg_type_id`=`r`.`reg_type_id`
					$sql_str LIMIT $limitText";
				
				$query = $this->db->query($sql);
				$result=$query->result_array();
				
				return $result;
			} else {
				return array();
			}
        }
    

//count total row using description
        public function count_letter_description($text)
        {
            $sql_str;
             $text=$text!=""?$text:'NULL';
             $sql_str="content like '%".$text."%' ";
             //$text=explode(" ",$text);

            /*  foreach($text as $value){
                  $sql_str.="or content like '%".$value."%' ";

             } */
     //echo $sql_str;exit;
            $query = $this->db->query("SELECT letter_id FROM fts_letter_record where regis_status='L' and  $sql_str ");
         //echo $this->db->last_query();exit;
            return $query->num_rows(); 
        }

    public function search_authority($keyword)
        {
            $keyword=$keyword!=""?$keyword:'NULL';
            $this->db->select('authority_id,authority_name');
            $this->db->from('fts_authority');
            $this->db->like('authority_name',$keyword,'after');
            $query = $this->db->get();
            $result=$query->result_array();  
            return $result;
           
        }

     //count total row using sending_authority
 public function count_letter_bysending_authority($authority)
    {
        $query = $this->db->query("SELECT letter_id FROM fts_letter_record where sending_authority='$authority'");
        return $query->num_rows(); 
    }





         
 //track file bysending authority
       public function track_letter_bysending_authority($authority,$limit,$start)
        { 
            $authority=$authority!=""?trim($authority):'NULL';
            $this->db->select('r.*,m.receiver_id,m.sender_id,m.ext_receiver,re.paper_type,au.authority_name');
            $this->db->from('fts_letter_record r');
            $this->db->join('fts_letter_movement m', 'r.letter_id=m.letter_id','left');
                 $this->db->join('fts_letter_register re', 'r.register_id=re.register_id');
                $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id');
            $this->db->where('r.sending_authority',$authority);
       
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result_array();
       //catecho $this->db->last_query();exit;
        //print_r($result);exit;
        $data=array();
        $section=array();
        $name=array();
        $file_ref=array();
        foreach ($result as $row) 
             {
                $data[] = $row;
                if($row['receiver_id']!=0)
                {
                 $name[$row['letter_id']]=$this->user_name($row['receiver_id']);
                 $sec=$this->section_and_desig($row['receiver_id']);
                 $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                  if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
                }
                else if($row['ext_receiver']!=NULL)
                {
                   $name[$row['letter_id']]=$row['ext_receiver'];
                 
                  $section[$row['letter_id']]="";
                  
                 }
                 else
                {
                   $name[$row['letter_id']]=$this->user_name($row['user_id']);
                  $sec=$this->section_and_desig($row['user_id']);  
                  $section[$row['letter_id']]=$this->section_name($sec['sec_id']);
                   if($row['file_id']){
                    $file_ref[$row['letter_id']]=$this->get_file($row['file_id']);
                 }
              }
             }
  
             $data_value[0]=$data;
             $data_value[1]=$section;
             $data_value[2]= $name;
             $data_value[3]= $file_ref;
             return $data_value;
             
        }

         public function search_file($keyword)
        {
            $keyword=$keyword!=""?$keyword:'NULL';
            $this->db->select('*');
            $this->db->from('fts_file_registration');
           
            if(substr_count($keyword,"/")>0)
            {
            $this->db->like('file_ref_sl_no', $keyword,'after'); 
            }
			else if(is_numeric($keyword)){
				$this->db->where('file_id=',$keyword);
			}
            else
            {
              $this->db->like('file_name',$keyword,'after');  
            } 
            $query = $this->db->get();
            $result=$query->result_array();  
            return $result;
           
        }

        public function letter_status_chang($action_id)
     {
        $this->db->select('ac.action_status');
        $this->db->from('fts_actionable_letter ac');
        $this->db->where('ac.action_id',$action_id);
        $query = $this->db->get();
        $result=$query->result_array();
      //print_r($result) ;exit;
        if($result[0]['action_status']=='P')
        {
           $this->db->update('fts_actionable_letter', array('action_status'=>'AT'),array('action_id'=>$action_id)); 
           if($this->db->affected_rows())
            return '<span style="color:green">Action Taken</span>';
            
        }
        else if($result[0]['action_status']=='No')
        {
            return '<span style="color:black">N.A</span>';
        }
        else
        {
           $this->db->update('fts_actionable_letter', array('action_status'=>'P'),array('action_id'=>$action_id)); 
           if($this->db->affected_rows())
            return '<span style="color:red">Pending</span>';
            
        }
     }

     public function action_notifcation()
     {
      $this->db->select('a.action_id,a.action_details,r.letter_name,r.memo_no');
      $this->db->from('fts_actionable_letter a');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->join('fts_letter_record r', 'a.letter_id=r.letter_id');
      $this->db->where('h.sender_user_id',$this->session->userdata('user_id'));
      $this->db->where('a.action_status','AT');
      $query = $this->db->get();
      $result=$query->result_array();
      //echo $this->db->last_query();exit;
      return $result;
    }

    public function action_pending()
     {
      $this->db->select('a.action_id,a.action_details,r.letter_name,r.memo_no');
      $this->db->from('fts_actionable_letter a');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->join('fts_letter_record r', 'a.letter_id=r.letter_id');
      $this->db->where('h.recv_id',$this->session->userdata('user_id'));
      $this->db->where('a.action_status','P');
      $query = $this->db->get();
      $result=$query->result_array();
      //echo $this->db->last_query();exit;
      return $result;
    }

    public function action_notifcation_count()
     {
      $this->db->select('a.action_id');
      $this->db->from('fts_actionable_letter a');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->join('fts_letter_record r', 'a.letter_id=r.letter_id');$this->db->where('h.sender_user_id',$this->session->userdata('user_id'));
      $this->db->where('a.action_status','AT');
      
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function access_sec($uid)
     {
     $query = $this->db->query("select sec_name from fts_section ");
      $result=$query->result_array();
      return $result[0];
    }

    public function section_letter_percent($sec_id)
     {
      $this->db->select('a.action_id');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->where('h.receiver_section_id',$sec_id);
      $this->db->where('h.recv_id !=',$this->session->userdata('user_id'));
      $this->db->where('a.action_status','P');
      $query1 = $this->db->get();
      //echo $this->db->last_query();
       $pending=$query1->num_rows();
     $result["section_pending"]=$pending;
      $this->db->select('a.action_id');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->where('h.receiver_section_id',$sec_id);

      $this->db->where('a.action_status !=','No');
      $query2 = $this->db->get();
      // echo $this->db->last_query();
      $total=$query2->num_rows(); 
      $result["section_total"]=$total;
      if($total!=0)
      {
   $result["section_persent"]=($pending*100)/$total;
     }
     else
     {
      $result["section_persent"]= 0;
     }
    return $result;
    }

public function user_letter_percent()
     {
      $this->db->select('a.action_id');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->where('h.recv_id',$this->session->userdata('user_id'));
      $this->db->where('a.action_status','P');
      $query1 = $this->db->get();
      //echo $this->db->last_query(); exit;
       $pending=$query1->num_rows();
      $result["pending_number"]=$pending;
      $this->db->select('a.action_id,r.letter_id');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      $this->db->join('fts_letter_record r', 'm.letter_id=r.letter_id');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->where('h.recv_id',$this->session->userdata('user_id'));
        //$this->db->where('a.action_status !=','No');
        $this->db->where('a.action_status !=','C');
       $this->db->where('r.file_id =','0');
      $query2 = $this->db->get();
      //echo $this->db->last_query();exit;
      $total=$query2->num_rows(); 
       $result["total"]= $total;
      if($total!=0)
      {
       $result["percent"]=($pending*100)/$total;
     }
     else
     {
       $result["percent"]= 0;
     }
        return $result;
    }



    public function check_not_pending($letter_id)
     {
    
      $user_id=$this->session->userdata('user_id');
      $this->db->select('a.action_id');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      //$this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $where = "a.letter_id='$letter_id' and m.receiver_id='$user_id' and (a.action_status='No' OR a.action_status='C')";
      $this->db->where($where);
      $query2 = $this->db->get();
	  
      //echo $this->db->last_query();exit;
     if($number=$query2->num_rows()=='1') 
    return true;
      else
    return false;
    }
	
	public function count_all_pending_list()
	{
		/**$this->db->select('m.letter_id');
		$this->db->from('fts_letter_movement m');
		$this->db->join('fts_letter_record r','m.letter_id = r.letter_id');
		$this->db->join('fts_actionable_letter a','r.letter_id = a.letter_id');
		$this->db->where('a.action_receiver= '.$this->session->userdata('user_id'));
		$this->db->where('a.action_status !=', 'C');
		$this->db->where('a.request_approval_status =', '0');
        //$this->db->where('a.deadline_dt !=', '0000-00-00');
		$query = $this->db->get();
    
		return $query->num_rows();**/
		$userId =$this->session->userdata('user_id');
		$sql = "SELECT COUNT(m.letter_id) AS total
				FROM fts_letter_movement m 
				LEFT JOIN fts_letter_record r ON m.letter_id = r.letter_id
				LEFT JOIN fts_actionable_letter a ON r.letter_id = a.letter_id
				WHERE (a.action_receiver= ".$userId." AND a.action_status != 'C' AND a.deadline_dt != '0000-00-00') 
				OR (a.request_approval_status = '0' AND a.action_details = 'Request Approval')";
				
		$query = $this->db->query($sql);
		if(isset($query->row()->total) && $query->row()->total > 0) {
			return $query->row()->total;
		} else {
			return 0;
		}
		
		
	}
	
	public function letter_set_approved($action_id)
	{
		$this->db->update('fts_actionable_letter', array('request_approval_status'=>1),array('action_id'=>$action_id)); 
		return true;
	}
	
	public function all_pending_list($limit,$start)
	{
		$this->db->select('r.memo_no,r.subject,r.letter_name,a.action_receiver,r.issue_dt,m.letter_id,m.receiver_id,r.location_path,m.sender_id,a.action_sender,a.action_id,a.deadline_dt,a.action_details,a.action_status,r.star_mark,r.star_given_by,u.name AS ratingGivenUser');
		$this->db->from('fts_letter_movement m');
		$this->db->join('fts_letter_record r','m.letter_id = r.letter_id');
		
		$this->db->join('fts_user u', 'u.user_id =r.star_given_by','left');
		
		$this->db->join('fts_actionable_letter a','r.letter_id = a.letter_id');
		$this->db->where('a.request_approval_status =', '0');
		$this->db->where('a.action_details =', 'Request Approval');
		$this->db->limit($limit, $start);
   
		$query = $this->db->get();
		$result[0]=$query->result_array();
		
		$this->db->select('r.memo_no,r.subject,r.letter_name,a.action_receiver,r.issue_dt,m.letter_id,m.receiver_id,r.location_path,m.sender_id,a.action_sender,a.action_id,a.deadline_dt,a.action_details,a.action_status,r.star_mark,r.star_given_by,u.name AS ratingGivenUser');
		$this->db->from('fts_letter_movement m');
		$this->db->join('fts_letter_record r','m.letter_id = r.letter_id');
		
		$this->db->join('fts_user u', 'u.user_id =r.star_given_by','left');
		
		$this->db->join('fts_actionable_letter a','r.letter_id = a.letter_id');
		$this->db->where('a.action_receiver= '.$this->session->userdata('user_id'));
		$this->db->where('a.action_status !=', 'C');
		$this->db->where('a.deadline_dt !=', '0000-00-00');
		$this->db->limit($limit, $start);
   
		$query = $this->db->get();
		$result[1]=$query->result_array();
		
		//echo '<pre>'; print_r($result); die;
		return $result;

	}

    public function check_myregister($letter_id)
     {
    
      $user_id=$this->session->userdata('user_id');
      $this->db->select('r.letter_id');
      $this->db->from('fts_letter_record r');
      $this->db->where('r.user_id',$this->session->userdata('user_id'));
      $this->db->where('r.letter_id',$letter_id);
      $this->db->where('r.letter_move_status','P');
      $query2 = $this->db->get();
      //echo $this->db->last_query();exit;
     if($number=$query2->num_rows()>=1) 
    return true;
      else
    return false;
    }

	 public function fetch_action_count() {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.letter_id,ac.action_remark,r.memo_no,r.location_path,r.reg_dt,ac.action_receiver,h.recv_id,h.date_of_action,ac.action_id,ac.action_status,r.issue_dt,r.subject,r.letter_name,h.recv_id,h.sender_user_id,h.sender_desig_id,a.authority_name,ac.action_details,ac.deadline_dt,ac.trail_letter_id');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
        //$this->db->join('fts_user u', 'u.user_id =h.recv_id');
        $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		//$this->db->join('fts_user u', 'u.user_id =h.recv_id');
       //$this->db->where('(ac.action_sender ='. $this->session->userdata('user_id') .' or h.sender_user_id= '. $this->session->userdata('user_id').')');
	   $this->db->where('ac.action_sender ='. $this->session->userdata('user_id'));
		$this->db->where('ac.action_receiver = h.recv_id' );
        $this->db->where('ac.deadline_dt !=', '0000-00-00');
		$this->db->where('ac.action_status !=', 'C');
        $this->db->order_by("ac.deadline_dt","asc");
       
        $query = $this->db->get();
		
        //echo $this->db->last_query();exit;
        $result=$query->num_rows();


        return $result;
        }
	
    // fetch_letter_sent
    public function fetch_letter_sent($limit, $start) {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.letter_id,r.subject,ac.action_remark,r.memo_no,r.location_path,r.reg_dt,ac.action_receiver,h.recv_id,h.date_of_action,ac.action_id,ac.action_status,r.issue_dt,r.subject,r.letter_name,h.recv_id,h.sender_user_id,h.sender_desig_id,a.authority_name,ac.action_details,ac.deadline_dt,ac.trail_letter_id,r.star_mark,r.star_given_by,u.name AS ratingGivenUser');
        $this->db->from('fts_letter_record r');
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
		$this->db->join('fts_user u', 'u.user_id =r.star_given_by','left');
		
        //$this->db->join('fts_user u', 'u.user_id =h.recv_id');
        $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		//$this->db->join('fts_user u', 'u.user_id =h.recv_id');
       //$this->db->where('(ac.action_sender ='. $this->session->userdata('user_id') .' or h.sender_user_id= '. $this->session->userdata('user_id').')');
	   $this->db->where('ac.action_sender ='. $this->session->userdata('user_id'));
		//$this->db->where('ac.action_receiver = h.recv_id' );
        $this->db->where('ac.deadline_dt !=', '0000-00-00');
		$this->db->where('ac.action_status !=', 'C');
        $this->db->order_by("ac.trail_letter_id","asc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
		
        //echo $this->db->last_query();exit;
        $result=$query->result_array();


        return $result;
        }


         public function letter_status_accept($action_id)
     {
        $this->db->select('ac.action_status');
        $this->db->from('fts_actionable_letter ac');
        $this->db->where('ac.action_id',$action_id);
        $query = $this->db->get();
        $result=$query->result_array();
        //print_r($result);exit;
		//return($result[0]['action_status']);
        if($result[0]['action_status']=='AT')
        {
           $this->db->update('fts_actionable_letter', array('action_status'=>'C'),array('action_id'=>$action_id)); 
           if($this->db->affected_rows())
            return '<label style="color:green">Accepted</label>';
        }
        else
        {
           $this->db->update('fts_actionable_letter', array('action_status'=>'AT'),array('action_id'=>$action_id)); 
           if($this->db->affected_rows())
            return '<label style="color:red">Accept</label>';
        }
     }

	  public function letter_status_postpond($action_id,$act_text,$dt)
     {
        $this->db->select('ac.action_status');
        $this->db->from('fts_actionable_letter ac');
        $this->db->where('ac.action_id',$action_id);
        $query = $this->db->get();
        $result=$query->result_array();
		//return $act_text;
		if($act_text==null || $act_text==""){
			$act_text="Next Date";
		}
        //return ($dt);exit;
        if($result[0]['action_status']=='AT' || $result[0]['action_status']=='P')
        {
           $this->db->update('fts_actionable_letter', array('action_status'=>'P','deadline_dt'=>dt_format($dt),'action_remark'=>$act_text),array('action_id'=>$action_id)); 
           
		  
		   if($this->db->affected_rows()){
			   return '<label style="color:green">Next Date:'.$dt.'</label>';
		   }
		}	
        /* else
        {
           $this->db->update('fts_actionable_letter', array('action_status'=>'AT'),array('action_id'=>$action_id)); 
           if($this->db->affected_rows())
            return '<label style="color:red">Accept</label>';
        } */
     }

      public function memono_check($memono,$issue_dt,$reg)
     {
            $this->db->select('letter_id');
            $this->db->from('fts_letter_record');
            $this->db->where('memo_no', $memono);
            $this->db->where('reg_type_id', $reg);
            $this->db->like('issue_dt',$issue_dt);
            $query = $this->db->get();
            $num = $query->num_rows();
            return $num;
     }


      public function section_pending_letter($sec_id,$limit, $start)
     {
      
      $this->db->select('a.action_id,r.memo_no,r.issue_dt,au.authority_name,u.name, m.dispatch_dt_time,r.letter_name,r.location_path');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      $this->db->join('fts_letter_record r', 'm.letter_id=r.letter_id');
      $this->db->join('fts_user u', 'm.receiver_id=u.user_id');
      $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->where('h.receiver_section_id',$sec_id);
      $this->db->where('a.action_status','P');
      $this->db->limit($limit, $start);
      $query = $this->db->get();
      //echo $this->db->last_query();
      $result=$query->result_array();
      return $result;
   }


     public function section_pending_letter_count($sec_id)
     {
      
      $this->db->select('a.action_id,r.memo_no,r.issue_dt,au.authority_name,u.name,r.letter_name,r.location_path');
      $this->db->from('fts_letter_movement m');
      $this->db->join('fts_actionable_letter a', 'm.action_id=a.action_id');
      $this->db->join('fts_letter_record r', 'm.letter_id=r.letter_id');
      $this->db->join('fts_user u', 'm.receiver_id=u.user_id');
      $this->db->join('fts_authority au', 'r.sending_authority=au.authority_id');
      $this->db->join('fts_letter_history_info h', 'a.trail_letter_id=h.trail_letter_id');
      $this->db->where('h.receiver_section_id',$sec_id);
      $this->db->where('a.action_status','P');
      $query = $this->db->get();
      //echo $this->db->last_query();
      return $query->num_rows();
   }
  public function extranal_letter_send($orgname)
        {
            $orgname=$orgname!=""?trim($orgname):'NULL';
            $this->db->select('*');
            $this->db->from('fts_external_address');
            $this->db->like('organization',$orgname,'after');
            $query = $this->db->get();
            //echo $this->db->last_query();
            $result=$query->result_array();
            return $result; 
            
        }

        public function extranal_address_exists($address)
        {
            $this->db->select('*');
            $this->db->from('fts_external_address');
            $this->db->where('address',$address);
            $query = $this->db->get();
            return $query->num_rows()>0?false:true;

            
        }  



        public function user_register_letter_percent()
     {
        //my pending
      $this->db->select('r.letter_id');
      $this->db->from('fts_letter_record r');
      $this->db->where('user_id', $this->session->userdata('user_id'));
      $this->db->where('letter_move_status','P');
      $this->db->where('regis_status','L');
      $query1 = $this->db->get();
      //echo $this->db->last_query(); exit;
       $pending=$query1->num_rows();
      $result["pending_number"]=$pending;
       //my total
      $this->db->select('r.letter_id');
      $this->db->from('fts_letter_record r');
      $this->db->where('user_id', $this->session->userdata('user_id'));
      $this->db->where('regis_status','L');
      $query2 = $this->db->get();
      //echo $this->db->last_query();exit;
      $total=$query2->num_rows(); 
       $result["total"]= $total;
      if($total!=0)
      {
       $result["percent"]=($pending*100)/$total;
     }
     else
     {
       $result["percent"]= 0;
     }
        return $result;
    }



public function ttt()
    {   
        $query = $this->db->get('fts_letter_history_info');
        $r=$query->result_array();
        foreach ($r as  $value) {
            $data=array(
                'letter_id' =>$value['letter_id'],
                'action_details' =>'Not Actionable',
                'trail_letter_id' =>$value['trail_letter_id'],
                'action_status'=>'No'
                );
            $this->db->insert('fts_actionable_letter',$data);
        }
        
    }


    public function t2()
    {   
        $query = $this->db->get('fts_actionable_letter');
        $r=$query->result_array();
        foreach ($r as  $value) {
            $data=array(
                'action_id' =>$value['action_id']
               
                );
            
            $this->db->update('fts_letter_movement', $data,array('letter_id'=>$value['letter_id']));
        }
        
    }

	
}
?>