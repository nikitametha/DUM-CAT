<?php
session_start();
//Code gets either "OS", "CN", "DS" or "AL"
// check file name, array index in fgetcsv
    
    extract($_GET);
    //$sub_code="OS";

	if($sub_code=="OS"){
        $file = fopen("OS.csv","r");
    }
    /*
	elseif($sub_code=='OS'){
		
	
		
    }
    elseif($sub_code=='OS'){
		
		
		
    }
    else{
		
		
	}
    */

    $E_arr = array();
    $M_arr = array();
    $H_arr = array();

    while(!feof($file))
    {
        $tmp = fgetcsv($file);
        //echo $tmp[5];
        if($tmp[5]=='E')
        { 
            //echo "IN E ";
            array_push($E_arr, $tmp);
            //echo $E_arr[0][1] . "\n";
        }
        
        elseif ($tmp[5]=='M')
        { 
            //echo "IN M";
            array_push($M_arr, $tmp);
        }
        elseif($tmp[5]=='H')
        { 
            //echo "IN H";
            array_push($H_arr, $tmp);
        }
        
    }
    fclose($file);
    $count=0;
    $_SESSION["E"]= $E_arr;
    $_SESSION["M"]= $M_arr;
    $_SESSION["H"]= $H_arr;
   
   // echo "session?". $_SESSION["E"][0][1];
    //sleep..send loading gif -- "preparing your test"
   echo "lets begin!";
   //sleep(5);


?>