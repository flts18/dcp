<?php
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
	parent::__construct();
    }
	
	public function crime_file_dash($sec_arr)
	{
		$user_id=$this->session->userdata('user_id');
        $this->db->select('r.file_id');
        $this->db->from('fts_file_registration r');
        //$this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
        //$this->db->join('fts_section se', 'r.issuing_authority =se.sec_id','left');
        $this->db->join('fts_final_report fr','r.file_id=fr.file_id','left');
        $this->db->where('r.file_type','CRIME');
        $this->db->where('r.sub_sec in('.trim($sec_arr,",").')');
		$this->db->where('fr.file_id is NULL');
		$query = $this->db->get();
        $result['total']=$query->num_rows();
       
       return  $result;
	}

	public function crime_file($sec_arr)
    {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.file_id,m.file_status,m.store_at,r.file_type,r.file_shadow,r.file_ref_sl_no,r.issuing_authority,r.folder_name,r.br_image_name,subject,r.file_reg_date,r.file_move_status,r.part_label,r.parent_file,se.sec_name');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
        $this->db->join('fts_section se', 'r.issuing_authority =se.sec_id','left');
        $this->db->join('fts_final_report fr','r.file_id=fr.file_id','left');
        $this->db->where('r.file_type','CRIME');
        $this->db->where('r.sub_sec in('.trim($sec_arr,",").')');
		//$this->db->where('(r.sub_sec in('.trim($sec_arr,",").') or r.issuing_authority in('.trim($sec_arr,",").'))');
		$this->db->where('fr.file_id is NULL');
		
        
        //$this->db->order_by("file_id", "desc");
        //$this->db->or_where('m.reciver_user_id', $this->session->userdata('user_id'));
       // $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result_array();
       $result['total']=$query->num_rows();
       //print_r($result['total']);exit;
       return  $result;
        
    }

	public function filter_cfile()
    {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.file_id,m.file_status,m.store_at,r.file_type,r.file_shadow,r.file_ref_sl_no,r.issuing_authority,r.folder_name,r.br_image_name,subject,r.file_reg_date,r.file_move_status,r.part_label,r.parent_file,se.sec_name');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
        $this->db->join('fts_section se', 'r.issuing_authority =se.sec_id','left');
        $this->db->where('file_type','CRIME');
        $this->db->where('r.sub_sec',$this->input->post("section",true));
        
        $query = $this->db->get();
        $result=$query->result_array();
       $result['total']=$query->num_rows();
       //print_r($result['total']);exit;
       return  $result;
        
    }
    
    public function poi_request_sup()
    {
        $today=date('Y-m-d',time()+86400);
		
		$rank=fetch_rank($this->session->userdata('user_id'));
        $this->db->select('p.superior_user_id');
        $this->db->from('fts_plan_action p');
		$this->db->join('fts_file_registration r', 'p.file_id=r.file_id');
		$this->db->join('fts_section s', 'r.sub_sec=s.sec_id');
		$this->db->join('fts_user u', 'u.user_id=p.superior_user_id','left');
       
	    $this->db->where('u.user_rank <=',$rank);
	    $this->db->where('p.action_status', 'CD');
		$this->db->where('p.superior_user_id > 0');
		$this->db->group_by('p.superior_user_id');
		
		if($rank==4) {
			$user_id=$this->session->userdata('user_id');
			$this->db->where('p.superior_user_id',$user_id);
		}
		
		$query = $this->db->get();
       //print_r($this->db->last_query());exit;
       return  $query->result_array();
        
    }
    
   
	
	
	public function chk_actv_user()
      {
    	  
        
    	$q= $this->db->update('fts_user', array('is_login'=>0),array('is_login'=>1, 'DATE(last_login) <'=>date("Y-m-d"))); 
    	
      }
	
	public function indexed_file_count()
    {
        
        $this->db->select('DISTINCT(file_id)');
        $this->db->from('fts_letter_record r');
      
        $this->db->where('file_id !=','0');
		$query = $this->db->get();
       return  $query->num_rows();
        
    }
	
	//upcoming my task
    public function upcoming_my_task()
  {
    $today=date('Y-m-d');
	$tomorrow=date("Y-m-d", time()+86400); 
	$after_tom=date("Y-m-d", time()+86400*2);
     
    $this->db->select('r.memo_no,r.subject,r.letter_name,r.issue_dt,m.letter_id,m.receiver_id,r.location_path,m.sender_id,a.action_id,a.deadline_dt,a.action_details,a.action_status,r.star_mark,r.star_given_by,ux.name AS ratingGivenUser');
    $this->db->from('fts_letter_movement m');
    $this->db->join('fts_actionable_letter a','m.letter_id = a.letter_id');
    $this->db->join('fts_letter_record r','m.letter_id = r.letter_id');
    
    $this->db->join('fts_user ux', 'ux.user_id =r.star_given_by','left');
    
    $this->db->where('a.action_status =',"P");
    $this->db->where('m.receiver_id = "'.$this->session->userdata('user_id').'"');
	//$this->db->where('a.deadline_dt BETWEEN "'. date('Y-m-d', strtotime($tomorrow)). '" and "'. date('Y-m-d', strtotime($after_tom)).'"');
    $this->db->where('a.deadline_dt >"'.$today.'"');
    $query = $this->db->get();
    //print_r($this->db->last_query());exit;
    $result=$query->result_array();
    //return $query->result_array();
    return $result;

  }

  //upcoming task given
		public function upcoming_task_given()
		{
			$user_id=$this->session->userdata('user_id');
			$today=date('Y-m-d');
			$tomorrow=date("Y-m-d", time()+86400); 
			$after_tom=date("Y-m-d", time()+86400*2);

			$this->db->select('r.*,h.*,ac.*,u.*');
			$this->db->from('fts_letter_record r');
			$this->db->join('fts_letter_history_info h', 'h.letter_id=r.letter_id');
			//$this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
			$this->db->join('fts_user u', 'u.user_id =h.recv_id');
			$this->db->join('fts_actionable_letter ac', 'h.letter_id =ac.letter_id');
			$this->db->where('h.sender_user_id', $this->session->userdata('user_id'));
			//$this->db->where('ac.deadline_dt >=', $today);
			//$this->db->where('ac.deadline_dt <=', $after_tom);
			//$this->db->where('ac.deadline_dt ="'.$today.'"');
			//$this->db->where('ac.deadline_dt ="'.$tomorrow.'"');
			//$this->db->where('ac.deadline_dt ="'.$after_tom.'"');
			//$this->db->where('ac.deadline_dt BETWEEN "'.$today.'" AND "'.$after_tom.'"');
			$this->db->where('ac.deadline_dt BETWEEN "'. date('Y-m-d', strtotime($tomorrow)). '" and "'. date('Y-m-d', strtotime($after_tom)).'"');
			//$this->db->where('ac.action_status !=','No');
			//$this->db->where('ac.action_status !=','C');
			//$this->db->order_by("ac.deadline_dt","desc");
			//$this->db->limit($limit, $start);
			
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			$result=$query->result_array();
			return $result;




		}
		
		public function poi_request_target_dt($sup_usr="")
        {
        $today=date('Y-m-d',time()+86400);
		$userRank = fetch_rank($this->session->userdata('user_id'));
		
        $this->db->select('p.action_id,p.superior_user_id,s.sec_name,p.plan_user_id,p.file_id,subject,p.action,p.act_target_dt,p.action_status,upi.user_id AS instruction_to_user,(SELECT COUNT(`pir`.`poi_rem_id`) FROM `fts_poi_remarks` `pir` WHERE  `pir`.`action_id`=`p`.`action_id`) AS total_remarks');
        $this->db->from('fts_plan_action p');
		$this->db->join('fts_file_registration r', 'p.file_id=r.file_id','left');
		
		$this->db->join('fts_personel_info upi', 'r.sub_sec=upi.sec_id');
		
		$this->db->join('fts_section s', 'r.sub_sec=s.sec_id','left');
		$this->db->join('fts_user u', 'u.user_id=p.superior_user_id','left');
        
		 
		$this->db->where('p.action_status', 'CD');
		$this->db->where("p.is_delete", "0");
		if($sup_usr !=""){
		    	$this->db->where('p.superior_user_id',$sup_usr);
		}
		if($userRank==4) {
			$user_id=$this->session->userdata('user_id');
			$this->db->where('p.superior_user_id',$user_id);
		}
	
		//$this->db->group_by('p.superior_user_id');
		$query = $this->db->get();
      // print_r($this->db->last_query());exit;
       return  $query->result_array();
        
    }
    
    public function remarksAddOnInstructions($data)
	{
		$this->db->insert('fts_poi_remarks', $data);
	}
    
    public function poi_failed_target($sup_usr="")
    {
        $today=date('Y-m-d',time()+86400);
		$userRank = fetch_rank($this->session->userdata('user_id'));
		
        $this->db->select('p.action_id,p.superior_user_id,s.sec_name,p.plan_user_id,p.file_id,subject,p.action,p.act_target_dt,p.action_status,upi.user_id AS instruction_to_user,(SELECT COUNT(`pir`.`poi_rem_id`) FROM `fts_poi_remarks` `pir` WHERE  `pir`.`action_id`=`p`.`action_id`) AS total_remarks');
        $this->db->from('fts_plan_action p');
		$this->db->join('fts_file_registration r', 'p.file_id=r.file_id');
		
		$this->db->join('fts_personel_info upi', 'r.sub_sec=upi.sec_id');
		
		$this->db->join('fts_section s', 'r.sub_sec=s.sec_id');
		$this->db->join('fts_user u', 'u.user_id=p.superior_user_id','left');
        
		$this->db->where('p.act_target_dt < "'. $today.'"');
		 
		$this->db->where('p.action_status', 'P');
		$this->db->where("p.is_delete", "0");
		if($sup_usr !=""){
		    $this->db->where('p.superior_user_id',$sup_usr);
		}
		
		if($userRank==4) {
			$user_id=$this->session->userdata('user_id');
			$this->db->where('p.superior_user_id',$user_id);
		}
		
		$this->db->group_by('p.file_id');
		$query = $this->db->get();
      // print_r($this->db->last_query());exit;
       return  $query->result_array();
        
    }
		
	 public function sent_letters() {
        $user_id=$this->session->userdata('user_id');
        $this->db->select('r.letter_id,r.subject,r.memo_no,r.location_path,r.reg_dt,h.recv_id,h.date_of_action,r.issue_dt,r.subject,r.letter_name,h.recv_id,h.sender_user_id,h.sender_desig_id,a.authority_name,r.star_mark,r.star_given_by,ux.name AS ratingGivenUser');
        $this->db->from('fts_letter_record r');
		
		$this->db->join('fts_user ux', 'ux.user_id =r.star_given_by','left');
		
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
        $this->db->join('fts_user u', 'u.user_id =h.recv_id');
       // $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		//$this->db->join('fts_user u', 'u.user_id =h.recv_id');
       $this->db->where('h.sender_user_id= '. $this->session->userdata('user_id'));
	   $this->db->order_by("h.date_of_action", "desc");
      
      
        $query = $this->db->get();
		
        //echo $this->db->last_query();exit;
        return $query->result_array();

    }
	public function almira_file_show()
    {
        
        $this->db->select('*','m.file_status');
        $this->db->from('fts_file_registration r');
		$this->db->join('fts_file_movement m', 'r.file_id=m.file_id');
        $this->db->where('m.file_status','A');
		$query = $this->db->get();
       //print_r($this->db->last_query());exit;
       return  $query->result_array();
        
    }
    public function wk_target_sup()
    {
        $today=date('Y-m-d',time()+86400);
		$this_wk=date("Y-m-d", time()+86400*7);
		$addedDate = date('Y-m-d', strtotime('+7 days'));
		$rank=fetch_rank($this->session->userdata('user_id'));
        $this->db->select('p.superior_user_id');
        $this->db->from('fts_plan_action p');
		$this->db->join('fts_file_registration r', 'p.file_id=r.file_id');
		$this->db->join('fts_section s', 'r.sub_sec=s.sec_id');
		$this->db->join('fts_user u', 'u.user_id=p.superior_user_id','left');
        $this->db->where('p.act_target_dt BETWEEN "'. date('Y-m-d', strtotime($today)). '" and "'. date('Y-m-d', strtotime($this_wk)).'"');
		$this->db->where('u.user_rank <=',$rank);
		$this->db->where('p.superior_user_id > 0');
		
		if($rank==4) {
			$user_id=$this->session->userdata('user_id');
			$this->db->where('p.superior_user_id',$user_id);
		}
		
		$this->db->group_by('p.superior_user_id');
		$query = $this->db->get();
       //print_r($this->db->last_query());exit;
       return  $query->result_array();
        
    }
	public function nxt_wk_target($user)
    {
       $today=date('Y-m-d',time()+86400);
		$this_wk=date("Y-m-d", time()+86400*7);
		
		$addedDate = date('Y-m-d', strtotime('+7 days'));
		
        $this->db->select('p.action_id,p.superior_user_id,s.sec_name,p.file_id,subject,p.action,p.act_target_dt,p.action_status,upi.user_id AS instruction_to_user,(SELECT COUNT(`pir`.`poi_rem_id`) FROM `fts_poi_remarks` `pir` WHERE  `pir`.`action_id`=`p`.`action_id`) AS total_remarks');
        $this->db->from('fts_plan_action p');
		$this->db->join('fts_file_registration r', 'p.file_id=r.file_id');
		
		$this->db->join('fts_personel_info upi', 'r.sub_sec=upi.sec_id');
		
		$this->db->join('fts_section s', 'r.sub_sec=s.sec_id');
        $this->db->where('p.act_target_dt BETWEEN "'. date('Y-m-d', strtotime($today)). '" and "'. date('Y-m-d', strtotime($this_wk)).'"');
		//$this->db->where('p.act_target_dt < "'. $addedDate .'"');
	//	$this->db->where('s.inves_power','1');
		$this->db->where('p.action_status','P');
		$this->db->where('p.superior_user_id',$user);
		$query = $this->db->get();
       //print_r($this->db->last_query());exit;
       return  $query->result_array();
        
        
    }
    
    public function nxt_wk_target_ajax()
    {
        $userRank = fetch_rank($this->session->userdata('user_id'));
        
        $today=date('Y-m-d',time()+86400);
		$this_wk=date("Y-m-d", time()+86400*7);
		
		$addedDate = date('Y-m-d', strtotime('+7 days'));
		
        $this->db->select('p.action_id,p.superior_user_id,s.sec_name,p.file_id,subject,p.action,p.act_target_dt,p.action_status,upi.user_id AS instruction_to_user,(SELECT COUNT(`pir`.`poi_rem_id`) FROM `fts_poi_remarks` `pir` WHERE  `pir`.`action_id`=`p`.`action_id`) AS total_remarks');
        $this->db->from('fts_plan_action p');
		$this->db->join('fts_file_registration r', 'p.file_id=r.file_id');
		
		$this->db->join('fts_personel_info upi', 'r.sub_sec=upi.sec_id');
		
		$this->db->join('fts_section s', 'r.sub_sec=s.sec_id');
        $this->db->where('p.act_target_dt BETWEEN "'. date('Y-m-d', strtotime($today)). '" and "'. date('Y-m-d', strtotime($this_wk)).'"');
		//$this->db->where('p.act_target_dt < "'. $addedDate .'"');
		$this->db->where('p.action_status','P');
		$this->db->where('s.inves_power','1');
		//$this->db->where('p.superior_user_id',$user);
		
		if($userRank==4) {
			$user_id=$this->session->userdata('user_id');
			$this->db->where('p.superior_user_id',$user_id);
		}
		
		$query = $this->db->get();
       //print_r($this->db->last_query());exit;
       return  $query->result_array();
    
    }
		public function almira_file_count()
    {
       
		$this->db->select('r.file_id');
		$this->db->from('fts_file_registration r');
		$this->db->join('fts_file_movement m', 'r.file_id=m.file_id');
        $this->db->where('m.file_status','A');
		$query = $this->db->get();
       return  $query->num_rows();
        
    }
	public function mov_file_count()
    {
       
		$this->db->select('r.file_id');
        $this->db->from('fts_file_registration r');
		$this->db->join('fts_file_movement m', 'r.file_id=m.file_id');
        $this->db->where('m.file_status !=','A');
		$query = $this->db->get();
       return  $query->num_rows();
        
    }
	public function total_file_count()
    {
        
        $this->db->select('file_id');
        $this->db->from('fts_file_registration r');
        $this->db->where('file_type !=','CRIME');
		$query = $this->db->get();
       return  $query->num_rows();
        
    }
    //to do list
    public function to_do_list()
  {
    $current_date=date('Y-m-d');
     
    $this->db->select('r.memo_no,r.subject,r.letter_name,r.issue_dt,m.letter_id,m.receiver_id,a.action_sender,r.location_path,m.sender_id,a.action_id,a.deadline_dt,a.action_details,a.action_status,r.star_mark,r.star_given_by,ux.name AS ratingGivenUser');
    $this->db->from('fts_letter_movement m');
    $this->db->join('fts_letter_record r','m.letter_id = r.letter_id');
    
    $this->db->join('fts_user ux', 'ux.user_id =r.star_given_by','left');
    
	$this->db->join('fts_actionable_letter a','r.letter_id = a.letter_id');
    $this->db->where('a.action_status =',"P");
	$this->db->where('a.deadline_dt <="'.$current_date.'"');
    $this->db->where('( m.receiver_id = "'.$this->session->userdata('user_id').'" or a.action_receiver= '.$this->session->userdata('user_id').' ) ');
   
    $query = $this->db->get();
    //print_r($this->db->last_query());exit;
    $result=$query->result_array();
    return $query->result_array();
    return $result;

  }
  
  public function userSections()
  {
	$rank=fetch_rank($this->session->userdata('user_id'));
	
    $sql = "SELECT DISTINCT user_id, name 
			FROM `fts_user` WHERE `user_id` IN 
			(SELECT `user_id` FROM `fts_personel_info` 
				WHERE `sec_id` IN 
				(SELECT sec_id FROM `fts_section` 
					WHERE inves_power=1)) 
			AND is_active='Y' 
			AND user_rank <= $rank ORDER BY name ASC";

	$query = $this->db->query($sql);
	return $query->result_array();
  }
  
  public function random_color_part() {
		$color = dechex(rand(0x000000, 0xFFFFFF));
		return '#'.$color;
	}
	
	
	
	public function section_wise_crime_count()
	{
		/**$sql = "SELECT s.sec_name,(SELECT COUNT(file_id) FROM fts_file_registration WHERE sec_id=s.sec_id AND file_type='CRIME' AND is_dormant=0) AS actionCount
		FROM fts_section AS s 
		WHERE s.inves_power=1";
		$query = $this->db->query($sql);
		
		//echo '<pre>'; print_r($query->result_array()); die;
		return json_encode($query->result_array());**/
		$user_id=$this->session->userdata('user_id');
		$sql = "SELECT access_section FROM fts_personel_info WHERE user_id=".$user_id;
		$accessSection = '';
		$query = $this->db->query($sql);
		$result=$query->row_array();
		if(isset($result['access_section'])) {
			$accessSection = $result['access_section'];
		}
		
		$sql = "SELECT s.sec_name,s.sec_id
		FROM fts_section AS s 
		WHERE s.inves_power=1 AND s.sec_id IN (".$accessSection.")";
		$query = $this->db->query($sql);
		
		$total = array();
		$dataHandedArr = $query->result_array();
		foreach($dataHandedArr as $singleArr){
			$sql = "SELECT COUNT(file_id) AS total FROM fts_file_registration WHERE file_type='CRIME' AND is_dormant=0 AND sub_sec=".$singleArr['sec_id'];
			$query = $this->db->query($sql);
			$single = array();
			$single['sec_name'] = $singleArr['sec_name'];
			$single['totalHandedFile'] = 0;
			//$single['color'] = $this->random_color_part();
			$single['color'] = '#c9f';
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0) 
			{
				$single['totalHandedFile'] = $query->row_array()['total'];
			}
			$total[] = $single;
		}
		//echo '<pre>'; print_r(json_encode($total)); die;
		return json_encode($total);
	}
	
	public function getSecIdByName($sectionName)
	{
		$sql = "SELECT sec_id FROM fts_section WHERE sec_name LIKE '".$sectionName."'";
		$query = $this->db->query($sql);
		$secId = 0;
		if($query->num_rows() > 0 && $query->row_array()['sec_id'] > 0)
		{
			$secId = $query->row_array()['sec_id'];
		}
		return $secId;
	}
	
	public function crime_file_display_by_year()
	{
		$sql = "select year(fr.issue_dt) as year, count(fr.file_id) as totalFile from fts_file_registration AS fr WHERE fr.file_type='CRIME' group by year";
		$query = $this->db->query($sql);
		return json_encode($query->result_array());
	}

	public function final_report_display()
	{
		$total = array();
		$dataHandedArr = array('NIA','CBI','DECONTROLLED','ED','TRF_OTH');
		foreach($dataHandedArr as $singleArr){
			$sql = "SELECT COUNT(file_id) AS total FROM fts_final_report WHERE handed_to LIKE '".$singleArr."'";
			$query = $this->db->query($sql);
			$single = array();
			if($singleArr == 'TRF_OTH')
			{
				$single['name'] = 'Others';
			} else {
				$single['name'] = $singleArr;
			}
			$single['totalHandedFile'] = 0;
			$single['color'] = $this->random_color_part();
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single['totalHandedFile'] = $query->row_array()['total'];
			}
			$total[] = $single;
		}
		//echo '<pre>'; print_r(json_encode($total)); die;
		return json_encode($total);
	}
  
  public function activeInactiveRecords($sections)
  {
	$results = array();
	$totalActiveResults = array();
	
	$results1 = array();
	$totalInactiveResults = array();
	if(count($sections) > 0)
	{
		$today = date('Y-m-d');
		$last_wk=date("Y-m-d", time()-86400*2);
		$lastMonth = date("Y-m-d",strtotime("first day of last month"));
		foreach($sections as $sec)
		{
			/** Today Results **/
			
			$sql = "SELECT COUNT(file_id) AS total 
					FROM fts_file_history_info WHERE user_id=".$sec['user_id']."
					AND date_of_action LIKE '".$today."' AND action_type IN ('A','D') 
					AND file_id IN (SELECT DISTINCT(file_id) 
						FROM fts_file_history_info WHERE user_id=".$sec['user_id']."
						AND date_of_action LIKE '".$today."' 
						AND action_type IN ('A','D'))";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$results['todayResults']['files'][] = $single;
			} else {
				$results1['todayResults']['files'][] = $sec['name'];
			}
			
			$sql = "SELECT COUNT(letter_id) AS total 
					FROM fts_letter_history_info WHERE recv_id=".$sec['user_id']."
					AND date_of_action LIKE '".$today."'  
					AND letter_id IN (SELECT DISTINCT(letter_id) 
						FROM fts_letter_history_info WHERE recv_id=".$sec['user_id']."
						AND date_of_action LIKE '".$today."')";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$results['todayResults']['letters'][] = $single;
			} else {
				$results1['todayResults']['letters'][] = $sec['name'];
			}
			
			$sql = "SELECT COUNT(action_id) AS total FROM fts_plan_action 
					WHERE plan_user_id=".$sec['user_id']." AND set_dt LIKE '".$today."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$results['todayResults']['poi'][] = $single;
			} else {
				$results1['todayResults']['poi'][] = $sec['name'];
			}
			
			//$totalActiveResults['todayResults'][] = $results;
			//$totalInactiveResults['todayResults'][] = $results1;
			
			/** Last 7 days Results **/
			
			$sql = "SELECT COUNT(file_id) AS total,MAX(date_of_action) AS lastdate 
					FROM fts_file_history_info WHERE user_id=".$sec['user_id']."
					AND date_of_action between '".$last_wk."' and '".$today."' AND action_type IN ('A','D') 
					AND file_id IN (SELECT DISTINCT(file_id) 
						FROM fts_file_history_info WHERE user_id=".$sec['user_id']."
						AND date_of_action between '".$last_wk."' and '".$today."' 
						AND action_type IN ('A','D'))";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$single['lastdate'] = $query->row_array()['lastdate'];
				$results['sevenDaysResults']['files'][] = $single;
			} else {
				$results1['sevenDaysResults']['files'][] = $sec['name'];
			}
			
			$sql = "SELECT COUNT(letter_id) AS total,MAX(date_of_action) AS lastdate  
					FROM fts_letter_history_info WHERE recv_id=".$sec['user_id']."
					AND date_of_action between '".$last_wk."' and '".$today."'  
					AND letter_id IN (SELECT DISTINCT(letter_id) 
						FROM fts_letter_history_info WHERE recv_id=".$sec['user_id']."
						AND date_of_action between '".$last_wk."' and '".$today."')";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$single['lastdate'] = $query->row_array()['lastdate'];
				$results['sevenDaysResults']['letters'][] = $single;
			} else {
				$results1['sevenDaysResults']['letters'][] = $sec['name'];
			}
			
			$sql = "SELECT COUNT(action_id) AS total,MAX(set_dt) AS lastdate 
					FROM fts_plan_action 
					WHERE plan_user_id=".$sec['user_id']." AND set_dt between '".$last_wk."' and '".$today."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$single['lastdate'] = $query->row_array()['lastdate'];
				$results['sevenDaysResults']['poi'][] = $single;
			} else {
				$results1['sevenDaysResults']['poi'][] = $sec['name'];
			}
			
			//$totalActiveResults['sevenDaysResults'][] = $results;
			//$totalInactiveResults['sevenDaysResults'][] = $results1;
			
			/** Last Months Results **/
			
			$sql = "SELECT COUNT(file_id) AS total,MAX(date_of_action) AS lastdate
					FROM fts_file_history_info WHERE user_id=".$sec['user_id']."
					AND date_of_action between '".$lastMonth."' and '".$today."' AND action_type IN ('A','D') 
					AND file_id IN (SELECT DISTINCT(file_id) 
						FROM fts_file_history_info WHERE user_id=".$sec['user_id']."
						AND date_of_action between '".$lastMonth."' and '".$today."' 
						AND action_type IN ('A','D'))";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$single['lastdate'] = $query->row_array()['lastdate'];
				$results['lastMonthResults']['files'][] = $single;
			} else {
				$results1['lastMonthResults']['files'][] = $sec['name'];
			}
			
			$sql = "SELECT COUNT(letter_id) AS total,MAX(date_of_action) AS lastdate 
					FROM fts_letter_history_info WHERE recv_id=".$sec['user_id']."
					AND date_of_action between '".$lastMonth."' and '".$today."'  
					AND letter_id IN (SELECT DISTINCT(letter_id) 
						FROM fts_letter_history_info WHERE recv_id=".$sec['user_id']."
						AND date_of_action between '".$lastMonth."' and '".$today."')";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$single['lastdate'] = $query->row_array()['lastdate'];
				$results['lastMonthResults']['letters'][] = $single;
			} else {
				$results1['lastMonthResults']['letters'][] = $sec['name'];
			}
			
			$sql = "SELECT COUNT(action_id) AS total,MAX(set_dt) AS lastdate 
					FROM fts_plan_action 
					WHERE plan_user_id=".$sec['user_id']." AND set_dt between '".$lastMonth."' and '".$today."'";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0 && $query->row_array()['total'] > 0)
			{
				$single = array();
				$single['name'] = $sec['name'];
				$single['totalFiles'] = $query->row_array()['total'];
				$single['lastdate'] = $query->row_array()['lastdate'];
				$results['lastMonthResults']['poi'][] = $single;
			} else {
				$results1['lastMonthResults']['poi'][] = $sec['name'];
			}
			
			//$totalActiveResults['lastMonthResults'][] = $results;
			//$totalInactiveResults['lastMonthResults'][] = $results1;
			
			
		}
	}
	//$finalResults['totalActiveResults'] = $totalActiveResults;
	//$finalResults['totalInactiveResults'] = $totalInactiveResults;
	$finalResults['totalActiveResults'] = $results;
	$finalResults['totalInactiveResults'] = $results1;
	return $finalResults;
  }
  
   public function mov_file_show()
    {
        
        $this->db->select('*','m.file_status');
        $this->db->from('fts_file_registration r');
		$this->db->join('fts_file_movement m', 'r.file_id=m.file_id');
        $this->db->where('m.file_status !=','A');
		$query = $this->db->get();
		//print_r($this->db->last_query());exit;
       return  $query->result_array();
        
    }


