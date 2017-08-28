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
       

    }
}

?>