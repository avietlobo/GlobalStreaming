<?php
/** @var $model \app\models\EvangelistModel */
?>
<h1>Register Evangelist</h1>

<?php $form = \app\core\form\Form::begin('',"post")  ?>
<?php echo $form->field($model,'entryDate')  ?>
<?php echo $form->field($model,'email')  ?>
<?php echo $form->field($model,'mobile')  ?>
<?php echo $form->field($model,'evngName')  ?>
<?php echo $form->field($model,'designation')  ?>
<?php echo $form->field($model,'gLeaderEmail')  ?>
<?php echo $form->field($model,'wgroupId')  ?>

<button type="submit" class="btn btn-primary">Submit</button>

<?php  \app\core\form\Form::end()  ?>

