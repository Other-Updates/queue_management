<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Currency_auth {
    
    private $error = array();
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
    }

    function toMoney($val,$symbol='INR. ',$r=2)
    {
        $n = $val; 
        $c = is_float($n) ? 1 : number_format($n,$r);
        $d = '.';
        $t = ',';
        $sign = ($n < 0) ? '-' : '';
        $i = $n = number_format(abs($n),$r); 
        $j = (($j = strlen($i) ) > 3) ? $j % 3 : 0; 	
        return  $symbol.$sign .($j ? substr($i,0, $j) + $t : '').preg_replace('/(\d{3})(?=\d)/',"$1" + $t,substr($i,$j)) ;	
    }
	
    function formatInMoney($num)
    {
        $pos = strpos((string)$num, ".");
        if ($pos === false) {
            $decimalpart = "00";
        }
        if (!($pos === false)) {
            $decimalpart = substr($num, $pos+1, 2); 
            $num = substr($num,0,$pos);
        }

        if(strlen($num)>3 & strlen($num) <= 12) {
            $last3digits = substr($num, -3 );
            $numexceptlastdigits = substr($num, 0, -3 );
            $formatted = $this->makeComma($numexceptlastdigits);
            $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart;
        } else if(strlen($num)<=3) {
            $stringtoreturn = $num.".".$decimalpart ;
        } else if(strlen($num)>12) {
            $stringtoreturn = number_format($num, 2);
        }

        if(substr($stringtoreturn,0,2)=="-,") {
            $stringtoreturn = "-".substr($stringtoreturn,2 );
        }

        return $stringtoreturn;
    }
	
    function makeComma($input)
    { 
        if(strlen($input)<=2) { 
            return $input; 
        }
        $length = substr($input,0,strlen($input)-2);
        $formatted_input = $this->makeComma($length).",".substr($input,-2);
        return $formatted_input;
    }        
}