// fetch_action_sent today
    public function fetch_action_sent() {
        $user_id=$this->session->userdata('user_id');
        $current_date=date('Y-m-d');
        $this->db->select('r.letter_id,r.subject,r.memo_no,r.reg_dt,h.date_of_action,r.location_path,ac.action_id,u.name,ac.action_status,r.issue_dt,r.subject,r.letter_name,h.recv_id,h.sender_user_id,h.sender_desig_id,a.authority_name,ac.action_details,ac.deadline_dt,ac.trail_letter_id,r.star_mark,r.star_given_by,ux.name AS ratingGivenUser');
        $this->db->from('fts_letter_record r');
        
        $this->db->join('fts_user ux', 'ux.user_id =r.star_given_by','left');
        
        $this->db->join('fts_letter_history_info h', 'r.letter_id =h.letter_id');
        $this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
        $this->db->join('fts_actionable_letter ac', 'h.trail_letter_id =ac.trail_letter_id');
		$this->db->join('fts_user u', 'u.user_id =ac.action_receiver');
        $this->db->where('h.sender_user_id', $this->session->userdata('user_id'));
        $this->db->where('ac.deadline_dt <="'.$current_date.'"');
        $this->db->where('ac.action_status !=','No');
        $this->db->where('ac.action_status !=','C');
        $this->db->order_by("ac.deadline_dt","desc");
        //$this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $result=$query->result_array();


        return $result;
        }
		
		public function fetch_action_sent_upcoming()
		{
			$user_id=$this->session->userdata('user_id');
			$today=date('Y-m-d');
			$tomorrow=date("Y-m-d", time()+86400); 
			$after_tom=date("Y-m-d", time()+86400*2);

			$this->db->select('r.subject,r.memo_no,r.issue_dt,ac.action_details,u.name,r.star_mark,r.star_given_by,ux.name AS ratingGivenUser');
			$this->db->from('fts_letter_record r');
			
			$this->db->join('fts_user ux', 'ux.user_id =r.star_given_by','left');
			
			$this->db->join('fts_letter_history_info h', 'h.letter_id=r.letter_id');
			//$this->db->join('fts_authority a', 'r.sending_authority =a.authority_id');
			$this->db->join('fts_user u', 'u.user_id =h.recv_id');
			$this->db->join('fts_actionable_letter ac', 'h.letter_id =ac.letter_id');
			$this->db->where('h.sender_user_id', $this->session->userdata('user_id'));
			
			$this->db->where('ac.deadline_dt BETWEEN "'. date('Y-m-d', strtotime($tomorrow)). '" and "'. date('Y-m-d', strtotime($after_tom)).'"');
		
			
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			$result=$query->result_array();
			return $result;




		}

		
		
