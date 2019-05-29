<?php

use common\models\Category;
use frontend\widgets\TreeMenu;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php
    echo TreeMenu::widget([
    // single query fetch to render the tree
    'query'             => Category::find()->addOrderBy('root, lft'),
    'headingOptions'    => ['label' => 'Categories'],
    'isAdmin'           => false,
    'displayValue'      => 1,
        'nodeView' => '@frontend/widgets/views/tree_menu'
    ]);
    ?>
</div>
