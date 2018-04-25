<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('file_name_folder'))
{
  function file_name_folder($file_id)
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('file_id,file_ref_sl_no,folder_name');
          $ci->db->where('file_id',$file_id);
          //$ci->db->where('is_active','Y');
          $query = $ci->db->get('fts_file_registration');
          $result = $query->row_array();

          if(is_array($result) && count($result)>0)
          {

            return $result;
          }
          else
          {

              return "";
              
          }


   
  
}}
if ( ! function_exists('render'))
{
   function render($content)
  {
    $ci =& get_instance();
    $view_data=array('content' =>$content);
    $ci->load->view('layout',$view_data);
  }
  
}
if ( ! function_exists('fetch_rank'))
{
  function fetch_rank($user_id)
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('user_rank');
          $ci->db->where('user_id',$user_id);
          //$ci->db->where('is_active','Y');
          $query = $ci->db->get('fts_user');
          $result = $query->row_array();

          if(is_array($result) && count($result)>0)
          {

            return $result['user_rank'];
          }
          else
          {

              return "";
              
          }


   
  
}}
if ( ! function_exists('fetch_user_name'))
{
  function fetch_user_name($user_id)
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('name');
          $ci->db->where('user_id',$user_id);
          //$ci->db->where('is_active','Y');
          $query = $ci->db->get('fts_user');
          $result = $query->row_array();

          if(is_array($result) && count($result)>0)
          {

            return $result['name'];
          }
          else
          {

              return "";
              
          }


   
  
}}

if ( ! function_exists('fetch_file_name'))
{
  function fetch_file_name($file_id)
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('file_ref_sl_no');
          $ci->db->where('file_id',$file_id);
          //$ci->db->where('is_active','Y');
          $query = $ci->db->get('fts_file_registration');
          $result = $query->row_array();

          if(is_array($result) && count($result)>0)
          {

            return $result['file_ref_sl_no'];
          }
          else
          {

              return "";
              
          }


   
  
}}

if ( ! function_exists('check_mark'))
{
  function check_mark()
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('m.file_id,receiver_id,file_ref_sl_no,subject');
          $ci->db->where('receiver_id',$ci->session->userdata('user_id'));
		  $ci->db->where('is_sent =0');
		  $ci->db->from('fts_file_markup m');
          $ci->db->join('fts_file_registration f', 'f.file_id =m.file_id');
          $query = $ci->db->get();
          $result = $query->result_array();

          if(is_array($result) && count($result)>0)
          {

            return $result;
          }
          else
          {

              return false;
              
          }


   
  
}}


if ( ! function_exists('fetch_sec_name'))
{
  function fetch_sec_name($sec_id)
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('sec_name');
          $ci->db->where('sec_id',$sec_id);
          //$ci->db->where('is_active','Y');
          $query = $ci->db->get('fts_section');
          $result = $query->row_array();

          if(is_array($result) && count($result)>0)
          {

            return $result['sec_name'];
          }
          else
          {

              return "";
              
          }


   
  
}}

if ( ! function_exists('fetch_auth_name'))
{
  function fetch_auth_name($sec_id)
  {

    $ci =& get_instance();
    //echo($ci->session->userdata('user_id'));exit;
    
    
          $ci->db->select('authority_name');
          $ci->db->where('authority_id',$sec_id);
          //$ci->db->where('is_active','Y');
          $query = $ci->db->get('fts_authority');
          $result = $query->row_array();

          if(is_array($result) && count($result)>0)
          {

            return $result['authority_name'];
          }
          else
          {

              return "";
              
          }


   
  
}}

if ( ! function_exists('check_user_page_access'))
{
	function check_user_page_access()
	{

		$ci =& get_instance();
		if( $ci->session->userdata('user_id')=='' || (!$ci->session->userdata('user_id')))
        {
            header('location:'.base_url());
			exit;
        }
	}
}

if ( ! function_exists('get_user_details'))
{
	function get_user_details()
	{
		$ci =& get_instance();
		$result = array();
		$ci->db->select('name,is_active,permit_file,permit_sub_sec,permit_sec,user_type');
		$ci->db->where('user_id',$ci->session->userdata('user_id'));
		$ci->db->where('is_active','Y');
		$query = $ci->db->get('fts_user');
		$result = $query->row_array();

		$ci->session->set_userdata('sessionUserDetails',$result);
		return $result;
		
		/**echo '<pre>';
		print_r($ci->session->userdata('sessionUserDetails'));
		die;
		if(!$ci->session->userdata('sessionUserDetails')) {
			$result = array();
			$ci->db->select('name,is_active,permit_file,permit_sub_sec,permit_sec,user_type');
			$ci->db->where('user_id',$ci->session->userdata('user_id'));
			$ci->db->where('is_active','Y');
			$query = $ci->db->get('fts_user');
			$result = $query->row_array();

			$ci->session->set_userdata('sessionUserDetails',$result);
			return $result;
		} else {
			return $ci->session->userdata('sessionUserDetails');
		}**/
	}
}

