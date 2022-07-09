<?php

namespace App\Model;

use App\Factory\PDOFactory;
use App\Entity\UserRole;
use PDO;


class UserRoleModel extends BaseModel
{

    public function getRoleName(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . PDOFactory::DATABASE . '.user_role ' . 'WHERE ID = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\UserRole');
        return $query->fetch();
    }

}