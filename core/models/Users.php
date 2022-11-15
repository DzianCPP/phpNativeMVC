<?php

namespace core\models;

use PDO;
use core\application\Database;

class Users
{
    private PDO $conn;
    private Database $database;
    private Validator $validator;

    public function __construct()
    {
        $this->database = new Database();
        $this->validator = new Validator();
        $this->conn = $this->database->getConnection();
    }

    public function insertNewUser(): bool
    {
        $email = $this->validator->makeDataSafe($_POST['email']);
        $fullName = $this->validator->makeDataSafe($_POST['name']);
        $gender = $this->validator->makeDataSafe($_POST['gender']);
        $status = $this->validator->makeDataSafe($_POST['status']);

        if (!$this->validator->userDataValid($email, $fullName)) {
            return false;
        }

        $query = $this->conn->prepare("INSERT INTO usersTable (email, fullName, gender, status)
                                                VALUES ('$email', '$fullName', '$gender', '$status')");

        $query->execute();
        return true;
    }

    public function getAllUsers(): array
    {
        $query = $this->conn->prepare("SELECT * FROM usersTable");
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();

        return $result;
    }

    public function getUserById(int $id): array
    {
        $query = $this->conn->prepare("SELECT * FROM usersTable WHERE userID = $id");
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();

        return $result[0];
    }

    public function editUser($newUserData): bool
    {
        $newEmail = $newUserData['newEmail'];
        $newFullName = $newUserData['newFullName'];
        $newGender = $newUserData['newGender'];
        $newStatus = $newUserData['newStatus'];
        $userID = $newUserData['newUserID'];
        $sqlQuery = "UPDATE usersTable SET email='$newEmail', fullName='$newFullName', gender='$newGender', status='$newStatus' WHERE userID='$userID'";
        $query = $this->conn->prepare($sqlQuery);
        $query->execute();
        return true;
    }

    public function delete(int $id): bool
    {
        $sqlQuery = "DELETE FROM usersTable WHERE userID=$id";
        $query = $this->conn->prepare($sqlQuery);
        if (!$query->execute()) {
            return false;
        }

        return true;
    }
}