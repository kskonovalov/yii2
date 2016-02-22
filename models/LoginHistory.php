<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 22.2.16
 * Time: 21.40
 */

namespace app\models;

use Yii;



class LoginHistory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return "clndr_login_history";
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['date_time'], 'safe']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', "ID"),
            'user_id' => Yii::t('app', "User ID"),
            'date_time' => Yii::t('app', "Date Time")
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ["id" => "user_id"]);
    }

    /**
     * @return query\LoginHistoryQuery
     */
    public static function find()
    {
        return new \app\models\query\LoginHistoryQuery(get_called_class());
    }
}