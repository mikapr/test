<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files_payloads`.
 */
class m171207_103515_create_files_payloads_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('files_payloads', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'tags' => $this->text(),
            'tags_count' => $this->integer(),
        ]);

        $this->addForeignKey(
            'files_tag-files_payloads',
            'files_payloads',
            'file_id',
            'files',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'files_tag-files_payloads',
            'files_payloads'
        );
        $this->dropTable('files_payloads');
    }
}
