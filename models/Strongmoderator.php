<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "strongmoderator".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 *
 * @property Translation[] $translations
 */
class Strongmoderator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'strongmoderator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'max' => 20],
            [['login'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Айди',
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['smoder_id' => 'id']);
    }
}
