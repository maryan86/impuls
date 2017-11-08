<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Biblys\Isbn\Isbn as Isbn;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
			[
				'attribute' => 'authors.name',
				'format' => 'raw',
				'label' => Yii::t('app', 'Authors')
			],
			[
				'attribute' => 'genres.name',
				'format' => 'raw',
				'label' => Yii::t('app', 'Genres')
			],
			'language',
            'publication_date',
			[
				'attribute' => 'image',
				'value' => function ($model) {
					return Html::img($model->image);
				},
				'format' => 'raw',
			],
			[
				'attribute' => 'isbn_number',
				'value' => function ($model) {
					$isbn = new Isbn($model->isbn_number);
					return $isbn->format('ISBN-13');
				},
				'format' => 'raw',
			],
			[
				'attribute' => 'created_at',
				'value' => function ($model) {
					return date("Y-m-d H:i:s", $model->created_at);
				},
				'format' => 'raw'
			],
			[
				'attribute' => 'updated_at',
				'value' => function ($model) {
					return date("Y-m-d H:i:s", $model->updated_at);
				},
				'format' => 'raw'
			],
        ],
    ]) ?>

</div>
