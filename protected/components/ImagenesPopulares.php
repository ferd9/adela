<?php
/**
 * Description of ImagenesPopulares
 *
 * @author El APRENDIZ www.elaprendiz.net63.net
 */

Yii::import('zii.widgets.CPortlet');
class ImagenesPopulares extends CPortlet{
   public $title='<h4>Imagenes</h4>';
   public $maxImg=24;
   public $titleCssClass='portlet-header';
   public $htmlOptions=array('class'=>'portlet span-21');
   public $tabNav = "<ul class='portlet-tab-nav'>";
   private $endTabNav="</ul>";
   public $urlTabNav = 'Ver todas las imagenes' ;
   
    protected function renderContent()
    {
            $postsImg= Apost::model()->findImagenes($this->maxImg);

            foreach($postsImg as $pi)
            {
                    $link=CHtml::link($pi->getImagen(), array('/anonimo/default/post',
                                                              'id'=>$pi->getId(),
                                                              'pagina'=>Util::eliminarSignos($pi->getTitulo())));
                    echo CHtml::tag('div', array(
                            'class'=>'box-mini-img',                            
                    ), $link);
            }
    }
    
    /**
	 * Renders the decoration for the portlet.
	 * The default implementation will render the title if it is set.
	 */
	protected function renderDecoration()
	{
		if($this->title!==null)
		{
			echo "<div class=\"{$this->decorationCssClass}\">\n";
			echo "<div class=\"{$this->titleCssClass}\">{$this->title}
                        {$this->tabNav}
                        <li class='portlet-tab-nav-active'>".CHtml::link($this->urlTabNav,array('/anonimo/post/imagenes'))."
                        
                        </li>
                        {$this->endTabNav}
                        
                        </div>\n";
			echo "</div>\n";
		}
	}
}

?>
