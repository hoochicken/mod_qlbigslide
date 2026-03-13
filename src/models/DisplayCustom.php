<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

class DisplayCustom extends DisplayBasic implements DisplayBasicInterface, DisplayQlbigslideInterface
{
    public ?Registry $params = null;
    public ?stdClass $module = null;
    public ?string $message = null;
    /** @var ErrorModel[] */
    public array $errors = [];

    public function __construct(Registry $params, stdClass $module)
    {
        parent::__construct($params, $module);
    }
}
