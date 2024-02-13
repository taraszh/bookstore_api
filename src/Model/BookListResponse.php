<?php

namespace App\Model;

class BookListResponse
{
    const MAX_ITEMS_PER_PAGE = 20;
    
    /**
     * @param BookListItem[] $items
     */
    public function __construct(private readonly array $items)
    {
    }

    /**
     * @return BookListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}