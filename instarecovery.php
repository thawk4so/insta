<?php
$db_user="root";
$db_pass="tz88Min4";
$db_name="personal";
$db_host = "localhost";
$db_port = "3306";
$pdb = new PDO("mysql:dbname={$db_name};host={$db_host};port={$db_port}", $db_user, $db_pass);
$directories = glob($somePath . 'pictures/*' , GLOB_ONLYDIR);
foreach ($directories as $idir) {
    $idir = str_replace("pictures/", "", $idir);
    echo $idir."\n";
    $query = "SELECT * FROM insta_ft_col WHERE instagram_account = '{$idir}'";
    $stmt = $pdb->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    if (empty($results)) {
        $query = "INSERT INTO insta_ft_col SET instagram_account = '{$idir}'";
        $stmt = $pdb->prepare($query);
        $stmt->execute();        
        
    }  
}

?>