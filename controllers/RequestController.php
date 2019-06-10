<?php

namespace app\controllers;

use app\models\UploadImage;
use Yii;
use app\models\Request;
use app\models\RequestSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    /**
     * @ is authentificated
     * ? is guest
     * Only administrators can edit Requests
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update', 'delete', 'index', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role === 5;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@']
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = time();
            $model->updated_at = time();

//            if($model->file = UploadedFile::getInstance($model, 'file'))
//            {
//                if ($model->upload())
//                {
//                    // file is uploaded successfully
//                }
//            }


            if ($model->save()) {
                if (!Yii::$app->user->isGuest) {
                    return $this->redirect(['index']);
                } else {
                    return $this->goHome();
                }

            } else {
                var_dump($model->getErrors());
                die;
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->request_id]);
            } else {
                var_dump($model->getErrors());
                die;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload()
    {
        $model = new UploadImage();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->upload();
            return $this->render('upload', ['model' => $model]);
        }
        return $this->render('upload',
            ['model' => $model]);
    }




}
