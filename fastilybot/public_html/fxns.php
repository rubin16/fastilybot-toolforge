<?php

	date_default_timezone_set("UTC");
	
    function resolveDate($name)
    {
    	$f = "reports/" . $name . ".txt";

    	if (file_exists($f)) 
    		echo date("H:i, d F Y (T)", filectime("reports/wpDupes.txt")); 
    	else 
    		echo "n/a";
    }
?>