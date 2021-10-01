<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VideoController
 *
 * @author 3l@PR3ND1Z
 */
class VideoController extends Controller{
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
        $model=new ApostVideo('insert');
        
        if(isset($_POST['ApostVideo']))
         {
             $model->attributes = $_POST['ApostVideo'];             
             
             if($model->validate())
              {
                 $model->save();
                 $this->redirect(array('default/post','id'=>$model->idpost,'pagina'=>Util::eliminarSignos($model->titulo)), true);
              }else{
                  print_r($model->getErrors());
              }
         }
        
        $this->render('post',array('model'=>$model,'categoria'=>"General"));
    }
}

?>
