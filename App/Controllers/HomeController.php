<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Order;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        return $this->html();
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function contact(): Response
    {
        return $this->html();
    }

    public function indicate()
    {
        if($this->app->getAuth()->isLogged()){
            if($this->app->getAuth()){
                $userId = $this->app->getAuth()->getLoggedUserId();
                $count = Order::getAll("status = ? and user = ?", ['Prebieha', $userId])[0]->getCountOfProduct();
                return $this->json(['count' => $count]);
            } else {
                return $this->json(['count' => 0]);
            }
        } else {
            return $this->json(['count' => 0]);
        }
    }
}