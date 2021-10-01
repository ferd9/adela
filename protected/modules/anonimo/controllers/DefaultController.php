<?php

class DefaultController extends Controller
{
    
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
        
        public function actionPostear()
        {
             $model=new Apost('register');
             
             if(isset($_POST['Apost']))
                {                    
                    $model->attributes = $_POST['Apost'];
                    
                    $sizePermitido = 2172864;
                    
                    if(!Yii::app()->user->isGuest)
                        $sizePermitido = 6291456; 
                    
                    if(isset($_FILES) and $_FILES['Apost']['error']['imagen']==0 and
                           $_FILES['Apost']['size']['imagen']<= $sizePermitido )
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
                                $imagen->descripcion = $_POST['Apost']['titulo'];
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
                                $imagen->idCategoria = $_POST['Apost']['idcategoria'];
                                $imagen->fecha =time();
                                
                                if($imagen->save(true))
                                {
                                    $model->idimagen = $imagen->idimagen;                                   
                                }else{
                                    echo $imagen->extension;
                                    print_r($imagen->getErrors());
                                    return;
                                }
                                    
                                
                            }
                                
                        }else
                        {
                            Yii::app()->user->setFlash('img-error',$_FILES['Apost']['name']['imagen'].' no es un archivo valido');
                           $this->render('post',array('model'=>$model));
                           return;
                        }
                            
                        
                    }
                       //q print_r($_FILES);
                    /*
                    $model->attributes=$_POST['Apost'];
                    */
                    if($model->validate())
                    {
                        if($model->save())
                        {
                            if(is_numeric($model->idimagen))
                            {
                                Cookie::set('ipost', $model->idpost);
                                Cookie::set('ipag', Util::eliminarSignos($model->titulo));
                            }
                           $this->redirect(array('post','id'=>$model->idpost,'pagina'=>Util::eliminarSignos($model->titulo)), true); 
                        }                            
                        else
                            print_r ($model->getErrors());
                    }
                }
             
             
             $this->render('post',array('model'=>$model,'categoria'=>'General'));
        }
    
	public function actionIndex()
	{               
                $this->setPageTitle(CHtml::encode(Yii::app()->name).' - anonimo');
                $this->render('index');		
	}
        
        /**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=  Aetiquetas::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}
        
       public function actionPost($id,$pagina)
       {
           if(is_numeric($id) and is_string($pagina) and $pagina != '')
           {
             $post = Apost::model()->findByPk($id);
             $comentario=new Acomentario;
             if($post != null)
             {
                 if($pagina == Util::eliminarSignos($post->titulo))
                 {                     
                    $this->render('verpost',array('model'=>$post,'comentario'=>$comentario)); 
                 }else
                    throw new CHttpException(404,'El post ningun post con ese titulo.');
                 
             }else
               throw new CHttpException(404,'El post que solicita no existe.');
               
           }else
               throw new CHttpException(404,'La página solicitada no existe.');
       }
       
       public function actionComentar()
       {
           $model=new Acomentario;

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='acomentario-_form-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['Acomentario']))
            {
                $model->attributes=$_POST['Acomentario'];
                if($model->validate())
                {
                    if($model->save())
                    {
                      Yii::app()->user->setFlash('comentario-ok','Comentario Agregado');  
                      $this->redirect(array('post','id'=>$model->id_del_comentado,'pagina'=>$model->tituloPost));  
                    }                       
                    
                }else
                {
                   print_r($model->getErrors()); 
                }
                    
            }
       }
       
       
       public function actionDenuncia()
    {
        $model=new Areportados('insert');

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='areportados-denuncia-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Areportados']))
        {
            $model->attributes=$_POST['Areportados'];
            if($model->validate())
            {
              $model->save();
               $this->redirect(array('post','id'=>$_POST['Areportados']['idreportado'],'pagina'=>$_POST['Areportados']['titulo']));
            }
        }
       $this->redirect(array('index')); 

    }
    
}