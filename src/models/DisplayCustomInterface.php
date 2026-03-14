<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

interface DisplayCustomInterface
{
    public function hasSlides(): bool;

    public function getSlides(): ?SlideCollection;

    public function setSlides(?SlideCollection $slideCollection): void;

    public function getAutoplayMs(): int;

    public function getBoxAlign(): string;

    public function displayNavigationPrevNext(): bool;

    public function displayNavigationDots(): bool;
}
