<?php

namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use common\models\SaveTransactionInfo;
use common\models\SaveUserPayment;

class SaveController extends \yii\web\Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionSavePayment()
    {
        //fake data
        $data = [];
        $data['transact_id'] = 5;
        $data['sum'] = 498 ;
        $data['comission'] = 2;

        $comissionSum = (int)$data['sum'] * ((int)$data['comission'] / 100);
        $sum = $data['sum'] + $comissionSum;


        $model = new SaveTransactionInfo();
        $model->transact_id = 18;
        $model->user_id = 1;
        $model->sum = $sum;

        if ($model->save()) {
            $userSum = SaveUserPayment::find()->where(['user_id' => 1])->one();
            if(!$userSum){
                $userSum = new SaveUserPayment();
                $userSum->user_id = 1;
                $userSum->sum = $sum;
                if(!$userSum->save()){
                    error_log(print_r($model->getErrorSummary(1), 1));
                }
            }
            else{
                $userSum->sum = $sum;
                if(!$userSum->save()){
                    error_log(print_r($model->getErrorSummary(1), 1));
                }
            }

        } else {
            error_log(print_r($model->getErrorSummary(1), 1));
        }

        //return $this->render('payment');
    }


}
