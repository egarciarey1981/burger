<?php

namespace Burger\Catalog\Domain\Model\Image;

class Image
{
    private ImageId $id;
    private ImageTitle $title;
    private ImageUrl $url;

    public function __construct(
        ImageId $id,
        ImageUrl $url,
        ?ImageTitle $title,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }

    public function id(): ImageId
    {
        return $this->id;
    }

    public function url(): ImageUrl
    {
        return $this->url;
    }

    public function title(): ?ImageTitle
    {
        return $this->title;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'url' => (string) $this->url,
            'title' => is_null($this->title) ? null : (string) $this->title,
        ];
    }
}
