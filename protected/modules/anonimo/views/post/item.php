<div class="portlet span-24">
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
