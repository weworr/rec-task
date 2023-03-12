<?php

namespace App\Service;

use App\Entity\History;
use App\Repository\HistoryRepository;

class HistoryService
{
    public function __construct(private readonly HistoryRepository $historyRepository)
    {
    }

    public function getAll(): array
    {
        return $this->historyRepository->findAll();
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