<?php
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$query = "SELECT * FROM insta_ft_col_requested";
$stmt = $pdb->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
foreach ($results as $iaccount) { 
    echo $iaccount['id']. " : ". $iaccount['instagram_account']."\n";
    unset($last_feed);

    $account = $iaccount['instagram_account']; 
   

        $ch_url = "https://www.instagram.com/{$account}/media/";
        $ch = curl_init($ch_url);      
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
            'Cookie: mid=WVZUpAAEAAEwwJctPlfDTrffc-Xd; csrftoken=ZTQj0ZevezV65sadLzRG6WHFNrZrzhsp; ds_user_id=5757643258; sessionid=IGSC03189d4c0dc262a6d910079c0b2aa10a9f7012de71c5ff2381022777c3910b8b%3AqesRvk7hYWHlMlJhj7h5lkAdhBvejqF6%3A%7B%22_auth_user_id%22%3A5757643258%2C%22_auth_user_backend%22%3A%22accounts.backends.CaseInsensitiveModelBackend%22%2C%22_auth_user_hash%22%3A%22%22%2C%22_token_ver%22%3A2%2C%22_token%22%3A%225757643258%3AvWPkKYeW63pGtRUQ01LsR0AFD8bpaMq5%3Aa1b2d8c33cf8a00d63b612f7397165679d18039afa185b9e204ba28a59a89f21%22%2C%22_platform%22%3A4%2C%22last_refreshed%22%3A1508164549.7247920036%2C%22asns%22%3A%7B%22time%22%3A1505921475%2C%22199.27.232.69%22%3A22571%7D%7D; ig_vw=1327; ig_pr=1; ig_vh=696; rur=ATN; urlgen="{\"time\": 1508247451\054 \"199.27.232.69\": 22571}:1e4S7x:FpXNHd8rX4yp4CpCbLDBZWuTkpY"',
         
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $more_str = curl_exec($ch); 
        curl_close($ch);
        
        if (empty($more_str)) {
            $update_query = "UPDATE insta_ft_col_requested SET account_existence = 0 WHERE id = {$iaccount['id']}";
            
        }  else {
            $more_instagram_array = json_decode($more_str, TRUE);
            $more_all_items = $more_instagram_array['items'];
            if (!empty($more_all_items))  {            
                $approved = 1;     
                $update_query = "UPDATE insta_ft_col_requested SET requested_status = {$approved} WHERE id = {$iaccount['id']}"; 
                echo $update_query."\n";     
                $update_stmt = $pdb->prepare($update_query);
                $update_stmt->execute();                      
            } else {
                $approved = 0;
                echo "account #". $iaccount['id']." - ".$iaccount['instagram_account']." has not been approved yet.\n";
            }
                    
        }
                   
}

?>