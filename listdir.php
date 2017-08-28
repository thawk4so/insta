<?php
//echo count(glob("./pictures/zees_solez/*")); 
$directories = glob('./pictures/*' , GLOB_ONLYDIR);      
//print_r($directories);
foreach ($directories as $idir) { 
    //echo $idir."\n";
    //$path = "./pictures/".$idir."/*";
    //echo $path;
    //echo count(glob("./pictures/".$idir."/*"));   
    if (count(glob($idir."/*")) === 0 ) {
        $account = str_replace("./pictures/", "", $idir);
        echo $account."\n";
        
        $check_more = 1;
        if (!file_exists("pictures/".$account)) {
            mkdir("pictures/".$account);
            
        }    
        while ($check_more == 1) {
            if (!empty($last_feed['id'])) {
                $more_str = file_get_contents("https://www.instagram.com/{$account}/media/?max_id=".$last_feed['id']);    
            } else {
                $more_str = file_get_contents("https://www.instagram.com/{$account}/media/");
            }       
            
            $more_instagram_array = json_decode($more_str, TRUE);

            $more_all_items = $more_instagram_array['items'];
            if (!empty($more_all_items))  {            
                foreach ($more_all_items as $indi) {
                    
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

                    if (!empty($indi['videos']['standard_resolution']['url'])) {
                        if (!file_exists("videos/".$account)) {
                            mkdir("videos/".$account);                        
                        }                    
                        $video_link = $indi['videos']['standard_resolution']['url'];
                        $vname_array = explode("/", $video_link);
                        $vname = end($vname_array);
                        if (!file_exists("videos/".$account."/".$vname)) {
                            copy($video_link, "videos/".$account."/".$vname);
                            echo "video id: ".$indi['id']."\n";    
                        }                     
                    }
                }          
            } 

            $check_more = $more_instagram_array['more_available'];
            $last_feed = end($more_instagram_array['items']);             
          
        }        

    }
}

?>