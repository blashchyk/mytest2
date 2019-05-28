<?php


namespace frontend\widgets;


class Module extends \kartik\tree\Module
{
    public $treeViewSettings = [
        'nodeView' => '@frontend/widgets/views/tree_menu',
        'nodeAddlViews' => [
            self::VIEW_PART_1 => '',
            self::VIEW_PART_2 => '',
            self::VIEW_PART_3 => '',
            self::VIEW_PART_4 => '',
            self::VIEW_PART_5 => '',
        ]
    ];
}