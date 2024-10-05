<?php

namespace Burger\Catalog\Infrastructure\Persistence\InMemory;

use Burger\Catalog\Domain\Model\Image\Image;
use Burger\Catalog\Domain\Model\Image\ImageId;
use Burger\Catalog\Domain\Model\Image\ImageNotFoundException;
use Burger\Catalog\Domain\Model\Image\ImageUrl;
use Burger\Catalog\Domain\Model\Image\ImageRepository;
use Burger\Catalog\Domain\Model\Image\ImageTitle;

class InMemoryImageRepository implements ImageRepository
{
    private array $images = [];

    public function __construct()
    {
        $this->images[] = new Image(
            new ImageId('burgers'),
            new ImageTitle('Burgers'),
            new ImageUrl('https://cdn.auth0.com/blog/whatabyte/burger-sm.png'),
        );
        $this->images[] = new Image(
            new ImageId('drinks'),
            new ImageTitle('Drinks'),
            new ImageUrl('https://cdn.auth0.com/blog/whatabyte/drinks-sm.png'),
        );
        $this->images[] = new Image(
            new ImageId('starters'),
            new ImageTitle('Starters'),
            new ImageUrl('https://cdn.auth0.com/blog/whatabyte/starters-sm.png'),
        );
    }

    public function ofImageId(ImageId $imageId): Image
    {
        foreach ($this->images as $image) {
            if ($image->id()->equals($imageId)) {
                return $image;
            }
        }

        throw new ImageNotFoundException('Image of id `' . $imageId->value() . '` not found');
    }
}