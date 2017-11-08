<?php

use yii\db\Migration;

/**
 * Handles the creation of table `authors`.
 */
class m171107_232846_create_authors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('authors', [
			'id' => $this->primaryKey(),
			'name' => $this->string(255)->null(),
			'created_at' => $this->integer(11)->null(),
			'updated_at' => $this->integer(11)->null(),
        ]);

		$this->insert('authors', [
			'name' => 'Paul Klimov',
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
		$this->insert('authors', [
			'name' => 'Kevin Yank',
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
		$this->insert('authors', [
			'name' => 'Michael Morrison',
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
		$this->insert('authors', [
			'name' => 'Robin Nixon',
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('authors');
    }
}
