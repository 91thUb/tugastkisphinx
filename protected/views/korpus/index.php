<?php
/* @var $this KorpusController */
?>

<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">Upload korpus</a>
</div>
    

<div id="wrapped_content">
    <h1>Select korpus file</h1>
    
        <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id'=>'selectfile-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data')));
    ?>
    
    <div class="form">
         <?php echo $form->errorSummary($model); ?>
        
        <div class="row">
            <?php echo $form->labelEx($model, 'file'); ?>
            <?php echo $form->fileField($model,'file'); ?>
            <?php echo $form->error($model, 'file'); ?>
        </div>
		
        <div id="row">
            <br/><br/>
            <?php echo CHtml::submitButton('Upload'); ?>
        </div>
    </div>
    
    <?php $this->endWidget(); ?>
</div>