<?php

/**
 * Description of BienvenidoController
 * Este controlador responde a la solicitudes de usuarios recien registrados
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class BienvenidoController extends CController{
    
    public $layout='//layouts/columnpasos';
    
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','foto',
                                                 'datos'),
				'users'=>array('@'),
                             ),	
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionFoto(){
        $model = new Upfoto();
        $src = Yii::app()->request->baseUrl.'/images/user/defaultlarge.gif';       
        $img = null;
        $idFotoActual = Yii::app()->db->createCommand('select foto from adl_perfil where idperfil='.Yii::app()->user->id)->queryRow();
        if(is_numeric($idFotoActual['foto']))
        {
            $img = Foto::model()->findByPk($idFotoActual['foto']);
            if($img != null)
                $src = Yii::app()->request->baseUrl.'/'.$img->thumb_directorio.'/'.$img->thumb_nom;
        }
        
        if(isset($_POST['Upfoto']))
        {
           if(isset($_FILES) and $_FILES['Upfoto']['error']['foto']==0)
            {
                $uf = CUploadedFile::getInstance($model, 'foto');
                $pi = new ProcessorImage($uf,200,180,true);
                if($pi->esValido())
                {
                    if($pi->procesoOK())
                    {
                        $nuevaFoto = new Foto();
                        $nuevaFoto->idperfil = Yii::app()->user->id;
                        $nuevaFoto->nombre = $pi->nombre;
                        $nuevaFoto->descripcion = 'Imagen de perfil';
                        $nuevaFoto->ancho = $pi->rAncho;
                        $nuevaFoto->alto = $pi->rAlto;
                        $nuevaFoto->directorio = $pi->directorioUpload;
                        $nuevaFoto->ruta = $pi->dirUpload;
                        $nuevaFoto->extension = $pi->extension;
                        $nuevaFoto->esfotoperfil = 'SI';
                        
                        $nuevaFoto->thumb_nom = $pi->thumb_nombre;
                        $nuevaFoto->thumb_ancho = $pi->thumb_ancho;
                        $nuevaFoto->thumb_alto = $pi->thumb_alto;
                        $nuevaFoto->thumb_ruta = $pi->dirThumb;
                        $nuevaFoto->thumb_directorio = $pi->directorioThumb;
                        $nuevaFoto->idvisibilidad=  Visibilidad::model()->getIdVisibilidad();
                        $nuevaFoto->idalbum = Cookie::get('idalbum');
                        $nuevaFoto->peso = $_FILES['Upfoto']['size']['foto'];
                        $nuevaFoto->fecha = time();
                        
                        if($nuevaFoto->validate())
                        {
                           if($nuevaFoto->save())
                           {
                               $pf = Perfil::model()->findByPk(Yii::app()->user->id);
                               if($pf != null)
                               {
                                   $pf->foto = $nuevaFoto->idfoto;
                                   $pf->update();
                               }
                                   
                               if($img!=null)
                               {
                                   $img->esfotoperfil = 'NO';
                                   $img->update();
                               }
                                    
                               Yii::app()->user->setFlash('foto_perfil','Foto estabecida');
                               $this->refresh();
                               
                           }
                        }
                    }
                }
            } 
        }
        
        $foto = CHtml::image($src);
        $this->render('foto',array('model'=>$model,'foto'=>$foto));
    }
    
    public function actionDatos()
    {
        $model=Perfil::model()->findByPk(Yii::app()->user->id);

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='perfil-datos-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Perfil']))
        {
            $model->attributes=$_POST['Perfil'];
            if($model->validate())
            {
                $model->update();
                $this->refresh();
            }
        }
        $this->render('datos',array('model'=>$model));
    }
}

?>
