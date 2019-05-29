<?php


namespace backend\controllers;


use common\models\Category;
use common\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ProductController extends Controller
{
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
     * @return string
     */
    public function actionIndex()
    {
        $model = new Product();
        $categories = Category::find()->all();
        $array = [];
        foreach ($categories as $category) {
            $array[$category->id] = $category->namePath . $category->name;
        }
        return $this->render('index', [
            'model' => $model,
            'categories' => $array,
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->load(\Yii::$app->request->post());
        if (!$model->save()) {
            throw new ForbiddenHttpException('Error');
        }
        $categories = Category::findAll(['id' => \Yii::$app->request->post('Product')['category']], []);
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $model->link('category', $category);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
