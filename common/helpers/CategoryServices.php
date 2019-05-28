<?php
namespace common\helpers;
use common\models\Category;

class CategoryServices
{
    /**
     * @param $id
     */
    public static function getCategoryProducts($id)
    {
        $category = Category::findOne($id);
        $children = $category->children()->all();
        if (!empty($category->product)) {
            foreach ($category->product as $product) {
                echo "<div class='row'>
                <div class='col-sm-4'>
                    {$product->name}
                </div>
                <div class='col-sm-8'>
                    {$product->price}
                </div></div><hr>";
            }
        }
        if (!empty($children)) {
            foreach ($children as $child) {
                if (!empty($child)) {
                    foreach ($child->product as $product) {
                        echo "<div class='row'>
                            <div class='col-sm-4'>
                                {$product->name}
                            </div>
                            <div class='col-sm-8'>
                                {$product->price}
                            </div></div>";
                    }
                }
            }
        }

    }

}