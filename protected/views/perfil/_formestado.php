<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'estado-_formestado-form',
        'htmlOptions'=>array('class'=>'formee'),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

		
		<?php echo $form->hiddenField($model,'idperfil',array('value'=>Yii::app()->user->id)); ?>
		<?php echo $form->hiddenField($model,'fecha',array('value'=>time())); ?>
                <?php echo $form->hiddenField($model,'content_link'); ?>

	<div class="row">		
		<?php echo $form->textArea($model,'contenido'); ?>
		<?php echo $form->error($model,'contenido'); ?>
	</div>	

	<div class="row  grid-5-12 clear">
		<?php echo $form->labelEx($model,'idvisibilidad'); ?>
		<?php echo $form->dropDownList($model,'idvisibilidad',DefinidorTipos::tipoVisivilidad(),array('style'=>'height:35px;')); ?>
		<?php echo $form->error($model,'idvisibilidad'); ?>
	</div>

	<div class="row buttons clear" >
		<?php echo CHtml::submitButton('Publicar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->