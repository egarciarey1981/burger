<?php

namespace Burger\Catalog\Domain\Model\Image;

interface ImageRepository
{
    public function ofImageId(ImageId $id, bool $throwException = false): ?Image;
}