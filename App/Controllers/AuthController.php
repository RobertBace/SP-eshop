<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\DB\Connection;
use App\Core\Responses\Response;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use http\Message;

$layout = 'auth';

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['email'], $formData['password']);
            if ($logged) {
                return $this->redirect('index.php');
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý email alebo heslo!'] : []);
        return $this->html($data);
    }

    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect('index.php');
    }

    public function registration(): Response
    {
        return $this->html();
    }

    public function registered(): Response
    {
        return $this->html();
    }

    public function create(): Response
    {
        return $this->html();
    }

    /**
     * Store a user
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\ViewResponse
     */
    public function store(): Response
    {
        $password = password_hash($this->request()->getValue('password'), PASSWORD_DEFAULT);
        $email = $this->request()->getValue('email');
        $username = $this->request()->getValue('username');
        $id = $this->request()->getValue('id');

        $sql = "SELECT email FROM users WHERE email = ?";
        $query = Connection::connect()->prepare($sql);
        $query->execute([$email]);

        $fetchedData = $query->fetch();

        if (!$fetchedData) {
            if ($this->request()->getValue('password') != $this->request()->getValue('repassword')) {

                $data = ['message' => 'Heslá sa nezhodujú!', 'email' => $email, 'username' => $username];
                return $this->html($data, viewName: 'registration');
            } else if (!(is_string($username) &&
                str_contains($email, "@") && strlen($username) <= 20)) {
                $data = ['message' => 'Nespravne zadané vstupné údaje!', 'email' => $email, 'username' => $username];
                return $this->html($data, viewName: 'registration');
            } else {
                $user = new User();

                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword($password);

                $user->save();

                return $this->redirect('?c=auth&a=registered');
            }
        } else {
            //$data = ($fetchedData === false ? ['message' => 'Zlý email alebo heslo!'] : []);
            $data = ['message' => 'Zadaný email už existuje!', 'email' => $email, 'username' => $username];
            return $this->html($data, viewName: 'registration');
        }

    }

    public function edit()
    {
        return $this->html();
    }


    public function storeEdit(): Response
    {
        $password = password_hash($this->request()->getValue('oldPassword'), PASSWORD_DEFAULT);
        $username = $this->request()->getValue('username');

        $user = User::getOne($this->app->getAuth()->getLoggedUserId());

        if ($this->app->getAuth()->login($user->getEmail(), $this->request()->getValue('oldPassword'))) {
            if ($this->request()->getValue('password') != $this->request()->getValue('repassword')) {
                $data = ['message' => 'Heslá sa nezhodujú!'];
                return $this->html($data, viewName: 'edit');

            } else if (!(is_string($username) && strlen($username) <= 20)) {
                $data = ['message' => 'Nespravne zadané vstupné údaje!'];
                return $this->html($data, viewName: 'edit');
            } else {
                $user->setUsername($username);
                if ($this->request()->getValue('password') != null) {
                    $user->setPassword(password_hash($this->request()->getValue('password'), PASSWORD_DEFAULT));
                }

                $user->save();

                return $this->redirect('index.php');
            }
        } else {
            $data = ['message' => 'Stare heslo sa nehoduje!'];
            return $this->html($data, viewName: 'edit');
        }

    }

    public function emailCheck()
    {
        $message = $this->request()->getValue('message');
        $emails = User::getAll("email = ?", [$message]);

        if(sizeof($emails) == 0){
            return $this->json(['duplicity' => false]);
        } else {
            return $this->json(['duplicity' => true]);
        }
    }
}