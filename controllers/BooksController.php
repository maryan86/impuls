<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Books;
use app\models\BooksSearch;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Biblys\Isbn\Isbn as Isbn;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['*'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();

		$request = Yii::$app->request->post();
		if(Yii::$app->request->post()) {
			$request["Books"]["image"] = $request["photo"];
		}
		if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

		$request = Yii::$app->request->post();
		if(Yii::$app->request->post()) {
			$request["Books"]["image"] = $request["photo"];
		}
        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionImageUpload()
	{
		$model = new Books();

		$imageFile = UploadedFile::getInstance($model, 'image');

		$directory = Yii::getAlias('@upload') . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
		if (!is_dir($directory)) {
			FileHelper::createDirectory($directory);
		}

		if ($imageFile) {
			$uid = uniqid(time(), true);
			$fileName = $uid . '.' . $imageFile->extension;
			$filePath = $directory . $fileName;
			if ($imageFile->saveAs($filePath)) {
				$path = '/images/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
				return Json::encode([
					'files' => [
						[
							'name' => $fileName,
							'size' => $imageFile->size,
							'url' => $path,
							'thumbnailUrl' => $path,
							'deleteUrl' => 'image-delete?name=' . $fileName,
							'deleteType' => 'POST',
						],
					],
				]);
			}
		}

		return '';
	}

}
