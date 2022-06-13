<?php

namespace App\Model;

use App\Factory\PDOFactory;
use PDO;


class CategoryModel extends BaseModel
{
    public function getAllCategory(): array

    {
        $query = $this->pdo->query('SELECT * FROM'  . PDOFactory::DATABASE . '.category');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS,'App\Entity\Category');
    }
}