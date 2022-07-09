<?php

namespace App\Entity;

class UserRole extends BaseEntity
{

    private int $id;
    private string $name;

     /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

     /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string 
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}