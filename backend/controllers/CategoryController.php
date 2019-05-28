<?php


namespace backend\controllers;


use common\models\Category;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use Yii;

class CategoryController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }

    /**
     * @param $id
     * @return Category|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionIndex()
    {
       $model = new Category();
       return $this->render('index', ['model' => $model]);
    }

    public function actionCreate()
    {
        $postData = Yii::$app->request->post();
        $node = new Category();
        if ($postData['Category']['parentId'] != '') {
            $node->activeOrig = $node->active;
            $node->load($postData);
            $parent = Category::findOne($postData['Category']['parentId']);
            $node->appendTo($parent);
        } else {
            $node->activeOrig = $node->active;
            $node->load($postData);
            $node->makeRoot();
        }
        if (!$node->save()) {
            throw new ForbiddenHttpException('Error');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
