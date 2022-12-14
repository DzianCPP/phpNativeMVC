<?php

namespace core\models;

class UsersDatabaseModel implements ModelInterface
{
    private const TABLE_NAME = "usersTable";
    protected array $fields = ['email', 'name', 'gender', 'status', 'id'];
    private Validator $validator;

    private DatabaseSqlBuilder $sqlBuilder;

    public function __construct()
    {
        $this->sqlBuilder = new DatabaseSqlBuilder();
        $this->validator = new Validator();
    }

    public function get(int|string $value = NULL): array
    {
        if ($value) {
            return $this->sqlBuilder->select(self::TABLE_NAME, column: "id", value: $value);
        }

        return $this->sqlBuilder->select(self::TABLE_NAME);
    }

    public function create(string $newRecordInfo = NULL): bool
    {
        $newUserInfo = json_decode($newRecordInfo, true);

        $newUserInfo = $this->validator->makeDataSafe($newUserInfo);
        if (!$this->validator->userDataValid($newUserInfo['email'], $newUserInfo['name'])) {
            return false;
        }

        $columns = [];
        foreach ($this->fields as $field) {
            if ($field != 'id') {
                $columns[] = $field;
            }
        }

        if (!$this->sqlBuilder->insert(recordInfo: $newUserInfo, fields: $columns, tableName: self::TABLE_NAME)) {
            return false;
        }

        return true;
    }

    public function update(array $newInfo): bool
    {
        $newUserInfo = $this->validator->makeDataSafe($newInfo);

        if (!$this->validator->userDataValid($newUserInfo['email'], $newUserInfo['name'])) {
            return false;
        }

        if (!$this->sqlBuilder->update(self::TABLE_NAME, $this->fields, column: "id", recordInfo: $newUserInfo)) {
            return false;
        }

        return true;
    }

    public function delete(int ...$ids): bool
    {
        $jsonString = file_get_contents("php://input");
        $ids = json_decode($jsonString, true);

        if (count($ids) < 1) {
            return false;
        }

        if (!$this->sqlBuilder->delete(
            column: "id",
            values: $ids,
            tableName: self::TABLE_NAME
        )) {

            return false;
        }

        return true;
    }

    public function seedUsers(array $data): bool
    {
        $userInfo = [
            'email' => $data['email'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'status' => $data['status']
        ];

        $columns = [];
        foreach ($this->fields as $field) {
            if ($field != 'id') {
                $columns[] = $field;
            }
        }

        if (!$this->sqlBuilder->insert($userInfo, $columns, self::TABLE_NAME)) {
            return false;
        }

        return true;
    }
}
