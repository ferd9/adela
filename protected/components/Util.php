<?php

/**
 * Description of Utilidades
 * Esta clase possea varias funcionee.. como por ejemplo acortar una cadena demasiada larga
 * 
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class Util {
    
    public static function minizarString($str,$longitud = 31)
    {
       if(strlen($str)<31)
           return $str;
       else
       {
          $tmp = str_split($str, $longitud);
          return $tmp[0]."..."; 
       }
       
       return null;
    }
    
    public static function eliminarSignos($str)
    {
        return preg_replace('/\W+/', ' ', $str);
    }
    
    public static function findCodeVideo($link)
    {
        
        $ps1 = strpos($link, '=');
        $pret = str_split($link, $ps1+1);
        $rs = $pret[1];
        if(!is_bool(strpos($pret[1], '&')))
        {
                $ps2 = strpos($pret[1], '&');
                $tmp = str_split($pret[1], $ps2);
                $rs = $tmp[0];
        }
        return '<iframe src="http://www.youtube.com/embed/'.$rs.'" frameborder="0" width="425" height="350"></iframe>';        
    }
}

?>
