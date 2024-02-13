<?php

namespace backend\controllers;

use backend\models\AppleGenerateForm;
use backend\models\AppleUpdateSizeForm;
use backend\models\search\AppleForm;
use common\components\domain\exceptions\AppleChangeStatusException;
use common\components\domain\service\AppleChangeStatusService;
use common\models\Apple;
use common\models\BaseModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AppleController extends Controller
{
    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'test', 'generate', 'update', 'delete', 'drop'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $appleForm = new AppleForm();
        $appleGenerateForm = new AppleGenerateForm();
        return $this->render('index', ['dataProvider' => $appleForm->search(), 'model' => $appleGenerateForm]);
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionGenerate()
    {
        $appleGenerateForm = new AppleGenerateForm();
        if ($appleGenerateForm->load(Yii::$app->request->post()) && $appleGenerateForm->do()) {
            return $this->redirect(['index']);
        }
    }

    public function actionUpdate(): \yii\web\Response
    {
        try {
            $model = new AppleUpdateSizeForm();
            if ($model->load(Yii::$app->request->post())) {
                $model->do();
            }
        } catch (AppleChangeStatusException $exception) {
            Yii::$app->session->setFlash("warning", $exception->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete(int $id): \yii\web\Response
    {
        $apple = $this->getModel($id);

        $apple->delete = BaseModel::DELETED;
        $apple->save();
        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDrop(int $id)
    {
        $apple = $this->getModel($id);

        try {
            $service = new AppleChangeStatusService($apple);
            $service->setDrop();
        } catch (\Exception $exception) {
            Yii::$app->session->setFlash(
                'warning', $exception->getMessage()

            );
        }

        $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function getModel($id): Apple
    {
        /** @var Apple $model */
        $model = Apple::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}