if ( ! function_exists('check_user_type'))
{
  function check_user_type($val,$type=array())
  {
    foreach ($type as $value) 
    {
     if($val==$value)
      return true;
    }
    header('location:'.base_url().'home_controller'); 
  }
  
}

if ( ! function_exists('check_user_permission'))
{
  function check_user_permission($val)
  {
    if($val==1)
     {
      return true;
    }
    header('location:'.base_url().'home_controller'); 
  }
  
}


if ( ! function_exists('emp_validation'))
{
  function emp_validation($val)
  {
    $ci =& get_instance();
    $ci->db->where('gpf_id',$val);
    $query = $ci->db->get('fts_employee');
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
  }
  
}



if ( ! function_exists('my_encrypt'))
{
  function id_encrypt($text)
 {
  //echo "trace";
  $salt = md5("dicrebyc");
    return urlencode(trim(base64_encode(base64_encode($text))));
}
  
}


if ( ! function_exists('my_decrypt'))
{
 function id_decrypt($text)
 {
  $salt = md5("dicrebyc");
  $text=urldecode($text);
    return trim(base64_decode(base64_decode($text)));
}
  
}

if ( ! function_exists('fchar'))
{
  function fchar($s)
  {
         $words=preg_replace('/[^A-Za-z0-9\-(]/', ' ', $s);
    $words = preg_split("(\s+)",$words);
    $str="";
    foreach($words as $v)
    {
    if(substr($v,0,1)=='(')
    break;
    $str.=substr($v,0,1);
    }
    return $str;
  }
}

if ( ! function_exists('sec_name'))
{
  function sec_name($sec_id)
  {
        $this->db->select('sec_name');
        $this->db->from('fts_section');
        $this->db->where('sec_id',$sec_id);
        $query = $this->db->get();
        $result =  $query->row();
       // print_r($result);exit;
        return $result['sec_name'];
  }
}


if ( ! function_exists('days_ago'))
{

    function days_ago ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

}

if ( ! function_exists('letter_inbox_count'))
{
  function letter_inbox_count()
  {
    $ci =& get_instance();
    $ci->db->select('m.letter_id');
     $ci->db->from('fts_letter_record r');
     $ci->db->join('fts_letter_movement m', 'r.letter_id =m.letter_id');
     $ci->db->where('m.receiver_id', $ci->session->userdata('user_id'));
	 $ci->db->where('m.letter_status', 'R');
	 $ci->db->where("r.file_id='0'");
      //$ci->db->where('m.recv_status !=', 'S');
    $query = $ci->db->get();
    //echo $ci->db->last_query();exit;
    if ($query->num_rows() > 0){
        return   $query->num_rows() ;
    }
    else{
        return '';
    }
  }
  
}


if ( ! function_exists('file_inbox_count'))
{
  function file_inbox_count()
  {
    $ci =& get_instance();
	$ci->db->select('file_id');
     $ci->db->from('fts_file_movement');
    $ci->db->where('reciver_user_id', $ci->session->userdata('user_id'));
	$ci->db->where('file_status !=', 'A');
    $query = $ci->db->get();
    if ($query->num_rows() > 0){
        return  $query->num_rows() ;
    }
    else{
        return '';
    }
  }
  
}

if ( ! function_exists('file_registar_count'))
{
  function file_registar_count()
  {
    $ci =& get_instance();
    $ci->db->select('file_id');
     $ci->db->from('fts_file_registration');
    $ci->db->where('user_id', $ci->session->userdata('user_id'));
    $ci->db->where('file_move_status !=','M');
    //$ci->db->or_where('file_move_status','A');
    $query = $ci->db->get();
    if ($query->num_rows() > 0){
        return '(' . $query->num_rows() . ')';
    }
    else{
        return '';
    }
  }
  
}

