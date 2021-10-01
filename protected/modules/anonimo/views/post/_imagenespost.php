<li>
    <?php 
        $img = Aimagen::model()->findByPk($data->idimagen);
        if($img != null)
        {
            $src = Yii::app()->request->baseUrl.'/'.$img->thumb_directorio.'/'.$img->nom_thumb;
            echo CHtml::link(CHtml::image($src),array('/anonimo/default/post',
                                                              'id'=>$data->idpost,
                                                              'pagina'=>Util::eliminarSignos($data->titulo)));
        }
    ?>
</li>    
