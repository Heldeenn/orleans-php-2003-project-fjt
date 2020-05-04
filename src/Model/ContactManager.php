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
    const TABLE = 'contacts';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $data
     * @return int
     */
    public function insert(array $data): int
    {
        $sendTimeMessage = new DateTime();

        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`lastname`, `firstname`, `email`, `phone`, `message`, 'sendDate') VALUES (:lastname, :firstname, :email, :phone, :message, :sendTimeMessage)");
        $statement->bindValue('lastname', $data['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $data['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('email', $data['email'], \PDO::PARAM_STR);
        $statement->bindValue('phone', $data['phone'], \PDO::PARAM_INT);
        $statement->bindValue('message', $data['message'], \PDO::PARAM_STR);
        $statement->bindValue('sendTimeMessage', $sendTimeMessage);


        $statement->execute();
    }
}
