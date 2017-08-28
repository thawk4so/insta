<?php
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$query = "SELECT * FROM intest_keep;";
$stmt = $pdb->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
foreach ($results as $iaccount) { 
    $account = $iaccount['name']; 
    $insert_query = "INSERT INTO insta_ft_col (instagram_account) VALUES ('{$account}')";
    echo $insert_query."\n";     
    $insert_stmt = $pdb->prepare($insert_query);
    $insert_stmt->execute(); 
                                   
}

?>