<?php

namespace App\Service;

class SwapService
{
    public function swap(int& $first, int& $second): void
    {
        $first += $second;
        $second -= $first;
        $first += $second;
        $second *= -1;
    }
}