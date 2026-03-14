<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

class SlideCollection
{
    /** @var SlideItem[] */
    private array $items = [];

    public function add(SlideItem $slide): void
    {
        $this->items[] = $slide;
    }

    /**
     * @param SlideItem[] $slides
     */
    public function set(array $slides): void
    {
        $this->items = $slides;
    }

    /**
     * @return SlideItem[]
     */
    public function get(): array
    {
        return $this->items;
    }

    public function isEmpty(): bool
    {
        return $this->items === [];
    }
}

