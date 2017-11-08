<?php

use yii\db\Migration;

/**
 * Class m171107_234933_related
 */
class m171107_234933_related extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

		// creates index for column `authors_id`
		$this->createIndex(
			'idx-books-authors_id',
			'books',
			'authors_id'
		);

		// add foreign key for table `authors`
		$this->addForeignKey(
			'fk-post-authors_id',
			'books',
			'authors_id',
			'authors',
			'id',
			'CASCADE'
		);

		// creates index for column `genres_id`
		$this->createIndex(
			'idx-books-genres_id',
			'books',
			'genres_id'
		);

		// add foreign key for table `genres`
		$this->addForeignKey(
			'fk-post-genres_id',
			'books',
			'genres_id',
			'genres',
			'id',
			'CASCADE'
		);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		// drops index for column `authors_id`
		$this->dropIndex(
			'idx-books-authors_id',
			'books'
		);

		// drops index for column `genres_id`
		$this->dropIndex(
			'idx-books-genres_id',
			'books'
		);
    }

}
