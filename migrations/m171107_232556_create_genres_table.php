<?php

use yii\db\Migration;

/**
 * Handles the creation of table `genres`.
 */
class m171107_232556_create_genres_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('genres', [
            'id' => $this->primaryKey(),
			'name' => $this->string(255)->null(),
			'created_at' => $this->integer(11)->null(),
			'updated_at' => $this->integer(11)->null(),
        ]);
		$this->insert('genres', [
			'name' => 'Programming',
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
		$this->insert('genres', [
			'name' => "Children's books",
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
		$this->insert('genres', [
			'name' => "Designer",
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
		$this->insert('genres', [
			'name' => "Films",
			'updated_at' => date("U"),
			'created_at' => date("U"),
		]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('genres');
    }
}
