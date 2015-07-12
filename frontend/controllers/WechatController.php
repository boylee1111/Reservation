<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

require "../../vendor/dodgepudding/wechat-php-sdk/wechat.class.php";

/**
 * SpotController implements the CRUD actions for Spot model.
 */
class WechatController extends Controller
{
    private $weObj;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Spot models.
     * @return mixed
     */
    public function actionIndex()
    {
        $options = array(
                'token'=>'carreserver', //填写你设定的key
                // 'encodingaeskey'=>'M6AR96d6zV7pGeUSCoKd6n6sHbSA0olJ05l4lRdWI0Z', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
                'appid'=>'wx83f8a350a1b6a9fc', //填写高级调用功能的app id
                'appsecret'=>'3af6ba1b70064c4aad54da48740d1446' //填写高级调用功能的密钥
            );
        $this->weObj = new \Wechat($options);
        $this->weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
        // $type = $weObj->getRev()->getRevType();
        // switch($type) {
        //  case Wechat::MSGTYPE_TEXT:
        //          $weObj->text("hello, I'm wechat")->reply();
        //          exit;
        //          break;
        //  case Wechat::MSGTYPE_EVENT:
        //          break;
        //  case Wechat::MSGTYPE_IMAGE:
        //          break;
        //  default:
        //          $weObj->text("help info")->reply();
        // }
        //设置菜单
        $newmenu = array(
                "button"=>
                    array(
                        array(
                            'name' => '学员',
                            'sub_button' => array(
                                    array('type'=>'click','name'=>'预约练车','key'=>'MENU_KEY_NEWS'),
                                    array('type'=>'view','name'=>'购买支付','url'=>'http://www.baidu.com?url'),
                                    array('type'=>'view','name'=>'推荐他人','url'=>'http://www.baidu.com'),
                                    array('type'=>'view','name'=>'取消预约','url'=>'http://www.baidu.com'),
                                )
                            ),
                        array(
                            'name' => '教练',
                            'sub_button' => array(
                                    array('type'=>'click','name'=>'推荐学员','key'=>'MENU_KEY_NEWS'),
                                    array('type'=>'view','name'=>'查询推荐人数','url'=>'http://www.baidu.com'),
                                    array('type'=>'view','name'=>'复习要点','url'=>'http://www.baidu.com'),
                                )
                            ),
                        array(
                            'name' => '我的账户',
                            'sub_button' => array(
                                    array('type'=>'click','name'=>'交通路线','key'=>'MENU_KEY_NEWS'),
                                    array('type'=>'view','name'=>'我的记录','url'=>'http://www.baidu.com'),
                                    array('type'=>'view','name'=>'联系客服','url'=>'http://www.baidu.com'),
                                    array('type'=>'view','name'=>'注册','url'=>'http://www.baidu.com'),
                                )
                            ),
                        )
                );
        $result = $this->weObj->createMenu($newmenu);
    }
}
