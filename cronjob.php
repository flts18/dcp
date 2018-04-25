<?php
ini_set('memory_limit', '-1');

    // change the name below for the folder you want
    $dir = "./login_log/".date('y');
    
    if( is_dir($dir) === false )
    {
        mkdir($dir);
    }
    
    $file= $dir."/log_".time().".csv";

    $fh = fopen($file, 'w');
    
    fputcsv($fh,array('user_id','login_ip','action_time','month_year','action','doc_type','doc_id'));
    
    $con = mysql_connect("localhost","c1dwbflt_fts","%lvC8WW=~4JX");
    mysql_select_db("c1dwbflt_file_tracking_system", $con);

    /* Fetch values from `fts_login_log` table*/

    $result = mysql_query("SELECT * FROM fts_login_log");   
    while ($row = mysql_fetch_assoc($result)) {          
        //$last = end($row);          
        //$num = mysql_num_fields($result) ;    
        //for($i = 0; $i < $num; $i++) {
            
            fputcsv($fh,$row);
            
            //fwrite($fh, $row[$i]);                      
            //if ($row[$i] != $last)
            //   fwrite($fh, ", ");
        //}                                                                 
        //fwrite($fh, "\n");
    }
    fclose($fh);
    /* Delete all records of `fts_login_log` table*/
    mysql_query("DELETE FROM fts_login_log"); 