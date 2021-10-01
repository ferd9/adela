<?php
/**
 * Description of PostController
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class PostController extends CController{
   
    public function actionIndex($wsearch)
    {
        if(strlen($wsearch)>0)
        {
            $post = Apost::model()->postEncontrados($wsearch);
            $this->render('listaposts',array('criterio'=>$post));
        }else
            $this->redirect (array('default/index'));
    }
    
    public function actionCategoria($id)
    {
        if(is_numeric($id))
        {
            $post = Apost::model()->postsPorCategoria($id);
            $this->render('listaposts',array('criterio'=>$post));            
        }
    }
    
    public function actionPublicaciones()
    {
        $datos = Apost::todosPost();
        $this->render('todos',array(
            'posts'=>$datos['posts'],
            'pages'=>$datos['pages'],
        ));
    }
    
    public function actionImagenes()
    {
          $post = Apost::model()->imgenesDeposts();
          $this->render('listarImagenespost',array('criterio'=>$post));         
    }
    
    public function actionEtiquetas($tag)
    {
        if($tag == '')
            throw new CHttpException(404,'Error!');
        $criteria=new CDbCriteria(array(			
			'order'=>'fecha DESC',			
		));
		
        $criteria->addSearchCondition('etiquetas',$tag);

		$dataProvider=new CActiveDataProvider('Apost', array(
			'pagination'=>array(
				'pageSize'=>15
			),
			'criteria'=>$criteria,
		));

		$this->render('listaposts',array(
			'criterio'=>$dataProvider,
		));
    }
    
}

?>
