<?php

namespace App\Model;

/**
 *
 */
class ContactManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'contact';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $data
     * @return void
     */
    public function insert(array $data): void
    {

        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`lastname`, `firstname`, `email`, `phone`, `message`, `sendDate`) 
            VALUES (:lastname, :firstname, :email, :phone, :message, NOW())");
        $statement->bindValue('lastname', $data['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $data['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('email', $data['email'], \PDO::PARAM_STR);
        $statement->bindValue('phone', $data['phone'], \PDO::PARAM_INT);
        $statement->bindValue('message', $data['message'], \PDO::PARAM_STR);

        $statement->execute();
    }

    public function selectAllContacts(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table . ' ORDER BY sendDate DESC')->fetchAll();
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
