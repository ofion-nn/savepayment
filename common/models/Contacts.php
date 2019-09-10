<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $email
 * @property string $tel
 * @property int $status
 *
 * @property LangContacts[] $langContacts
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    const STATUS_ACTIVE   = '1';
    const STATUS_HIDE   = '0';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_HIDE], 'message' => Yii::t('news','Incorrect status')],
            [['email', 'tel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'E-mail'),
            'tel' => Yii::t('app', 'Телефон'),
            'status' => Yii::t('app', 'Активен'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangContacts()
    {
        return $this->hasMany(LangContacts::class, ['contact_id' => 'id']);
    }

    public function getData(){
        $language = Yii::$app->language;
        $data_lang = $this->getLangContacts()->where(['lang'=>$language])->one();
        return $data_lang;
    }

    public function getContacts(){
        return $this->find()->all();
    }


}