public function sec_filter_cfile($sec_id) {
        //print_r($sec_id);exit;
      
        $user_id=$this->session->userdata('user_id');
		
        $this->db->select('m.reciver_user_id,r.file_id,r.sub_sec,m.file_status,m.store_at,r.file_type,r.file_shadow,r.file_ref_sl_no,r.issuing_authority,r.folder_name,r.br_image_name,subject,r.file_reg_date,r.file_move_status,r.part_label,r.parent_file,se.sec_name');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
		//$this->db->join('fts_final_report f', 'r.file_id =f.file_id','left');
        $this->db->join('fts_section se', 'r.issuing_authority =se.sec_id','left');
        $this->db->where('file_type','CRIME');
		//$this->db->where('f.dormant','0');
        $this->db->where('r.sub_sec',$sec_id);
		//$this->db->or_where('r.issuing_authority',$sec_id);
       // $this->db->limit($limit, $start);
		
        $query = $this->db->get();
		//echo($this->db->last_query());exit;
		//return $this->db->last_query() ;exit;
        $result=$query->result_array();
     //$result[1]=$query->num_rows();
 //print_r($result[0]);exit;
        return $result;
        }
    public function usrwise_cfile($sec_arr) {
        //print_r(trim($sec_arr,','));exit;
       
        $user_id=$this->session->userdata('user_id');
        $this->db->select('m.reciver_user_id,r.file_id,r.sub_sec,m.file_status,m.store_at,r.file_type,r.file_shadow,r.file_ref_sl_no,r.issuing_authority,r.folder_name,r.br_image_name,subject,r.file_reg_date,r.file_move_status,r.part_label,r.parent_file,se.sec_name');
        $this->db->from('fts_file_registration r');
        $this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
       //$this->db->join('fts_pr_report p', 'r.file_id =p.file_id','left');
        $this->db->join('fts_section se', 'r.issuing_authority =se.sec_id','left');
        $this->db->join('fts_final_report fr','r.file_id=fr.file_id','left');
        $this->db->where('file_type','CRIME');
		
		$this->db->where('r.file_id > 0');  
        
		$this->db->where('r.sub_sec in('.trim($sec_arr,",").')');
		$this->db->where('fr.file_id is NULL');
        
        $query = $this->db->get();
        $result=$query->result_array();

        return $result;
        }
        
        public function usrwise_cfile_current($sec_arr) {
			$user_id=$this->session->userdata('user_id');
			$this->db->select('m.reciver_user_id,r.file_id,r.sub_sec,m.file_status,m.store_at,r.file_type,r.file_shadow,r.file_ref_sl_no,r.issuing_authority,r.folder_name,r.br_image_name,subject,r.file_reg_date,r.file_move_status,r.part_label,r.parent_file,se.sec_name');
			$this->db->from('fts_file_registration r');
			$this->db->join('fts_file_movement m', 'r.file_id =m.file_id','left');
			
			$this->db->join('fts_section se', 'r.issuing_authority =se.sec_id','left');
			$this->db->where('file_type','CRIME');
			
			$this->db->where('r.file_id > 0');
			
			$this->db->where('r.sub_sec in('.trim($sec_arr,",").')');
			
			$query = $this->db->get();
			$result=$query->result_array();
			$result['total']=$query->num_rows();
			return $result;
        }

    public function recive_letter($user_id)
    {
       $this->db->select('recv_id');
       $this->db->where('recv_id',$user_id);
       $query = $this->db->get('fts_letter_history_info'); 
       return  $query->num_rows();
        
    }

     public function sent_letter($user_id)
    {
		$today=date('Y-m-d');
		$last_wk=date("Y-m-d", time()-86400*2);
		
		
		$this->db->select('sender_user_id');
       $this->db->where('sender_user_id',$user_id);
		//$this->db->where('date_of_action BETWEEN "'. date('Y-m-d', strtotime($last_wk)). '" and "'. date('Y-m-d', strtotime($today)) .'"');
       $query = $this->db->get('fts_letter_history_info'); 
      // echo($this->db->last_query());
	   
	   return $query->num_rows();
        
    }
	

	
    public function sec_name($sec)
        {
            
            $this->db->select('sec_name');
            $this->db->from('fts_section');
            $this->db->where('sec_id',$sec);
            $query=$this->db->get();
            $result=$query->row_array();
            
            return $result;
            
        }

	public function active_user_dash()
	{
    
		$this->db->select('user_id');
		$this->db->where('is_login','1');
		$query = $this->db->get('fts_user'); 
		
		$data['count']=$query->num_rows();
		
		return $data;
	}

    public function active_user()
  {
    //select distinct (`user_id`) from fts_login_log;
	$data=array();
    //$this->db->distinct();
    $this->db->select('user_id,name,last_login,phone');
	$this->db->where('is_login','1');
    $query = $this->db->get('fts_user'); 
	//echo($this->db->last_query());exit;
     $data['count']=$query->num_rows();
	$data['results']=$query->result_array();
	return $data;
  }
        
    public function section_pletter($sec=array())
    {

      $res=array();
        foreach ($sec as $k=>$value) {
          $this->db->select('s.sec_name as sec,count(*) as count');
            $this->db->where('r.reciever_sec',$value);
            $this->db->where('r.letter_move_status','P');
           // $this->db->or_where('m.recv_status !=','S');
           $this->db->from('fts_letter_record r');
           $this->db->join('fts_section s', 'r.reciever_sec =s.sec_id');
           $this->db->group_by('sec');
          // echo($this->db->last_query());exit;
           $query = $this->db->get(); 
           
           $result1[$k]=$query->result_array();
           $section[$k]=$this->sec_name($value);
         }
           $result[0]=$result1;
           $result[1]=$section;
       return $result; 
        
    }

    public function recv_pletter($sec=array())
    {
     // print_r($sec);exit;
        foreach ($sec as $k=>$value) {
          $this->db->select('s.sec_name as sec,count(*) as count');
            $this->db->where('m.reciever_sec',$value);
            $this->db->where('m.recv_status !=','S');
           $this->db->from('fts_letter_movement m');
           $this->db->join('fts_section s', 'm.reciever_sec =s.sec_id');
           $this->db->group_by('sec');
          // echo($this->db->last_query());exit;
           $query = $this->db->get(); 
           
          $result1[$k]=$query->result_array();
          
           $section[$k]=$this->sec_name($value);
         }//print_r($result1);exit;
           $result[0]=$result1;
           $result[1]=$section;
       return $result; 
        
    }

     public function login_time($user_id)
    {
       $this->db->select('last_login');
       $this->db->where('user_id',$user_id);
       $query = $this->db->get('fts_user'); 
       $result=$query->row();
       return $result->last_login; 
        
    }

    public function total_user()
    {
        $this->db->select('user_id');
       $this->db->where('is_deleted','N');
       $query = $this->db->get('fts_user'); 
       return $query->num_rows();
        
    }
	
    public function recive_file($user_id)
    {
       $this->db->select('reciver_user_id');
       $this->db->where('reciver_user_id',$user_id);
       $this->db->where('file_status !=','A');
       $query = $this->db->get('fts_file_movement'); 
       return  $query->num_rows();

        
    }
	public function file_inbox($user_id)
    {
       $this->db->select('user_id');
       $this->db->where('user_id',$user_id);
       // $this->db->where('action_type','R');
       $query = $this->db->get('fts_file_history_info'); 
       return  $query->num_rows();

        
    }

	/*fetch access section*/

	public function user_access_sec($user_id)
	{
		$sql="select access_section from fts_personel_info where user_id='".$user_id."'";
		$query = $this->db->query($sql); 
		$result=$query->result_array();
		//echo($this->db->last_query());exit;
		//print_r($result);exit;
		return $result;
   }




	public function pr_chart($sec_id)
	{
		//print_r($sec_id);exit;
		$today=date('Y-m-d');
		$sql="select max(p.pr_date),count(p.file_id),r.sec_id,DATEDIFF('$today',max(pr_date)) as day from fts_file_registration r join fts_pr_report p ON r.file_id=p.file_id where FIND_IN_SET(r.sub_sec,'$sec_id')  group by p.file_id having day >60";
		$query = $this->db->query($sql); 
		$result=$query->num_rows();
		//echo($this->db->last_query());exit;
		//print_r($result);exit;
		return $result;


	}

