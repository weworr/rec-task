<?php

namespace App\Strategy;

use App\Details\PaginationDetails;
use App\Exception\InvalidData;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\Tools\Pagination\Paginator;

class GetDataPaginatedStrategy implements GetDataStrategyInterface
{
    public function __construct(
        private readonly PaginationDetails $paginationDetails
    )
    {
    }

    public function getData(EntityRepository $repository): array
    {
        $qb = $repository->createQueryBuilder('q');

        $sortBy = $this->paginationDetails->getSortBy();
        if ($sortBy) {
            $qb->orderBy("q.$sortBy", $this->paginationDetails->getSortDirection());
        }

        $paginator = new Paginator($qb->getQuery());

        try {
            return $paginator
                ->getQuery()
                ->setFirstResult($this->paginationDetails->getPage() * $this->paginationDetails->getLimit())
                ->setMaxResults($this->paginationDetails->getLimit())
                ->getArrayResult();
        } catch (QueryException) {
            throw new InvalidData('Invalid sortBy field value');
        }
    }
}