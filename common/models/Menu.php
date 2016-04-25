<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $url
 * @property string $position
 * @property integer $sort
 * @property string $status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
            [['name', 'url', 'position', 'sort', 'status'], 'required'],
            [['position', 'status'], 'string'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родитель',
            'name' => 'Имя',
            'url' => 'Ссылка',
            'position' => 'Позиция',
            'sort' => 'Сортировочный номер',
            'status' => 'Статус',
        ];
    }

    public function getAllMenu()
    {
        return Menu::find()->where(['status'=>'on'])->all();
    }
}
