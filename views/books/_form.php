<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUpload;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

	<div class="col-lg-6">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'authors_id')
			->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Authors::find()->all(), 'id', 'name'),
				[
					'prompt' => '',
				]) ?>
		<?= $form->field($model, 'genres_id')
			->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Genres::find()->all(), 'id', 'name'),
				[
					'prompt' => '',
				]) ?>

		<?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'isbn_number')->textInput(['maxlength' => true]) ?>

		<div class="block-image">
			<img src="<?= $model->image ?>">
			<input name="photo" type="hidden" value="<?= $model->image ?>">
		</div>

		<?= FileUpload::widget([
			'model' => $model,
			'attribute' => 'image',
			'url' => ['books/image-upload', 'id' => $model->id], // your url, this is just for demo purposes,
			'options' => ['accept' => 'image/*'],
			'clientOptions' => [
				'maxFileSize' => 2000000
			],
			'clientEvents' => [
				'fileuploaddone' => 'function(e, data) {
					var photo = JSON.parse(data.result);
					photo = photo.files[0];
					$(".block-image img").attr("src", photo.thumbnailUrl);
					$(".block-image input").val(photo.url)
				}',
				'fileuploadfail' => 'function(e, data) {
					console.log(e);
					console.log(data);
				}',
			],
		]); ?>

		<?= $form->field($model, 'publication_date')->widget(
			DatePicker::className(), [
			// inline too, not bad
			'inline' => true,
			// modify template for custom rendering
			'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd-m-yyyy'
			]
		]); ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
</div>
