<?php
if (empty($argv[1])) {
    echo "Please enter an instagram account\n";
} else {
    $account = $argv[1]; 
    if (!empty($argv[2])){
        $last_feed['id'] = $argv[2];    
    }
    $check_more = 1;
    if (!file_exists("pictures/".$account)) {
        mkdir("pictures/".$account);
        
    }
    
    while ($check_more == 1) {
        if (!empty($last_feed['id'])) {
            $prev_last_id = $last_feed['id'];
            $more_str = file_get_contents("https://www.instagram.com/{$account}/media/?max_id=".$last_feed['id']);    
        } else {
            $prev_last_id = "0_0";
            $more_str = file_get_contents("https://www.instagram.com/{$account}/media/");
        }
        //echo "*********************************\n";
        //echo $more_str."\n";
        //echo "$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$\n"; 

        $more_instagram_array = json_decode($more_str, TRUE);

        $more_all_items = $more_instagram_array['items'];
        if (!empty($more_all_items))  {            
            foreach ($more_all_items as $indi) {
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
        if (!empty($more_instagram_array['status'])) {
            $json_status = $more_instagram_array['status'];    
        } else {
            $json_status = "error"; 
        }
        
        echo "last id is ".$last_feed['id']. " and check more is ".$check_more." and prev last id is ".$prev_last_id. " and status is ".$json_status. "\n";              
    }
    if ($json_status == "error" || $check_more){
        echo "out loop (check_more is not empty or status error): "."last id is ".$last_feed['id']. " and check more is ".$check_more." and prev last id is ".$prev_last_id. " and status is ".$json_status."\n";        
    } else {
        echo "out loop: "."last id is ".$last_feed['id']. " and check more is ".$check_more." and prev last id is ".$prev_last_id. " and status is ".$json_status."\n";     
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