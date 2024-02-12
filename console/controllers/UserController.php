<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{
    public function actionCreate($email, $username, $password): int
    {
        $user = new User();
        $user->email = $email;
        $user->username = $username;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->generateAuthKey();
        if (!$user->save()) {
            var_dump($user->getErrors());
            throw new \Exception("User not saved!");
        };
        return ExitCode::OK;
    }
}