<?php
$cs=Yii::app()->clientScript;
$cs->coreScriptPosition=CClientScript::POS_HEAD;
$cs->scriptMap=array();
$baseUrl=Yii::app()->request->baseUrl;
$cs->registerCoreScript('jquery');
$mdl = Yii::app()->getController()->getModule();
if($mdl != null)
{
    if($mdl->getId() == 'anonimo'){
$cookie = Cookie::get('uacep');
/*if(!$cookie or is_null($cookie))
    Yii::app()->getController()->redirect(array('/site/index'));*/

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/tiny_mce/jquery.tinymce.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('tynimce','
    $().ready(function() {
		$("textarea.tinymce").tinymce({
			// Location of TinyMCE script
			script_url : "'.Yii::app()->request->baseUrl.'/js/tiny_mce/tiny_mce.js",

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,youtubeIframe,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,preview,media,searchreplace,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "link,unlink,emotions,youtubeIframe,media,image,help,code,|,preview",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "'.Yii::app()->request->baseUrl.'/css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
    ',CClientScript::POS_HEAD);
    
    } 
}
 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.pop.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScript('elpop','
    
        
            $(".ingreso").click(function(e) {          
				e.preventDefault();
                $("div#flog").toggle();
	        $(".ingreso").toggleClass("menu-open");
            });
			
			$("div#flog").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {                            
				if($(e.target).parent("a.ingreso").length==0) {
					$(".ingreso").removeClass("menu-open");
					$("div#flog").hide();
				}
			});
    '      
        );
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link href='<?php echo Yii::app()->request->baseUrl."/images/favicon.png"; ?>' rel='icon' type='image/png'/>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
        
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <!--[if lt IE 9]>
	<style type="text/css">
            body{
                font: normal 9pt Arial,Helvetica,sans-serif;
            }
        </style>
	<![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formee-structure.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
            
        <?php 
         if($mdl != null)
         {
            if($mdl->getId() == 'anonimo'){ ?>
            <style type="text/css">
                body{
                    margin-top: 70px;
                }
            </style> 
        <?php }        
        }?>
         <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="topbar">
    <div id="header">
        <div id="logo"><?php echo Chtml::link(Chtml::image(Yii::app()->request->baseUrl.'/images/mlogo.png'),array('//site/index')); ?></div>
    </div><!-- header -->
     
    
    <div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions'=>array('id'=>'asdad'),
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')),
//                                array('label'=>'Anonimo', 'url'=>array('/anonimo')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
//				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Ingresar', 'url'=>array('#'), 'visible'=>Yii::app()->user->isGuest,
                                    'linkOptions'=>array('class'=>'ingreso')),
				array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
        <?php if(Yii::app()->user->isGuest){ ?>  
        <div class="box-login portlet" id="flog">
        <?php            
            $login=new LoginForm;
            Yii::app()->getController()->renderPartial('//site/login',array('model'=>$login));
        ?>
        </div>
        <?php } ?>
	</div><!-- mainmenu -->    
    
    
</div>
<div class="subtopbar">
     <?php 
         if($mdl != null)
         {
            if($mdl->getId() == 'anonimo'){
            ?>
                <?php
               echo CHtml::link('Anonimo', array('//anonimo'), array('class'=>'btn btn-mediun')); 
               echo CHtml::link('Agregar Imagen', array('//anonimo/imagen'), array('class'=>'btn btn-mediun','style'=>'margin-left:0.4em'));
               echo CHtml::link('Publicar un post', array('//anonimo/default/postear'), array('class'=>'btn btn-mediun','style'=>'margin-left:0.4em'));
               echo CHtml::link('Agregar Video', array('//anonimo/video'), array('class'=>'btn btn-mediun','style'=>'margin-left:0.4em'));
               echo Yii::app()->getController()->renderPartial('/post/buscar');
               
               ?>
                <div class="clearfix"></div>
            <?php     
            }
                   
         }             
         ?> 
    
    
</div>    
<div class="container" id="page"> 
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by 3l@Pr3d1z.<br/>
		All Rights Reserved.<br/>		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>