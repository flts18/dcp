<?php
class User_model extends CI_Model
{
    public function __construct()
    {
	parent::__construct();
    }
    
    
    public function get_email_ph($u_id) 
		{
			$this->db->select('u.email,u.phone');
			$this->db->from('fts_user u');
			$this->db->where('u.user_id',$u_id);
			$query = $this->db->get();
			$result=$query->row_array();
			
			return $result;
        }  
        
    public function fetch_co() {
       
		$sql = "SELECT u.`user_id`,`name` FROM `fts_user` u join fts_personel_info p on u.`user_id`= p.user_id left join fts_section s on p.sec_id = s.sec_id WHERE u.`user_rank`> 1 and s.inves_power= 1 or p.sec_id=0 ";
        $query= $this->db->query($sql);
        $result=$query->result_array();
		//return $this->db->last_query();
        
          
         return  $result;

        }  
         public function fetch_usr_list()
        {
            $this->db->select('u.user_id,name');
            $this->db->from('fts_user u');
		    $query=$this->db->get();
            $result=$query->result_array();
            //print_r($result);exit;
            return $result;
            
        }
		 public function fetch_desig_list()
        {
            $this->db->select('desig_id,desig_name');
            $this->db->from('fts_designation');
            $this->db->order_by("desig_name", "asc");
		    $query=$this->db->get();
            $result=$query->result_array();
            //print_r($result);exit;
            return $result;
            
        }
		public function fetch_sec_list()
        {
            $this->db->select('sec_id,sec_name');
            $this->db->from('fts_section');
		    $query=$this->db->get();
            $result=$query->result_array();
            //print_r($result);exit;
            return $result;
            
        }
// user authenticate check
    function authenticate($username, $password)
    {
		$sql = "SELECT * FROM fts_user WHERE
                user_name = '".$this->db->escape_str($username)."' AND password = '".$this->db->escape_str($password)."' ";
		$query= $this->db->query($sql);
		$result_arr= $query->result_array();
		if( isset($result_arr[0]) )
            return $result_arr[0];
		else
            return false;
    }
    
    // login session value initialization
    function log_this_login($user_data)
    {

		$this->db->update('fts_user', array('last_login'=>date('Y-m-d H:i:s'),'is_login'=>1),array('user_id'=>$user_data['user_id'])); 
	    $session_data   = array('user_id'=>$user_data['user_id'],
                                'fullname'=>$user_data['name'],
                                'user_type'=>$user_data['user_type'],
								'is_login'=>$user_data['is_login'],
                                'gpf_id'=>$user_data['gpf_id'],
                                'rank'  =>fetch_rank($user_data['user_id'])
							 );

		//print_r($session_data);exit;
        $this->session->set_userdata($session_data);
    }
    
    public function user_byrank($designation_id) {
        $this->db->select('user_id,name');
        $this->db->from('fts_user u');
        $this->db->where('user_rank',$designation_id);
        $query = $this->db->get();
        $result=$query->result_array();
		//return $this->db->last_query();
        
          
         return  $result;

        }  
        
     public function fetch_usr_bysec($sec,$rank="")
        {
          
            
            $this->db->select('p.user_id');
            $this->db->from('fts_personel_info p');
			$this->db->join('fts_user u', 'p.user_id=u.user_id');
            $this->db->where('sec_id',$sec);
			if($rank !=""){
				$this->db->where('user_rank',$rank);
			}
			
            $query=$this->db->get();
            $result=$query->row_array();
            //print_r($result);exit;
            return $result["user_id"];
            
        }
	function forceLogoutOnbrowserClose()
	{
		$this->db->update('fts_user', array('is_login'=>0),array('user_id'=>$this->session->userdata('user_id'))); 
	}
	
	function setUserLoginOn()
	{
		$this->db->update('fts_user', array('is_login'=>1,'last_login'=> date('Y-m-d H:i:s')),array('user_id'=>$this->session->userdata('user_id'))); 
	}
    //logout
    function logout()
    {
         $this->session->unset_userdata('captchaCode');
		$this->db->update('fts_user', array('is_login'=>0),array('user_id'=>$this->session->userdata('user_id'))); 
       $session_data   = array('user_id',
                                'gpf_id',
                                'user_type',
								'is_login',
                                'fullname',
                                'totalIns'
							 );
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
    }
	
