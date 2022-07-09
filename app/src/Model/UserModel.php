<?php

namespace App\Model;

use App\Entity\User;
use App\Factory\PDOFactory;
use PDO;


class UserModel extends BaseModel
{

    public function getAllUsers(): array
    {
        $query = $this->pdo->query('SELECT * FROM ' . PDOFactory::DATABASE . '.users');
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\User');
        return $query->fetchAll();
    }

    public function getUserByEmail(string $email): user|bool
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . PDOFactory::DATABASE . '.users WHERE email=?');
        $query->bindvalue(':email', $email, \PDO::PARAM_STR);
        $query->execute([$email]);
        $query-> setFetchMode(\PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'App\Entity\user');
        $user = $query->fetch();
        if ($user) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUserExistCheck(string $email): bool
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ' . PDOFactory::DATABASE . '. users WHERE email=?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function addUser(user $user): bool
    {
        $query = $this->pdo->prepare('INSERT INTO ' . PDOFactory::DATABASE . '.users (email, password, id_role, nb_creation, date_inscription) VALUES (:email, :password, :id_role, :nb_creation, :date_inscription)');
        $query->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $query->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $query->bindValue(':id_role', $user->getIdRole(), \PDO::PARAM_STR);
        $query->bindValue(':nb_creation', $user->getNbCreation(), \PDO::PARAM_STR);
        $query->bindValue(':date_inscription', $user->getDateInscription(), \PDO::PARAM_STR);
        return $query->execute();
    }


}