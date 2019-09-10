<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%save_user_payment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m190909_053738_create_save_user_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%save_user_payment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'sum' => $this->float(3),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-save_user_payment-user_id}}',
            '{{%save_user_payment}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-save_user_payment-user_id}}',
            '{{%save_user_payment}}',
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
            '{{%fk-save_user_payment-user_id}}',
            '{{%save_user_payment}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-save_user_payment-user_id}}',
            '{{%save_user_payment}}'
        );

        $this->dropTable('{{%save_user_payment}}');
    }
}
