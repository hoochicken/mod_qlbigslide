<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

class DisplayCustom extends DisplayBasic implements DisplayBasicInterface, DisplayCustomInterface
{
    public ?Registry $params = null;
    public ?stdClass $module = null;
    public ?string $message = null;
    public ?SlideCollection $slides = null;

    public function __construct(Registry $params, stdClass $module)
    {
        parent::__construct($params, $module);
    }

    public function hasSlides(): bool
    {
        return !is_null($this->slides) && !$this->slides->isEmpty();
    }

    public function getSlides(): ?SlideCollection
    {
        return $this->slides;
    }

    public function setSlides(?SlideCollection $slides): void
    {
        $this->slides = $slides;
    }
}