if ( ! function_exists('letter_registar_count'))
{
  function letter_registar_count()
  {
    $ci =& get_instance();
    $ci->db->where('user_id', $ci->session->userdata('user_id'));
    $ci->db->where('letter_move_status','P');
     $ci->db->where('regis_status','L');
    $query = $ci->db->get('fts_letter_record');
    if ($query->num_rows() > 0){
        return '(' . $query->num_rows() . ')';
    }
    else{
        return '';
    }
  }
  
}

if ( ! function_exists('get_client_ip'))
{
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    
    return $ipaddress;
  }
}
if ( ! function_exists('count_day'))
{
  function count_day($date)
  {
   $now = time(); 
   $your_date = strtotime($date);
   $datediff = $now - $your_date;
   return floor($datediff / (60 * 60 * 24));
  }
  
}


if ( ! function_exists('date_color'))
{
  function date_color($date)
  {
	  if(isset($date)){
		  $now = strtotime(date('Y-m-d')); 
		   $your_date = strtotime($date);
			 if($your_date>$now)
			return 'green';
			elseif($your_date==$now)
			return '#f8b230';
			elseif($your_date<$now)
			return 'red';
	  }
   return "#fff";
  }
  
}
if ( ! function_exists('dt_format'))
{
  function dt_format($date)
  {
      $dtt="";
      $dt=explode('/',$date);
      //print_r($dt);exit;
       if(count($dt)>1){
        $dtt= $dt[2].'-'.$dt[1].'-'.$dt[0];
       }
      return $dtt;
  }
  
}
if ( ! function_exists('dt_format'))
{
  function dt_format($date)
  {
      if(strlen($date)> 0){
        $dt=explode('/',$date);
        //print_r($dt);exit;
        $dtt= $dt[2].'-'.$dt[1].'-'.$dt[0];
        return $dtt;
      }
  }
  
}
if ( ! function_exists('db_dt_format'))
{
  function db_dt_format($date)
  {
	   if(strlen($date)> 0){
		  $dt=explode('-',$date);
		  //print_r($dt);exit;
		   if(count($dt)>1){
		    $dtt= $dt[2].'/'.$dt[1].'/'.$dt[0];
		   }
		  return $dtt;
	   }
  }
  
}
if ( ! function_exists('last_pr_date'))
{
  function last_pr_date($fid)
  {
    
     $ci =& get_instance();

   $ci->load->model('File_model');
    $var = $ci->File_model->max_date($fid);
    
      if(($var['dt'])!=''){
           return "Last P.R added on ".db_dt_format($var['dt'])."&nbsp;&nbsp;PR No - ".$var['pr'];
     }
     else{
        return "P.R is not added to this file.";
     }
         
  }
  
}

if ( ! function_exists('fetch_date'))
{
  function fetch_date($fid)
  {
    
     $ci =& get_instance();

   $ci->load->model('File_model');
    $var = $ci->File_model->pr_diff($fid);
	//print_r($var);exit;
    
       
		
		if(($var['dt'])!=''){
/*
              $diff = abs(strtotime(date('Y-m-d')) - strtotime($var['dt']));
              $years = floor($diff / (365*60*60*24));
              $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
              $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            //printf("%d years, %d months, %d days\n", $years, $months, $days);
            $dt_val['days']=$days;
            $dt_val['months']=$months;
            $dt_val['years']=$years;
            //$colr=pr_color($dt_val);
            $dt = $dt_val; 
           // print_r($dt);

*/


            if($var['dt']<=30)
             return 'green';
			elseif($var['dt'] >30 && $var['dt']<=60)
             return '#ffae1a';
            elseif($var['dt']>60)
             return 'red';
            // elseif($var['dt']>365)
             // return 'teal';

         
		}
        else
         {
           return "#0000ff";
         } 
  }
  
}


if ( ! function_exists('dt_sql_format'))
{
  function dt_sql_format($date)
  {
  $dt=explode('-',$date);
  //print_r($dt);exit;
  $dtt= $dt[2].'/'.$dt[1].'/'.$dt[0];
  return $dtt;
  }
  
}

if ( ! function_exists('year'))
{
  function year($y)
  {
  $yy=explode('/',$y);
// echo $y;exit;
  return  $yy[2];
  }
  
}
   
if ( ! function_exists('wordcut'))
{
   function wordcut($string,$char_number)
{
if (strlen($string) > $char_number) {

    $stringCut = substr($string, 0, $char_number);
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
    return  $string;
}
else
{
return  $string;
}
}
}


