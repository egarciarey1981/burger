<?php

namespace Burger\Catalog\Domain\Model\Image;

class Image
{
    private ImageId $id;
    private ImageTitle $title;
    private ImageUrl $url;

    public function __construct(
        ImageId $id,
        ImageTitle $title,
        ImageUrl $url,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }

    public function id(): ImageId
    {
        return $this->id;
    }

    public function title(): ImageTitle
    {
        return $this->title;
    }

    public function url(): ImageUrl
    {
        return $this->url;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'title' => (string) $this->title,
            'url' => (string) $this->url,
        ];
    }
}
