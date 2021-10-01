<div id="posts" class="portlet-content" style="padding: 10px 50px 4px 50px;">
<?php foreach($posts as $data){?>
<div class="portlet span-24 apost">
    <div class="portlet-header"><h4><?php echo CHtml::link($data->titulo,array('/anonimo/default/post','id'=>$data->idpost,'pagina'=>  Util::eliminarSignos($data->titulo)));?></h4>
    <ul class="portlet-tab-nav">
        <li class="portlet-tab-nav-active"><?php echo CHtml::link('VER POST COMPLETO',array('/anonimo/default/post','id'=>$data->idpost,'pagina'=>  Util::eliminarSignos($data->titulo)));?>
        </li>
        <li class="portlet-tab-nav-active"><a>Comentarios (
                <?php echo Acomentario::model()->count('id_del_comentado='.$data->idpost)?> )
            </a>
        </li>
    </ul>
    </div>
    <?php foreach($data->getTagLinks() as $etiqueta)
                echo $etiqueta." ";
           ?>
    <div class="portlet-content">        
        <div class="content-flow">
        <?php echo $data->contenido;?>
        </div>    
    </div>    
</div> 
<?php } ?>
</div> 
<div class="clear"></div>
<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#posts',
    'itemSelector' => 'div.apost',
    'loadingText' => 'Cargando mas publicacione.......',
    'donetext' => 'Parece que ya no hay mas publicciones :(',
    'pages' => $pages,
)); ?>
