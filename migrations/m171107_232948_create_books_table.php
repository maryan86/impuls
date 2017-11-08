<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books`.
 */
class m171107_232948_create_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
			'title' => $this->string(255)->null(),
			'language' => $this->string(20)->null(),
			'authors_id' => $this->integer(11)->null(),
			'genres_id' => $this->integer(11)->null(),
			'publication_date' => $this->string(20)->null(),
			'image' => $this->string(255)->null(),
			'isbn_number' => $this->string(50)->null(),
			'created_at' => $this->integer(11)->null(),
			'updated_at' => $this->integer(11)->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('books');
    }
}
