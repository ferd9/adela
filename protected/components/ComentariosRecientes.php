<?php

/**
 * Description of ComentariosRecientes
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
Yii::import('zii.widgets.CPortlet');
class ComentariosRecientes extends CPortlet{
   public $title='<h4>Comentarios Recientes</h4>';
   public $max=25;
   public $titleCssClass='portlet-header';
   public $htmlOptions=array('class'=>'portlet span-12');
    
   protected function renderContent()
    {
            $comentarios= Acomentario::model()->findComentariosNuevos($this->max);
            $liItem='';
            foreach($comentarios as $comentario)
            {
                $post = Apost::model()->findByPk($comentario->id_del_comentado);
                    $link=CHtml::link($comentario->nombre." en ".Util::minizarString($post->titulo), array('/anonimo/default/post','id'=>$post->idpost,'pagina'=>  Util::eliminarSignos($post->titulo)));
                    $liItem .= CHtml::tag('li', array(
                            'class'=>'recent-post',                            
                    ),$link);
            }
            echo CHtml::tag('ul',array(
                'id'=>'invoice_actions'
            ),$liItem);
    }
}

?>