if ( ! function_exists('login_log'))
{
  function login_log($action,$doc_type,$doc_id)
  {
    $ci =& get_instance();
   $user_id=$ci->session->userdata('user_id');
   $client_ip=get_client_ip();
   $action_time=date('Y-m-d H:i:s');
   $month_year=date('m-Y');
   $data=array("user_id"=>$user_id,
                "login_ip"=>$client_ip,
                "action_time"=>$action_time,
                "month_year"=>$month_year,
                "action"=>$action,
                "doc_type"=>$doc_type,
                "doc_id"=>$doc_id,
              );
   $ci->db->insert('fts_login_log',$data);
   
  }
  
}

if ( ! function_exists('doctype_action'))
{
  function doctype_action($type)
  {
    $doc= array('LC' =>'Letter Creation', 
                'LD' =>'Letter Dispatch',
                'LAF' =>'Letter Attach To File',
                'FC' =>'File Creation', 
                'FD' =>'File Dispatch',
                'FA' =>'Almirah', 
                'FL' =>'Letter Attach To File',
                'FE' =>'File Edit',
                'FR' =>'File Receive',
                'UPro' =>'Profile Update',
                'USett' =>'Settings Change',
                'UMI' =>'Manage User(Inactive)',
                'UMP' =>'Manage User(Permission)',
                'UMA' =>'Manage User(Active)',
                'ULgin' =>'Login',
                'ULgout' =>'Log Out',
                'FCAN' =>'File Cancel',
                'SH_F' => 'Shadow File Creation',
                'LS'   =>'Letter Self',
				'FN'	=>'Add Notesheet',
				'FPOI'  =>'Plan of Investigation',
				'ATTACH_EDIT' =>'Edit Attachment Report',
                );
    return $doc[$type];
   
  }

  if ( ! function_exists('part_file_label_value'))
{
  function part_file_label_value($labeltext)
  {
    $label= array(
                  'Part-I',
                  'Part-II',
                  'Part-III',
                  'Part-IV',
                  'Part-V',
                  'Part-VI',
                  'Part-VII',
                  'Part-VIII',
                  'Part-IX',
                  'Part-X'
                );
      $flipped = array_flip($label);
      $index=$flipped[$labeltext];
      $index+=1;
      return $label[$index];
  }
}
  
}

if ( ! function_exists('check_dormant'))
{
  function check_dormant($file_id)
  {
    $ci =& get_instance();
    $ci->db->select('dormant');
    $ci->db->from('fts_final_report');
    $ci->db->where('file_id',$file_id);
	$ci->db->where('dormant','1');
    $query = $ci->db->get();
    $result=$query->num_rows();
    return $result;
             
       
  }
  
}

if ( ! function_exists('letter_endorsed'))
{
  function letter_endorsed($letter_id)
  {
    $ci =& get_instance();
    $ci->db->select('u.name,m.ext_receiver');
    $ci->db->from('fts_letter_history_info h');
    $ci->db->join('fts_user u','h.recv_id=u.user_id');
    $ci->db->join('fts_letter_movement m','h.letter_id=m.letter_id');
    $ci->db->where('h.letter_id',$letter_id);
    $query = $ci->db->get();
    $result=$query->result_array();
    return $result;
             
       
  }
  
}

if ( ! function_exists('pending_file_count'))
{
 function pending_file_count()
 {
	$ci =& get_instance();
	$currentUserRank = fetch_rank($ci->session->userdata('user_id'));


	$sql = "SELECT COUNT(ffm.file_id) AS totalFile
				FROM `fts_file_movement` AS ffm 
				LEFT JOIN `fts_file_registration` AS ffr 
				ON ffm.reciver_user_id=ffr.user_id AND ffm.file_id=ffr.file_id
				LEFT JOIN fts_user ftu ON ftu.user_id=ffm.reciver_user_id
				WHERE (SELECT COUNT(file_id) FROM fts_file_history_info 
					WHERE file_id=ffm.file_id AND user_id=ffm.reciver_user_id) > 1 
				AND now() > cast((ffm.received_date_time + interval 4 day) as date)
				AND ftu.user_rank < $currentUserRank AND ffr.file_move_status != 'A' 
				GROUP BY ffm.reciver_user_id";
	$totalFile=0;

	$query = $ci->db->query($sql);
	if($query->num_rows() > 0)
	{
		foreach($query->result_array() as $single)
		{
			$totalFile += $single['totalFile'];
		}
	}
	return $totalFile;
 }
 
}