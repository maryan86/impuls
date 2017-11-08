<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use Biblys\Isbn\Isbn as Isbn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php echo $this->render('_search', ['model' => $searchModel]); ?>
	<div class="col-md-6 no-padding text-right">
		<p>
			<?= Html::a(Yii::t('app', 'Create Books'), ['create'], ['class' => 'btn btn-success']) ?>
		</p>
	</div>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'options' => [
			'id' => 'table-books',
		],
		'layout' => "{items}<div class='col-sm-4 no-padding-left'>{summary}</div><div class='col-sm-8 no-padding text-right'>{pager}</div>",
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			['attribute' => 'title',
				'value' => function ($model) {
					return $model->title . ' <i class="fa fa-paint-brush" aria-hidden="true"></i>';
				},
				'format' => 'raw',
				'contentOptions' => function ($model, $key, $index, $column) {
					return ['class' => 'title'];
				},
			],
			'language',
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
			'publication_date',
			[
				'attribute' => 'isbn_number',
				'value' => function ($model) {
					if ($model->isbn_number) {
						$isbn = new Isbn($model->isbn_number);
						return $isbn->format('ISBN-13');
					}
					return false;
				},
				'format' => 'raw',
			],
			[
				'attribute' => 'image',
				'value' => function ($model) {
					return Html::img($model->image);
				},
				'format' => 'raw',
				'contentOptions' => function ($model, $key, $index, $column) {
					return ['class' => 'image'];
				},
				'headerOptions' => ['class' => 'hide-th-image'],
				'label' => false
			],

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
	<?php Pjax::end(); ?></div>
