<?php

namespace core\controllers;
use core\models\Users;
use function MongoDB\BSON\fromJSON;

class UserController extends BaseController
{
    public function create(): void
    {
        $users = new Users();
        if ($users->insertNewUser()) {
            $this->show();
        } else {
            $email = $_POST['email'];
            $fullName = $_POST['name'];
            $this->new($email, $fullName);
        }
    }

    public function new(string $email = '', string $fullName = ''): void
    {
        $this->render("main", "forms/new");
    }

    public function show(): void
    {
        $usersModel = new Users();
        $allUsers = $usersModel->getAllUsers();
        $this->render("main", "tables/users", $allUsers);
    }

    public function showById(): void
    {
        $users = new Users();
        $userID = $_GET['userID'];
        $userID = ltrim(rtrim($userID, '}'), '{');
        $user = $users->getUserById($userID);
        $this->render("main", "tables/users", $user);
    }

    public function editUser(): void
    {
        $users = new Users();
        $userID = $_GET['userID'];
        $userID = rtrim($userID, '}');
        $userID = ltrim($userID, '{');
        $userToEdit = $users->getUserById($userID);
        $this->render("main", "forms/edit", $userToEdit[0]);
    }

    public function update(): void
    {
        $jsonString = file_get_contents("php://input");
        $newUserInfo = json_decode($jsonString, true);
        $users = new Users();
        if ($users->editUser($newUserInfo)) {
            http_response_code(200);
            $this->show();
        }
    }

    public function delete(): void
    {
        $jsonString = file_get_contents("php://input");
        $id = json_decode($jsonString, true);
        $id = $id['userID'];
        $id = ltrim($id, "\"");
        $id = rtrim($id, "\"");
        $users = new Users();
        if ($users->delete($id)) {
            http_response_code(200);
        }
    }
}