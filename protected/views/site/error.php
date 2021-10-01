<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<?php if($code==500) { ?>
<div class="flash-notice">
    <p>Hubo en pequeño problema, pero aun asi tu publicacion se guardo.</p>
    <?php if(Cookie::get('ipost') and Cookie::get('ipag')){
        echo CHtml::link('Ver publicacion', array('default/post','id'=>Cookie::get('ipost'),
            'pagina'=>Cookie::get('ipag')),array('class'=>'btn btn-large'));
    }else
        echo CHtml::link('Ir a publicaciones', array('//anonimo','ctg'=>'General'), array('class'=>'btn btn-large'));
?>
   
</div>  
<?php } ?>