<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

class SlideItem
{
    private bool $display;
    private string $image;
    private string $title;
    private string $text;

    public function isDisplay(): bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): void
    {
        $this->display = $display;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}