public function pr_section_wise_crime_file($sec_id,$color)
	{
		$today=date('Y-m-d');
		if($color=='red')
		{

			/**$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,r.file_ref_sl_no,fr.final_id,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day 
			from fts_file_registration r 
			left join fts_pr_report p ON r.file_id=p.file_id 
			
			left join fts_file_movement m ON r.file_id=m.file_id 
			left join fts_final_report fr ON p.file_id=fr.file_id
			
			where r.sub_sec='$sec_id' and file_type='CRIME' and fr.final_id is null 
			group by p.file_id having day >60";**/
			
			$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,r.file_ref_sl_no,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day 
			from fts_file_registration r 
			left join fts_pr_report p ON r.file_id=p.file_id 
			
			left join fts_file_movement m ON r.file_id=m.file_id 
			left join fts_final_report fr ON p.file_id=fr.file_id
			
			where r.sub_sec='$sec_id' and file_type='CRIME' and NOT EXISTS 
                (SELECT fr.file_id
                 FROM fts_final_report fr
                 WHERE fr.file_id=r.file_id)
			group by p.file_id having day >60";
			
			$query = $this->db->query($sql); 
			$red=$query->result_array();
			//echo $this->db->last_query();Exit;
			//$red_file_count=$query->num_rows();
			$result=$red;
			return $result;
		}

		if($color=='orange')
		{
			
			/**$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,r.file_ref_sl_no,fr.final_id,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day 
			from fts_file_registration r
			left join fts_pr_report p ON r.file_id=p.file_id 
			left join fts_file_movement m ON r.file_id=m.file_id 
			left join fts_final_report fr ON p.file_id=fr.file_id
			where r.sub_sec='$sec_id' and file_type='CRIME' and fr.final_id is null
			group by p.file_id having day >30 and day <=60 ";**/
			
			$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,r.file_ref_sl_no,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day 
			from fts_file_registration r
			left join fts_pr_report p ON r.file_id=p.file_id 
			left join fts_file_movement m ON r.file_id=m.file_id 
			
			where r.sub_sec='$sec_id' and file_type='CRIME' and NOT EXISTS 
                (SELECT fr.file_id
                 FROM fts_final_report fr
                 WHERE fr.file_id=r.file_id)
			group by p.file_id having day >30 and day <=60 ";
			
			$query = $this->db->query($sql); 
			$orange=$query->result_array();
			//$orange_file_count=$query->num_rows();
			//echo($this->db->last_query());EXIT;
			//print_r($orange_file_count);exit;
			$result=$orange;
			return $result;
		}

		if($color=='green')
		{
			/**$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,fr.final_id,r.file_ref_sl_no,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day 
			from fts_file_registration r 
			left join fts_pr_report p ON r.file_id=p.file_id 
			left join fts_file_movement m ON r.file_id=m.file_id 
			left join fts_final_report fr ON p.file_id=fr.file_id 
			where r.sub_sec='$sec_id' and file_type='CRIME' and fr.final_id is null
			group by p.file_id having day <=30 ";**/
			
			$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,r.file_ref_sl_no,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day 
			from fts_file_registration r 
			left join fts_pr_report p ON r.file_id=p.file_id 
			left join fts_file_movement m ON r.file_id=m.file_id 
			 
			where r.sub_sec='$sec_id' and file_type='CRIME' and NOT EXISTS 
                (SELECT fr.file_id
                 FROM fts_final_report fr
                 WHERE fr.file_id=r.file_id)
			group by p.file_id having day <=30 ";
			
			$query = $this->db->query($sql); 
			$green=$query->result_array();
			//$green_file_count=$query->num_rows();
			$result=$green;
			return $result;
		}
		
		if($color=='blue')
		{
			//$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_id,r.file_ref_sl_no,r.subject,r.sub_sec,DATEDIFF('$today',max(p.pr_date)) as day from fts_file_registration r join fts_pr_report p ON r.file_id=p.file_id join fts_file_movement m ON r.file_id=m.file_id where r.sub_sec='$sec_id' and file_type='CRIME' and m.file_status!='R' group by p.file_id having day <=30 ";

			/**$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_ref_sl_no,fr.final_id,r.subject,r.file_id,p.pr_no,r.sub_sec from fts_file_registration r 
			left join fts_pr_report p ON r.file_id=p.file_id 
			left join fts_file_movement m ON r.file_id=m.file_id 
			left join fts_final_report fr ON p.file_id=fr.file_id 
			where p.pr_no is Null and r.sub_sec='$sec_id' and file_type='CRIME' and fr.final_id is null";**/
			
			$sql="select m.reciver_user_id,m.file_status,m.store_at,r.file_type, r.issuing_authority,r.file_ref_sl_no,r.subject,r.file_id,p.pr_no,r.sub_sec from fts_file_registration r 
    			left join fts_pr_report p ON r.file_id=p.file_id 
    			left join fts_file_movement m ON r.file_id=m.file_id 
    			where p.pr_no is Null and r.sub_sec='$sec_id' and file_type='CRIME' and NOT EXISTS 
                (SELECT fr.file_id
                 FROM fts_final_report fr
                 WHERE fr.file_id=r.file_id)";


			$query = $this->db->query($sql); 
			$blue=$query->result_array();
			//$blue_file_count=$query->num_rows();
			$result=$blue;
			return $result;
		}
			//return $result;
	}

	public function section_wise_crime_file($sec_id)
	{
		
		$sec_id=trim($sec_id,"'");
		
		
		$today=date('Y-m-d');
		/**$sql="select count(r.file_id) as total,r.sub_sec,s.sec_name, s.inves_power, r.sub_sec from fts_file_registration r join fts_section s ON r.sub_sec=s.sec_id left join fts_final_report fr ON r.file_id=fr.file_id 
		where r.sub_sec=s.sec_id and r.sub_sec in ($sec_id) and s.inves_power='1' and r.file_type='CRIME'   and fr.final_id is null group BY sub_sec";**/
		
		$sql="select count(r.file_id) as total,r.sub_sec,s.sec_name, s.inves_power, r.sub_sec 
		from fts_file_registration r 
		join fts_section s ON r.sub_sec=s.sec_id 
		where r.sub_sec=s.sec_id and r.sub_sec in ($sec_id) and s.inves_power='1' and r.file_type='CRIME'   and NOT EXISTS 
                (SELECT fr.file_id
                 FROM fts_final_report fr
                 WHERE fr.file_id=r.file_id) group BY sub_sec";
		
		$query = $this->db->query($sql); 
		$result=$query->result_array();
		

		$green=array();
		$orange=array();
		$red=array();
		
		
		
		$sql1="select r.sub_sec,r.file_id,DATEDIFF('$today',max(p.pr_date)) as day 
		from fts_file_registration r 
		left join fts_pr_report p ON r.file_id=p.file_id  
		
		where r.sub_sec in ($sec_id) and r.file_type='CRIME' and NOT EXISTS 
                (SELECT fr.file_id
                 FROM fts_final_report fr
                 WHERE fr.file_id=r.file_id) group BY file_id";
		
		$query = $this->db->query($sql1); 
		//echo($this->db->last_query());exit;
		$record=$query->result_array();
		
		
		$final=array();
		foreach($result as $k=>$sect){
			
			$g_count=0;
			$o_count=0;
			$r_count=0;
			$b_count=0;
			//echo("<pre>");print_r($sect);
			$final[$k]['grn']=$g_count;
			$final[$k]['orng']=$o_count;
			$final[$k]['red']=$r_count;
			$final[$k]['blue']=$b_count;
			foreach($record as $i=>$val){
				//echo("<pre>");print_r($val);
				if($sect['sub_sec']==$val['sub_sec']){
					$final[$k]['sec_id']=$val['sub_sec'];
					if(is_null($val['day']))
					{
					    $b_count++;
						$final[$k]['blue']=$b_count;
					}
					else if($val['day']>=0 && $val['day']<=30){
						$g_count++;
						$final[$k]['grn']=$g_count;
					}
					
					else if($val['day']>30 && $val['day']<=60){
						$o_count++;
						$final[$k]['orng']=$o_count;
					}
					
                    else if($val['day']>60){
						$r_count++;
						$final[$k]['red']=$r_count;
					}
					
				
					
					$final[$k]['total']=$sect['total'];
				}
				
				
			}
		}
	
		$rec_set=array();
		//echo "<pre>" ; print_r($final);exit;
		foreach($final as $j=>$val){
			$rec_set[$j]['sec_id']=$val['sec_id'];
			$rec_set[$j]['grn']=($val['grn']*100)/$val['total'];
			$rec_set[$j]['orng']=($val['orng']*100)/$val['total'];
			$rec_set[$j]['red']=($val['red']*100)/$val['total'];
			//$rec_set[$j]['red']=$val['red'];
			$rec_set[$j]['blue']=($val['blue']*100)/$val['total'];
			$rec_set[$j]['total']=$val['total'];
			$rec_set[$j]['perc']=(((2*$val['grn'])+(1*$val['orng'])+(0*$val['red']))/($val['total']*2))*100;
			
		}
		//echo "<pre>----" ; print_r($rec_set);exit;
		
		return $rec_set;


	}


	
     public function sent_files($user_id)
    {
       
       $this->db->select("*");
	   $this->db->where('h.user_id',$user_id);
       $this->db->where('h.action_type','D');
	    $this->db->from('fts_file_history_info h');
        $this->db->join('fts_file_registration r', 'r.file_id =h.file_id');
		$this->db->join('fts_file_movement m', 'r.file_id =m.file_id');
		$this->db->join('fts_user u', 'h.addressing_id =u.user_id');
		$this->db->order_by('h.date_of_action','desc'); 
       $query = $this->db->get(); 
	   
	  
	   $result=$query->result_array();
       return  $result;

        
    }
	
	
	
	 public function sent_file($user_id)
    {
       $this->db->select('user_id');
       $this->db->where('user_id',$user_id);
       $this->db->where('action_type','D');
       $query = $this->db->get('fts_file_history_info'); 
       return  $query->num_rows();

        
    }
	
		
	public function pr_added_within_month($sec_id)
	{
		

		$today=date('Y-m-d');
		//$sql ="SELECT `pr_date`,`file_id`,DATEDIFF('$today',max(pr_date)) as day FROM `fts_pr_report` group by file_id having day <=30";
		$sql="select max(p.pr_date),count(p.file_id),r.sec_id,DATEDIFF('$today',max(pr_date)) as day,r.file_id,r.file_ref_sl_no,r.subject,m.store_at,m.file_status,r.file_move_status,r.sub_sec,r.file_type,r.part_label,r.file_reg_date,m.reciver_user_id from fts_file_registration r left join fts_file_movement m ON r.file_id=m.file_id join fts_pr_report p ON r.file_id=p.file_id left join fts_final_report fr ON r.file_id=fr.file_id where FIND_IN_SET(r.sub_sec,'$sec_id') and r.file_type='CRIME' and fr.file_id is NULL group by p.file_id having day <=30";
		$query = $this->db->query($sql); 
		$result=$query->result_array();
		//print_r($result);exit;
		//echo($this->db->last_query());exit;
		return $result;

		
	}


	public function pr_added_within_two_month($sec_id)
	{
		

		$today=date('Y-m-d');
		//$sql ="SELECT `pr_date`,`file_id`,DATEDIFF('$today',max(pr_date)) as day FROM `fts_pr_report` group by file_id having day >30 AND day <=60";
		$sql="select max(p.pr_date),count(p.file_id),r.sec_id,DATEDIFF('$today',max(pr_date)) as day,r.file_id,r.file_ref_sl_no,r.subject,m.store_at,m.file_status,r.file_move_status,r.sub_sec,r.file_type,r.part_label,r.file_reg_date,m.reciver_user_id from fts_file_registration r left join fts_file_movement m ON r.file_id=m.file_id join fts_pr_report p ON r.file_id=p.file_id left join fts_final_report fr ON r.file_id=fr.file_id where FIND_IN_SET(r.sub_sec,'$sec_id') and file_type='CRIME' and fr.file_id is NULL group by p.file_id having day >30 AND day <=60";
		$query = $this->db->query($sql); 
		$result=$query->result_array();
		//print_r($result);exit;
		return $result;

		
	}


