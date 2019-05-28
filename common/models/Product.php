<?php


namespace common\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function rules()
    {
        return [
            ['price', 'integer'],
            ['name', 'string'],
            [['name', 'price'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'price' => \Yii::t('app', 'Price'),
            'name' => \Yii::t('app', 'Name'),
        ];
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('{{%product_category}}', ['product_id' => 'id']);
    }
}
