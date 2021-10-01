<?php
/*$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);*/
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
        'htmlOptions'=>array('class'=>'formee'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<fieldset>
	<div class="row grid-12-12 f-login" >
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row grid-12-12 f-login clear">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
        </div>
        
        <div class="row rememberMe grid-12-12 f-login clear">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>                
	</div>
    
        <div class="row buttons f-login  clear" style="padding-top: 15px;">
		<?php echo CHtml::submitButton('Ingresar',array('submit' => array('/site/login'))); ?>
	</div>
    
        <div class="row rememberMe grid-12-12 f-login">
		<?php echo CHtml::link('¿Olvidaste tu contraseña?'); ?>		               
	</div>

</fieldset>	

	

<?php $this->endWidget(); ?>
</div><!-- form -->
