<?php

namespace App\Auth;

use App\Core\DB\Connection;
use App\Core\IAuthenticator;

/**
 * Class DummyAuthenticator
 * Basic implementation of user authentication
 * @package App\Auth
 */
class DummyAuthenticator implements IAuthenticator
{
    const LOGIN = "admin";
    const PASSWORD_HASH = '$2y$10$GRA8D27bvZZw8b85CAwRee9NH5nj4CQA6PDFMc90pN9Wi4VAWq3yq'; // admin
    const USERNAME = "Admin";

    /**
     * DummyAuthenticator constructor
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Verify, if the user is in DB and has his password is correct
     * @param $email
     * @param $password
     * @return bool
     * @throws \Exception
     */
    function login($email, $password): bool
    {
        $sql = "SELECT email, password, username, id FROM users WHERE email = ?";
        $query = Connection::connect()->prepare($sql);
        $query->execute([$email]);

        $fetchedData = $query->fetch();

        if(!$fetchedData){
            return false;
        }

        if ($email == $fetchedData['email'] && password_verify($password,$fetchedData['password'])) {
            $_SESSION['user'] = $fetchedData['id'];
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logout the user
     */
    function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    /**
     * Get the name of the logged-in user
     * @return string
     */
    function getLoggedUserName(): string
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }

    /**
     * Get the context of the logged-in user
     * @return string
     */
    function getLoggedUserContext(): mixed
    {
        return null;
    }

    /**
     * Return if the user is authenticated or not
     * @return bool
     */
    function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }

    /**
     * Return the id of the logged-in user
     * @return mixed
     */
    function getLoggedUserId(): mixed
    {
        //return $_SESSION['user'];
        return isset($_SESSION['user']) ? $_SESSION['user'] : throw new \Exception("User not logged in");
    }
}