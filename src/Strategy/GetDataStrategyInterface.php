<?php

namespace App\Strategy;

use Doctrine\ORM\EntityRepository;

interface GetDataStrategyInterface
{
    public function getData(EntityRepository $repository): array;
}