<?php

namespace App\EventListener;

use App\Entity\History;

class HistoryEntityListener
{
    public function preUpdate(History $history): void
    {
        $history->setUpdateTime(new \DateTime());
    }
}