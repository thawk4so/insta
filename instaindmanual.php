<?php
if (empty($argv[1])) {
    echo "Please enter an instagram account id\n";
} else {
    $account_id = $argv[1];
    $db_user="root";
    $db_pass="tz88Min4";
    $db_name="personal";
    $db_host = "localhost";
    $db_port = "3306";
    $pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
    $query = "SELECT * FROM insta_ft_col_json WHERE id = {$account_id}";
    $stmt = $pdb->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($results)) {
        $ind_account_info = $results[0];    
        
        $account = $ind_account_info['instagram_account']; 

        $check_more = $ind_account_info['more_available'];
        if (!file_exists("pictures/".$account)) {
            mkdir("pictures/".$account);
            
        }

/*        
        if (!empty($last_feed['id'])) {
            $prev_last_id = $last_feed['id'];
            $more_str = file_get_contents("https://www.instagram.com/{$account}/media/?max_id=".$last_feed['id']);    
        } else {
            $prev_last_id = "0_0";
            $more_str = file_get_contents("https://www.instagram.com/{$account}/media/");
        }       
*/
        $more_str = $ind_account_info['json'];
        //echo $more_str; exit();
        
        
        
        //$more_str = str_replace("*", "", $more_str);
        //$more_str = str_replace("\n", "", $more_str);
        //$more_str = str_replace("@", "hello world", $more_str);
        //$more_str = str_replace("'", "", $more_str);
        //$more_str = str_replace('\u', "", $more_str);
        //$query = "UPDATE insta_ft_col_json SET json = '{$more_str}' WHERE id = {$account_id}";
        //echo $query; exit();
    //$stmt = $pdb->prepare($query);
    //$stmt->execute();        
        //$more_str = preg_replace('/"text":[\s\S]+?,/', '', $more_str);    
        //echo $more_str; 
        $more_instagram_array = json_decode($more_str, TRUE);
        //var_dump(json_last_error(), json_last_error_msg());
        //echo  json_last_error()."\n";
        //print_r($more_instagram_array); exit();
        $more_all_items = $more_instagram_array['items'];
        if (!empty($more_all_items))  {            
            foreach ($more_all_items as $indi) {
                echo $indi['id']."\n"; 
                if (!empty($indi['videos']['standard_resolution']['url'])) {
                    if (!file_exists("videos/".$account)) {
                        mkdir("videos/".$account);
                        
                    }                    
                    $video_link = $indi['videos']['standard_resolution']['url'];
                    $vname_array = explode("/", $video_link);
                    $vname = end($vname_array);
                    if (!file_exists("videos/".$account."/".$vname)) {
                        copy($video_link, "videos/".$account."/".$vname);
                        echo "video id is: ". $indi['id']."\n";    
                    }                    
                } else {
                    $image_link = $indi['images']['standard_resolution']['url'];
                    //echo $image_link."\n";
                    $fname_array = explode("/", $image_link);
                    //print_r($fname_array);
                    $fname = end($fname_array); 
                    //echo $fname."\n";
                    $get_url = "https://". $fname_array[2]."/".$fname_array[3]."/e35/".end($fname_array);
                    if (!file_exists("pictures/".$account."/".$fname)) {
                        copy($get_url, "pictures/".$account."/".$fname);  
                        echo $indi['id']."\n";  
                    }                    
                }               
            }          
        }             
        $check_more = $more_instagram_array['more_available'];
        $last_feed = end($more_instagram_array['items']); 
           
        echo "last id is ".$last_feed['id']. " check more is ".$check_more. "\n";            
          
                
    }   
}
/*
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$query = "SELECT * FROM insta_ft_col ORDER BY id ASC";
$stmt = $pdb->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $iaccount) { 
    echo $iaccount['id']. " : ". $iaccount['instagram_account']."\n";
    $account = $iaccount['instagram_account']; 
    $check_more = 1;
    while ($check_more == 1) {
        $break_while = 0; 
        if (!empty($last_feed['id'])) {
            $more_str = file_get_contents("https://www.instagram.com/{$account}/media/?max_id=".$last_feed['id']);    
        } else {
            $more_str = file_get_contents("https://www.instagram.com/{$account}/media/");
        }       
        
        $more_instagram_array = json_decode($more_str, TRUE);

        $more_all_items = $more_instagram_array['items'];
        if (!empty($more_all_items))  {            
            foreach ($more_all_items as $indi) {
                echo $indi['id']."\n";
                $image_link = $indi['images']['standard_resolution']['url'];
                //echo $image_link."\n";
                $fname_array = explode("/", $image_link);
                //print_r($fname_array);
                $fname = end($fname_array); 
                //echo $fname."\n";
                $get_url = "https://". $fname_array[2]."/".$fname_array[3]."/e35/".end($fname_array);
                if (!file_exists("pictures/".$fname)) {
                    copy($get_url, "pictures/".$fname);    
                } else {
                    $break_while =1;
                    break;
                }

                if (!empty($indi['videos']['standard_resolution']['url'])) {
                    $video_link = $indi['videos']['standard_resolution']['url'];
                    $vname_array = explode("/", $video_link);
                    $vname = end($vname_array);
                    if (!file_exists("videos/".$vname)) {
                        copy($video_link, "videos/".$vname);    
                    } else {
                        $break_while = 1;
                        break;
                    }                    
                }
            }          
        } 
        if ($break_while){
            break;
        } else {
            $check_more = $more_instagram_array['more_available'];
            $last_feed = end($more_instagram_array['items']);             
        }
      
    }
   
        //$res = $this->Instagram_Model->fetchFeeds($icaccount); 
}
//$str = file_get_contents("https://www.instagram.com/patyfeet/media/");
//$instagram_array = json_decode($str, TRUE);
//print_r($instagram_array);
//print_r($instagram_array['items']);
//$test = $instagram_array['items'][0];
//print_r($test); 
*/


?>