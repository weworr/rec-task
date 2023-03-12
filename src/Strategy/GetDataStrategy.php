<?php

namespace App\Strategy;

use Doctrine\ORM\EntityRepository;

class GetDataStrategy implements GetDataStrategyInterface
{
    public function getData(EntityRepository $repository): array
    {
        return $repository->findAll();
    }
}