<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "save_transaction_info".
 *
 * @property int $id
 * @property int $transact_id
 * @property int $user_id
 * @property double $sum
 *
 * @property User $user
 */
class SaveTransactionInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'save_transaction_info';
    }

    const MIN_SUM = '10';
    const MAX_SUM = '700';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transact_id'], 'required'],
            [['transact_id', 'user_id'], 'integer'],
            [['sum'], 'number'],
            //['sum', 'in', 'range' => [self::MIN_SUM, self::MAX_SUM], 'message' => 'Incorrect sum'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transact_id' => 'Transact ID',
            'user_id' => 'User ID',
            'sum' => 'Sum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
