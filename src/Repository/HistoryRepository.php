<?php

namespace App\Repository;

use App\Entity\History;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class HistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, History::class);
    }

    public function flush(History $history): void
    {
        $this->_em->persist($history);
        $this->_em->flush();
    }

    public function findAll()
    {
        $qb = $this->createQueryBuilder('q');

        return $qb
            ->getQuery()
            ->getArrayResult();
    }
}