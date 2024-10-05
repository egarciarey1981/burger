<?php

namespace Burger\Catalog\Domain\Model\Category;

use Burger\Catalog\Domain\Model\Image\Image;

class Category
{
    private CategoryId $id;
    private CategoryName $name;
    private ?Image $image;

    public function __construct(
        CategoryId $id,
        CategoryName $name,
        ?Image $image,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'image' => $this->image?->toArray() ?? null,
        ];
    }
}
