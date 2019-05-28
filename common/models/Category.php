<?php


namespace common\models;


use kartik\tree\models\Tree;

class Category extends Tree
{
    public static function tableName()
    {
        return '{{%tree}}';
    }

    public function getParentId()
    {
        $parent = $this->parent;
        return $parent ? $parent->id : null;
    }

    public function getParent()
    {
        return $this->parents(1)->one();
    }

    /**
     * @return string
     */
    public function getNamePath()
    {
        $codePath = '';
        $parentsNodes = $this->parents()->all();
        foreach ($parentsNodes as $parentNode) {
            $codePath .= $parentNode->name . ' ';
        }
        unset($parentsNodes);
        return $codePath;
    }

    /**
     * @param int $node_id
     * @return array
     */
    public static function getTree($node_id = 0)
    {
        $children = [];
        if ( ! empty($node_id))
            $children = array_merge(
                self::findOne($node_id)->children()->column(),
                [$node_id]
            );
        $rows = self::find()->
        select('id, name')->
        where(['NOT IN', 'id', $children])->
        orderBy('root, lft')->
        all();
        $return = [];
        foreach ($rows as $row) {
            if (Category::findOne($row->id)->parent != null) {
                $return[$row->id] = Category::findOne($row->id)->namePath . ' ' . $row->name;
            } else {
                $return[$row->id] = $row->name;
            }
        }
        return $return;
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_category}}', ['category_id' => 'id']);
    }


}