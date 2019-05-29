<?php


namespace frontend\widgets;

use kartik\tree\TreeView;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class TreeMenu extends TreeView
{

    public function renderRoot()
    {
        $content = $this->renderToggleIconContainer(true);
        if ($this->showCheckbox) {
            $content .= $this->renderCheckboxIconContainer(true);
        }
        $content .= ArrayHelper::remove($this->rootOptions, 'label', Yii::t('kvtree', Yii::t('app', 'Категории')));
        return Html::tag('div', $content, $this->rootOptions);
    }

    public function renderFooter()
    {
        return '';
    }

}