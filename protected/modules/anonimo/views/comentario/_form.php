<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>$this->createUrl('default/comentar'),
	'id'=>'acomentario-_form-form',
        'enableClientValidation'=>true,
        'htmlOptions'=>array('class'=>'formee'),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
                <?php echo $form->hiddenField($model,'id_del_comentado',array('value'=>$post)); ?>
                <?php echo $form->hiddenField($model,'post_or_imagen',array('value'=>  DefinidorTipos::$POST)); ?>
                <?php echo $form->hiddenField($model,'fecha',array('value'=>time())); ?>
                <?php echo $form->hiddenField($model,'tituloPost',array('value'=>Util::eliminarSignos($titulo))); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'comentario'); ?>
		<?php echo $form->textArea($model,'comentario',array('class'=>'tinymce')); ?>
		<?php echo $form->error($model,'comentario'); ?>
	</div>	

	            
            <?php if(Yii::app()->user->isGuest){
            if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'ccaptcha'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'ccaptcha'); ?>
		</div>
		<div class="hint" style="color: blue;">Genere un codigo nuevo y escriba el texto que se muestra</div>
		<?php echo $form->error($model,'ccaptcha'); ?>
	</div>
	<?php endif; 
        }?>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit');?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->