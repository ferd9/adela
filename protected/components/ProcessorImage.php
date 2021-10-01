<?php
/**
 * Description of ProcessorImage
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class ProcessorImage {
    
    public $ancho;
    public $alto;
    public $extension;
    public $nombre;
    public $nombreOrginal;
    
    /**thumbnal***/
    public $thumb_ancho;
    public $thumb_alto;
    public $thumb_nombre;
    
    public $upfile;
    
    private $archivoValido;
    /**
     *
     * @var type string:  ruta donde se suarda un archio
     */
    public $dirUpload; 
    
    /**
     *
     * @var type string: tura donde se guarda el thumbnail
     */
    public $dirThumb;
    
    /**
     *
     * @var type string: nombre base del directorio donde se suben los archivos
     */
    public $directorioUpload;
    
    /**
     *
     * @var type string: nombre base del directorio donde se suben los thumbnail
     */
    public $directorioThumb;
    private $dirTmp;
    private $imgTmp;
    private $realImagen;
    
    //dimension de redimensionado
    public $rAncho;
    public $rAlto;
    
    private $procesoCompletoOK = false;


    /**
     *
     * @param CUploadedFile $uf clase que ayuda a subir un archivo.
     * @param int $thumAncho ancho para el thumbnail
     * @param int $thumAlto alto para el thumbnail
     * @param bool $islogin opcion si un usuario esta logueado o no.
     * @param bool $borrarTmp opcion para borrar imagen guardada en tmp si se estable en false no se borrara
     */
    public function __construct(CUploadedFile $uf,$thumAncho=320,$thumAlto=280,$islogin=false,$borrarTmp = true) {
        $this->upfile = $uf;
        $this->thumb_ancho = $thumAncho;
        $this->thumb_alto = $thumAlto;
        $this->nombreOrginal = $this->upfile->getName();
        
        if(self::esExtensionValida($this->upfile->getType()) and $this->upfile->getSize() <= 6291456)
        {
            $this->extension = $this->upfile->getType();
                        
            $this->dirTmp = Yii::getPathOfAlias('webroot').'/tmp';
            $this->dirUpload = Yii::getPathOfAlias('webroot').'/auploads';
            $this->dirThumb=Yii::getPathOfAlias('webroot').'/athumb';
            $this->nombre = uniqid()."-".$uf->getName();
            $this->directorioUpload = basename($this->dirUpload);
            $this->directorioThumb = basename($this->dirThumb);
            if($islogin)
            {
                $nYearDir = date('Y',time());
                $idDirUser = Yii::app()->user->id;               
                
                if(!($existe = @opendir(Yii::getPathOfAlias('webroot').'/ruploads/'.$nYearDir)))
                    mkdir(Yii::getPathOfAlias('webroot').'/ruploads/'.$nYearDir);                
                
                if(!($existedirUser = @opendir(Yii::getPathOfAlias('webroot').'/ruploads/'.$nYearDir.'/'.$idDirUser)))
                    mkdir(Yii::getPathOfAlias('webroot').'/ruploads/'.$nYearDir.'/'.$idDirUser);
                
                /***thumb***/                
                if(!($existet = @opendir(Yii::getPathOfAlias('webroot').'/rthumb/'.$nYearDir)))
                    mkdir(Yii::getPathOfAlias('webroot').'/rthumb/'.$nYearDir);                
                
                if(!($existedirUsert = @opendir(Yii::getPathOfAlias('webroot').'/rthumb/'.$nYearDir.'/'.$idDirUser)))
                    mkdir(Yii::getPathOfAlias('webroot').'/rthumb/'.$nYearDir.'/'.$idDirUser);
                
                
                $this->dirUpload = Yii::getPathOfAlias('webroot').'/ruploads/'.$nYearDir.'/'.$idDirUser;
                $this->dirThumb=Yii::getPathOfAlias('webroot').'/rthumb/'.$nYearDir.'/'.$idDirUser;
                $this->nombre = Yii::app()->user->id."_R_".$uf->getName();
                
                $this->directorioUpload = '/ruploads/'.$nYearDir.'/'.$idDirUser;
                $this->directorioThumb = '/rthumb/'.$nYearDir.'/'.$idDirUser;
            }
            
            
            $this->thumb_nombre = "thumb".$this->nombre;
            $this->imgTmp = $this->dirTmp.'/'.$this->nombre;
            $uf->saveAs($this->imgTmp);
            $this->archivoValido = 1;
            if($this->esImgValid($this->imgTmp))
            {
               //echo " imagen valida ".$this->ancho." X ".$this->alto;
               $imagenCreated = $this->creaImagen($this->imgTmp, $this->upfile->getType());
               if($this->upfile->getSize() > 1572864 and $this->upfile->getType() != "image/gif")
               {                   
                   if($imagenCreated != false)
                   {
                       $this->bajarCalidad($imagenCreated, $this->dirTmp.'/'.$this->nombre, 35, $this->upfile->getType());
                       $rd = null;
                       if($this->esRedimensionable())
                       {
                            $rd = $this->redimensiona($imagenCreated);
                           if($rd!=null)
                           {
                               $this->grabarRedimensionado($rd, $this->dirTmp.'/'.$this->nombre, $this->upfile->getType());
                           }
                       }                     
                   }                   
               }else
               {
                   /*
                    * si no se cumple la condicion entonces no se llega asignar los valores
                    * a rAncho y rAlto.. por eso es necesario
                    */
                   $this->rAncho = $this->ancho;
                   $this->rAlto = $this->alto;
               }
               $thumb = $this->creaThumbnail($imagenCreated);
               $this->grabarImageProcesada($thumb, $this->dirThumb.'/'.$this->thumb_nombre, $this->upfile->getType());
               $fn = $this->finalizarYGuardar($this->dirTmp.'/'.$this->nombre, $this->dirUpload.'/'.$this->nombre,$borrarTmp);
               imagedestroy($imagenCreated);
               
               $this->procesoCompletoOK = true;
               
            }else
            {
                unlink($this->imgTmp);
                $this->archivoValido = 0;                
            }
        }else
        {            
            $this->archivoValido = 0;
        }
    }
    
    /**
     *
     * @return type booleano: true si la imagen pasada es una imagen valida, de locontrario false.
     */
    public function esValido()
    {
        return $this->archivoValido;
    }
    
    /**
     *
     * @param type $rsr: resource
     * @return type object: null en caso no se crea el thumbnail,de lo contrario resource
     */
    public function creaThumbnail($rsr)
    {
        $dif = $this->alto - $this->ancho;        
        if($dif > 1000)
            $this->thumb_ancho = intval($this->thumb_ancho/4);
        elseif($this->alto > $this->ancho and $this->alto < 1000) 
            $this->thumb_ancho = intval($this->thumb_ancho/2);
        
        $thum = imagecreatetruecolor($this->thumb_ancho, $this->thumb_alto); 
        $redimensionado = imagecopyresampled($thum, $rsr, 0, 0, 0, 0, $this->thumb_ancho, $this->thumb_alto, $this->ancho, $this->alto);
        if($redimensionado)
        {
           return $thum; 
        }            
        else
            return null;
    }
    
    /**
     * este metodo redimensiona una imagen
     * @param type $rsr resource
     * @return type object, null en caso no se puede redimensionar
     */
    public function redimensiona($rsr)
    {      
        $rmdo = imagecreatetruecolor($this->rAncho, $this->rAlto); 
        $redimensionado = imagecopyresampled($rmdo, $rsr, 0, 0, 0, 0, $this->rAncho, $this->rAlto, $this->ancho, $this->alto);
        if($redimensionado)
        {
           return $rmdo; 
        }            
        else
            return null;
    }
    
    /**
     * verifica si una imagen debe ser redimensionada<br/>
     * este metodo es llamado antes que el metodo redimensiona
     * @return type boleano:
     */
    public function esRedimensionable()
    {
        $dif = $this->alto - $this->ancho;
        if($this->ancho > 1800 and $this->ancho < 3500 and (($this->ancho > $this->alto) or $dif >=1 ) )
        {
            $this->rAncho = intval($this->ancho/2);
            $this->rAlto = intval($this->alto/2);
        }else if($this->ancho > 3500)
        {
            $this->rAncho = intval($this->ancho/4);
            $this->rAlto = intval($this->alto/4);
        }else
        {
            $this->rAncho = $this->ancho;
            $this->rAlto = $this->alto;
            return false;
        }
        return true;
    }
    
    /**
     *
     * @param type $resource: resource
     * @param type $filename: string nombre de imagen
     * @param type $calidad: entero que indique que cantidad de calidad se desea bajar o subir
     * @param type $tipoMime: MIME (Ejem: 'image/jpg')
     * @return type: booleando true si la operacion se realizo, de lo contrario false 
     */
    public function bajarCalidad($resource,$filename,$calidad,$tipoMime)
    {
         switch($tipoMime)
        {
            case 'image/jpeg':
            case 'image/pjpeg':    
            case 'image/jpg':                 
                return imagejpeg($resource, $filename, $calidad);
                break;
            case 'image/png': 
            case 'image/x-png':
                return imagepng($resource, $filename, $calidad);
                break;            
            default:
                return false;
        }
    }
    
    /**
     *
     * @param type $resource: resource
     * @param type $filename: nombre de imagen
     * @param type $tipoMime: MIME (Ejem: 'image/jpg')
     * @return type: booleano si se guardo la imagen, de lo contraio false 
     */
    private function grabarRedimensionado($resource,$filename,$tipoMime)
    {
         switch($tipoMime)
        {
            case 'image/jpeg':
            case 'image/pjpeg':    
            case 'image/jpg':                 
                return imagejpeg($resource, $filename);
                break;
            case 'image/png': 
            case 'image/x-png':    
                return imagepng($resource, $filename);
                break;            
            default:
                return false;
        }
    }
    
    
    /**
     *
     * @param type $resource: resource
     * @param type $filename: nombre de imagen
     * @param type $tipoMime: MIME (Ejem: 'image/jpg')
     * @return type: booleano si se guardo la imagen, de lo contraio false 
     */
    private function grabarImageProcesada($resource,$filename,$tipoMime)
    {
         switch($tipoMime)
        {
            case 'image/jpeg':
            case 'image/pjpeg':    
            case 'image/jpg':                 
                return imagejpeg($resource, $filename);
                break;
            case 'image/png': 
            case 'image/x-png':    
                return imagepng($resource, $filename);
                break;
            case 'image/gif':
                return imagegif($resource, $filename);
                break;
            default:
                return false;
        }
    }

    /**
     *
     * @param type $imagen: string nombre de la imagen.
     * @return type: booleano true si $imagen es realmente una imagen, de lo contrario false
     */
    public function esImgValid($imagen)
    {
        $arraySizeImg = getimagesize($imagen);
            if($arraySizeImg==FALSE)
                return false;
            else{
                $this->ancho = $arraySizeImg[0];
                $this->alto = $arraySizeImg[1];
                return true;
            }
                
    }
    
    /**
     *
     * @param type $imagen resource
     * @param type $ext mime(ejem: image/jpg)
     * @return type 1 si la imagen se pudo crear de lo contrio retorna null
     */
    public function creaImagen($imagen,$ext)
    {     
         switch($ext)
        {
            case 'image/jpeg':
            case 'image/pjpeg':    
            case 'image/jpg':                
                //$this->findWH($this->realImagen);
                return $this->realImagen=imagecreatefromjpeg($imagen);
                break;
            case 'image/png':
            case 'image/x-png':    
               // $this->findWH($this->realImagen);
                return $this->realImagen=imagecreatefrompng($imagen); 
                break;
            case 'image/gif':
                
                //$this->findWH($this->realImagen);
                return $this->realImagen=imagecreatefromgif($imagen); 
                break;
            default:
                return false;
        }
    }
    
    
    /**
     *se obtiene el ancho y el alto
     * @param type $img resource (imagen)
     */
    /*
    private function findWH($img)
    {
        $this->ancho=imagesx($img);
        $this->alto=imagesy($img);
    }*/
    
    /**
     *
     * @param type $ext valida el MIme de un archivo
     * @return type true si es valido, de lo contrario false
     */
    public static function esExtensionValida($ext)
    {
        switch($ext)
        {
            case 'image/jpeg':
            case 'image/pjpeg':    
            case 'image/jpg':                
                return true;
                break;
            case 'image/png':
            case 'image/x-png':    
                return true;
                break;
            case 'image/gif':                
                return true;
                break;
            default:
                return false;
        }
    }
    
    /**
     *
     * @param type $imagen: ruta de la imagen (ejem: /images/foto.png)
     * @param type $destino: ruta de la imagen destino (ejem: /images/foto.png)
     * @param type $borrar: booleano, si es true se borrara el archivo original,valor por defecto false
     * @return type booleano: true si el archivo fue copiado,de lo contrario false
     */
    public function finalizarYGuardar($imagen,$destino,$borrar=false)
    {
        $copiado = copy($imagen, $destino);
        if($borrar)
            unlink($imagen);
        return $copiado;        
    }
    
    /**
     *
     * @return bool booleano: devuelve true si todo si todo el proceso correctamente.
     */
    public function procesoOK()
    {
        header_remove();        
        return $this->procesoCompletoOK;
    }
}

?>

