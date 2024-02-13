<?php

declare(strict_types=1);

namespace App\Service;


class PaginationUtils
{
    public static function calculateOffset(int $page, int $pageLimit): int
    {
        return max($page - 1, 0) * $pageLimit;
    }
}
