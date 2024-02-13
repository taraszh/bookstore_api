<?php

namespace App\Model;

class AuthorListResponse
{
    const MAX_ITEMS_PER_PAGE = 20;
    
    /**
     * @param AuthorListItem[] $items
     */
    public function __construct(private readonly array $items)
    {
    }

    /**
     * @return AuthorListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}