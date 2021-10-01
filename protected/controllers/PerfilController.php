<?php
/**
 * Description of PerfilController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class PerfilController extends CController{
   
    public $layout='//layouts/columnperfil';
    
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
				'actions'=>array('index','albums',
                                                  'amigos',
                                                  'estados',
                                                  'posts',
                                                  'publicarEstado'),
				'users'=>array('@'),
                             ),	
                        array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    
    
    
    public function actionIndex($id)
    {
        if(is_numeric($id))
        {
            $pf = Perfil::model()->findByPk($id);
           $foto=$pf->getFoto(); 
          $this->render('index',array('foto'=>$foto));  
        }else
            throw new CHttpException(404,'La pagina solicitada no existe');
        
    }
    
    public function actionPublico($id)
    {
        
    }
    
    public function actionAlbums()
    {
        $this->renderPartial('_items/albums');
    }
    
    public function actionAmigos()
    {
       $this->renderPartial('_items/amigos'); 
    }
    
    public function actionEstados()
    {
        $model=new Estado('register');
        $this->renderPartial('_items/estados',array('model'=>$model));
    }
    
    public function actionPosts()
    {
        $this->renderPartial('_items/posts');
    }
    
    public function actionPublicarEstado()
    {
        $model=new Estado('register');

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='estado-_formestado-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['Estado']))
        {
            $model->attributes=$_POST['Estado'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('_formestado',array('model'=>$model));
    }
    
}

?>
