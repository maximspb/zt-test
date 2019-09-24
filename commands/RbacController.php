<?php

namespace app\commands;


use app\models\User;
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

        $adminModel = User::findOne(['username' => 'admin']);

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

        $auth->assign($admin, $adminModel->getId());

        $editor1 = User::findOne(['username' => 'editor1']);
        if (!empty($editor1)) {
            $auth->assign($editor, $editor1->getId());
        } else {
            $editor1 = new User();
            $editor1->username = 'editor1';
            $editor1->email = env('EDITOR_EMAIL');
            $editor1->setPassword(env('EDITOR_PASSWORD'));
            $editor1->generateAuthKey();
            if ($editor1->save()) {
                $auth->assign($editor, $editor1->getId());
            }
        }

        return true;
    }
}
