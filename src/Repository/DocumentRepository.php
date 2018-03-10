<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DocumentRepository
 * @package App\Repository
 */
class DocumentRepository extends EntityRepository
{
    /**
     * Add a default sort
     * @return array
     */
    public function findAll()
    {
        return $this->findBy([], ['status' => 'ASC', 'createdAt' => 'DESC']);
    }

}