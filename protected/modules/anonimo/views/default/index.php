<?php
$this->breadcrumbs=array(
	$this->module->id,
);

?>
<div class="portlet span-22 categorias"> 
         <div class="portlet-header"><h4>CATEGORIAS</h4>
            <ul class="portlet-tab-nav">
                <li class="portlet-tab-nav-active">
                    <?php echo CHtml::link("VER TODAS LAS PUBLICACIONES", array('post/publicaciones'))?>
                </li>
            </ul>
         </div>
         <div class="portlet-content">
     <?php 
        $categorias = Yii::app()->db->createCommand("select idcategoria, nombre from acategoria")->queryAll();
     ?>   
        
     <?php foreach($categorias as $categoria1){?>
        
        <?php echo CHtml::link($categoria1['nombre'], array('post/categoria','id'=>$categoria1['idcategoria']), array('class'=>'btn btn-small'))?>
        
     <?php }?>
          </div>   
 </div>

    
<div class="box-imagen portlet span-22">
    <div class="portlet-content"> 
    
    <?php $this->widget('ImagenesPopulares', array(
				//'maxTags'=>Yii::app()->params['tagCloudCount'],
        )); ?>  
     <?php $this->widget('UltimosPost', array(
				//'maxTags'=>Yii::app()->params['tagCloudCount'],
        )); ?>   
    
    <?php $this->widget('ComentariosRecientes', array(
				//'maxTags'=>Yii::app()->params['tagCloudCount'],
        )); ?> 
        
    <?php $this->widget('EtiquetasNube', array(
				//'maxTags'=>Yii::app()->params['tagCloudCount'],
        )); ?>
        
       
    </div>
</div>