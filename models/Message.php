<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property string $content
 * @property integer $type
 * @property string $date_time
 * @property integer $trans_id
 *
 * @property Translation $trans
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'date_time','type'], 'required'],
            [['trans_id'], 'integer'],
            [['type'],'string', 'max' =>60],
            [['content'], 'string', 'max' => 255],
            [['date_time'], 'string', 'max' => 100],
            [['trans_id'], 'exist', 'skipOnError' => true, 'targetClass' => Translation::className(), 'targetAttribute' => ['trans_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Айди',
            'content' => 'Содержание',
            'type' => 'Тип',
            'date_time' => 'Дата',
            'trans_id' => 'Трансляция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrans()
    {
        return $this->hasOne(Translation::className(), ['id' => 'trans_id']);
    }

    public function jsonModalUpdate()
    {
        $modal ="<div class='modal fade' id='redModal'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                            <h2 class='modal-title' id='myModalLabel'>Редактирование</h2>
                        </div>
                    <div class='modal-body'>
                    <form name='update_form' method='get' action='message/update'>
                      <input name='mes_content' class='form-control' value='".$_POST['mes_content']."'></input>
                      <input name='mes_id' type='hidden' value='".$_POST['mes_id']."'>
                    </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-dismiss='modal' >Закрыть</button>
                        <button type='submit' id='a_beta' class='btn btn-warning' onclick='update_form.submit()'>Редактировать</a>
                        
                    </div>
                </div>
            </div>
        </div>";

        return $modal;
    }

    public function newMessage($trans_id)
    {
        $this->date_time=date("Y-m-d H:i:s");

        $this->trans_id=(int)$trans_id;
    }
}
