<?php
                            if (!file_exists("pictures/test/test.jpg")) {
                                echo "no\n";  
                            } else {
                                echo "yes\n";
                            }
echo time()."\n";
echo time()-(48*60*60)."\n";

if (empty($argv[1]) || !filter_var($argv[1], FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
    $daycount = 1;
} else {
    $daycount = (int)$argv[1];
}
echo $daycount."\n";
?>