<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%save_transaction_info}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190908_142838_create_save_transaction_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%save_transaction_info}}', [
            'id' => $this->primaryKey(),
            'transact_id' => $this->tinyInteger()->notNull(),
            'user_id' => $this->integer(),
            'sum' => $this->float(3),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-save_payment-user_id}}',
            '{{%save_transaction_info}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-save_transaction_info-user_id}}',
            '{{%save_transaction_info}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-save_transaction_info-user_id}}',
            '{{%save_transaction_info}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-save_transaction_info-user_id}}',
            '{{%save_transaction_info}}'
        );

        $this->dropTable('{{%save_transaction_info}}');
    }
}
