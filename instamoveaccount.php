<?php
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$query = "SELECT * FROM insta_ft_col_requested WHERE requested_status = 1";
$stmt = $pdb->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
foreach ($results as $iaccount) { 
    echo $iaccount['id']. " : ". $iaccount['instagram_account']."\n";    
    $account = $iaccount['instagram_account']; 
    $insert_query = "INSERT INTO insta_ft_col (instagram_account) VALUES ('{$account}')";
    echo $insert_query."\n";     
    $insert_stmt = $pdb->prepare($insert_query);
    $insert_stmt->execute(); 
    $delete_query = "DELETE FROM insta_ft_col_requested WHERE id = {$iaccount['id']}";
    echo $delete_query."\n";     
    $delete_stmt = $pdb->prepare($delete_query);
    $delete_stmt->execute();                                    
}

?>