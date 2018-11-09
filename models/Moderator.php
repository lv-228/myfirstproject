<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "moderator".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 *
 * @property Translation[] $translations
 */
class Moderator extends ActiveRecord implements IdentityInterface
{
    public static $rolenameid = [1 => 'moder',
        2 => 'admin',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%moderator}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password','role'], 'required'],
            [['login'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 255],
            [['login'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['role', 'in', 'range' => [self::ROLE_ADMIN, self::ROLE_USER]],
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
            'role' => 'Роль',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['moder_id' => 'id']);
    }

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
 
     const ROLE_ADMIN = 10;
    const ROLE_USER = 1;
    /**
     * @inheritdoc
     */

        public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

        public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function isUserAdmin($userlogin) //для проверки админ ли пользователь
    {
        if (static::findOne(['login' => $userlogin, 'role' => self::ROLE_ADMIN]))
        {
            return true;
        } else {
            return false;
        }
    }
}
