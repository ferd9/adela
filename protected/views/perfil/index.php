<div class="span-24">
<div class="span-6 portlet">
    <div class="portlet-content">
    <?php echo $foto;?>
     </div>   
</div>    
<div class="span-15">
    
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
      'tabs'=>array(
          'Estados'=>array('ajax'=>$this->createUrl('perfil/estados')),
          'Fotos'=>array('ajax'=>$this->createUrl('perfil/albums')),
          'Amigos'=>array('ajax'=>$this->createUrl('perfil/amigos')),
          'Posts'=>array('ajax'=>$this->createUrl('perfil/posts')),
          
      ),
      // additional javascript options for the tabs plugin
      'options'=>array(
          'collapsible'=>true,
      ),
  ));

?>
</div>
</div>    
