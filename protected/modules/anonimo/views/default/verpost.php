<div class="portlet span-22">
    <div class="portlet-header"><h4><?php echo $model->titulo; ?></h4>
    <ul class="portlet-tab-nav">
     <li class="portlet-tab-nav-active">  
     <?php echo CHtml::link("VER MAS PUBLICACIONES", array('post/publicaciones'))?>
         </li>
        <li class="portlet-tab-nav-active"><a href="#f-coment">Comentar </a></li>				
        <li class="portlet-tab-nav-active"><?php 
        echo CHtml::link('Reportar', array('#'), array('onclick'=>'$("#aviso").dialog("open"); return false;'));
        ?></li>
    </ul>
    </div>
    <?php 
            foreach($model->getTagLinks() as $etiquetas)
                echo $etiquetas." ";
    ?>
    <div class="portlet-content">
        <?php if($model->tieneImagen){?>
            <?php echo $model->getImagen(450,350);?>
        <?php }?>
        <?php echo $model->contenido; ?>
    </div>
</div>
<div class="clearfix"></div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$comentario->comentariosDePost($model->idpost),
	'itemView'=>'/comentario/item',
)); ?>
<div class="portlet span-12">
    <div class="portlet-header"><h4><a name="f-coment">Comentar</a></h4></div>
     <div class="portlet-content">
     <?php if(Yii::app()->user->hasFlash('comentario-ok')){?>  
         <div class="flash-success">
             <?php echo Yii::app()->user->getFlash('comentario-ok'); ?>
         </div>
     <?php } ?>        
<?php
$this->renderPartial('/comentario/_form',array('model'=>$comentario,
                                                'post'=>$model->idpost,'titulo'=>$model->titulo));
?>
     </div>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
      'id'=>'aviso',
      // additional javascript options for the dialog plugin
      'options'=>array(
          'title'=>'Denuncia',
          'autoOpen'=>false,
      ),
  ));
$model=new Areportados('insert');
echo $this->renderPartial('/reportados/denuncia',array('model'=>$model,'id'=>$_GET['id'],'pagina'=>$_GET['pagina']),true);
?>
 
<?php
  $this->endWidget('zii.widgets.jui.CJuiDialog');

?>
