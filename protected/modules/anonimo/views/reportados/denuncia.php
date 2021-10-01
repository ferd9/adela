<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'areportados-denuncia-form',
        'enableClientValidation'=>true,
        'action'=>$this->createUrl('default/denuncia'),
        'htmlOptions'=>array('class'=>'formee'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'motivo'); ?>
		<?php echo $form->textArea($model,'motivo'); ?>
		<?php echo $form->error($model,'motivo'); ?>
	</div>

	<?php echo $form->hiddenField($model,'titulo',array('value'=>$pagina)); ?>
	<?php echo $form->hiddenField($model,'idreportado',array('value'=>$id)); ?>
			
        <?php echo $form->hiddenField($model,'fecha',array('value'=>time())); ?>
		


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->