<?php

namespace core\models;

use PDO;
use core\application\Database;

class Users
{
    private PDO $conn;
    private Database $database;
    private Validator $validator;
    private SqlPreparer $sqlPreparer;
    private array $sqlQueries;

    public function __construct()
    {
        $this->database = new Database();
        $this->validator = new Validator();
        $this->sqlPreparer = new SqlPreparer();
        $this->sqlQueries = require "sqlQueries.php";
        $this->conn = $this->database->getConnection();
    }

    public function insertNewUser(): bool
    {
        $params = array (
                'email' => $this->validator->makeDataSafe($_POST['email']),
            'fullName' => $this->validator->makeDataSafe($_POST['name']),
            'gender' => $this->validator->makeDataSafe($_POST['gender']),
            'status' => $this->validator->makeDataSafe($_POST['status'])
        );

        if (!$this->validator->userDataValid($params['email'], $params['fullName'])) {
            return false;
        }

        $query = $this->sqlPreparer->prepareInsertSql($params, $this->conn);
        if (!$query->execute()) {
            return false;
        }
        return true;
    }

    public function getAllUsers(): array
    {
        $query = $this->sqlPreparer->prepareSelectAllSql($this->conn);
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();
        return $result;
    }

    public function getUserById(int $id): array
    {
        $query = $this->sqlPreparer->prepareSelectById($id, $this->conn);
        $query->execute();
        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();

        return $result[0];
    }

    public function editUser($newUserData): bool
    {
        $params = array(
            'newEmail' => $newUserData['newEmail'],
        'newFullName' => $newUserData['newFullName'],
        'newGender' => $newUserData['newGender'],
        'newStatus' => $newUserData['newStatus'],
        'userID' => $newUserData['newUserID']
        );

        $query = $this->sqlPreparer->prepareUpdateSql($params, $this->conn);
        if (!$query->execute()) {
            return false;
        }
        return true;
    }

    public function delete(int $id): bool
    {
        $query = $this->sqlPreparer->prepareDeleteSql($id, $this->conn);
        if (!$query->execute()) {
            return false;
        }

        return true;
    }

    public function seedData(array $data): bool
    {
        $params = array (
                'email' => $data['email'],
            'fullName' => $data['fullName'],
            'gender' => $data['gender'],
            'status' => $data['status']
        );

        $query = $this->sqlPreparer->prepareInsertSql($params, $this->conn);
        if (!$query->execute()) {
            return false;
        }

        return true;
    }
}