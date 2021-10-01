<?php

/**
 * Description of UltimosPost
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */

Yii::import('zii.widgets.CPortlet');
class UltimosPost extends CPortlet{
    
   public $title='<h4>Post Recientes</h4>';
   public $max=40;
   public $titleCssClass='portlet-header';
   public $htmlOptions=array('class'=>'portlet span-8');
   
    protected function renderContent()
    {
            $posts= Apost::model()->ultimosPost($this->max);
            $liItem='';
            foreach($posts as $post)
            {
                    $link=CHtml::link(Util::minizarString($post->getTitulo()), array('/anonimo/default/post','id'=>$post->getId(),'pagina'=>  Util::eliminarSignos($post->getTitulo())));
                    $liItem .= CHtml::tag('li', array(
                            'class'=>'recent-post',                            
                    ), $link);
            }
            echo CHtml::tag('ul',array(
                'id'=>'invoice_actions'
            ),$liItem);
    }
}

?>
