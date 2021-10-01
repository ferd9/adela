<?php
/**
 * Description of DefinidorTipos
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class DefinidorTipos {
    
    /***variables estaticas para espeficicar si un post es comentario o publicacion***/
    public static $TIPO_PULICACION = 'POST';
    public static $TIPO_COMENTARIO = 'COMENTARIO';
    public static $TIPO_IMAGEN = 'IMAGEN';
    public static $TIPO_VIDEO = 'VIDEO';
    public static $TIPO_ADJUNTA = 'ADJUNTA';  
    
    public static $POST = 'POST';
    public static $IMAGEN = 'IMAGEN';
    
    /****tipos de visivilidad****/
    public static $PUBLICO="PUBLICO";
    public static $AMIGO="AMIGO";
    public static $PRIVADO="PRIVADO";
    public static $PERSONALIZADO="PERSONALIZADO";





    public static function listaSexo()
    {
        return array(
            'H'=>'Hombre',
            'M'=>'Mujer'
        );
    }
    
    public static function dias($mes="")
    {
        $dia = array();
        for($i=1;$i<=31;$i++)
        {
            if($i<10)
                $i = '0'.$i;                
           $dia[$i]=$i; 
        }
        
        return $dia;
    }
    
    public static function meses()
    {
        return array(
           '01'=>'Enero',
           '02'=>'Febrero',
           '03'=>'Marzo',
           '04'=>'Abril',
           '05'=>'Mayo',
           '06'=>'Junio',
           '07'=>'Julio',
           '08'=>'Agosto',
           '09'=>'Setiembre',
           '10'=>'Octubre',
           '11'=>'Noviembre',
           '12'=>'Diciembre'
        );
    }
    
    public static function anios()
    {
        $anio=array();
        for($i=date('Y');$i>=1905;$i--){
                $anio[$i]=$i;                
            }        
        return $anio;
    }
    
    public static function preferencia()
    {
       return array(
            'H'=>'Hombres',
            'M'=>'Mujeres',
            'B'=>'Hombres y Mujeres'
        );
    }
    
    public static function situacionSentimental()
    {
        return array(
            'S'=>'SOLTERO(A)',
            'C'=>'CASADO(A)',
            'CMP'=>'COMPROMETIDO(A)',
            'COMPLICADA'=>'COMPLICADA',
            'ABIERTA'=>'ABIERTA',
            'DIFICIL'=>'DIFICIL',
            'A'=>'ABANDONADO(A)',
        );
    }
    
    public static function tipoVisivilidad()
    {
        $vs = Visibilidad::model()->findAll();
        $arrayv = array();
        foreach($vs as $v)
        {
           $arrayv[$v->idvisibilidad] = $v->tipo;
        }
        return $arrayv;
    }
}

?>
