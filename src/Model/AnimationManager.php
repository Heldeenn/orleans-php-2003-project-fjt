<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class AnimationManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'animation';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $animation
     * @return int
     */
    public function insert(array $animation): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `description`, `image`)
        VALUES (:name, :description, :image)");
        $statement->bindValue('name', $animation['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $animation['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $animation['image'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}