	//user_profile
		public function profile()
		{
		$this->db->select('u.user_id,u.name,u.gpf_id,u.user_name,u.phone,u.email,u.password,
		p.desig_id,p.sec_id,u.gender');
        $this->db->from('fts_user u');
        $this->db->join('fts_personel_info p', 'u.user_id=p.user_id');
        $this->db->where('p.user_id',$this->session->userdata('user_id'));
        $query = $this->db->get();
        $result=$query->result_array();
        return  $result;
        
		}
		
		public function accesss_sec()
		{
		$this->db->select('p.access_section');
        $this->db->from('fts_user u');
        $this->db->join('fts_personel_info p', 'u.user_id=p.user_id');
        $this->db->where('p.user_id',$this->session->userdata('user_id'));
        $query = $this->db->get();
        $result=$query->result_array();
		//print_r($result);exit;
        return  $result[0]['access_section'];
        
		}
		
        // //user_profile
        // public function fetche_status()
        // {
        // $this->db->select('user_type');
        // $this->db->from('fts_user u');
       
        // $this->db->where('u.user_id',$this->session->userdata('user_id'));
        // $query = $this->db->get();
        // $result=$query->result_array();
        // return  $result;
        
        // }

		//setting
		public function setting()
		{
		$this->db->select('u.user_id,u.gpf_id,u.user_name,u.phone,u.email,u.password');
		$this->db->from('fts_user u');
		$result=$this->db->get();
			return($result);
			
		}
		
		//password check
		public function pass_check()
		{
			
			$this->db->select('password');
			$this->db->from('fts_user');
			$this->db->where('user_id',$this->session->userdata('user_id'));
			$query=$this->db->get();
			$result=$query->result_array();
			return $result;
			
		}

        public function usr_section($uid="")
        {
            if($uid==""){
                $uid=$this->session->userdata('user_id');
            }
            
            $this->db->select('sec_id');
            $this->db->from('fts_personel_info');
            $this->db->where('user_id',$uid);
            $query=$this->db->get();
            $result=$query->result_array();
            
            return $result;
            
        }

        public function check_parent_sec($sec)
        {
            
            $this->db->select('parent_sec as sec_id');
            $this->db->from('fts_section');
            $this->db->where('sec_id',$sec);
            $query=$this->db->get();
            $result=$query->result_array();
            
            return $result;
            
        }

        public function section_by_uid($uid)
        {
            
            $this->db->select('sec_id');
            $this->db->from('fts_personel_info');
            $this->db->where('user_id',$uid);
            $query=$this->db->get();
            $result=$query->result_array();
            
            return $result;
            
        }
         public function sec_name($sec)
        {
            
            $this->db->select('sec_name');
            $this->db->from('fts_section');
            $this->db->where('sec_id',$sec);
            $query=$this->db->get();
            $result=$query->row();
            
            return $result;
            
        }
		public function usr_acc_section()
        {
            
            $this->db->select('access_section');
            $this->db->from('fts_personel_info');
            $this->db->where('user_id',$this->session->userdata('user_id'));
            $query=$this->db->get();
            $result=$query->result_array();
            
            return $result;
            
        }
		public function parent_sec()
        {
            
            $this->db->select('*');
            $this->db->from('fts_section');
            $this->db->where('parent_sec =0');
            $this->db->order_by('sec_name', 'asc');
            $query=$this->db->get();
            $result=$query->result_array();
            //echo($this->db->last_query());exit;
            return $result;
            
        }
	
        public function get_subsec($sec)
        {
            
            $this->db->select('sec_id,sec_name,sec_code');
            $this->db->from('fts_section');
            $this->db->where('parent_sec',$sec);
            $this->db->order_by('sec_name', 'asc');
            $query=$this->db->get();
            $result=$query->result_array();

            //echo($this->db->last_query());exit;
            return $result;
            
        }

	//user count
    // public function user_count() {
    //     return $this->db->count_all("fts_user");
    // }
    public function user_count($utype) {
        $usr_sec=$this->usr_section();
        $this->db->select('*');
        $this->db->from('fts_user u');
        
        $this->db->join('fts_personel_info p', 'u.user_id =p.user_id','left');
        $this->db->join('fts_section s', 'p.sec_id =s.sec_id','left');
         if($utype=="priv_user"){
            $this->db->where("p.sec_id",$usr_sec[0]['sec_id']);
            $this->db->or_where("s.parent_sec",$usr_sec[0]['sec_id']);
        }
        $this->db->order_by('u.user_id', 'desc');
        //$this->db->limit($limit, $start);

        $query = $this->db->get();
        $result = $query->result_array();
        return count($result);
    }
    // user data
    public function fetch_user_data($utype,$limit, $start) {
        $usr_sec=$this->usr_section();
        //
        $this->db->select('*');
        $this->db->from('fts_user u');
        
        $this->db->join('fts_personel_info p', 'u.user_id =p.user_id','left');
        $this->db->join('fts_section s', 'p.sec_id =s.sec_id','left');
        if($utype=="priv_user"){
           // print_r($usr_sec);exit;
             $this->db->where("p.sec_id",$usr_sec[0]['sec_id']);
             $this->db->or_where("s.parent_sec",$usr_sec[0]['sec_id']);
        }
       
        $this->db->order_by('u.user_id', 'desc');
        $this->db->limit($limit, $start);

        $query = $this->db->get();
         //print_r($this->db->last_query());exit;
        $desig_name= array();
        $sec_name=array();

        if ($query->num_rows() > 0) {
            $data_value=array();
            $desig_name=array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;

                $desig=explode(',', $row['desig_id']);
                $section=explode(',', $row['sec_id']);
                //print_r( $section);exit;
                $query2=$this->designation($desig);
                $query3=$this->section($section);
                //if(sizeof($query3)>1){ print_r(sizeof($query3));exit;}
               
                $uid=$row['user_id'];
               
                $d_name="";
                foreach ($query2 as $value) {

                    //echo $uid;
                    $d_name.=$value['desig_name'].',';
                   
                }//exit;
                $desig_name[$uid]=$d_name;
                $s_name="";
                foreach ($query3 as $value) {

                    //echo $uid;
                    $s_name.=$value['sec_name'].',';
                   
                }//exit;
                $sec_name[$uid]=$s_name;
            }
           
            $data_value[0]=$data;
            $data_value[1]=$desig_name;
            $data_value[2]=$sec_name;
           // print_r($data_value[2]);exit;
            return $data_value;
        }
        return false;
   }

// user data
    public function fetch_user_all($limit, $start) {
        $usr_sec=$this->usr_section();
        $this->db->select('*');
        $this->db->from('fts_user u');
        
        $this->db->join('fts_personel_info p', 'u.user_id =p.user_id','left');
        $this->db->join('fts_section s', 'p.sec_id =s.sec_id','left');
        $this->db->order_by('u.user_id', 'desc');
        $this->db->limit($limit, $start);

        $query = $this->db->get();
         //print_r($this->db->last_query());exit;
        $desig_name= array();
        $sec_name=array();

        if ($query->num_rows() > 0) {
            $data_value=array();
            $desig_name=array();
            foreach ($query->result_array() as $row) {
                $data[] = $row;

                $desig=explode(',', $row['desig_id']);
                $section=explode(',', $row['sec_id']);
                //print_r($desig);exit;
                $query2=$this->designation($desig);
                $query3=$this->section($section);
               // print_r($query2);exit;
                $uid=$row['user_id'];
               
                $d_name="";
                foreach ($query2 as $value) {

                    //echo $uid;
                    $d_name.=$value['desig_name'].',';
                   
                }//exit;
                $desig_name[$uid]=$d_name;
                $s_name="";
                foreach ($query3 as $value) {

                    //echo $uid;
                    $s_name.=$value['sec_name'].',';
                   
                }//exit;
                $sec_name[$uid]=$s_name;
            }
           
            $data_value[0]=$data;
            $data_value[1]=$desig_name;
            $data_value[2]=$sec_name;
            return $data_value;
        }
        return false;
   }


