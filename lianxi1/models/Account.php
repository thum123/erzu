<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $we_id
 * @property string $we_name
 * @property string $we_sta
 * @property string $appid
 * @property string $appsecret
 * @property string $we_num
 * @property string $token
 * @property string $url
 * @property string $tok
 * @property integer $uid
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['we_name', 'we_sta'], 'string', 'max' => 33],
            [['appid', 'appsecret', 'we_num', 'token', 'url'], 'string', 'max' => 255],
            [['tok'], 'string', 'max' => 213]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'we_id' => 'We ID',
            'we_name' => 'We Name',
            'we_sta' => 'We Sta',
            'appid' => 'Appid',
            'appsecret' => 'Appsecret',
            'we_num' => 'We Num',
            'token' => 'Token',
            'url' => 'Url',
            'tok' => 'Tok',
            'uid' => 'Uid',
        ];
    }
}
