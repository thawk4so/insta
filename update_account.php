<?php
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$query = "SELECT * FROM insta_ft_col WHERE instagram_account_id = '0' OR instagram_account_id IS NULL OR instagram_account_id = '' ORDER BY id ASC";
$stmt = $pdb->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
foreach ($results as $iaccount) { 
    echo $iaccount['id']. " : ". $iaccount['instagram_account']."\n";
    //unset($instagram_account_id);

    $account = $iaccount['instagram_account']; 
 

    $ch_url = "https://www.instagram.com/{$account}/?__a=1";

    $ch = curl_init($ch_url);      
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array(
            'Cookie: mid=WVZUpAAEAAEwwJctPlfDTrffc-Xd; csrftoken=ZTQj0ZevezV65sadLzRG6WHFNrZrzhsp; ds_user_id=5757643258; sessionid=IGSC041d66ae1b6d79153d9d00d5a839b21b12341b934fd8bfa2d47fcdf85b803bd3%3AFJGqJkrI3SegDtHRW7j9Ten2m1XsqgGZ%3A%7B%22_auth_user_id%22%3A5757643258%2C%22_auth_user_backend%22%3A%22accounts.backends.CaseInsensitiveModelBackend%22%2C%22_auth_user_hash%22%3A%22%22%2C%22_token_ver%22%3A2%2C%22_token%22%3A%225757643258%3AvWPkKYeW63pGtRUQ01LsR0AFD8bpaMq5%3Aa1b2d8c33cf8a00d63b612f7397165679d18039afa185b9e204ba28a59a89f21%22%2C%22_platform%22%3A4%2C%22last_refreshed%22%3A1508428486.8380105495%2C%22asns%22%3A%7B%22time%22%3A1505921475%2C%22199.27.232.69%22%3A22571%7D%7D; rur=ATN; urlgen="{\"time\": 1508428485\054 \"199.27.232.69\": 22571}:1e5D9w:9zdpm5mDDUAyM98QldAuM__SOKc"; ig_vw=1292; ig_pr=1; ig_vh=697; ig_or=landscape-primary',
     
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $more_str = curl_exec($ch);  
    curl_close($ch);
    $more_instagram_array = json_decode($more_str, TRUE);
    if (!empty($more_instagram_array['user']['id'])) {
        $instagram_account_id = $more_instagram_array['user']['id'];    
    } else {
        $instagram_account_id = 0;
    }
    
    echo "instagram account id is: ".$instagram_account_id."\n"; 
            
    $update_query = "UPDATE insta_ft_col SET instagram_account_id = '{$instagram_account_id}' WHERE id = {$iaccount['id']}"; 
    //echo $update_query."\n";          
    $update_stmt = $pdb->prepare($update_query);
    $update_stmt->execute();    
    
}

?>