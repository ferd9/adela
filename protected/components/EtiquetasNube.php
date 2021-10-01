<?php

/**
 * Description of EtiquetasNube
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
Yii::import('zii.widgets.CPortlet');
class EtiquetasNube extends CPortlet{
    public $title='<h4>Etiquetas</h4>';
    public $maxTags=20;
    public $titleCssClass='portlet-header';
    public $htmlOptions=array('class'=>'portlet span-12');

    protected function renderContent()
    {
            $tags=  Aetiquetas::model()->findTagWeights($this->maxTags);

            foreach($tags as $tag=>$weight)
            {
                    $link=CHtml::link(CHtml::encode($tag), array('/anonimo/post/etiquetas','tag'=>$tag));
                    echo CHtml::tag('span', array(
                            'class'=>'tag ticket responded',
                            'style'=>"font-size:{$weight}pt",
                    ), $link)."\n";
            }
    }
}

?>
