<?php

namespace app\commands;


use Yii;
use yii\console\Controller;

/**
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
    /**
     * @throws \yii\base\Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $importProxies = $auth->createPermission('importProxies');
        $importProxies->description = 'Импортировать список прокси из файла';
        $auth->add($importProxies);

        $seeProxies = $auth->createPermission('seeProxies');
        $seeProxies->description = 'Импортировать список прокси из файла';
        $auth->add($seeProxies);

        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $importProxies);
        $auth->addChild($editor, $seeProxies);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $editor);

        $auth->assign($admin, 1);
    }
}
