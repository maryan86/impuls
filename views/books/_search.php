<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-6 no-padding">
	<div class="books-search">

		<?php $form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
		]); ?>

		<?= $form->field($model, 'title',
			['options' => [
				'class' => 'form-group col-md-6 no-padding-left'
			]])->label(false) ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
</div>