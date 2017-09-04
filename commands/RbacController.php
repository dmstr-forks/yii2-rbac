<?php
/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2017 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dektrium\rbac\commands;


use dektrium\user\models\User;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Assign role to user
     *
     * @param $roleName
     * @param $userName
     */
    public function actionAssign($roleName, $userName)
    {
        $userModel = new User();
        $user = $userModel->finder->findUserByUsername($userName);
        $manager = \Yii::$app->authManager;
        $role = $manager->getRole($roleName);
        $manager->assign($role, $user->id);
        $this->stdout('Role has been assigned');
        $this->stdout("\n\nDone.\n");
    }

    /**
     * Revoke role from user
     *
     * @param $roleName
     * @param $userName
     */
    public function actionRevoke($roleName, $userName)
    {
        $userModel = new User();
        $user = $userModel->finder->findUserByUsername($userName);
        $manager = \Yii::$app->authManager;
        $role = $manager->getRole($roleName);
        $manager->revoke($role, $user->id);
        $this->stdout('Role has been revoked');
        $this->stdout("\n\nDone.\n");
    }
}