<?php

namespace Hoochicken\Module\Qlbigslide\Site\models;

use Joomla\Registry\Registry;
use stdClass;

interface DisplayInterface
{
    public function toArray(): array;

    public function showTitle(): bool;

    public function hasErrors(): bool;

    public function getParams(): ?Registry;

    public function setParams(?Registry $params): void;

    public function getModule(): ?stdClass;

    public function setModule(?stdClass $module): void;

    public function getMessage(): ?string;

    public function setMessage(?string $message): void;

    public function getErrors(): array;

    public function setErrors(array $errors): void;
}
