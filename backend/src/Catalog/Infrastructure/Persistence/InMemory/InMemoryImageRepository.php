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

    public function __construct($images = [])
    {
        if (empty($images)) {
            $this->initialize();
        } else {
            $this->images = $images;
        }
    }

    public function ofImageId(ImageId $id, bool $throwException = false): ?Image
    {
        foreach ($this->images as $image) {
            if ($image->id()->equals($id)) {
                return $image;
            }
        }

        if ($throwException) {
            throw new ImageNotFoundException('Image of id ' . $id->value() . ' not found');
        } else {
            return null;
        }
    }

    private function initialize(): void
    {
        $data = [
            [
                'id' => 'burgers',
                'title' => 'Burgers',
                'url' => 'https://cdn.pixabay.com/photo/2016/03/05/19/02/hamburger-1238246__480.jpg',
            ],
            [
                'id' => 'burger',
                'title' => 'Burger',
                'url' => 'https://cdn.pixabay.com/photo/2016/03/05/19/02/hamburger-1238246__480.jpg',
            ],
            [
                'id' => 'cheeseburger',
                'title' => 'Cheeseburger',
                'url' => 'https://cdn.pixabay.com/photo/2016/03/05/19/02/hamburger-1238246__480.jpg',
            ],
            [
                'id' => 'starters',
                'title' => 'Starters',
                'url' => 'https://cdn.pixabay.com/photo/2016/11/18/17/20/bar-snacks-1836310__480.jpg',
            ],
        ];

        foreach ($data as $image) {
            $this->images[] = new Image(
                new ImageId($image['id']),
                new ImageUrl($image['url']),
                new ImageTitle($image['title']),
            );
        }
    }
}
