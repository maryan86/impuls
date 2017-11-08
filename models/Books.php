<?php

namespace app\models;

use Yii;
use Biblys\Isbn\Isbn as Isbn;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $language
 * @property integer $authors_id
 * @property integer $genres_id
 * @property string $publication_date
 * @property string $image
 * @property string $isbn_number
 * @property integer $created_at
 * @property integer $updated_at
 */
class Books extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%books}}';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => \yii\behaviors\TimestampBehavior::className(),
				'attributes' => [
					\yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					\yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				],
				'value' => function () {
					return date('U');
				},
			],];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['authors_id', 'genres_id', 'created_at', 'updated_at'], 'integer'],
			[['title', 'isbn_number', 'authors_id', 'genres_id', 'isbn_number', 'publication_date'], 'required'],
			[['language', 'publication_date'], 'string', 'max' => 20],
			[['image', 'title'], 'string', 'max' => 255],
			// isbn_number is validated by validateIsbn()
			['isbn_number', 'validateIsbn'],
		];
	}

	public function validateIsbn()
	{
		$isbn = new Isbn($this->isbn_number);
		if (!$isbn->isValid()) {
			$this->addError('isbn_number', 'Incorrect Isbn Number, only ISBN-13.');
		}
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'language' => Yii::t('app', 'Language'),
			'authors_id' => Yii::t('app', 'Authors'),
			'genres_id' => Yii::t('app', 'Genres'),
			'publication_date' => Yii::t('app', 'Publication Date'),
			'image' => Yii::t('app', 'Image'),
			'isbn_number' => Yii::t('app', 'Isbn Number'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		];
	}

	public function getAuthors()
	{
		return $this->hasOne(\app\models\Authors::className(), ['id' => 'authors_id']);
	}

	public function getGenres()
	{
		return $this->hasOne(\app\models\Genres::className(), ['id' => 'genres_id']);
	}
}
