<div class="portlet span-10">
  <div class="portlet-content">  
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'perfil-datos-form',
        'htmlOptions'=>array('class'=>'formee'),
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<fieldset>
    <legend>Cuentanos algo de ti</legend>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login'); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'s_sentimental'); ?>
		<?php echo $form->dropDownList($model,'s_sentimental',DefinidorTipos::situacionSentimental(),
                                                array(
                                                    'options'=>array($model->s_sentimental=>array('selected'=>true)),
                                                    'empty'=>'¿Cuál es tu situacion sentimental?'
                                                )); ?>
		<?php echo $form->error($model,'s_sentimental'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'intereses'); ?>
		<?php echo $form->dropDownList($model,'intereses',DefinidorTipos::preferencia(),array(
                                                    'options'=>array($model->intereses=>array('selected'=>true)),
                                                    'empty'=>'¿Prefieres?'
                                                
                                                )); ?>
		<?php echo $form->error($model,'intereses'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fono'); ?>
		<?php echo $form->textField($model,'fono'); ?>
		<?php echo $form->error($model,'fono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'movil'); ?>
		<?php echo $form->textField($model,'movil'); ?>
		<?php echo $form->error($model,'movil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nextel'); ?>
		<?php echo $form->textField($model,'nextel'); ?>
		<?php echo $form->error($model,'nextel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion'); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'especialidad_social'); ?>
		<?php echo $form->textArea($model,'especialidad_social'); ?>
		<?php echo $form->error($model,'especialidad_social'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'frase'); ?>
		<?php echo $form->textArea($model,'frase'); ?>
		<?php echo $form->error($model,'frase'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->
 <div class="clearfix"></div>
       <?php echo CHtml::link('Continuar',array('perfil/index','id'=>Yii::app()->user->id),array('class'=>'btn btn-small'));?>   
           
</div>
 </div>   