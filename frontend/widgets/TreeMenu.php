<?php


namespace frontend\widgets;


use kartik\base\Config;
use kartik\tree\models\Tree;
use kartik\tree\Module;
use kartik\tree\TreeSecurity;
use kartik\tree\TreeView;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class TreeMenu extends TreeView
{
    public function renderWidget()
    {
        $content = strtr(
            $this->mainTemplate, [
                '{wrapper}' => $this->renderWrapper(),
                '{detail}' => $this->renderDetail(),
            ]
        );
        return strtr(
                $content, [
                    '{heading}' => $this->renderHeading(),
                    '{search}' => $this->renderSearch(),
                    '{toolbar}' => $this->renderToolbar(),
                ]
            ) . "\n" .
            Html::textInput('kv-node-selected', $this->value, $this->options) . "\n";
    }

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

    public function renderDetail()
    {
        /**
         * @var Tree $modelClass
         * @var Tree $node
         */
        $modelClass = $this->query->modelClass;
        $node = $this->displayValue ? $modelClass::findOne($this->displayValue) : null;
        if (empty($node)) {
            $node = new $modelClass;
        }
        $iconTypeAttribute = ArrayHelper::getValue($this->_module->dataStructure, 'iconTypeAttribute', 'icon_type');
        if ($this->_nodeIconsList !== false) {
            $node->$iconTypeAttribute = ArrayHelper::getValue($this->iconEditSettings, 'type', self::ICON_CSS);
        }
        $url = Yii::$app->request->url;

        $manageData = TreeSecurity::parseManageData([
            'formOptions' => $this->nodeFormOptions,
            'hideCssClass' => $this->hideCssClass,
            'modelClass' => $modelClass,
            'formAction' => $this->nodeActions[Module::NODE_SAVE],
            'currUrl' => $url,
            'isAdmin' => $this->isAdmin,
            'iconsList' => $this->_nodeIconsList,
            'softDelete' => $this->softDelete,
            'allowNewRoots' => $this->allowNewRoots,
            'showFormButtons' => $this->showFormButtons,
            'showIDAttribute' => $this->showIDAttribute,
            'showNameAttribute' => $this->showNameAttribute,
            'nodeView' => $this->nodeView,
            'nodeAddlViews' => $this->nodeAddlViews,
            'nodeViewButtonLabels' => $this->nodeViewButtonLabels,
            'nodeViewParams' => serialize($this->nodeViewParams),
            'nodeSelected' => $this->_nodeSelected,
            'breadcrumbs' => $this->breadcrumbs,
            'noNodesMessage' => Html::tag('div', $this->emptyNodeMsg, $this->emptyNodeMsgOptions),
            'nodeTitle' => $this->nodeTitle,
            'nodeTitlePlural' => $this->nodeTitlePlural,
            'defaultBtnCss' => $this->getDefaultBtnCss(),
        ]);
        $removeData = TreeSecurity::parseRemoveData([
            'modelClass' => $modelClass,
            'softDelete' => $this->softDelete,
        ]);
        $moveData = TreeSecurity::parseMoveData([
            'modelClass' => $modelClass,
            'allowNewRoots' => $this->allowNewRoots,
        ]);
        $params = $this->_module->treeStructure + $this->_module->dataStructure + [
                'node' => $node,
                'treeManageHash' => $manageData['newHash'],
                'treeRemoveHash' => $removeData['newHash'],
                'treeMoveHash' => $moveData['newHash'],
            ] + $manageData['out'] + $this->nodeViewParams;
        $content = $this->render($this->nodeView, ['params' => $params]);
        return Html::tag('div', $content, $this->detailOptions);
    }
}