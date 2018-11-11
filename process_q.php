<?php
session_start();
extract($_GET);

function check_E($ca, $qnumber)
 {
    $ci = $_SESSION["current_question_index"];
    $correct_answer = $_SESSION["E"][$ci][6];
    //echo $ca;
    if( strcmp( $ca, $correct_answer ) ==0)
    {
        //echo "wut";
        $_SESSION["cw"] = "correct";
        ++$_SESSION['n']; 
        
    }
    
    else{
        //echo "why";
        $_SESSION["cw"] = "wrong";
    }

    $_SESSION["avg"] = (($_SESSION['n']) / ($qnumber-1)) *100;
    array_splice($_SESSION["E"], $ci, 1); //remove from array to avoid duplicate questions
    
    if($_SESSION["avg"]<=40)
    give_easy();
    else
    give_medium(); 
 }   

 function check_M($ca, $qnumber)
 {
    $ci = $_SESSION["current_question_index"];
    $correct_answer = $_SESSION["M"][$ci][6];
    
    if( strcmp( $ca, $correct_answer ) ==0)
    {
        $_SESSION["cw"] = "correct";
        ++$_SESSION['n']; 
        
    }
    
    else{
        $_SESSION["cw"] = "wrong";
    }

    $_SESSION["avg"] = (($_SESSION['n']) / ($qnumber-1)) *100;
    array_splice($_SESSION["M"], $ci, 1); //remove from array to avoid duplicate questions
    
    if($_SESSION["avg"]<=40)
    give_easy();
    elseif($_SESSION["avg"]>60)
    give_hard();
    else
    give_medium(); 
 }   

 function check_H($ca, $qnumber)
 {
    $ci = $_SESSION["current_question_index"];
    $correct_answer = $_SESSION["H"][$ci][6];
    
    if( strcmp( $ca, $correct_answer ) ==0)
    {
        $_SESSION["cw"] = "correct";
        ++$_SESSION['n']; 
        
    }
    
    else{
        $_SESSION["cw"] = "wrong";
    }

    $_SESSION["avg"] = (($_SESSION['n']) / ($qnumber-1)) *100;
    array_splice($_SESSION["H"], $ci, 1); //remove from array to avoid duplicate questions
    
    if($_SESSION["avg"]<=60)
    give_medium();
    else
    give_hard(); 
 }   
    


function give_easy()
{
    //echo(count($_SESSION["E"]));
    $len_E = count($_SESSION["E"]);
    $ri = mt_rand(0,($len_E)-1);  //get random index
    //echo $_SESSION["E"][$ri][0];
    $_SESSION["current_question_index"] = $ri; 
    
    $resp=array('q'=>$_SESSION["E"][$ri][0],
                'a1'=>$_SESSION["E"][$ri][1],
                'a2'=>$_SESSION["E"][$ri][2],
                'a3'=>$_SESSION["E"][$ri][3],
                'a4'=>$_SESSION["E"][$ri][4],
                'diff'=>$_SESSION["E"][$ri][5],//difficulty
                'cw'=>$_SESSION["cw"],  //correct or wrong
                'avg'=> $_SESSION["avg"] ); //current avg
    
         
	//json_encode — Returns the JSON representation of a value
    echo json_encode($resp);
}

function give_medium()
{
    //echo(count($_SESSION["E"]));
    $len_E = count($_SESSION["M"]);
    $ri = mt_rand(0,($len_M)-1);  //get random index
    //echo $_SESSION["E"][$ri][0];
    $_SESSION["current_question_index"] = $ri; 
    
    $resp=array('q'=>$_SESSION["M"][$ri][0],
                'a1'=>$_SESSION["M"][$ri][1],
                'a2'=>$_SESSION["M"][$ri][2],
                'a3'=>$_SESSION["M"][$ri][3],
                'a4'=>$_SESSION["M"][$ri][4],
                'diff'=>$_SESSION["M"][$ri][5],//difficulty
                'cw'=>$_SESSION["cw"],  //correct or wrong
                'avg'=> $_SESSION["avg"] ); //current avg
    
         
	//json_encode — Returns the JSON representation of a value
    echo json_encode($resp);
}

function give_hard()
{
    //echo(count($_SESSION["E"]));
    $len_E = count($_SESSION["H"]);
    $ri = mt_rand(0,($len_M)-1);  //get random index
    //echo $_SESSION["E"][$ri][0];
    $_SESSION["current_question_index"] = $ri; 
    
    $resp=array('q'=>$_SESSION["H"][$ri][0],
                'a1'=>$_SESSION["H"][$ri][1],
                'a2'=>$_SESSION["H"][$ri][2],
                'a3'=>$_SESSION["H"][$ri][3],
                'a4'=>$_SESSION["H"][$ri][4],
                'diff'=>$_SESSION["H"][$ri][5],//difficulty
                'cw'=>$_SESSION["cw"],  //correct or wrong
                'avg'=> $_SESSION["avg"] ); //current avg
    
         
	//json_encode — Returns the JSON representation of a value
    echo json_encode($resp);
}


if($qnumber==1) //initial question - easy
{
    $_SESSION['n'] = 0;
    $_SESSION["avg"] = 0;
    $_SESSION["current_question_index"] = 0;
    give_easy();
}

elseif ( ($qnumber>10)  ||  (($qnumber>5)&&(($_SESSION["avg"])>95)) )
{
    $resp=array('q'=>"FIN",
                'a1'=>"FIN",
                'a2'=>"FIN",
                'a3'=>"FIN",
                'a4'=>"FIN",
                'diff'=>"FIN",//difficulty
                'cw'=>"FIN",  //correct or wrong
                'avg'=> "FIN" ); //current avg
    
         
	//json_encode — Returns the JSON representation of a value
    echo json_encode($resp);
}

else
{
   // $ci = $_SESSION["current_question_index"]; 

    if ( strcmp($diff,'E')==0 )
    {
        //echo "umm";
        check_E($ca, $qnumber);
    }
    
    elseif ( strcmp($diff,'M')==0 )
    {
        check_M($ca, $qnumber);
    }

    else // ((diff=='H') )
    {
        check_H($ca, $qnumber);
    }
    

}    
 
   

?>