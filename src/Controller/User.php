<?php
/**
 * @noinspection ALL
 */

declare(strict_types=1);

namespace Controller;

use Exception;
use Model\User as UserModel;
use Model\View;

class User extends AbstractController
{
    /**
     * @todo Sanitize input
     * @return void
     */
    public function actionLogin(): void
    {
        if (!empty($email = $_POST['email']) && !empty($password = $_POST['password'])) {
            $user = UserModel::findOneByColumns(['email' => $email, 'password' => \md5($password)]);
            if (!$user) {
                throw new Exception(\sprintf('User with these credentials not found: "%s", "%s".', $email, $password));
            }
            $_SESSION['user'] = $user->email;

            $this->redirect('survey/all');
        } else {
            $view = new View();
            $view->title = 'Login page';
            $view->display('user/login');
        }
    }

    /**
     * @return void
     */
    public function actionLogout(): void
    {
        unset($_SESSION['user']);
        $this->redirect('/');
    }

    /**
     * @todo Sanitize input
     * @return void
     */
    public function actionRegister(): void
    {
        if (!empty($email = $_POST['email']) && !empty($password = $_POST['password'])) {
            $user = UserModel::findOneByColomn('email', $email);
            if ($user) {
                throw new Exception(\sprintf('User with this email already exists: "%s".', $email));
            }

            $user = new UserModel();
            $user->email = $email;
            $user->password = \md5($password);
            $user->insert();

            $this->redirect('user/login');
        } else {
            $view = new View();
            $view->title = 'Register page';
            $view->display('user/register');
        }
    }
}
