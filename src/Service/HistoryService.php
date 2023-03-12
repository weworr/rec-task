<?php

namespace App\Service;

use App\Entity\History;
use App\Repository\HistoryRepository;
use App\Strategy\GetDataStrategyInterface;

class HistoryService
{
    public function __construct(private readonly HistoryRepository $historyRepository)
    {
    }

    public function getAll(GetDataStrategyInterface $strategy): array
    {
        return $strategy->getData($this->historyRepository);
    }

    public function add(int $first, int $second): History
    {
        $history = new History();
        $history
            ->setFirstIn($first)
            ->setSecondIn($second);

        $this->historyRepository->flush($history);
        return $history;
    }

    public function update(History $history): History
    {
        $this->historyRepository->flush($history);
        return $history;
    }
}