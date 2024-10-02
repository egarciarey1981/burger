<?php

namespace Burger\Catalog\Application\Service\Product;

class ViewProductRequest
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
