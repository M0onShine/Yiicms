<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use anerg\OAuth2\OAuth;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','qq-login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * @return mixed
     * qq登录
     */
    public function actionQqLogin() {
        $this->layout = 'main-login';
        $config = [
            'app_key'    => '101453644',
            'app_secret' => 'd26957e410044304d95370af4879823b',
            'scope'      => 'get_user_info',
            'callback'   => [
                'default' => 'http://xxx.com/sns_login/callback/qq',
                'mobile'  => 'http://h5.xxx.com/sns_login/callback/qq',
            ]
        ];
        $OAuth  = OAuth::getInstance($config, 'qq');
        //$OAuth->setDisplay('mobile'); //此处为可选,若没有设置为mobile,则跳转的授权页面可能不适合手机浏览器访问
        return $this->redirect($OAuth->getAuthorizeURL());
    }

    public function actionCallback($channel) {
        $config   = [
            'app_key'    => 'xxxxxx',
            'app_secret' => 'xxxxxxxxxxxxxxxxxxxx',
            'scope'      => 'get_user_info',
            'callback'   => [
                'default' => 'http://xxx.com/sns_login/callback/qq',
                'mobile'  => 'http://h5.xxx.com/sns_login/callback/qq',
            ]
        ];
        $OAuth    = OAuth::getInstance($config, $channel);
        $OAuth->getAccessToken();
        /**
         * 在获取access_token的时候可以考虑忽略你传递的state参数
         * 此参数使用cookie保存并验证
         */
//        $ignore_stat = true;
//        $OAuth->getAccessToken(true);
        $sns_info = $OAuth->userinfo();
        /**
         * 此处获取了sns提供的用户数据
         * 你可以进行其他操作
         */
    }
}
