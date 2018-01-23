<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ftitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titlepic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->dropDownList(\yii\helpers\ArrayHelper::map($source,'id','name'), ['prompt'=>'请选择','style'=>'width:120px']) ?>

    <?/*= $form->field($model, 'source')->widget(Select2::classname(), [
        'data' =>\yii\helpers\ArrayHelper::map($source,'id','name'),
        'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
        'pluginOptions' => [
        ],
    ]) */?>

    <?//= $form->field($model, 'created_time')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'updated_time')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
