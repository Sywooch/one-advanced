<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category_games".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $status
 *
 * @property Games[] $games
 */
class CategoryGames extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_games';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'status'], 'required'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['slug'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'slug' => 'Slug',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['category_id' => 'id']);
    }
}
