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
        'Cookie: mid=WVZUpAAEAAEwwJctPlfDTrffc-Xd; fbm_124024574287414=base_domain=.instagram.com; fbsr_124024574287414=4WrUf86DhNAJniQr0wG4IOJ6i9R1UnjP32am29fG-bY.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUUIyTlBSOWFwRjRkdHAyY2xzQm1CbHB0NDgwUkhmY1pHTm1uRXE3Q2EzcHpqaEwwbFp1SzRsR0p0X2FJUlFLbnJxOWVxeEo1R0N0Y0Jlb2VLYm9Udl9ESU1wWno4WEs0U3pyaENlYWlWZDZrWFFqd1FxeFR4cElycld1dXNqVWhFelFnZEtSTmdhV0tWTXBhUWcwUHNIcHlmSmtQbDYzVkV2VmQ1eWtUcUlTeTF6d0p5LWVvM1VtVEpfSEJSVGZjVkNQeUt0QlZMQjV2VlhDejV2Sm94a09INXF1ZXFtUHQ4YW90OWg5SXRKcmhvb1dnUVZRWjE2MEdmb1lFUjE3U2plbngwSUh6cWphWnFfc2Rjdlo0b3FRWF93aVVnTkdWQkgxc09OUXZIanB1YzlEZFkwcUxEVlBoMzBwNkMxVHVWejVCX3JQZm5rLWdFYWlWUnFpekFUOSIsImlzc3VlZF9hdCI6MTUwMDQ5MDc1MCwidXNlcl9pZCI6IjExMzEwMzEzMzgifQ; csrftoken=3GfW1gAVas1saDbwcxo2AoZEIkQzgYoM; ds_user_id=5757643258; sessionid=IGSCf11d1f20011719b492f4093bcd499d9c198f171e8b395949a375592476e20702%3AR18GucFhZBCQE3yd3ss9Rlhs3cZh8E9B%3A%7B%22_auth_user_id%22%3A5757643258%2C%22_auth_user_backend%22%3A%22accounts.backends.CaseInsensitiveModelBackend%22%2C%22_auth_user_hash%22%3A%22%22%2C%22_token_ver%22%3A2%2C%22_token%22%3A%225757643258%3ATJXPNrnclvUVKkjxPNSBc5Nsf6KwTKOC%3A786a894f61538bc0ebcdaf660489cb6e1e9aa2b7ce493dbb6fd7ef283b0c42f3%22%2C%22_platform%22%3A4%2C%22last_refreshed%22%3A1500471357.915245533%2C%22asns%22%3A%7B%22time%22%3A1500471359%2C%22199.27.232.69%22%3A22571%7D%7D; ig_vw=1350; ig_pr=1; rur=ATN',
     
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