   public function designation($condition) 
    {   
        $this->db->where_in('desig_id',$condition); 
        $query = $this->db->get('fts_designation');
       return $query->result_array();
       //echo $this->db->last_query();
    }
	
	public function section($condition)
	{
	    $this->db->where_in('sec_id',$condition); 
        $query = $this->db->get('fts_section');
       // print_r($query->result_array());exit;
        return $query->result_array();
	}

// public function sec_name($sec_id)
//     {
//         $this->db->select('sec_name');
//         $this->db->from('fts_section');
//         $this->db->where('sec_id',$sec_id);
//         $query = $this->db->get();
//         $result =  $query->row();
//         return $result['sec_name'];
//     }
    // check valid mail id for forget password
        public function chk_mid($data)
        {
                $query=$this->db->query("Select email from fts_user where email='$data'");  
                if($query->num_rows()==1)
                {
                return TRUE;
                }
                else 
                {
                return FALSE;
                }
                
        }
	// generate password if forgot
        public function new_pass($password,$email)
        {
            $this->db->update('fts_user', array('password'=>$password),array('email'=>$email)); 
            return $this->db->affected_rows();          
            
        }

    public function user_status_chang($user_id)
     {
        $this->db->select('u.is_active');
        $this->db->from('fts_user u');
        $this->db->where('u.user_id',$user_id);
        $query = $this->db->get();
        $result=$query->result_array();
        if($result[0]['is_active']=='Y')
        {
           $this->db->update('fts_user', array('is_active'=>'N'),array('user_id'=>$user_id)); 
           if($this->db->affected_rows())
           {
            login_log(doctype_action('UMI'),'U',$user_id);
            return '<label style="color:red">Inactive</label>';
           }
        }
        else
        {
           $this->db->update('fts_user', array('is_active'=>'Y'),array('user_id'=>$user_id)); 
           if($this->db->affected_rows())
           {
            login_log(doctype_action('UMA'),'U',$user_id);
            return '<label style="color:green">Active</label>';
          }
        }
     }

//user permission..
public function user_permit_chang($user_id,$permt_name,$permt_val)
     {
        $this->db->select($permt_name);
        $this->db->from('fts_user u');
        $this->db->where('u.user_id',$user_id);
        $query = $this->db->get();
        $result=$query->result_array();
         if($result[0][$permt_name]==1)
         {
           $this->db->update('fts_user', array($permt_name=>0),array('user_id'=>$user_id));

           if($this->db->affected_rows())
           {
            login_log(doctype_action('UMP'),'U',$user_id);
            //return 1;
            //return '<label style="color:red">Inactive</label>';
           }
           //return $this->db->last_query();
        }
        else
        {
           $this->db->update('fts_user', array($permt_name=>1),array('user_id'=>$user_id)); 
           if($this->db->affected_rows())
           {
            login_log(doctype_action('UMP'),'U',$user_id);
            //return '<label style="color:green">Active</label>';
          }
        }
     }

         public function user_type_chang($user_id,$typevalue)
         {
            
            if($typevalue=="normal_user"){
                $data=array(
                    'user_type'=>$typevalue,
                    'permit_file'=>'0',
                    'permit_sub_sec'=>'0',
                    'permit_sec'=>'0'
                );
            }
            else if($typevalue=="priv_user"){
                $data=array(
                    'user_type'=>$typevalue,
                    'permit_file'=>'1',
                    'permit_sub_sec'=>'1',
                    'permit_sec'=>'0'
                );
            }
            else if($typevalue=="super_user"){
                $data=array(
                    'user_type'=>$typevalue,
                    'permit_file'=>'1',
                    'permit_sub_sec'=>'0',
                    'permit_sec'=>'0'
                );
            }
            

             $this->db->update('fts_user', $data ,array('user_id'=>$user_id));
         }

}

?>