<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

include "../../vendor/dodgepudding/wechat-php-sdk/wechat.class.php";
include "../../vendor/dodgepudding/wechat-php-sdk/Thinkphp/EasyWechat.class.php";

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
                'appsecret'=>'3af6ba1b70064c4aad54da48740d1446', //填写高级调用功能的密钥
                'cachedir'=>'./cache/', //填写缓存目录，默认为当前运行目录的子目录cache下
                'logfile'=>'run.log' //填写日志输出文件，可选项。如果没有提供logcallback回调，且设置了输出文件则将日志输出至此文件，如果省略则不输出
            );
        $this->weObj = new \EasyWechat($options);
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
