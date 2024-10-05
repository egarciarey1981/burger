<?php

namespace Burger\Catalog\Domain\Model\Category;

class Category
{
    private CategoryId $id;
    private CategoryName $name;
    private CategoryImageUrl $imageUrl;

    public function __construct(CategoryId $id, CategoryName $name, CategoryImageUrl $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }

    public function imageUrl(): CategoryImageUrl
    {
        return $this->imageUrl;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => (string) $this->name,
            'image_url' => (string) $this->imageUrl,
        ];
    }
}
