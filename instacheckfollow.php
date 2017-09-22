<?php
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$query = "SELECT * FROM intest ORDER BY id DESC";
$stmt = $pdb->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
foreach ($results as $ind) {
    $delete_flag = 0; 
    $temp_string =  trim($ind['name']);  
    if (strpos($temp_string, ' ') !== false) {
        $delete_flag = 1;
    } 
    if(preg_match('/[A-Z]/', $temp_string)){
        $delete_flag = 1;
    } 
    if (strpos($temp_string, '?') !== false) {
        $delete_flag = 1;
    }
    if (strpos($temp_string, '#') !== false) {
        $delete_flag = 1;
    }    
    if (strpos($temp_string, "'") !== false) {
        $delete_flag = 1;
    }    
    if (strpos($temp_string, '@') !== false) {
        $delete_flag = 1;
    } 
    if (strlen($temp_string) <5) {
        $delete_flag = 1;
    } 
    $temp_string = str_replace("'", "", $temp_string);       
    $query = "SELECT * FROM insta_ft_col WHERE instagram_account = '{$temp_string}' ";
    $stmt = $pdb->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    if (!empty($results)) {
        $delete_flag = 1;
    }    
    if ($delete_flag) {
        $query = "INSERT INTO intest_removed (name) VALUES ('{$temp_string}')";
    } else {
        $query = "INSERT INTO intest_keep (name) VALUES ('{$temp_string}')";
    }
    $stmt = $pdb->prepare($query);
    $stmt->execute();  
        
}

?>