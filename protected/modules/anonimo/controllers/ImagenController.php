<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImagenController
 *
 * @author 3l@PR3ND1Z
 */
class ImagenController extends Controller{
    
    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFAABB,
			),
			
		);
	}
        
    public function actionIndex()
    {
        $renderView = 'posturl';
        $model = new ApostImagenUrl('register');
        
        if(isset($_GET['upfile']) and $_GET['upfile'] == 1)
        {
           $renderView = 'post';
            $model = new ApostImagen('register');
        }
        
        $this->render($renderView,array('model'=>$model,'categoria'=>"General"));
    }
    
    public function actionImgUrl()
    {
        $model = new ApostImagenUrl('register');
        if(isset($_POST['ApostImagenUrl']))
         {
             $model->attributes = $_POST['ApostImagenUrl'];             
             
             if($model->validate())
              {
                 $model->save();
                 $this->redirect(array('default/post','id'=>$model->idpost,'pagina'=>Util::eliminarSignos($model->titulo)), true);
              }else{
                  print_r($model->getErrors());
              }
         }
    }
    
    public function actionImgFile()
    {
        $model = new ApostImagen('register');        
        
                if(isset($_POST['ApostImagen']))
                {
                    $model->attributes = $_POST['ApostImagen'];
                    
                    $sizePermitido = 2172864;
                    
                    if(!Yii::app()->user->isGuest)
                        $sizePermitido = 6291456; 
                    
                    if(isset($_FILES) and $_FILES['ApostImagen']['error']['imagen']==0 and
                            $_FILES['ApostImagen']['size']['imagen']<= $sizePermitido)
                    {
                        $uf = CUploadedFile::getInstance($model, 'imagen');
                        $pi = new ProcessorImage($uf);
                        if($pi->esValido())
                        {
                            if($pi->procesoOK())
                            {
                                
                                $imagen = new Aimagen();
                                $imagen->nombre_original = $pi->nombreOrginal;
                                $imagen->nombre = $pi->nombre;
                                $imagen->descripcion = $_POST['ApostImagen']['titulo'];
                                $imagen->extension = $pi->extension;
                                $imagen->ruta = $pi->dirUpload;
                                $imagen->directorio = $pi->directorioUpload;
                                $imagen->ancho = $pi->rAncho;
                                $imagen->alto = $pi->rAlto;
                                
                                $imagen->nom_thumb = $pi->thumb_nombre;
                                $imagen->thumb_ruta = $pi->dirThumb;
                                $imagen->thumb_directorio = $pi->directorioThumb;
                                $imagen->thumb_alto = $pi->thumb_alto;
                                $imagen->thumb_ancho = $pi->thumb_ancho;
                                
                                $imagen->tipo = DefinidorTipos::$TIPO_ADJUNTA;
                                $imagen->enpost = 1;
                                $imagen->idCategoria = $_POST['ApostImagen']['idcategoria'];
                                $imagen->fecha =time();
                                
                                if($imagen->save(true))
                                {
                                    $model->idimagen = $imagen->idimagen; 
                                    
                                    if($model->validate())
                                    { 
                                        $model->save();
                                        Cookie::set('ipost', $model->idpost);
                                        Cookie::set('ipag', Util::eliminarSignos($model->titulo));                                        
                                        $this->redirect(array('default/post','id'=>$model->idpost,'pagina'=>Util::eliminarSignos($model->titulo)), true);
                                    }else
                                        print_r($model->getErrors());
                                }
                                
                            }
                                
                        }else
                        {
                           Yii::app()->user->setFlash('img-error',$_FILES['ApostImagen']['name']['imagen'].' no es un archivo valido');
                           $this->redirect(array('index','upfile'=>1));
                           return;
                        }
                            
                        
                    }
                    else
                        {
                           Yii::app()->user->setFlash('img-error',$_FILES['ApostImagen']['name']['imagen'].' tiene un tamaño superior a 2MB < '.$_FILES['ApostImagen']['size']['imagen']);
                           $this->redirect(array('index','upfile'=>1));
                           return;
                        }
                }
        
         
    }
}

?>
