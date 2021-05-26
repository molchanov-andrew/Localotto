<?php

namespace backend\controllers;

use backend\models\response\AjaxResponse;
use common\models\records\Banner;
use common\models\records\BannerToPageContent;
use common\models\records\Image;
use common\models\records\Language;
use common\models\records\Page;
use Yii;
use common\models\records\PageContent;
use backend\models\search\PageContentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PageContentController implements the CRUD actions for PageContent model.
 */
class PageContentController extends Controller
{
    public $page;

    public function init()
    {

        $this->view->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['/page']];
        $parentId = Yii::$app->request->get('parentId', null);
        if ($parentId !== null) {
            $this->page = $this->findPageModel($parentId);
            $this->view->params['breadcrumbs'][] = ['label' => $this->page->name, 'url' => ['/page/view', 'id' => $this->page->id]];
        }

        parent::init();
    }

    public function getUniqueId()
    {
        if ($this->page instanceof Page) {
            return "page/{$this->page->id}/{$this->id}";
        }
        return parent::getUniqueId();
    }

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

    /**
     * Lists all PageContent models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new PageContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $languages = Language::find()->asArray()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'page' => $this->page,
            'languages' => $languages,
        ]);
    }

    /**
     * Displays a single PageContent model.
     * @param integer $languageId
     * @param integer $pageId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($languageId, $pageId)
    {
        return $this->render('view', [
            'model' => $this->findModel($languageId, $pageId),
        ]);
    }

    /**
     * Creates a new PageContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PageContent(['pageId' => $this->page->id]);
        $model->serviceContent1 = $model->getContent1();
        $model->serviceContent2 = $model->getContent2();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->content = $model->serviceContent1 . $model::CONTENT_DIVIDER . $model->serviceContent2;
            if ($model->save())
                return $this->render('view', ['model' => $model]);
        }
        $images = Image::find()->pages()->all();
        $languages = Language::find()->all();
        $banners = Banner::getBannersSortedByPosition();
        $notUsedLanguages = $this->page->getNotUsedLanguages($languages, []);
        return $this->render('create', [
            'model' => $model,
            'images' => $images,
            'languages' => $languages,
            'page' => $this->page,
            'banners' => $banners,
            'notUsedLanguages' => $notUsedLanguages,
        ]);
    }

    /**
     * Updates an existing PageContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $languageId
     * @param integer $pageId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($languageId, $pageId)
    {
        $model = $this->findModel($languageId, $pageId);
        $model->serviceContent1 = $model->getContent1();
        $model->serviceContent2 = $model->getContent2();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            Banners update
            $pageContent = Yii::$app->request->post('PageContent');
            $banners = $model->banners;
            if($banners) {
                foreach ($banners as $banner) {
//                case update
                    if ($banner->position == 'right_top' && $pageContent['rightTopBanner']) {
                        $modelBannerToPageContent = BannerToPageContent::find()->where(['pageId' => $model->pageId, 'languageId' => $model->languageId, 'bannerId' => $banner->id])->one();
                        $modelBannerToPageContent->bannerId = $pageContent['rightTopBanner'];
//                case new
                    } else if ($banner->position != 'right_top' && $pageContent['rightTopBanner']) {
                        $modelBannerToPageContent = new BannerToPageContent();
                        $modelBannerToPageContent->bannerId = $pageContent['rightTopBanner'];
                        $modelBannerToPageContent->pageId = $pageContent['pageId'];
                        $modelBannerToPageContent->languageId = $pageContent['languageId'];

                    } else if ($banner->position == 'right_top' && !$pageContent['rightTopBanner']) {
                        $modelBannerToPageContent = BannerToPageContent::find()->where(['pageId' => $model->pageId, 'languageId' => $model->languageId, 'bannerId' => $banner->id])->one();
                        $modelBannerToPageContent->delete();
                    }
                    if ($banner->position == 'right_bottom' && $pageContent['rightBottomBanner']) {
                        $modelBannerToPageContent = BannerToPageContent::find()->where(['pageId' => $model->pageId, 'languageId' => $model->languageId, 'bannerId' => $banner->id])->one();
                        $modelBannerToPageContent->bannerId = $pageContent['rightBottomBanner'];
                    } else if ($banner->position != 'right_bottom' && $pageContent['rightBottomBanner']) {
                        $modelBannerToPageContent = new BannerToPageContent();
                        $modelBannerToPageContent->bannerId = $pageContent['rightBottomBanner'];
                        $modelBannerToPageContent->pageId = $pageContent['pageId'];
                        $modelBannerToPageContent->languageId = $pageContent['languageId'];
                    } else if ($banner->position == 'right_bottom' && !$pageContent['rightBottomBanner']) {
                        $modelBannerToPageContent = BannerToPageContent::find()->where(['pageId' => $model->pageId, 'languageId' => $model->languageId, 'bannerId' => $banner->id])->one();
                        $modelBannerToPageContent->delete();
                    }
                    if ($banner->position == 'bottom' && $pageContent['bottomBanner']) {
                        $modelBannerToPageContent = BannerToPageContent::find()->where(['pageId' => $model->pageId, 'languageId' => $model->languageId, 'bannerId' => $banner->id])->one();
                        $modelBannerToPageContent->bannerId = $pageContent['bottomBanner'];
                    } else if ($banner->position != 'bottom' && $pageContent['bottomBanner']) {
                        $modelBannerToPageContent = new BannerToPageContent();
                        $modelBannerToPageContent->bannerId = $pageContent['bottomBanner'];
                        $modelBannerToPageContent->pageId = $pageContent['pageId'];
                        $modelBannerToPageContent->languageId = $pageContent['languageId'];
                    } else if ($banner->position == 'bottom' && !$pageContent['bottomBanner']) {
                        $modelBannerToPageContent = BannerToPageContent::find()->where(['pageId' => $model->pageId, 'languageId' => $model->languageId, 'bannerId' => $banner->id])->one();
                        $modelBannerToPageContent->delete();
                    }
                }
            } else {
                $modelBannerToPageContent = new BannerToPageContent();
                if ($pageContent['rightTopBanner']) {
                    $modelBannerToPageContent->bannerId = $pageContent['rightTopBanner'];
                } else if($pageContent['rightBottomBanner']) {
                    $modelBannerToPageContent->bannerId = $pageContent['rightBottomBanner'];
                } else if($pageContent['bottomBanner']){
                    $modelBannerToPageContent->bannerId = $pageContent['bottomBanner'];
                }
                $modelBannerToPageContent->pageId = $pageContent['pageId'];
                $modelBannerToPageContent->languageId = $pageContent['languageId'];
            }
            $modelBannerToPageContent->save();

//            create Content
            $model->content = $model->serviceContent1 . $model::CONTENT_DIVIDER . $model->serviceContent2;

            if ($model->save())
                return $this->redirect(['view', 'languageId' => $model->languageId, 'pageId' => $model->pageId]);
        }
        $images = Image::find()->pages()->all();
        $languages = Language::find()->all();
        $banners = Banner::getBannersSortedByPosition();
        $notUsedLanguages = $this->page->getNotUsedLanguages($languages, [$model->languageId]);
        return $this->render('update', [
            'model' => $model,
            'images' => $images,
            'languages' => $languages,
            'page' => $this->page,
            'banners' => $banners,
            'notUsedLanguages' => $notUsedLanguages,
        ]);
    }

    /**
     * Deletes an existing PageContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $languageId
     * @param integer $pageId
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($languageId, $pageId)
    {
        $this->findModel($languageId, $pageId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PageContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $languageId
     * @param integer $pageId
     * @return PageContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($languageId, $pageId)
    {
        if (($model = PageContent::findOne(['languageId' => $languageId, 'pageId' => $pageId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findPageModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChangeMultiple()
    {
        $model = new PageContent();
        $model->isNewRecord = false;
        if (Yii::$app->request->post()) {
            $response = PageContent::changeMultiple(Yii::$app->request->post());
            return $response->render();
        }
        $banners = Banner::getBannersSortedByPosition();
        $images = Image::find()->pages()->all();
        $languages = Language::find()->all();

        return $this->renderAjax('change-multiple', [
            'model' => $model,
            'images' => $images,
            'banners' => $banners,
            'languages' => $languages,
            'page' => $this->page,
            'notUsedLanguages' => $languages,
        ]);
    }

    public function actionDeleteMultiple()
    {
        if (Yii::$app->request->post()) {
            $response = PageContent::deleteMultiple(Yii::$app->request->post());
        } else {
            $response = new AjaxResponse(['status' => 'error', 'message' => 'No post data']);
        }
        return $response->render();
    }
}


