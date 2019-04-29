<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;


class SiteController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {


        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('dataProvider', 'searchModel'));
    }

}
