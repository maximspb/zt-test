<?php

namespace app\commands;


use app\models\Proxy;
use app\models\User;
use Faker\Factory;
use Faker\Provider\Internet;
use Yii;
use yii\console\Controller;

/**
 * Заполнение базы тестовыми данными
 * Class SeedController
 * @package app\commands
 */
class SeedController extends Controller
{
    private $testPassword = '123456';

    /**
     * Добавление тестовых пользователей в базу
     * @return bool
     */
    public function actionUsers()
    {
        $faker = Factory::create();
        $auth = Yii::$app->authManager;
        $editorRole = $auth->getRole('editor');
        $adminRole = $auth->getRole('admin');

        try {
            /*Создаем второго админа, если его нет в базе*/
            $secondAdmin = User::findOne(['username' => 'admin2']);

            if (empty($secondAdmin)) {
                $admin2 = new User();
                $admin2->username = 'admin2';
                $admin2->email = $faker->email;
                $admin2->setPassword($this->testPassword);
                $admin2->generateAuthKey();

                if ($admin2->save()) {
                    $auth->assign($adminRole, $admin2->getId());
                }
            }


            for ($i = 1; $i <= 5; $i++) {
                /*Создаем тестовых юзеров с ролью Редактора*/
                $user = new User();
                $user->username = $faker->username;
                $user->email = $faker->email;
                $user->generateAuthKey();
                $user->setPassword($this->testPassword);
                if ($user->save()) {
                    $auth->assign($editorRole, $user->getId());
                }
            }

            return true;
        } catch (\Throwable $exception) {
            echo $exception->getMessage();

            return false;
        }
    }

    /**
     * Добавление тестовых прокси (с рандомными данными)
     * @return bool
     */
    public function actionProxies()
    {
        try {
            for ($i = 1; $i <= 10; $i++) {
                $randomIp = long2ip(rand(0, "4294967295"));
                $randomPort = random_int(20, 49151);

                $proxy = new Proxy();
                $proxy->ip = $randomIp;
                $proxy->port = $randomPort;
                $proxy->save();

            }

            return true;
        } catch (\Throwable $exception) {
            echo $exception->getMessage();

            return false;
        }
    }
}