public function pr_added_more_two_month($sec_id)
	{
		

		$today=date('Y-m-d');
		//$sql ="SELECT `pr_date`,`file_id`,DATEDIFF('$today',max(pr_date)) as day FROM `fts_pr_report` group by file_id having day >60";
		$sql="select max(p.pr_date),count(p.file_id),r.sec_id,DATEDIFF('$today',max(pr_date)) as day,r.file_id,r.file_ref_sl_no,r.subject,m.store_at,m.file_status,r.file_move_status,r.sub_sec,r.file_type,r.part_label,r.file_reg_date,m.reciver_user_id from fts_file_registration r left join fts_file_movement m ON r.file_id=m.file_id join fts_pr_report p ON r.file_id=p.file_id left join fts_final_report fr ON r.file_id=fr.file_id where FIND_IN_SET(r.sub_sec,'$sec_id') and file_type='CRIME' and fr.file_id is NULL group by p.file_id having day >60";
		$query = $this->db->query($sql); 
		$result=$query->result_array();
		//print_r($result);exit;
		return $result;

		
	}

public function pr_not_added($sec_id)
	{
		$today=date('Y-m-d');
		//$sql="select file_id from fts_pr_report where pr_no=' '";
		//$sql="select max(p.pr_date),p.file_id,r.sec_id,r.sub_sec,DATEDIFF('$today',max(pr_date)) as day from fts_file_registration r join fts_pr_report p ON r.file_id=p.file_id where FIND_IN_SET(r.sub_sec,'$sec_id') and file_type='CRIME' group by p.file_id";

		$sql="select r.file_id,p.pr_no,r.sub_sec,r.file_id,r.file_ref_sl_no,r.subject,r.file_reg_date,m.file_status,m.store_at,m.reciver_user_id,r.file_type,r.part_label from fts_file_registration r left join fts_file_movement m ON r.file_id=m.file_id left join fts_pr_report p ON r.file_id=p.file_id left join fts_final_report fr ON r.file_id=fr.file_id where p.pr_no is Null and FIND_IN_SET(r.sub_sec,'$sec_id') and file_type='CRIME' and fr.file_id is NULL";


		$query = $this->db->query($sql); 
		$result=$query->result_array();
		//print_r($result);exit;
		//echo($this->db->last_query());exit;
		return $result;

		
	}
}
?>