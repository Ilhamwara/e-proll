<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  if ( ! function_exists('inputmask_todate'))
  {
    function inputmask_todate($str)
    {                                  
        $d = substr($str, 0, 2);
        $m = substr($str, 2, 2);
        $Y = substr($str, 4, 4);              

        $strvalid = $Y . '-' . $m . '-' . $d;              
        $valid_date = date('Y-m-d', strtotime($strvalid));

      return $valid_date;
    }
  }
  
  if ( ! function_exists('generate_id_int'))
  {
    function generate_id_int($type, $table)
    {                                  
        $id_generate_db = get_generate_last_id($type, $table) ;
        $last_id = ($id_generate_db['seq_lastid'] + 1);          
        
        update_generate_last_id($type, $last_id, $table);

      return trim($last_id);
    }
  }
  if ( ! function_exists('generate_id_string'))
  {
    function generate_id_string($type, $length, $table)
    {      
        $id_generate_db = get_generate_last_id($type, $table);
        $last_id = ($id_generate_db['seq_lastid'] + 1);
        $id_loop = $length ;  
        //$id_nol = "0";
        $id_separate = sprintf("%'.0$id_loop.d\n", $last_id);  
        $id = $type . $id_separate ;
        
        update_generate_last_id($type, $last_id, $table);

      return trim($id);
    }
  }
  function get_generate_last_id($type, $table)
  {
      $CI = &get_instance();   

      if (strlen($type) > 1 != null) { 
        $CI->db->where('seq_type', $type);  
      }     

      $result = $CI->db->get($table); 
      if ($result->num_rows() == 1) 
      {
        return $result->row_array();
      } 
      else 
      {
        return array();
      }
  }

  function update_generate_last_id($type, $last_id, $table)
  {
      $CI = &get_instance();

      $data = array( 
                'seq_lastid' =>  $last_id ,
                'seq_lastdate' =>  date("Y-m-d H:i:s"),
              );
      if (strlen($type) > 1 != null) 
      { 
        $CI->db->where('seq_type', $type);  
      }

      $CI->db->update($table, $data);
  }

  if ( ! function_exists('number_to_words'))
  {;
    
    function number_to_wordsnorp($number){
        $before_comma = trim(to_word($number));
        $after_comma = trim(comma($number));
        //return ucwords($results = $before_comma.' koma '.$after_comma);
        if ($number==0){
        $before_comma="Nol";	
        }
      return ucwords($results = $before_comma);
    }
    
    function number_to_words($number){
        $before_comma = trim(to_word($number));
        $after_comma = trim(comma($number));
        //return ucwords($results = $before_comma.' koma '.$after_comma);
      return ucwords($results = $before_comma.' Rupiah ');
    }

    function to_word($number){
        $words = "";
        $arr_number = array(
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas");

        if($number<12)
        {
          $words = " ".$arr_number[$number];
        }
        else if($number<20)
        {
          $words = to_word($number-10)." belas";
        }
        else if($number<100)
        {
          $words = to_word($number/10)." puluh ".to_word($number%10);
        }
        else if($number<200)
        {
          $words = "seratus ".to_word($number-100);
        }
        else if($number<1000)
        {
          $words = to_word($number/100)." ratus ".to_word($number%100);
        }
        else if($number<2000)
        {
          $words = "seribu ".to_word($number-1000);
        }
        else if($number<1000000)
        {
          $words = to_word($number/1000)." ribu ".to_word($number%1000);
        }
        else if($number<1000000000)
        {
          $words = to_word($number/1000000)." juta ".to_word($number%1000000);
        }
        else if($number<1000000000000)
        {
          $words = to_word($number/1000000000)." milyar ".to_word($number%1000000000);
        }
        else
        {
          $words = "undefined";
        }
      return $words;
    }
    
    function comma($number){
        $after_comma = stristr($number,',');
        $arr_number = array(
        "nol",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan");

        $results = "";
        $length = strlen($after_comma);
        $i = 1;
        while($i<$length)
        {
          $get = substr($after_comma,$i,1);
          $results .= " ".$arr_number[$get];
          $i++;
        }
      return $results;
    }
  }

  function Terbilang($x)
  {
      $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      if ($x < 12)
        return " " . $abil[$x];
      elseif ($x < 20)
        return Terbilang($x - 10) . "belas";
      elseif ($x < 100)
        return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
      elseif ($x < 200)
        return " seratus" . Terbilang($x - 100);
      elseif ($x < 1000)
        return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
      elseif ($x < 2000)
        return " seribu" . Terbilang($x - 1000);
      elseif ($x < 1000000)
        return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
      elseif ($x < 1000000000)
        return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
      elseif ($x < 1000000000000)
        return Terbilang($x / 1000000000) . " milyar" . Terbilang($x % 1000000000);
  }	

	function romanic_number($integer, $upcase = true) 
	{ 
	    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
	    $return = ''; 
	    while($integer > 0) 
	    { 
	        foreach($table as $rom=>$arb) 
	        { 
	            if($integer >= $arb) 
	            { 
	                $integer -= $arb; 
	                $return .= $rom; 
	                break; 
	            } 
	        } 
	    } 

	    return $return; 
	} 

  function getIndoBulan($bln){
      switch ($bln) {
          case 1: 
              return "Januari";
              break;
          case 2:
              return "Februari";
              break;
          case 3:
              return "Maret";
              break;
          case 4:
              return "April";
              break;
          case 5:
              return "Mei";
              break;
          case 6:
              return "Juni";
              break;
          case 7:
              return "Juli";
              break;
          case 8:
              return "Agustus";
              break;
          case 9:
              return "September";
              break;
          case 10:
              return "Oktober";
              break;
          case 11:
              return "November";
              break;
          case 12:
              return "Desember";
              break;
      }
  } 
     