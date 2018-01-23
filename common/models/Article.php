<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title 标题
 * @property string $ftitle 副标题
 * @property string $titlepic 标题图
 * @property string $profile 简介
 * @property string $content 内容
 * @property int $source 来源
 * @property string $created_time 创建时间
 * @property string $updated_time 修改时间
 *
 * @property Source $source0
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'ftitle', 'source',], 'required'],
            [['source', 'created_time', 'updated_time'], 'integer'],
            [['title', 'ftitle', 'titlepic', 'profile', 'content'], 'string', 'max' => 255],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['source' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'ftitle' => 'Ftitle',
            'titlepic' => 'Titlepic',
            'profile' => 'Profile',
            'content' => 'Content',
            'source' => 'Source',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    /** 自动添加时间 */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',
                'updatedAtAttribute' => 'updated_time',
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource0()
    {
        return $this->hasOne(Source::className(), ['id' => 'source']);
    }

}
