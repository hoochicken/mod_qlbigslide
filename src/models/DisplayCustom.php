<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

class DisplayCustom extends DisplayBasic implements DisplayBasicInterface, DisplayCustomInterface
{
    private ?SlideCollection $slideCollection = null;

    public function __construct(Registry $params, stdClass $module)
    {
        parent::__construct($params, $module);
    }

    public function hasSlides(): bool
    {
        return !is_null($this->slideCollection) && $this->slideCollection->hasSlides();
    }

    public function getSlides(): ?SlideCollection
    {
        return $this->slideCollection;
    }

    public function setSlides(?SlideCollection $slideCollection): void
    {
        $this->slideCollection = $slideCollection;
    }
}
