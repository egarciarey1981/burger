<?php

namespace Burger\Catalog\Domain\Model\Image;

interface ImageRepository
{
    public function ofImageId(ImageId $imageId): ?Image;
}